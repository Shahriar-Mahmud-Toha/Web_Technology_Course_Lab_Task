<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
require "Modules/_em.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $fullname = extractRaw($_POST["fullname"]);
    $std_username = extractRaw($_POST["std_username"]);
    $_SESSION["std_username"] = $std_username;
    $std_password = extractRaw($_POST["std_password"]);

    $_SESSION["fullname"] = $fullname;
    $_SESSION["std_username"] = $std_username;
    $_SESSION["std_password"] = $std_password;

    if (empty($fullname)) {
        $flag = false;
        $_SESSION["fullnameEmptyMsg"] = true;
    }
    if (empty($std_username)) {
        $flag = false;
        $_SESSION["std_usernameEmptyMsg"] = true;
    }
    if (empty($std_password)) {
        $flag = false;
        $_SESSION["std_passwordEmptyMsg"] = true;
    }
    if ($flag) {
        $validFlag = true;
        if (!validateUsername($std_username)) {
            $validFlag = false;
            $_SESSION["std_usernameInvalidMsg"] = true;
        }
        if ($validFlag) {
            $uniFlag = true;
            $sql = 'SELECT username FROM `studenttb` WHERE username="' . $std_username . '"';
            if (isValueExistsToDB("lmsdb", $sql)) {
                $_SESSION["std_usernameMatchedMsg"] = true;
                $uniFlag = false;
            }
            if ($uniFlag) {
                $sql = "INSERT INTO `studenttb`(`username`, `fullname`, `password`) VALUES ('$std_username','$fullname','$std_password')";
                if (noOutputQueryToDB("lmsdb", $sql)) {
                    $sql = 'CREATE TABLE `lmsdb`.`' . $std_username . '_files` (`filename` VARCHAR(128) NULL DEFAULT NULL , `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`)) ENGINE = InnoDB';
                    noOutputQueryToDB("lmsdb", $sql);
                    if (!is_dir('uploadedFiles/' . $std_username . '')) {
                        mkdir('uploadedFiles/' . $std_username . '', 0777, true);
                    }
                    setcookie("successAcCrMsg", true, time() + 120);
                    session_destroy();
                    header("location:student_login.php");
                } else {
                    echo "Database Error";
                    die();
                }
            } else {
                header("location:student_signup.php");
            }
        } else {
            header("location:student_signup.php");
        }
    } else {
        header("location:student_signup.php");
    }
} else {
    header("location:student_login.php");
}
?>