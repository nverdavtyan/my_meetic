<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyMeetic</title>
    <link rel="icon" href="../public/assets/images/favico-e2902aad538.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/CSS/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="../public/js/signAjax.js"></script>
</head>
<body class="bg-white">
<?php
require_once "../private/autoloader.php";
Autoloader::push();
$db = dbConnect::connect();
$getInfo = new getInfo($db);
?>
<div class="welcome start__page">
        <div class="container-fluid start__page--container">
            <div class="logo_container">
                <span id="logotitle">MY</span>
                <img class="logo__home" src="../public/assets/images/pinkwhite-44d5e901294.svg"   alt="logo my meetic">
            </div>

            
            <div class="btn__container">
           
                <form id="connect-form" method="get" >
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Email" id="email" >
                    <p class="error-msg"></p>
                    <label for="password">Password</label>
                    <input type="password" name="password"  placeholder="Password"  id="password">
                    <p class="error-msg"></p>
                  <button type="submit"  class="register__button--submit">Sign in</button>
       
                  <a href="../Inscription" class="register__button--submit start__btn">Sign up</a> 
                  <div class="alert alert-danger same" role="alert">
                <p class="alert__error-msg">Wrong email address or password !</p>
            </div>  
                </form>
                <div class="alert alert-danger disable__account" role="alert" >
                <p class="alert__error-msg">Your account is temporarily deactivated!</p>
                <a href="../private/disableProfile.php" class="alert-link">You can reactivate your account here.</a>
            </div>
          
            </div>

        </div>
</div>

</body>
</html>