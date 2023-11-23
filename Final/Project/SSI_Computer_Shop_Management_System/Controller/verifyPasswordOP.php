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
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $username = $_SESSION["username"];
    $password = extractRaw($_POST["password"]);
    if (empty($password)) {
        $flag = false;
        setcookie("passwordEmptyMsg", true, time() + 120,"/");
    }
    if ($flag) {
        if (isValueExistsToWith3Param("admindb","admintb","username","username",$username,"password",$password,"active",1,"ssi")) {
            $_SESSION["passwordVerified"] = true;
            header("location:../View/changeEmail.php");
        } else {
            $_SESSION["cngPassChecked"] = true;
            setcookie("invalidInfo", true, time() + 120,"/");
            header("location:../View/verifyPassword.php");
        }
    } else {
        $_SESSION["cngPassChecked"] = true;
        header("location:../View/verifyPassword.php");
    }
} else {
    header("location:../View/login.php");
}
?>