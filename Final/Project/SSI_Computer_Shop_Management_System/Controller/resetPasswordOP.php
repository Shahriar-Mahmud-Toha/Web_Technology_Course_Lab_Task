<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    if (empty($_POST["npassword"])) {
        $flag = false;
        setcookie("npasswordEmpty", true, time() + 120,"/");
        // $_SESSION["npasswordEmpty"] = true;
    }
    if (empty($_POST["cnpassword"])) {
        $flag = false;
        setcookie("cnpasswordEmpty", true, time() + 120,"/");
        // $_SESSION["cnpasswordEmpty"] = true;
    }
    if ($flag) {
        $npassword = extractRaw($_POST["npassword"]);
        $cnpassword = extractRaw($_POST["cnpassword"]);
        $email = $_SESSION["email"];
        if ($npassword != $cnpassword) {
            setcookie("bothPassUnmatched", true, time() + 120,"/");
            // $_SESSION["bothPassUnmatched"] = true;
            header("location:../View/resetPassword.php");
            die();
        }
        if (updateSingleValue("admindb","admintb","password",$npassword,"ss","email",$email)) {
            setcookie("resetSuccessMsg", true, time() + 3600,"/");
            session_destroy();
            header("location:../View/login.php");
        } else {
            setcookie("errorMsg", true, time() + 120,"/");
            // $_SESSION["errorMsg"] = true;
            header("location:../View/resetPassword.php");
        }
    } else {
        header("location:../View/resetPassword.php");
    }
} else {
    // session_destroy();
    header("location:../View/login.php");
}
?>