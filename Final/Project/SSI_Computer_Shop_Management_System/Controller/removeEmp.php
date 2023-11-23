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
if (!isset($_SESSION["manageROk"])) {
    header("location:../View/admin.php");
    die();
}
if (!($_SESSION["manageROk"])) {
    header("location:../View/admin.php");
    die();
}
if (isset($_GET["username"])) {
    $flag = true;
    $username = extractRaw($_GET["username"]);
    $sql = "DELETE FROM `employeetb` WHERE username='$username'";
    if (deleteSingleValue("admindb","employeetb","username",$username,"s")) {
        $_SESSION["manageROk"] = null;
        setcookie("empDeletedMsg", true, time() + 120,"/");
        header("location:../View/userManagementAdmin.php");
    } else {
        die("Cannot Deleted from Database.");
    }
} else {
    header("location:../View/login.php");
}
?>