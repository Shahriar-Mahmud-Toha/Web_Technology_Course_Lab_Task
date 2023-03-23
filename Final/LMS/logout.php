<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
require "Modules/_em.php";
if (isset($_GET["logout"])) {
    $btn = extractRaw($_GET["logout"]);
} else {
    $btn = false;
}
if ($btn) {
    if (isset($_SESSION["stdLoginVerified"])) {
        if ($_SESSION["stdLoginVerified"]) {
            session_destroy();
            header("location:student_login.php");
        } else {
            echo "You have already logged out";
        }
    } else if (isset($_SESSION["tLoginVerified"])) {
        if ($_SESSION["tLoginVerified"]) {
            session_destroy();
            header("location:teacher_login.php");
        } else {
            echo "You have already logged out";
        }
    } else {
        header("location:student_login.php");
    }
} else {
    header("location:student_login.php");
}
?>