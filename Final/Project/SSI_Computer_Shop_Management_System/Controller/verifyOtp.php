<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    if (empty($_POST["otp"])) {
        $flag = false;
        setcookie("otpEmpty", true, time() + 120,"/");
    }
    if ($flag) {
        $otp = extractRaw($_POST["otp"]);
        if (verifyOtp($_SESSION["email"], $otp, "admindb", "admintb")) {
            $_SESSION["otpVerified"] = true;
            header("location:../View/resetPassword.php");
        } else {
            setcookie("otpNotMatched", true, time() + 120,"/");
            header("location:../View/forgotPassword.php");
        }
    } else {
        header("location:../View/forgotPassword.php");
    }
} else {
    header("location:../View/login.php");
}
?>