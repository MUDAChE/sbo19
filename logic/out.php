<?php

$_SESSION = [];

if (isset($_COOKIE['sign-in'])){
    setcookie('sign-in', '', time()-3600, '/');
}
//session_destroy();
header('Location: ../index.php');