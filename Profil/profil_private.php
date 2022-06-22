<?php
include_once '../private/autoloader.php';
Autoloader::push();
$db = dbConnect::connect();
$obj = new getInfo($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyMeetic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../public/assets/images/favico-e2902aad538.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/CSS/profile.css">
    <script src="https://kit.fontawesome.com/054fdad312.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../public/js/dropdownMenu.js"></script>
    <script src="../public/js/signAjax.js"></script>
</head>
<body>
<header>
<div>
 <a href="../" class="logo_link"><img class="meetic__logo" src="../public/assets/images/positive-75570a615a9.svg" alt="logo My meetic"></a>
 </div> 
    <div class="navbar__header">

        <!-- Overlay profil-->
        <div class="profile__over">
        <span class="rounded__over">
            <img class="rounded__img" alt=""
                 src="">
        </span>
            <?php
            $obj->verifyGetId();
      
            if ($obj->resultInfo()[0]["id"] === NULL) {
                header("Location: " . "../Profil/?id=" . $_SESSION['id']);
            }

            if ($_GET['id'] !== NULL && !empty($_SESSION)){
            foreach ($obj->fetch->result as $value) {
            echo '<span class="profile__over--name">' . $value["firstname"] . " " . $value["lastname"] . '</span>';
            ?>
            <div class="dropdown-menu show">
                <a href="../Profil/?id=<?= $_SESSION["id"] ?>" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    <span class="ml-1">My profile</span>
                </a>
                <a href="../" class="dropdown-item">
                    <i class="fas fa-search"></i>
                    <span class="ml-1">Search</span>
                </a>
                <a class="dropdown-item disable__account">
                    <i class="fas fa-trash-alt"></i>
                    <span class="ml-1">Disable my profile</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="../private/disconnect.php" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="ml-1">Sign out</span>
                </a>
            </div>
        </div>

    </div>


</header>

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" id="mod_lab_2">
                    <i class="fas fa-sad-cry" style="color: #ffffff"></i>
                    <span style="color: #ffffff; font-family: 'Roboto', sans-serif;">Disable my profile ?</span>
                </span>
            </div>
            <div class="modal-body">
                <p>Do you confirm ?</p>
            </div>
            <div class="modal-footer">
                <a href="../private/disableProfile.php" class="btn btn-info">Yes</a>
                <button type="button" class="btn btn-secondary close__modal">No</button>
            </div>
        </div>
    </div>
</div>

<div class="welcome">
    <span class="mask__background"></span>
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="welcome__text col-lg-7 col-md-10">
                <h1 class="welcome__titre">Salut <?= $value["firstname"] ?></h1>
                <p class="text-black mt-0 mb-5">Here is the management page of your account, 
                     here you can modify and have an
                     overview of your profile on Mymeetic, good and pleasant experience on the site </p>
                <form id="update-form" method="post" action="" role="form">
                    <button type="submit" class="btn btn-info">Save</button>
            </div>
        </div>
    </div>
</div>

<!--Part profile -->
<div class="container-fluid">
    <div class="row">
        <!--Part view profil-->
        <div class="col-xl-4  mb-5 mb-xl-0">
            <div class="card">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="../public/assets/images/no-user.png"
                                     class="rounded-circle" alt="">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-header border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                </div>


                <div class="card-body pt-0 pt-md-4">
                    <div class="text-center">
                        <h3 class="user__name apercu"><?= $value["firstname"] . " " . $value["lastname"] ?></h3>
                        <span class="font-weight-light"><?= $obj->calculAge($value["date_naissance"]) ?> ans</span>

                        <div class="user__location">
                            <i class="fas fa-map-marker-alt"></i><?= " " . $value["ville"] ?>
                        </div>
                        <div class="user__gender mt-3 mb-1">
                            <i class="fas fa-venus-mars"></i><?= "  Genre : " . $value["genre"] ?>
                        </div>
                        <div class="user__hobbies user__mail">
                            <i class="fas fa-envelope"></i><?= " Email : " . $value["email"] ?>
                        </div>
                        <div class="user__hobbies">
                            <i class="fas fa-walking"></i><?= " Activité préférée : " . $value["nom"] ?>
                        </div>
                        <hr class="my-4">
                        <p class="user__description"><?= $value["description"] ?></p>
                        <a href="#" class="btn btn-sm btn-default"><i class="fas fa-envelope"></i> Message</a>
                    </div>
                </div>
            </div>
        </div>

        <!--Partie edition profil-->

        <div class="col-xl-8">
            <div class="card card__compte">
                <div class="card-header border-0 header__compte">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="user__name">My Profile</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- FORMULAIRE MODIFICATION -->

                    <h6 class="heading-small text-muted mb-4">Profile information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="firstname">Firstname</label>
                                    <input name="firstname" type="text" class="form-control" id="firstname"
                                           autocomplete="off" value="<?= $value["firstname"] ?>">
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="lastname">Lastname</label>
                                    <input type="text" name="lastname" class="form-control" id="lastname"
                                           autocomplete="off" value="<?= $value["lastname"] ?>">
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="city">Ville</label>
                                    <input type="text" name="ville" class="form-control" id="city"
                                           autocomplete="off" value="<?= $value["ville"] ?>">
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4 line__info--profil">
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                           value="<?= $value["email"] ?>">
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           autocomplete="off" placeholder="Nouveau mot de passe">
                                    <p class="error-msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Description -->
                    <h6 class="heading-small text-muted mb-4">Bio</h6>
                    <div class="pl-lg-4">
                        <div class="form-group focused">
                            <label for="description">Description</label>
                            <textarea rows="4" name="description" id="description" class="form-control h-100"
                            value="<?= $value["description"] ?>"></textarea>
                            <p class="error-msg"></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="footer__container">
        <img class="meetic__logo" src="../public/assets/images/positive-75570a615a9.svg" alt="logo Mymeetic">
    </div>
    <h5 class="copyright">© COPYRIGHT 2022 MYMEETIC</h5>
</footer>
<?php
}
} else {
    header("Location: " . "../Connection");
}
?>
</body>
</html>