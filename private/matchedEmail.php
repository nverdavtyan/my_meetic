<?php
class matchedEmail
{
    public $db;
    public $fetch;
    public $arrEmail = [];

    function __construct()
  {
      require_once 'autoloader.php';
      Autoloader::push();
      $this->db = dbConnect::connect();
      $this->fetch = new fetch($this->db);

  }

    public function email($email)
    {
        $SQL = "SELECT email FROM login WHERE email = '$email'";
        $this->fetch->query($SQL, $this->arrEmail);
        if(empty($this->arrEmail)){
            return false;
        }else{
            return true;
        }
    }

}
dbConnect::disconnect();