<?php
session_start();
require_once 'autoloader.php';
Autoloader::push();
$db = dbConnect::connect();

$userInfo = new getInfo($db);
$obj = new verify_update();
$status = $userInfo->sessionInfo()[0]["not_active"];

// deactivate the account or reactivate it depending on the status => change active column value in the db
if ($status === "0") {
   $obj->disableProfile("not_active = 1");
  header("Location: " . "../Connection");
}else{
   $obj->disableProfile("not_active = 0");
    header("Location: " . "../Profil/?id=".$_SESSION['id']);
}
dbConnect::disconnect();