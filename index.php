<?php
// error_reporting(0);
require 'connection.php';
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true || isset($_COOKIE["user"])) {

} else {
    echo '<script>window.location.href = "user-verification.php";</script>';
}

$sql = "SELECT * FROM `candidates` WHERE status= 'on' ORDER BY RAND()";
$query = mysqli_query($connect, $sql);
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $user_agent)) {
    // the user is on a mobile device
    $height = 400;
} else {
    // the user is on a desktop or laptop
    $height = 600;
}
?>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <title>Khatri Naukri - Home</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a href="index.php" class="navbar-brand h1 link-primary m-0"> <img src="favicon.png" alt="KN logo"
                    class="mx-1" style="max-height: 40px;"> Khatri Naukri</a>

            <a href="profile.php" class="btn btn-primary" style="margin-left: auto;" role="button"><b>Profile</b></a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu"
                style="margin-left: 5px;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu" style="flex-grow: 0;">
                <ul class="navbar-nav">
                    <li class="nav-item mx-3">
                        <a href="index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="about.php" class="nav-link link-primary">About</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="logout.php" class="nav-link link-primary">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_SESSION['user-verified'])) {
        unset($_SESSION['send-otp'], $_SESSION['otp'], $_SESSION['user-verified']);
    }
    if (isset($_SESSION['account-created-success'])) {
        echo '<div class="alert alert-success container">Account Created Successfully. <br> Now Make <a href="profile.php">Profile</a> if You Want To Get Hired.</div>';
        unset($_SESSION['account-created-success']);
    }
    ?>

    <h3 class="text-center text-muted mt-3 mb-3 px-2">Find Sales Man According To Your Needs.</h3>
    <hr>
    <?php
    while ($availUser = mysqli_fetch_assoc($query)) {
        if ($availUser['salary'] == "") {
            $rupeeIcon = "";
        } else {
            $rupeeIcon = "<i class='fa-solid fa-indian-rupee-sign h3 mx-1'></i>";
        }
        
        if ($availUser['category'] == "Other") {
            $exp = "";
            $experienceText = "";
        } else {
            $exp = $availUser['category'];
            $experienceText = "<li>Experience</li>";
        }


        echo "    <div class='container d-lg-flex py-3' name='card'>
    <div class='col-lg-6 text-center' name='dp'>
    <img class='img-fluid rounded' src='" . $availUser['candidatedp'] . "'
    style='height:" . $height . "px; width:500px; object-fit: cover;' alt='Condidate-Dp'>
        </div>";
        echo '
        <div class="col-lg-6 px-lg-5 px-1 py-3 py-lg-0" name="bio">

            <h2 name="name" class="d-block h1">' . $availUser['name'] . '</h2>
            
            <button name="age" class="d-inline btn btn-Secondary mb-1" disabled>Age:</button>
            <button name="age" class="d-inline btn mb-1" style="background-color:#008cff; border-color:#008cff; color:white; " disabled><b>' . $availUser['age'] . '</b></button>
            <br>
            <button name="marital-status" class="d-inline btn btn-Secondary mb-1" disabled>Marital Status:</button>
            <button name="marital-status" class="d-inline btn mb-1" style="background-color:#008cff; border-color:#008cff; color:white; " disabled><b>' . $availUser['maritalstatus'] . '</b></button>
            <br>
            <button name="city" class="d-inline btn btn-Secondary mb-1" disabled>City:</button>
            <button name="city" class="d-inline btn mb-1" style="background-color:#008cff; border-color:#008cff; color:white; " disabled><b>' . $availUser['city'] . '</b></button>
            <br>
            <button name="district" class="d-inline btn btn-Secondary mb-1" disabled>District:</button>
            <button name="district" class="d-inline btn mb-1" style="background-color:#008cff; border-color:#008cff; color:white; " disabled><b>' . $availUser['district'] . '</b></button>
            <br>
            <button name="state" class="d-inline btn btn-Secondary mb-1" disabled>State:</button>
            <button name="state" class="d-inline btn mb-1" style="background-color:#008cff; border-color:#008cff; color:white; " disabled><b>' . $availUser['state'] . '</b></button>
            
            <div class="experience py-3">
            <ul>
                '. $experienceText .'
                <span><b>' . $exp . '</b></span>
            </ul>
            </div>
            <p name="additional-information">' . $availUser['additionalinformation'] . '</p>
            <div name="salary" class="mb-3">
                ' . $rupeeIcon . '
                <span class="h3 mb-2">' . $availUser['salary'] . '</span>
            </div>
            <div name="number">

            <span name="call" class="p-2 rounded" style="background-color:#00b527; border-color:#00b527; color:white;" disabled> 
                <i class="fa-solid fa-phone h5"></i>
                <a href="tel:' . $availUser['number'] . '" name="phone-number" class="h5 text-decoration-none text-light" style="cursor:pointer;">Call Now</a>
            </span>

            </div>
        </div>
        </div>
        <div class="container">
        <hr>
        </div>
        

    ';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>