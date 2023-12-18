<?php
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
session_start();
if (!isset($_SESSION["otpVerified"])) {
    header("location:login.php");
    die();
}
if (!$_SESSION["otpVerified"]) {
    header("location:login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="resetPassId">
    <?php require "header.php"; ?>
    <main align="center">
        <form action="../Controller/resetPasswordOP.php" method="post" novalidate>
            <h2 class="mt">Reset Password</h2>
            <input class="inputBox" id="npassword" name="npassword" type="password" placeholder="Enter new password">
            <?php
            if (isset($_COOKIE["npasswordEmpty"]) && $_COOKIE["npasswordEmpty"]) {
                echo "* New Password field cannot be Empty.";
                setcookie("npasswordEmpty", "", time() - 3600, "/");
            }
            ?>
            <input class="inputBox" id="cnpassword" name="cnpassword" type="password" placeholder="Confirm new password">
            <?php
            if (isset($_COOKIE["cnpasswordEmpty"]) && $_COOKIE["cnpasswordEmpty"]) {
                echo "* Confirm New Password field cannot be Empty.";
                setcookie("cnpasswordEmpty", "", time() - 3600, "/");
            }
            ?>
            <p align="center">
                <?php
                if (isset($_COOKIE["bothPassUnmatched"]) && $_COOKIE["bothPassUnmatched"]) {
                    echo "* New Password and Confirm New Password does not match.";
                    setcookie("bothPassUnmatched", "", time() - 3600, "/");
                }
                if (isset($_COOKIE["errorMsg"]) && $_COOKIE["errorMsg"]) {
                    echo "* Password reset unsuccessful.";
                    setcookie("errorMsg", "", time() - 3600, "/");
                }
                ?>
            </p>
            <p align="center"><input class="submitBtnCreate" type="submit" value="Send OTP"></p><br>
        </form>
    </main>
    <div class="endSpace"></div>
</body>

</html>