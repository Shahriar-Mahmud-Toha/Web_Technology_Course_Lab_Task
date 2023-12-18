<?php
session_start();
if (isset($_SESSION["loginVerified"])) {
    if ($_SESSION["loginVerified"]) {
        header("location:View/admin.php");
        die();
    }
} else {
    header("location:View/login.php");
    session_destroy();
}
?>