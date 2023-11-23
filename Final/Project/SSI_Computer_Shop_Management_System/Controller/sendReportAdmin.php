<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
require "../Model/_dashboard_m.php";
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
if (isset($_GET["send"])) {
    $btn["snEdit"] = extractRaw($_GET["send"]);
} else {
    $btn = false;
}
if (!$btn) {
    header("location:../View/admin.php");
    die();
}
if (sendReportToAdmin($_SESSION["report"], $_SESSION["username"])) {
    $_SESSION["reportSntSuccss"] = true;
    $_SESSION["report"] = null;
    header("location:../View/admin.php");
} else {
    header("location:../View/admin.php");
}
?>