<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyMeetic</title>
    <link rel="icon" href="../public/assets/images/favico-e2902aad538.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/CSS/style.css">
    <link rel="stylesheet" href="../public/CSS/inscription.css">
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
                <a href="../">
                <img class="logo__home" src="../public/assets/images/pinkwhite-44d5e901294.svg"   alt="logo my meetic"></a>
            </div>

           
                <form id="register-form" method="post">
                <div class="row">
                       <div class="col-md-6 col-sm-12"> 
              <div>
                <label for="firstname">Firstname :</label>
                    <input name="firstname" type="text"  id="firstname" autocomplete="on" placeholder="Firstname">
                    <p class="error-msg"></p>
             </div>
             <div>
                    <label for="lastname">Lastname :</label>
                    <input type="text" name="lastname"  id="lastname" autocomplete="on" placeholder="Lastname">
                    <p class="error-msg"></p>
             </div>   
             <div>    
                    <label for="email">Email :</label>
                <input type="text" name="email" id="email" placeholder="Email">
                <p class="error-msg"></p>
         </div>
         <div>
                <label for="password">Password:</label>
                <input type="password" name="password"  id="password" placeholder="Password">
                <p class="error-msg"></p>
         </div>
               </div>
               <div class="col-md-6 col-sm-12"> 
         <div>
                <label for="birth">Date of brith :</label>
                <input  name="birth" type="date" value="2006-10-25" id="birth">
                <p class="error-msg"></p>
                </div>
                <div>
                <label for="gender">Sexe :</label>
                    <select  name="gender" id="gender" data-toggle="dropdown">
                        <option class="" value="homme" selected>Men</option>
                        <option value="femme">Women</option>
                        <option value="autre">Other</option>
                    </select>
                    </div>
                    <div>
                    <label for="Hobbies">Hobbies :</label>
                    <select  name="hobbies" id="Hobbies" data-toggle="dropdown">
                        <?php
                        foreach($getInfo->getHobbies() as $hobbies){
                          echo '<option value="'.$hobbies["id_hobbies"].'">'.$hobbies["nom"].'</option>';
                        }
                        ?>
                    </select>
                    </div>
                    <div>
                    <label for="city">City :</label>
                <input type="text" name="city" id="city" autocomplete="on" placeholder="City">
                <p class="error-msg"></p>
                </div>
         
                <button type="submit" class="register__button--submit">Sign up</button>
                </div>
                </div>
             
                </form>

          


        </div>
</div>
</body>
</html>