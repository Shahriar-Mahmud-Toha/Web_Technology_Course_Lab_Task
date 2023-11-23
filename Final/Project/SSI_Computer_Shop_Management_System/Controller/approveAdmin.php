<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if (!isset($_SESSION["loginVerified"])) {
    session_destroy();
    header("location:../View/login.php");
    die();
}
if (!($_SESSION["loginVerified"])) {
    session_destroy();
    header("location:../View/login.php");
    die();
}
if (!isset($_SESSION["manageOk"])) {
    header("location:../View/admin.php");
    die();
}
if (!($_SESSION["manageOk"])) {
    header("location:../View/admin.php");
    die();
}
if (isset($_GET["username"])) {
    $flag = true;
    $username = extractRaw($_GET["username"]);
    if (updateSingleValueWith2Param("admindb","employeetb","approval",1,"username",$username,"verified",1,"isi")) {
        $_SESSION["manageOk"] = null;
        setcookie("empApvMsg", true, time() + 120,"/");
        header("location:../View/userManagementAdmin.php");
    } else {
        die("Cannot Update to Database.");
    }
} else {
    header("location:../View/login.php");
}
?>