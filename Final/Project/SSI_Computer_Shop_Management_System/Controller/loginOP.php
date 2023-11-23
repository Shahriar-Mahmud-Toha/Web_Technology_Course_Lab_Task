<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $username = extractRaw($_POST["username"]);
    $_SESSION["username"] = $username;
    $password = extractRaw($_POST["password"]);
    if (empty($username)) {
        $flag = false;
        setcookie("usernameEmptyMsg", true, time() + 120,"/");
    }
    if (empty($password)) {
        $flag = false;
        setcookie("passwordEmptyMsg", true, time() + 120,"/");
    }
    if ($flag) {
        if (isValueExistsToDbAccSet($username,$password)) {
            $_SESSION["username"] = $username;
            $_SESSION["loginVerified"] = true;
            if (isset($_POST["remember"])) {
                setcookie("remember", true, time() + 3600,"/");
                $ckid = $username . "=-" . hash('whirlpool', random_bytes(rand(2, 32)));
                if (update2Value("admindb","admintb","ckid",$ckid,"remember",1,"username",$username,"sis")) {
                    setcookie("ckid", "$ckid", time() + 3600,"/");
                } else {
                    die("Cookie Not Set");
                }
            } else {
                if (updateSingleValue("admindb","admintb","remember",0,"is","username",$username)) {
                    setcookie("ckid", "", time() - 3600,"/");
                    setcookie("remember", "", time() - 3600,"/");
                } else {
                    die("Cookie Not Removed");
                }
            }
            header("location:../View/admin.php");
        } else {
            setcookie("invalidInfo", true, time() + 120,"/");
            header("location:../View/login.php");
        }
    } else {
        header("location:../View/login.php");
    }
} else {
    // session_destroy();
    header("location:../View/login.php");
}
?>