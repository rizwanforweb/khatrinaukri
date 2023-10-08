<?php
// error_reporting(0);
require 'connection.php';
$wrongImageAlert = false;
$wrongImageAlert2 = false;
$chooseImageAlert = false;
$bigImgAlert = false;
$fieldsRequiredAlert = false;
$selectRequiredAlert = false;
$updateFailedAlert = false;
session_start();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $user_agent)) {
    // the user is on a mobile device
    $mobile = true;
} else {
    // the user is on a desktop or laptop
    $mobile = false;
}
?>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <title>Khatri Naukri - Profile</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
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
        </div>
    </nav>

    <?php
    if (isset($_SESSION['profileCreateSuccess']) && $_SESSION['profileCreateSuccess'] == true) {
        echo '<div class="alert alert-success container">Profile Created Successfully.</div>';
        unset($_SESSION['profileCreateSuccess']);
    }
    if (isset($_SESSION['profileUpdateSuccess']) && $_SESSION['profileUpdateSuccess'] == true) {
        echo '<div class="alert alert-success container">Profile Updated Successfully.</div>';
        unset($_SESSION['profileUpdateSuccess']);
    }
    if (isset($_SESSION['profileUpdateFailed']) && $_SESSION['profileUpdateFailed'] == true) {
        echo '<div class="alert alert-danger container">Can\'t Update Profile Please Try Later.</div>';
        unset($_SESSION['profileUpdateFailed']);
    }


    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true || isset($_COOKIE["user"])) {

        $key = 'mysecretkey123456'; // 24 bytes key
        $decrypted = openssl_decrypt($_COOKIE['user'], 'DES-EDE3', $key);

        $candidateDataFetchQuery = "SELECT * FROM `candidates` where id= $decrypted";
        $userData = mysqli_query($connect, $candidateDataFetchQuery);
        $user = mysqli_fetch_assoc($userData);
        if (isset($_POST['update'])) {

            $userInputName = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $userInputCity = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
            $userInputDistrict = htmlspecialchars($_POST['district'], ENT_QUOTES, 'UTF-8');
            $userInputState = htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8');
            $userInputAdditionalinformation = htmlspecialchars($_POST['additionalinformation'], ENT_QUOTES, 'UTF-8');

            $selects = $_POST['data'];
            $allSelects = implode("<br>", $selects);
            if (!empty($_FILES['candidatedp']['name'])) {
                $ext = pathinfo($_FILES['candidatedp']['name'], PATHINFO_EXTENSION);
                $mime = getimagesize($_FILES['candidatedp']['tmp_name'])['mime'];
                if (($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') && substr($mime, 0, 6) == 'image/') {
                    if (empty($_POST['name']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['maritalstatus']) || empty($_POST['number'])) {
                        $fieldsRequiredAlert = true;
                    } elseif (isset($_POST['data'])) {
                        $filename = $_FILES["candidatedp"]["name"];
                        $tempname = $_FILES["candidatedp"]["tmp_name"];
                        $folder = "candidatedp/" . $filename;
                        move_uploaded_file($tempname, $folder);
                        $query = "INSERT INTO `candidates` (id, candidatedp, name, age, city, district, state, maritalstatus, category, additionalinformation, salary, number, status, datetime) VALUES ('$decrypted', '$folder', '$userInputName', '$_POST[age]', '$userInputCity', '$userInputDistrict', '$userInputState', '$_POST[maritalstatus]', '$allSelects', '$userInputAdditionalinformation', '$_POST[salary]', '$_POST[number]', '$_POST[status]', CURRENT_TIMESTAMP);";
                        $result = mysqli_query($connect, $query);
                        if ($result) {
                            $_SESSION['profileCreateSuccess'] = true;
                            echo '<script>window.location.href = "profile.php";</script>';
                        } else {
                            $query = "UPDATE `candidates` SET `candidatedp` = '$folder',`name` = '$userInputName', `age` = '$_POST[age]', `city` = '$userInputCity', `district` = '$userInputDistrict', `state` = '$userInputState', `maritalstatus` = '$_POST[maritalstatus]',`category` = '$allSelects', `additionalinformation` = '$userInputAdditionalinformation', `salary` = '$_POST[salary]', `number` = '$_POST[number]', `status` = '$_POST[status]'  WHERE `candidates`.`id` = $decrypted";
                            $result = mysqli_query($connect, $query);
                            if ($result) {
                                $_SESSION['profileUpdateSuccess'] = true;
                                echo '<script>window.location.href = "profile.php";</script>';
                            } else {
                                $_SESSION['profileUpdateFailed'] = true;
                                echo '<script>window.location.href = "profile.php";</script>';
                            }
                        }
                    } else {
                        $selectRequiredAlert = true;
                    }
                } else {
                    $wrongImageAlert = true;
                }
            } else {
                if ($user['candidatedp'] == "") {
                    $chooseImageAlert = true;
                } else {
                    if (empty($_POST['name']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['maritalstatus']) || empty($_POST['number'])) {
                        $fieldsRequiredAlert = true;
                    } elseif (isset($_POST['data'])) {
                        
                        $query = "UPDATE `candidates` SET `candidatedp` = '$user[candidatedp]', `name` = '$userInputName', `age` = '$_POST[age]', `city` = '$userInputCity', `district` = '$userInputDistrict', `state` = '$userInputState', `maritalstatus` = '$_POST[maritalstatus]',`category` = '$allSelects', `additionalinformation` = '$userInputAdditionalinformation', `salary` = '$_POST[salary]', `number` = '$_POST[number]', `status` = '$_POST[status]'  WHERE `candidates`.`id` = $decrypted";
                        $result = mysqli_query($connect, $query);
                        if ($result) {
                            $_SESSION['profileUpdateSuccess'] = true;
                            echo '<script>window.location.href = "profile.php";</script>';
                        } else {
                            $_SESSION['profileUpdateFailed'] = true;
                            echo '<script>window.location.href = "profile.php";</script>';
                        }
                    } else {
                        $selectRequiredAlert = true;
                    }
                }
            }
        }
        $category = $user['category'];
        $foundCategory = explode("<br>", $category);
    } else {
        echo '<script>window.location.href = "user-verification.php";</script>';
    }
    ?>

    <?php
    if ($wrongImageAlert) {
        echo '<div class="alert alert-warning container">Please Select Image File For Your DP.</div>';
    }
    if ($wrongImageAlert2) {
        echo '<div class="alert alert-warning container">Please Select Image File For Your DP2.</div>';
    }
    if ($chooseImageAlert) {
        echo '<div class="alert alert-warning container">You Have To Select Your DP.</div>';
    }
    if ($bigImgAlert) {
        echo '<div class="alert alert-warning container">Max Image Size Allowed 5MB.</div>';
    }
    if ($fieldsRequiredAlert) {
        echo '<div class="alert alert-warning container">All Fields Are Required Except <b>Age, District, Additional Information & Salary</b>.</div>';
    }
    if ($selectRequiredAlert) {
        echo '<div class="alert alert-warning container">At Least One Selection is Required in The Experience List if You Don\'t Have Any Experience Just Select <b>New</b> or Select <b>Other</b> if You Want To Write Custom Work Experience.</div>';
    }
    ?>
    <div class="container p-0 my-3">
        <div class="row container p-0" style="margin: 0;">
            <form action="profile.php" method="post" enctype="multipart/form-data" class="d-lg-flex flex-lg-row">
                <div class="col-lg-6 px-1">
                    <div class="d-flex justify-content-center">
                        <?php
                        $userCheckQuery = "SELECT * FROM `candidates` WHERE id = $decrypted";
                        $userCheckSql = mysqli_query($connect, $userCheckQuery);
                        $rows = mysqli_num_rows($userCheckSql);
                        ?>
                        <img class="img-fluid" style="height: <?php if ($mobile) {
                            echo "400";
                        } else {
                            echo "600";
                        } ?>px; width:500px; object-fit: cover;" alt="Profile Preview" id="img" src="
                        <?php
                        if ($rows < 1 || $user['candidatedp'] == "candidatedp/") {
                            echo "https://i.ibb.co/Cwy5J76/dummy2.jpg";
                        } else {
                            echo $user['candidatedp'];
                        }
                        ?>
                        ">
                    </div>
                    <div class="d-flex justify-content-center py-3">
                        <input type="file" accept="image/*" class="form-control" name="candidatedp" id="imgbtn" <?php if ($user['candidatedp'] == "") {
                            echo "required";
                        } ?>>
                    </div>
                </div>
                <div class=" col-lg-6 px-1">
                    <input type="text" name="name" class="form-control my-2" placeholder="Full Name"
                        value="<?php echo $user['name']; ?>" Required>
                    <div name="ageCityState" class="row form-group my-3">
                        <div class="col-lg-3 my-1">
                            <input type="number" class="form-control" name="age" placeholder="Age" min="18"
                                value="<?php echo $user['age']; ?>">
                        </div>
                        <div class="col-lg-3 my-1">
                            <input type="text" class="form-control" name="city" placeholder="City"
                                value="<?php echo $user['city']; ?>" Required>
                        </div>
                        <div class="col-lg-3 my-1">
                            <input type="text" class="form-control" name="district" placeholder="District"
                                value="<?php echo $user['district']; ?>">
                        </div>
                        <div class="col-lg-3 my-1">
                            <input type="text" class="form-control" name="state" placeholder="State"
                                value="<?php echo $user['state']; ?>" Required>
                        </div>
                    </div>
                    <div name="status" class="form-group my-3">
                        <input type="radio" class="form-check-input" name="maritalstatus" value="Unmarried" <?php if ($user['maritalstatus'] == "Unmarried") {
                            echo "checked";
                        } ?> Required>
                        <label for="unmarried" class="form-check-label">Unmarried</label>
                        <br>
                        <input type="radio" class="form-check-input" name="maritalstatus" value="Married" <?php if ($user['maritalstatus'] == "Married") {
                            echo "checked";
                        } ?> Required>
                        <label for="married" class="form-check-label">Married</label>
                    </div>
                    <div name="experience" class="form-group my-3">
                        <label>What experience do you have?</label>
                        <div class="category">
                            <input type="checkbox" name="data[]" value="New" class="form-check-input" <?php if (in_array("New", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="new" class="form-check-label">New</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Saree" class="form-check-input" <?php if (in_array("Saree", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="saree" class="form-check-label">Saree</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Kid\'s Wear" class="form-check-input" <?php if (in_array("Kid's Wear", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="kids-wear" class="form-check-label">Kid's Wear</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Men\'s Wear" class="form-check-input" <?php if (in_array("Men's Wear", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="mens-wear" class="form-check-label">Men's Wear</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Top Leggings" class="form-check-input" <?php if (in_array("Top Leggings", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="top-leggings" class="form-check-label">Top Leggings</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Suiting Shirting" class="form-check-input" <?php if (in_array("Suiting Shirting", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="suiting-shirting" class="form-check-label">Suiting Shirting</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Dress Material" class="form-check-input" <?php if (in_array("Dress Material", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="dress-material" class="form-check-label">Dress Material</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Meter Kapda" class="form-check-input" <?php if (in_array("Meter Kapda", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="meter-kapda" class="form-check-label">Meter Kapda</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Foot Wear" class="form-check-input" <?php if (in_array("Foot Wear", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="foot-wear" class="form-check-label">Foot Wear</label>
                            <br>
                            <input type="checkbox" name="data[]" value="China Bazaar" class="form-check-input" <?php if (in_array("China Bazaar", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="china-bazaar" class="form-check-label">China Bazaar</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Handloom" class="form-check-input" <?php if (in_array("Handloom", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="handloom" class="form-check-label">Handloom</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Jalebi" class="form-check-input" <?php if (in_array("Jalebi", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            <label for="jalebi" class="form-check-label">Jalebi</label>
                            <br>
                            <input type="checkbox" name="data[]" value="Other" class="form-check-input" <?php if (in_array("Other", $foundCategory)) {
                                echo "checked";
                            } ?>>
                            
                            <label for="other" class="form-check-label">Other</label>
                        </div>
                    </div>
                    <textarea name="additionalinformation" class="form-control my-4"
                        placeholder="Extra Information"><?php echo $user['additionalinformation']; ?></textarea>

                    <div class="d-flex">
                        <i class='fa-solid fa-indian-rupee-sign h2 d-inline my-auto mx-2'></i>
                        <input type="number" name="salary" class="form-control my-2" placeholder="Salary" min="0"
                            value="<?php echo $user['salary']; ?>">
                    </div>

                    <div class="d-flex">
                        <i class='fa-solid fa-phone h3 d-inline my-auto mx-1'></i>
                        <input type="number" name="number" class="form-control my-2" placeholder="Contact Number"
                            min="0" maxlength="10" value="<?php echo $user['number']; ?>">
                    </div>

                    <div name="changes" class="d-flex justify-content-between my-4">
                        <div>
                            <input type="checkbox" class="form-check-input" name="status" <?php
                            if ($user['status'] == "on" || mysqli_num_rows($userData) < 1) {
                                echo "checked";
                            }
                            ?>>
                            <label for="availablity" class="form-check-label">Public Profile</label>


                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary" name="update" value="Save Changes">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="index.js"></script>
</body>

</html>