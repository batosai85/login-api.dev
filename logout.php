<?php
session_start();
if ($_POST) {
    $email = json_encode($_POST["email"]);
    $_SESSION["email"] = $email;
    header("Location:  http://login-api.dev/facebook_api.php");
}else{
    header("Location:  http://login-api.dev/facebook_api.php");
}
