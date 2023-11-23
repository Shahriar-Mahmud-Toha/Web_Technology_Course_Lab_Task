<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    if (empty($_POST["email"])) {
        $flag = false;
        setcookie("recEmailEmptyMsg", true, time() + 120,"/");
    }
    if ($flag) {
        $email = extractRaw($_POST["email"]);
        // $sql = 'SELECT username FROM `admintb` WHERE email="' . $email . '"';
        $username = getSingleValue("admindb","admintb","username","email",$email,"s");
        if($username==null){
            setcookie("invalidRecEmail", true, time() + 120,"/");
            header("location:../View/forgotPassword.php");
            session_destroy();
            die();
        }
        if (!sendOtp($email, "admindb", "admintb", true)) {
            setcookie("otpNotSentMsg", true, time() + 120,"/");
            header("location:../View/forgotPassword.php");
            session_destroy();
            die();
        }
        $_SESSION["otpSent"] = true;
        $_SESSION["email"] = $email;
        header("location:../View/forgotPassword.php");
    } else {
        session_destroy();
        header("location:../View/forgotPassword.php");
    }
} else {
    header("location:../View/login.php");
}
?>