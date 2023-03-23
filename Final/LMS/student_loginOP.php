<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
require "Modules/_em.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $std_username = extractRaw($_POST["std_username"]);
    $_SESSION["std_username"] = $std_username;
    $std_password = extractRaw($_POST["std_password"]);
    if (empty($std_username)) {
        $flag = false;
        setcookie("std_usernameEmptyMsg", true, time() + 120);
    }
    if (empty($std_password)) {
        $flag = false;
        setcookie("std_passwordEmptyMsg", true, time() + 120);
    }
    if ($flag) {
        $sql = 'SELECT username FROM `studenttb` WHERE username="' . $std_username . '" and password="' . $std_password . '"';
        if (isValueExistsToDB("lmsdb", $sql)) {
            $_SESSION["std_username"] = $std_username;
            $_SESSION["stdLoginVerified"] = true;
            header("location:home_student.php");
        } else {
            setcookie("invalidInfo", true, time() + 120);
            header("location:student_login.php");
        }
    } else {
        header("location:student_login.php");
    }
} else {
    header("location:student_login.php");
}
?>