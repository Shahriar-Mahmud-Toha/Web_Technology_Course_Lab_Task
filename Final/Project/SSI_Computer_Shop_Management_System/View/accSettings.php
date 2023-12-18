<?php
session_start();
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
$status = false;
$check = true;
if (isset($_GET["accset"])) {
    $btn = extractRaw($_GET["accset"]);
} else {
    $btn = false;
}
if (isset($_SESSION["accSetPass"])) {
    if ($_SESSION["accSetPass"]) {
        $status = true;
        $check = false;
    }
}
if ($check) {
    if ($btn) {
        if (isset($_SESSION["loginVerified"])) {
            if ($_SESSION["loginVerified"]) {
                $status = true;
            } else {
                header("location:login.php");
            }
        } else {
            header("location:login.php");
        }
    } else {
        header("location:login.php");
    }
}
if (!$status) {
    header("location:login.php");
    die();
}
$_SESSION["accSetPass"] = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Account Settings</title>
    <script src="validateForm.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="accSettingsId">
    <?php require "header_admin.php"; ?>
    <main>
        <h2 class="mt">Account Settings</h2>
        <form action="../Controller/accSettingsOP.php" method="post" novalidate enctype="multipart/form-data">
            <input id="fullname" class="inputBox" name="fullname" type="text" placeholder="Enter your full name" value="<?php if (isset($_SESSION["fullname"])) {
                echo $_SESSION["fullname"];
            } ?>">
            <input class="inputBox" id="curpassword" name="curpassword" type="password"
                placeholder="Enter your current password">
            <?php
            if (isset($_SESSION["passNotMatched"]) && $_SESSION["passNotMatched"]) {
                echo "*  Incorrect current password";
                $_SESSION["passNotMatched"] = null;
            }
            ?>
            <input class="inputBox" id="npassword" name="npassword" type="password" placeholder="Enter new password">
            <p class="cngEmailAccSet"><a href="verifyPassword.php?change=1">Change Email</a></p>
            <textarea class="txtArea" id="address" name="address" cols="21" rows="2" placeholder="Enter your home address"
                value="<?php if (isset($_SESSION["address"])) {
                    echo $_SESSION["address"];
                } ?>"></textarea>
            <input class="inputBox" id="nid" name="nid" type="text" placeholder="Enter your NID number" value="<?php if (isset($_SESSION["nid"])) {
                echo $_SESSION["nid"];
            } ?>">
            <?php
            if (isset($_SESSION["nidInvalidMsg"]) && $_SESSION["nidInvalidMsg"]) {
                echo "* Invalid nid number format. Only <= 10 digit numbers are allowed";
                $_SESSION["nidInvalidMsg"] = null;
            }
            if (isset($_SESSION["nidMatchedMsg"]) && $_SESSION["nidMatchedMsg"]) {
                echo "* This nid is assosiated with another user.";
                $_SESSION["nidMatchedMsg"] = null;
            }
            ?>
            <input class="inputBox" id="phone" name="phone" type="text" placeholder="Enter your phone number" value="<?php if (isset($_SESSION["phone"])) {
                echo $_SESSION["phone"];
            } ?>">
            <?php
            if (isset($_SESSION["phoneInvalidMsg"]) && $_SESSION["phoneInvalidMsg"]) {
                echo "* Invalid phone number. Phone number must be contain 11 digits and only numbers.";
                $_SESSION["phoneInvalidMsg"] = null;
            }
            if (isset($_SESSION["phoneMatchedMsg"]) && $_SESSION["phoneMatchedMsg"]) {
                echo "* This phone is assosiated with another user.";
                $_SESSION["phoneMatchedMsg"] = null;
            }
            ?>
            <label for="dob" class="msg">Enter your date of birth</label>
            <input class="datePicker" id="dob" name="dob" type="date" value="<?php if (isset($_SESSION["dob"])) {
                echo $_SESSION["dob"];
            } ?>">
            <label class="spMsg2" for="profilepic"><img id="demoProfilePicIcon" src="Icons/profilepic.png"
                    alt="profilepic-icon"></label>
            <input id="profilepic" name="profilepic" type="file">
            <p>Supported File Type( .png, .jpg, .jpeg )</p>
            <?php
            if (isset($_SESSION["fileTypeInvalidMsg"]) && $_SESSION["fileTypeInvalidMsg"]) {
                echo "* Invalid picture type.";
                $_SESSION["fileTypeInvalidMsg"] = null;
            }
            if (isset($_SESSION["fileSizeInvalidMsg"]) && $_SESSION["fileSizeInvalidMsg"]) {
                echo "* Picture size must be less than 10 MB";
                $_SESSION["fileSizeInvalidMsg"] = null;
            }
            ?>
            <p align="center"><input class="submitBtnCreate" type="submit" name="submit" value="Update Changes"></p><br>
            <p class="goBackBtn"><a href="admin.php">Go Back</a></p>
        </form>
    </main>
    <div class="endSpace"></div>
</body>

</html>