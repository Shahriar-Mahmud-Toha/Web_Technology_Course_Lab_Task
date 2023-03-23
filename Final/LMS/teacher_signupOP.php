<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
require "Modules/_em.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $fullname = extractRaw($_POST["fullname"]);
    $t_username = extractRaw($_POST["t_username"]);
    $_SESSION["t_username"] = $t_username;
    $t_password = extractRaw($_POST["t_password"]);

    $_SESSION["fullname"] = $fullname;
    $_SESSION["t_username"] = $t_username;
    $_SESSION["t_password"] = $t_password;

    if (empty($fullname)) {
        $flag = false;
        $_SESSION["fullnameEmptyMsg"] = true;
    }
    if (empty($t_username)) {
        $flag = false;
        $_SESSION["t_usernameEmptyMsg"] = true;
    }
    if (empty($t_password)) {
        $flag = false;
        $_SESSION["t_passwordEmptyMsg"] = true;
    }
    if ($flag) {
        $validFlag = true;
        if (!validateUsername($t_username)) {
            $validFlag = false;
            $_SESSION["t_usernameInvalidMsg"] = true;
        }
        if ($validFlag) {
            $uniFlag = true;
            $sql = 'SELECT username FROM `teachertb` WHERE username="' . $t_username . '"';
            if (isValueExistsToDB("lmsdb", $sql)) {
                $_SESSION["t_usernameMatchedMsg"] = true;
                $uniFlag = false;
            }
            if ($uniFlag) {
                $sql = "INSERT INTO `teachertb`(`username`, `fullname`, `password`) VALUES ('$t_username','$fullname','$t_password')";
                if (noOutputQueryToDB("lmsdb", $sql)) {
                    setcookie("successAcCrMsg", true, time() + 120);
                    session_destroy();
                    header("location:teacher_login.php");
                } else {
                    echo "Database Error";
                    die();
                }
            } else {
                header("location:teacher_signup.php");
            }
        } else {
            header("location:teacher_signup.php");
        }
    } else {
        header("location:teacher_signup.php");
    }
} else {
    header("location:teacher_login.php");
}
?>