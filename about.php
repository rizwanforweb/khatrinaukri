<?php
error_reporting(0);
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <title>Khatri Naukri - About</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
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
                                 <a href="about.php" class="nav-link active">About</a>
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

    <div class="container row d-flex m-auto">
        <div class="col-lg-6 text-center">
            <h6 class="mt-3 h1">एप्लीकेशन का मकसद</h6>

            <p>Khatri Naukri एप्लिकेशन स्पेशली खात्री कम्यूनिटी के लोगो के लिए बनाई गयी है ताकि उन्हे उनकी दुकानों पर
                काम करने के लिए ऐसे लोगो से कांटैक्ट करने मे आसानी हो जो काम की तलाश मे है।</p>
            <p>इस एप्लिकेशन को खात्री के अलावा दुसरे लोग भी इस्तेमाल आकर सकते है।</p>

            <p>जो आदमी सेल पे काम करने के लिए जाना चाहता है वो आदमी इस एप पर अकाउंट बनाने के बाद अपनी प्रोफाइल बनाएगा
                अपनी पर्सनल इनफॉर्मेशन और कॉन्टैक्ट डिटेल्स डालने के बाद उस आदमी की प्रोफाइल दूसरे लोगो को दिखने लग
                जायेगी और जब किसी सेल वाले को काम के लिए आदमी की जरूरत होगी तो वो सेल वाला उस काम करने वाले से कॉन्टैक्ट
                कर लेगा।</p>

            <p>ध्यान रखे - काम करने वाले आदमी के काम पर जाने से पहले दुकान वाला काम करने वाले आदमी की और काम करने वाला
                दुकान वाले की जाच पड़ताल करले, दोनों मे किसी को भी हानी पहोचने पर Khatri Naukri एप्लिकेशन बनाने वाले की
                कोई ज़िम्मेदारी नहीं रहेगी।</p>
            <hr>


            <span class="display-6 mb-3 d-block">The Creator</span>
            <!-- <h3 class="mt-3">Rizwan Dyeing</h3> -->
            <!-- <br> -->
            <span class="mt-3 h1">Ri</span><span class="mt-3 h1 bg-dark text-light">Z</span><span class="mt-3 h1">wan
                Dyeing</span>
            <br>

            <a href="creator.html">
                <img class="rounded-circle my-4" style="height: 300px; width: 300px; object-fit: cover;"
                    src="https://i.ibb.co/wR40xmq/khatrinaukri-creator-rizwan-dyeing-preview.jpg"
                    alt="Creator - Image : Rizwan Dyeing">
            </a>


            <h6 class="mt-3">अगर आप किसी को हमारे ऐप का गलत इस्तेमाल करते देखते हैं तो कृपया हमें सूचित करें।</h6>
            <h6 class="mt-3">यदि आपके कोई विचार या सुझाव हैं तो बेझिझक हमसे संपर्क करें।</h6>
            <h6 class="mt-3">कृपया अपने विचार हमें बताएं की हम अपने ऐप को कैसे बेहतर बना सकते हैं।</h6>
            <h6 class="mt-3">हमारे ऐप को बेहतर बनाने में हमारा साथ दें।</h6>
            <h6 class="mt-3">एप्लिकेशन मे कोई गड़बड़ी दिखने पर तुरंत दिये गए नंबर पर जानकारी दे।</h6>

            <div class="mt-5">
                <i class="fa-brands fa-whatsapp h1"></i> <a href="tel:9165665606" class="h1 text-decoration-none mx-2"
                    style="cursor:pointer;">+91 9165665606</a>
            </div>
        </div>
        <!-- <div class="col-lg-6 mx-auto py-5 py-lg-0">
            <p>The world is changing so fast. It is not enough to just live in the present and think that the world will
                change by itself. We need to take a step forward, imagine a better future and then work hard to make it
                happen.</p>
            <p>Together, we can create a better community by being kind and compassionate, listening to and supporting
                one another, and standing up for what we believe in.</p>
            <p>We want to create a community where people can share their thoughts and ideas.</p>
            <p>We want to create a better community, where we can all help each other grow.</p>
            <p>A place where we can all learn from each other, and grow together.</p>
            
            <p>We are always looking for ways to improve our service help us make our application better.</p>
        </div> -->
    </div>
    <!-- <div class="container text-center my-5">
        <h1 style=' font-family: "Trirong", serif; '>Think BIG, Build BIG.</h1>
        <h2 style=' font-family: "Trirong", serif; '>Imagine The Impossible</h2>
    </div> -->
    <div class="text-center d-flex justify-content-around p-5">
        <a href="t&c.php" class="nav-link link-primary"><i class="fa-regular fa-file"></i> Terms & Conditions </a>
        <a href="privacy_policy.php" class="nav-link link-primary"><i class="fa-regular fa-file"></i> Privacy Policy</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>