<?php
include "config.php";
//include "User.php";
//include "Controller.php";
//include "View.php";

//$model = new Model();
//$controller = new Controller($model);
//$view = new View($controller, $model);
//
//if (isset($_GET['action']) && !empty($_GET['action'])) {
//    $controller = $controller->$_GET['action']();
//}
?>
<html>
<head>
    <title>Title</title>
    <meta charset="UTF-8">
    <script src="../js/fblogintest.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/test.css">
</head>

<body>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<div class="wrapper">
    <div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false"
         data-auto-logout-link="true">
    </div>


    <!--<fb:login-button autologoutlink="true" scope="public_profile,email" onlogin="checkLoginState();">-->
    <!--</fb:login-button>-->

    <a class="id-login-button" href="idcard_auth.php?action=auth"><img src="../img/idcard.gif"></a>

    <div id="status"></div>
</div>


<div id="allar-on-noob"></div>


</body>
</html>