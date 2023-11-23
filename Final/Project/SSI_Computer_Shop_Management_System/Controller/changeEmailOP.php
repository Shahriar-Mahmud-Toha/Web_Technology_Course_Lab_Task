<?php
session_start();
if (!isset($_SESSION["loginVerified"])) {
    session_destroy();
    header("location:../View/login.php");
    die();
}
if (!$_SESSION["loginVerified"]) {
    session_destroy();
    header("location:../View/login.php");
    die();
}
if (!isset($_SESSION["passwordVerified"])) {
    session_destroy();
    header("location:../View/login.php");
    die();
}
if (!$_SESSION["passwordVerified"]) {
    session_destroy();
    header("location:../View/login.php");
    die();
}
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $username = $_SESSION["username"];
    $email = extractRaw($_POST["email"]);
    $email = strtolower($email);
    $_SESSION["emailNew"] = $email;
    if (empty($email)) {
        $flag = false;
        $_SESSION["emailEmptyMsg"] = true;
    }
    if ($flag) {
        $validFlag = true;
        if (!validateEmail($email)) {
            $validFlag = false;
            $_SESSION["emailInvalidMsg"] = true;
        }
        if ($validFlag) {
            $uniFlag = true;
            if (isSingleValueExistsToDB("admindb","admintb","email",$email,"s")) {
                $_SESSION["emailMatchedMsg"] = true;
                $uniFlag = false;
            }
            if ($uniFlag) {
                if (sendOtpForUpdateEmail($email, $username, "admindb", "admintb")) {
                    $_SESSION["updatedEmail"] = $email;
                    $_SESSION["otpSentCheck"] = true;
                    header("location:../View/otpVerifyForUpdateEmail.php");
                } else {
                    $_SESSION["otpNotSentMsg"] = true;
                    header("location:../View/changeEmail.php");
                }
            } else {
                header("location:../View/changeEmail.php");
            }
        } else {
            header("location:../View/changeEmail.php");
        }
    } else {
        header("location:../View/changeEmail.php");
    }
} else {
    header("location:../View/login.php");
}
?>