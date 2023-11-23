<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if (isset($_GET["logout"])) {
    $btn = extractRaw($_GET["logout"]);
} else {
    $btn = false;
}
if ($btn) {
    if (isset($_SESSION["loginVerified"])) {
        if ($_SESSION["loginVerified"]) {
            if (isset($_COOKIE["remember"])) {
                if ($_COOKIE["remember"]) {
                    $username = $_SESSION["username"];
                    $ckid = $username . "=-" . hash('whirlpool', random_bytes(rand(2, 32)));
                    if (update2Value("admindb","admintb","ckid",$ckid,"remember",1,"username",$username,"sis")) {
                        setcookie("ckid", "$ckid", time() + 3600,"/");
                    } else {
                        die("Cookie Not Set");
                    }
                }
            }
            session_destroy();
            header("location:../View/login.php");
        } else {
            echo "You have already logged out";
        }
    } else {
        header("location:../View/login.php");
    }
} else {
    header("location:../View/login.php");
}
?>