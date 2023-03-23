<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
require "Modules/_em.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $t_username = extractRaw($_POST["t_username"]);
    $_SESSION["t_username"] = $t_username;
    $t_password = extractRaw($_POST["t_password"]);
    if (empty($t_username)) {
        $flag = false;
        setcookie("t_usernameEmptyMsg", true, time() + 120);
    }
    if (empty($t_password)) {
        $flag = false;
        setcookie("t_passwordEmptyMsg", true, time() + 120);
    }
    if ($flag) {
        $sql = 'SELECT username FROM `teachertb` WHERE username="' . $t_username . '" and password="' . $t_password . '"';
        if (isValueExistsToDB("lmsdb", $sql)) {
            $_SESSION["t_username"] = $t_username;
            $_SESSION["tLoginVerified"] = true;
            header("location:home_teacher.php");
        } else {
            setcookie("invalidInfo", true, time() + 120);
            header("location:teacher_login.php");
        }
    } else {
        header("location:teacher_login.php");
    }
} else {
    header("location:teacher_login.php");
}
?>