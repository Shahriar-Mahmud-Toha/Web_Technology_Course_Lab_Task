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
if (!isset($_SESSION["deleteOk"])) {
    header("location:../View/adminTask.php");
    die();
}
if (!($_SESSION["deleteOk"])) {
    header("location:../View/adminTask.php");
    die();
}
if (isset($_GET["sn"])) {
    $flag = true;
    $sn = extractRaw($_GET["sn"]);
    if (deleteSingleValue("admindb","tasktb","sn",$sn,"i")) {
        $_SESSION["deleteOk"] = null;
        setcookie("taskDeletedMsg", true, time() + 120,"/");
        header("location:../View/adminTask.php");
    } else {
        die("Cannot Deleted from Database.");
    }
} else {
    header("location:../View/login.php");
}
?>