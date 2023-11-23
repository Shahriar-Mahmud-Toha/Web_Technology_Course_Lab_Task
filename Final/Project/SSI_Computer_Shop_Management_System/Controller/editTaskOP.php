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

if (!isset($_SESSION["snEdit"])) {
    header("location:../View/adminTask.php");
    die();
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $flag = true;
    $sn = $_SESSION["snEdit"];
    $task = extractRaw($_POST["task"]);
    if (empty($task)) {
        $flag = false;
    }
    if ($flag) {
        if (updateSingleValue("admindb","tasktb","task",$task,"si","sn",$sn)) {
            setcookie("taskUpdatedMsg", true, time() + 120,"/");
            header("location:../View/adminTask.php");
        } else {
            echo "Cannot stored in Database.";
            die();
        }
    } else {
        $_SESSION["editTsk"] = true;
        setcookie("taskEmptyMsg", true, time() + 120,"/");
        header("location:editTask.php");
    }
} else {
    header("location:../View/login.php");
}
?>