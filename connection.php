<!-- ?php
// error_reporting(0);
$host = "localhost";
$username = "id19882929_site_users";
$password = "khatrinaukri@000Webhost";
$database = "id19882929_site_user";
$connect = mysqli_connect($host, $username, $password, $database);
if(!$connect) {
    echo "Server Down";
}
? -->


<?php
error_reporting(0);
$host = "localhost";
$username = "root";
$password = "";
$database = "site_users";
# Connection to database Making & Checking
$connect = mysqli_connect($host, $username, $password, $database);
if (!$connect) {
    die("Connect Failed!!");
}
?>