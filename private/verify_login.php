<?php
session_start();
class verifyLogin
{
    public $db;
    public $info = [];
    public $match = [];
    public $securityPwd;
    public $fetch;
    public $get;

    function __construct()
    {
        $this->info = array("email" => "", "password" => "", "emailError" => "", "passwordError" => "",
                            "errorStatus" => true, "disableAccount" => false, "sameLogin" => false, "userID" => "");
        include_once 'autoloader.php';
        Autoloader::push();
        $this->db = dbConnect::connect();
        $this->securityPwd = new hashedPass();
        $this->fetch = new fetch($this->db);
        $this->get = new getInfo($this->db);
        $this->verify();
    }

    public function verify()
    {
        $this->info["email"] = $this->verifyInput($_GET["email"]);
        $this->info["password"] = $this->verifyInput($_GET["password"]);
        $this->info["errorStatus"] = false;


        if (!isset($this->info["email"]) || empty($this->info["email"])) {
            $this->info["emailError"] = "Ce champ est vide !";
            $this->info["errorStatus"] = true;
        } elseif (!$this->isEmail($this->info["email"])) {
            $this->info["emailError"] = "email invalide !";
            $this->info["errorStatus"] = true;
        }
        if (!isset($this->info["password"]) || empty($this->info["password"])) {
            $this->info["passwordError"] = "Ce champ est vide !";
            $this->info["errorStatus"] = true;
        }


        if ($this->info["errorStatus"] === false) {
            $email = $this->info["email"];
            $SQL = "SELECT password FROM login WHERE email = '$email'";
            $this->fetch->query($SQL, $this->match);
            if (count($this->match) !== 1 || $this->securityPwd->samePwd($this->info["password"], $this->match[0]["password"])) {
                $this->info["sameLogin"] = true;
                $this->info["errorStatus"] = true;
            }else{
                $this->isActiveAccount();
            }
        }


        if ($this->info["errorStatus"] === false && $this->info["sameLogin"] === false) {
            $userinfo = $this->get->userInfo($this->info["email"]);
            $_SESSION['id'] = $userinfo[0]['id'];
            $this->info["userID"] = $userinfo[0]['id'];
        }

        $this->info["password"] = $this->securityPwd->hash($this->info["password"]);
        echo json_encode($this->info);
    }

    public function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    public function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

    public function isActiveAccount()
    {
        if (empty($this->info["emailError"])) {
            $isActive = $this->get->userInfo($this->info["email"])[0]["not_active"];

            if ($isActive === "1") {
                $this->info["disableAccount"] = true;
                $this->info["errorStatus"] = true;
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }


    }
}

$obj = new verifyLogin();
dbConnect::disconnect();