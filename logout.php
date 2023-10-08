<?php
error_reporting(0);
session_start();
session_unset();
session_destroy();
setcookie("user", "", time() - 60*60*24*7);
header("location:index.php");
?>