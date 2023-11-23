<?php
session_start();
if (isset($_SESSION["loginVerified"])) {
    if ($_SESSION["loginVerified"]) {
        header("location:admin.php");
        die();
    }
} else {
    header("location:login.php");
    session_destroy();
}
?>