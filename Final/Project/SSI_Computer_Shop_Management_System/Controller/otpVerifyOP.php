<?php
session_start();
if (isset($_SESSION["loginVerified"])) {
    if (!$_SESSION["loginVerified"]) {
        header("location:../View/admin.php");
        die();
    }
}
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
        $email = extractRaw($_SESSION["emailSignUp"]);
        if (verifyOtp($email, $otp, "admindb", "admintb")) {
            if (updateSingleValue("admindb","admintb","active",1,"is","email",$email)) {
                setcookie("successAcCrMsg", true, time() + 120,"/");
                session_destroy();
                header("location:../View/login.php");
            }
        } else {
            setcookie("otpNotMatched", true, time() + 120,"/");
            header("location:../View/otpVerify.php");
        }
    } else {
        header("location:../View/otpVerify.php");
    }
} else {
    header("location:../View/login.php");
}
?>