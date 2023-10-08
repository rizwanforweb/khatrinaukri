<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Khatri Naukri - Privacy Policy</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a href="index.php" class="navbar-brand h1 link-primary m-0"> <img src="favicon.png" alt="KN logo"
                    class="mx-1" style="max-height: 40px;"> Khatri Naukri</a>
                    <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true || isset($_COOKIE["user"])) {
                echo '
                <a href="profile.php" class="btn btn-primary" style="margin-left: auto;" role="button"><b>Profile</b></a>
                     <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu"
                         style="margin-left: 5px;">
                         <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse justify-content-end" id="navMenu" style="flex-grow: 0;">
                         <ul class="navbar-nav">
                             <li class="nav-item mx-3">
                                 <a href="index.php" class="nav-link link-primary">Home</a>
                             </li>
                             <li class="nav-item mx-3">
                                 <a href="about.php" class="nav-link link-primary">About</a>
                             </li>
                             <li class="nav-item mx-3">
                                 <a href="logout.php" class="nav-link link-primary">Logout</a>
                             </li>
                         </ul>
                     </div>
                     ';
            } else {
                echo '<a href="user-verification.php" class="btn btn-primary" style="margin-left: auto;" role="button"><b>Login</b></a>';
            }
            ?>
        </div>
    </nav>
    <h1 class="mt-5 text-center">Privacy Policy</h1>
    <div class="container mt-5">
        <p>1. This website collects personal information from users in order to create profiles and make them available
            to other users.
        </p>
        <p>2. The website may collect information such as profile picture, name, age, city, district or state,
            Experience(expertise), salary, and contact number.</p>
        <p>3. If a user chooses to make their profile public, their information will be displayed on the website's home
            page.
        </p>
    </div>
    <h1 class="mt-5 text-center">गोपनीयता नीति</h1>
    <div class="container mt-5">
        <p>1. यह वेबसाइट प्रोफाइल बनाने और उन्हें उपलब्ध कराने के लिए उपयोगकर्ताओं से व्यक्तिगत जानकारी एकत्र करती है
            अन्य उपयोगकर्ताओं के लिए।
        </p>
        <p>2. वेबसाइट प्रोफ़ाइल चित्र, नाम, आयु, शहर, जिला या राज्य, अनुभव (विशेषज्ञता), वेतन और संपर्क नंबर जैसी
            जानकारी एकत्र कर सकती है।</p>
        <p>3. यदि कोई उपयोगकर्ता अपनी प्रोफ़ाइल को सार्वजनिक करना चुनता है, तो उसकी जानकारी वेबसाइट के मुखपृष्ठ पर
            प्रदर्शित की जाएगी पृष्ठ।
        </p>
    </div>
    <div class="text-center p-5"><a href="t&c.php" class="nav-link link-primary"><i class="fa-regular fa-file"></i> Terms & Conditions</a></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>