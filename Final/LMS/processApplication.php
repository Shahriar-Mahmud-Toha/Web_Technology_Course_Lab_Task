<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
if (!isset($_SESSION["tLoginVerified"])) {
    session_destroy();
    header("location:teacher_login.php");
    die();
}
if (!isset($_SESSION["process"])) {
    header("location:home_teacher.php");
    die();
}
$_SESSION["process"] = null;
require "Modules/_em.php";
if (isset($_GET["username"]) && isset($_GET["approve"])) {
    $username = extractRaw($_GET["username"]);
    $approve = extractRaw($_GET["approve"]);
    $break = true;
    if ($approve == 0 || $approve == 1) {
        $break = false;
    }
    if ($break) {
        header("location:teacher_login.php");
        die();
    }
} else {
    header("location:teacher_login.php");
    die();
}
if ($approve) {
    $sql = 'UPDATE `studenttb` SET `approved`=1 WHERE username="' . $username . '"';
    $_SESSION["apvMsg"] = true;
} else {
    $sql = 'UPDATE `studenttb` SET `approved`=-1 WHERE username="' . $username . '"';
}
if (noOutputQueryToDB("lmsdb", $sql)) {
    header("location:home_teacher.php");
} else {
    $_SESSION["apvMsg"] = null;
    die("Cannot Update to Database.");
}
?>