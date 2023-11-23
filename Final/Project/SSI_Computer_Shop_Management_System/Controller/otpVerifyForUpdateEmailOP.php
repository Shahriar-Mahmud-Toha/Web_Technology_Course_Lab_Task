<?php
session_start();
if (!isset($_SESSION["otpSentCheck"])) {
    header("location:../View/login.php");
    die();
}
if (!$_SESSION["otpSentCheck"]) {
    header("location:../View/login.php");
    die();
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
        $email = $_SESSION["email"];
        $updatedEmail = $_SESSION["updatedEmail"];
        $username = $_SESSION["username"];
        if (verifyOtp($email, $otp, "admindb", "admintb")) {
            if (updateSingleValueWith2Param("admindb","admintb","email",$updatedEmail,"username",$username,"active",1,"ssi")) {
                $_SESSION["email"] = $updatedEmail;
                $_SESSION["successEmailUpdateMsg"] = true;
                header("location:../View/admin.php");
            } else {
                echo "Database Error";
                die();
            }
        } else {
            setcookie("otpNotMatched", true, time() + 120,"/");
            header("location:../View/otpVerifyForUpdateEmail.php");
        }
    } else {
        header("location:../View/otpVerifyForUpdateEmail.php");
    }
} else {
    header("location:../View/login.php");
}
?>