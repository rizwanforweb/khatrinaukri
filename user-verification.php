<?php
// error_reporting(0);
require 'connection.php';
session_start();
$emptyFieldAlert = false;
$numbersDigitAlert = false;
$termsConditionsAlert = false;
$serverDownAlert = false;
$otpLimitAlert = false;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true || isset($_COOKIE["user"])) {
    header("location: index.php");
} else {
    $numbersDigit = strlen($_POST['number']);
    if (isset($_POST['send'])) {
        if (isset($_POST['terms-conditions'])) {
            if (empty($_POST['number'])) {
                $emptyFieldAlert = true;
            } else {
                if ($numbersDigit === 10) {
                    // Check if the user has reached the OTP sending limit
                    $otpSendCount = isset($_COOKIE['RC']) ? (int) $_COOKIE['RC'] : 0;
                    $lastOtpSendTime = isset($_COOKIE['RT']) ? (int) $_COOKIE['RT'] : 0;
                    $currentTimestamp = time();

                    // Calculate the timestamp for 24 hours ago
                    $twentyFourHoursAgo = $currentTimestamp - (24 * 60 * 60);

                    // Check if the user has exceeded the limit within the last 24 hours
                    if ($otpSendCount >= 3 && $lastOtpSendTime >= $twentyFourHoursAgo) {
                        // User has reached the OTP sending limit within the last 24 hours
                        $otpLimitAlert = true;
                    } else {
                        // User is allowed to send OTP
                        $sql = "SELECT * FROM `user_site_access` WHERE `number`='{$_POST['number']}'";
                        $query = mysqli_query($connect, $sql);

                        if ($query) {
                            // Send OTP
                            $otp = rand(10000, 99999);
                            $otp = urlencode($otp);

                            $_SESSION['otp'] = $otp;
                            $_SESSION['otp-send'] = true;
                            $_SESSION['number'] = $_POST['number'];

                            // Update the OTP sending count and timestamp in cookies

                            // Request Count
                            setcookie('RC', $otpSendCount + 1, $currentTimestamp + (24 * 60 * 60)); // Expire in 24 hours
                            // Request Time
                            setcookie('RT', $currentTimestamp, $currentTimestamp + (24 * 60 * 60)); // Expire in 24 hours

                            echo '<script>window.location.href = "verify-otp.php";</script>';
                        } else {
                            // Error in executing the SQL query
                            $serverDownAlert = true;
                            echo "Error: " . mysqli_error($connect);
                        }
                    }
                } else {
                    $numbersDigitAlert = true;
                }
            }
        } else {
            $termsConditionsAlert = true;
        }
    }





}
?>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khatri Naukri - User Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a href="index.php" class="navbar-brand h1 link-primary m-0"> <img src="favicon.png" alt="KN logo"
                    class="mx-1" style="max-height: 40px;"> Khatri Naukri</a>
            <a href="about.php" class="nav-link link-primary mx-3">About</a>
        </div>
    </nav>
    <?php
    if ($emptyFieldAlert) {
        echo '<div class="alert alert-danger container">Please Enter Your Phone Number.</div>';
    }
    if ($numbersDigitAlert) {
        echo '<div class="alert alert-danger container">Please Enter 10 Digits Number.</div>';
    }
    if ($termsConditionsAlert) {
        echo '<div class="alert alert-danger container">Please Accept Terms & Conditions Other Wise You Won\'t Be Able Login.</div>';
    }
    if ($serverDownAlert) {
        echo '<div class="alert alert-danger container">There\'s Some Issue With Server Please Try Again After Some Time.</div>';
    }
    if ($_COOKIE['RC'] == 3) {
        echo '<div class="alert alert-danger container">OTP Limit Exceeded, Try Again After 24 Hours.<br>You Can\'t Send OTP More Than 3 Times Under 24 Hours.</div>';
    }
    ?>
    <div class="container d-flex justify-content-center mt-5">
        <form action="user-verification.php" method="post">
            <div class="form-group">
                <h1>Enter Your Phone Number</h1>
                <small class="form-text text-muted">OTP Will Be Send To Your Phone Number.</small>
                <input type="number" class="form-control my-3" name="number" placeholder="Phone Number" required>
                <input type="checkbox" class="form-check-input" name="terms-conditions" required>

                <label class="form-check-label" for="terms-conditions">I have read and accept</label>
                <a href="t&c.php" class="link-primary text-decoration-none" name="terms-conditions">T&C,</a>
                <a href="privacy_policy.php" class="link-primary text-decoration-none" name="privacy policy">Privacy
                    Policy</a>
                <br>
                <!-- <small class="form-text text-muted">Note: You Can't Send OTP More Than 3 Under 24 Hours.</small> -->
                <input type="submit" class="btn btn-primary my-3 w-100" name="send" value="Send OTP">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>