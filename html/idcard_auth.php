<?php
/**
 * Created by PhpStorm.
 * User: allar
 * Date: 6.12.15
 * Time: 12:48
 */
include "config.php";
include "User.php";
include "Controller.php";
include "View.php";

$user = new User();
$controller = new Controller($user);
$view = new View($controller, $user);

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller = $controller->$_GET['action']();
}

function authenticate()
{
    session_start();
    if ($_SESSION['fingerprint'] != md5($_SERVER['HTTP_USER_AGENT'])) {
        session_destroy();
        echo 'die';
        header('HTTP/1.0 401 Unauthorized');
        exit();
    }
}

//    function debug_to_console($data)
//{
//
//    if (is_array($data))
//        $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
//    else
//        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
//
//    echo $output;
//}

authenticate();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google-signin-client_id"
          content="754123089612-ru560a6li4tcnbtaddd1425q0c4fq4js.apps.googleusercontent.com">

    <title>Authorized</title>

    <!-- Base URL for ajax calls -->
    <base href="https://52.29.136.34/">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">


    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="fonts/fonts.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<!-- Header -->
<a name="about"></a>

<div class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">


                    <h1 style="color: #9cff28; font-size: 2.2em;"><?php echo $view->output(); ?></h1>
                    <h4 id="user_id"><?php echo $view->outputParseMessage(); ?></h4>
                    <hr class="intro-divider" style="width: 500px">
                    <?php echo $view->outputEPersonData(); ?>

                    <hr class="intro-divider" style="width: 500px">
                    <ul class="list-inline intro-social-buttons">
                        <li>
                            <a class="btn btn-block btn-social btn-facebook">
                                <span class="fa fa-facebook"></span> Connect with Facebook
                            </a>
                        </li>
                        <li>
                            <div class="g-signin2" data-onsuccess="onSignIn"></div>
                        </li>
                        <li>
                            <a class="btn btn-block btn-social btn-google" onclick="onSignIn">
                                <i class="fa fa-google"></i>Connect with Google
                            </a>
                        </li>
                    </ul>
                    <div id="status-facebook">

                    </div>

                    <div id="status-google">

                    </div>
                </div>


            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->

<!-- Page Content -->

<div class="content-section-a">

    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <div class="clearfix"></div>
                <h2 class="section-heading">Kasutatud materjalid:</h2>
                <a target="_blank"
                   href="http://security.stackexchange.com/questions/23929/creating-secure-php-sessions">http://security.stackexchange.com/questions/23929/creating-secure-php-sessions</a>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-a -->

<script src="https://apis.google.com/js/platform.js" async defer></script>
<!-- jQuery -->
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

<script src="js/facebookLogin.js"></script>
<script src="js/googleLogin.js"></script>

<script>
    FacebookLogin.initLoginButton();
</script>

</body>

</html>
