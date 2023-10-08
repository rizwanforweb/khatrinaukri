<?php
// error_reporting(0);
require 'connection.php';
session_start();
$emptyFieldAlert = false;
$wrongOtpAlert = false;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true || isset($_COOKIE["user"])) {
    header("location: index.php");
} else {
    // echo $_SESSION['otp'];
    if (isset($_SESSION['otp-send']) && $_SESSION['otp-send'] == true) {
        if (isset($_POST['verify'])) {
            if (empty($_POST['otp'])) {
                $emptyFieldAlert = true;
            } else {
                if ($_SESSION['otp'] == $_POST['otp']) {

                    $sql = "SELECT * FROM `user_site_access` WHERE `number`='$_SESSION[number]'";
                    $query = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($query) < 1) {

                        $sql = "INSERT INTO `user_site_access` (number, datetime) VALUES ('$_SESSION[number]', CURRENT_TIMESTAMP);";
                        $query = mysqli_query($connect, $sql);

                        $sql2 = "SELECT * FROM `user_site_access` WHERE `number`='$_SESSION[number]'";
                        $query2 = mysqli_query($connect, $sql2);
                        $query_fetch = mysqli_fetch_assoc($query2);
                        $_SESSION['logged_in'] = true;
                        $_SESSION['currentUserId'] = $query_fetch['id'];
                        $_SESSION['user-verified'] = true;
                        $_SESSION['account-created-success'] = true;
                        $key = 'mysecretkey123456'; // 24 bytes key
                        $encrypted = openssl_encrypt($_SESSION['currentUserId'], 'DES-EDE3', $key);
                        setcookie("user", $encrypted, time() + 60 * 60 * 24 * 30);
                        echo '<script>window.location.href = "index.php";</script>';
                    } else {
                        $sql = "SELECT * FROM `user_site_access` WHERE `number`='$_SESSION[number]'";
                        $query = mysqli_query($connect, $sql);
                        $query_fetch = mysqli_fetch_assoc($query);
                        $_SESSION['logged_in'] = true;
                        $_SESSION['currentUserId'] = $query_fetch['id'];
                        $_SESSION['user-verified'] = true;
                        $key = 'mysecretkey123456'; // 24 bytes key
                        $encrypted = openssl_encrypt($_SESSION['currentUserId'], 'DES-EDE3', $key);
                        setcookie("user", $encrypted, time() + 60 * 60 * 24 * 30);
                        echo '<script>window.location.href = "index.php";</script>';
                    }
                } else {
                    $wrongOtpAlert = true;
                }
            }
        }
    } else {
        header("location: index.php");
    }
}
?>

<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khatri Naukri - OTP Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a href="index.php" class="navbar-brand h1 link-primary m-0"> <img src="favicon.png" alt="KN logo"
                    class="mx-1" style="max-height: 40px;"> Khatri Naukri</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav">
                    <li class="nav-item mx-3">
                        <a href="index.php" class="nav-link link-primary" aria-current="page">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="about.php" class="nav-link link-primary">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if ($emptyFieldAlert) {
        echo '<div class="alert alert-danger container">Please Enter OTP.</div>';
    }
    if (isset($_SESSION['otp-send'])) {
        echo '<div class="alert alert-success container">OTP [<b>' . $_SESSION['otp'] . '</b>] send to your ' . $_SESSION['number'] . ' number.</div>';
    }
    if ($wrongOtpAlert) {
        echo '<div class="alert alert-danger container">Please Re-Check OTP Carefully and Try Again.</div>';
    }
    ?>
    <div class="container d-flex justify-content-center mt-5">
        <form action="verify-otp.php" method="post">
            <div class="form-group">
                <h1>Enter OTP</h1>
                <input type="text" class="form-control my-3" name="otp" placeholder="OTP" required>
                <small class="form-text text-muted">Check Messages for OTP</small>
                <input type="submit" class="btn btn-primary my-3 w-100" name="verify" value="Verify">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>