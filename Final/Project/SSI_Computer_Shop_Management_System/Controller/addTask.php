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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $task = extractRaw($_POST["task"]);
    if (empty($task)) {
        $flag = false;
    }
    if ($flag) {
        $sql = 'INSERT INTO `tasktb`(`task`) VALUES ("' . $task . '")';
        if (insertSingleValue("admindb","tasktb","task",$task,"s")) {
            setcookie("taskAddedMsg", true, time() + 120,"/");
            header("location:../View/adminTask.php");
        } else {
            echo "Cannot stored in Database.";
            die();
        }
    } else {
        setcookie("taskEmptyMsg", true, time() + 120,"/");
        header("location:../View/adminTask.php");
    }
} else {
    header("location:../View/login.php");
}
?>