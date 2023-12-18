<?php
session_start();
require "../../Model/crud_database.php";
require "../essential_modules.php";
require "../../Model/_dashboard_m.php";

if (!isset($_SESSION["loginVerified"])) {
    session_destroy();
    header("location:../../View/login.php");
    die();
}
echo json_encode(getTotalSalaryWage());
?>