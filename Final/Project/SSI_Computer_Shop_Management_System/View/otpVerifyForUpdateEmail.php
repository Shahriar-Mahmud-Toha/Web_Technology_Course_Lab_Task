<?php
session_start();
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
if (!isset($_SESSION["otpSentCheck"])) {
    header("location:login.php");
    die();
}
if (!$_SESSION["otpSentCheck"]) {
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
    <title>SSI Computer Shop - OTP Verification</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="otpVerifyForUpdateId">
    <?php require "header.php"; ?>
    <main align="center">
        <form action="../Controller/otpVerifyForUpdateEmailOP.php" method="post" novalidate>
            <h2 class="mt">OTP Verification</h2>
            <p align="center">* OTP has been sent to your email</p>
            <input class="inputBox" id="otp" name="otp" type="text" placeholder="Enter your OTP">
            <?php
            if (isset($_COOKIE["otpEmpty"]) && $_COOKIE["otpEmpty"]) {
                echo "* OTP cannot be Empty.";
                setcookie("otpEmpty", "", time() - 3600, "/");
            }
            ?>
            <?php
            if (isset($_COOKIE["otpNotMatched"]) && $_COOKIE["otpNotMatched"]) {
                echo "* OTP Not Matched.";
                setcookie("otpNotMatched", "", time() - 3600, "/");
            }
            ?>
            <p align="center"><input class="submitBtnCreate" type="submit" name="submit" value="Submit"></p>
        </form>
    </main>
    <div class="endSpace"></div>
</body>

</html>