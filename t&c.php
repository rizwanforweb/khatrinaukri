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
    <title>Khatri Naukri - Terms & Conditions</title>
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
    <h1 class="mt-5 text-center">Terms & Conditions</h1>
    <div class="container mt-5">
        <h6 class="mb-5">By submitting your personal information through this website, you consent to the collection,
            use, and disclosure of your information in accordance with these terms and conditions.</h6>
        <p>1. The website is intended for use by employees to create profiles and share information about themselves.
        </p>
        <p>2. The personal information you provide will be used to create a public profile on our website, which may
            be viewable by other users.</p>
        <p>3. You are responsible for ensuring that the personal information you provide is accurate and up-to-date.
        </p>
        <p>4. You are responsible for maintaining the confidentiality of your login information and for any
            activities that
            occur under your account.</p>
        <p>5.You may update or remove your personal information at any time by logging into your account.</p>
        <p>6. We reserve the right to remove any public profile that contains inappropriate image or text, inaccurate,
            incomplete, or outdated
            information.</p>
        <p>7. We will not be liable for any damages or losses resulting from the use of your personal information by
            other users.</p>

        <p>8. The website owner shall not be held liable for any actions taken by employees or employers on the website.
            Any disputes or issues arising between employees and employers are solely the responsibility of the parties
            involved and the website owner is not responsible for any damages or losses resulting from such disputes or
            issues.</p>
        <p>9. App/Website owner may modify these terms and conditions at any time, and users are responsible for
            regularly reviewing the latest terms to ensure they are in compliance.</p>
        <p>10. You must not use this website for any illegal or unauthorized purposes.</p>
        <p>11. The website reserves the right to remove or edit any information that you provide at any time, for any
            reason.</p>
        <p>12. The website may display advertisements to users.</p>
        <p>13. Keep in mind - before the worker goes to work, the shopkeeper should check the worker and the worker
            should check the shopkeeper. The creator of Khatri Naukri application will not take any responsibility if
            any harm happens to either of them.</p>
    </div>
    <h1 class="mt-5 text-center">नियम एवं शर्तें</h1>
    <div class="container mt-5">
        <h6 class="mb-5">इस वेबसाइट के माध्यम से अपनी व्यक्तिगत जानकारी सबमिट करके, आप इन नियमों और शर्तों के अनुसार
            अपनी जानकारी के संग्रह, उपयोग और प्रकटीकरण के लिए सहमति देते हैं।</h6>
        <p>1. वेबसाइट का उद्देश्य कर्मचारियों द्वारा प्रोफ़ाइल बनाने और अपने बारे में जानकारी साझा करने के लिए उपयोग
            करना है।
        </p>
        <p>2. आपके द्वारा प्रदान की जाने वाली व्यक्तिगत जानकारी का उपयोग हमारी वेबसाइट पर एक सार्वजनिक प्रोफ़ाइल बनाने
            के लिए किया जाएगा, जो हो सकता है
            अन्य उपयोगकर्ताओं द्वारा देखा जा सकता है।</p>
        <p>3. आप यह सुनिश्चित करने के लिए जिम्मेदार हैं कि आपके द्वारा प्रदान की जाने वाली व्यक्तिगत जानकारी सटीक और
            अद्यतित है।
        </p>
        <p>4. आप अपनी लॉगिन जानकारी और किसी के लिए गोपनीयता बनाए रखने के लिए जिम्मेदार हैं
            गतिविधियाँ जो
            आपके खाते के अंतर्गत होता है।</p>
        <p>5. आप अपने खाते में लॉग इन करके किसी भी समय अपनी व्यक्तिगत जानकारी अपडेट कर सकते हैं या हटा सकते हैं।</p>
        <p>6. हम किसी भी सार्वजनिक प्रोफ़ाइल को हटाने का अधिकार सुरक्षित रखते हैं जिसमें अनुचित छवि या पाठ, गलत, अधूरा
            या पुरानी जानकारी हो।</p>
        <p>7. हम आपकी व्यक्तिगत जानकारी के उपयोग से होने वाली किसी भी क्षति या नुकसान के लिए उत्तरदायी नहीं होंगे।</p>
        <p>8. वेबसाइट पर कर्मचारियों या नियोक्ताओं द्वारा की गई किसी भी कार्रवाई के लिए वेबसाइट के मालिक को उत्तरदायी
            नहीं ठहराया जाएगा।
            कर्मचारियों और नियोक्ताओं के बीच उत्पन्न होने वाले किसी भी विवाद या मुद्दों के लिए केवल पार्टियों की
            जिम्मेदारी होती है
            और वेबसाइट का मालिक इस तरह के मुद्दे या विवादों से होने वाली किसी भी क्षति या नुकसान के लिए ज़िम्मेदार
            नहीं है।</p>
        <p>9. ऐप/वेबसाइट के मालिक किसी भी समय इन नियमों और शर्तों को संशोधित कर सकते हैं, और यह सुनिश्चित करने के लिए
            उपयोगकर्ता नवीनतम शर्तों की नियमित रूप से समीक्षा करने के लिए जिम्मेदार हैं कि वे अनुपालन में हैं।
        </p>
        <p>10. आपको इस वेबसाइट का उपयोग किसी भी अवैध या अनधिकृत उद्देश्यों के लिए नहीं करना चाहिए।</p>
        <p>11. वेबसाइट किसी भी समय आपके द्वारा प्रदान की गई किसी भी जानकारी को हटाने या संपादित करने का अधिकार सुरक्षित
            रखती है।</p>
        <p>12. वेबसाइट उपयोगकर्ताओं को विज्ञापन प्रदर्शित कर सकती है।</p>
        <p>13. ध्यान रखे - काम करने वाले आदमी के काम पर जाने से पहले दुकान वाला काम करने वाले आदमी की और काम करने वाला
            दुकान वाले की जाच पड़ताल करले, दोनों मे किसी को भी हानी पहोचने पर Khatri Naukri एप्लिकेशन बनाने वाले की कोई
            ज़िम्मेदारी नहीं रहेगी।</p>
    </div>
    <div class="text-center p-5"><a href="privacy_policy.php" class="nav-link link-primary"><i class="fa-regular fa-file"></i> Privacy Policy</a></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>