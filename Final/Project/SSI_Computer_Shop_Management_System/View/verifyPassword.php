<?php
session_start();
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
$check = false;
if (isset($_GET["change"])) {
    $btn = extractRaw($_GET["change"]);
} else {
    $btn = false;
}
if (isset($_SESSION["loginVerified"])) {
    if ($_SESSION["loginVerified"]) {
        $check = true;
    }
}
if (!$btn) {
    $check = false;
}
if (isset($_SESSION["cngPassChecked"])) {
    if ($_SESSION["cngPassChecked"]) {
        $check = true;
        $_SESSION["cngPassChecked"] = null;
    }
}
if (!$check) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Change Email</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="verifyPasswordId">
    <?php require "header.php"; ?>
    <main>
        <form class="curPassContainerVerPas" action="../Controller/verifyPasswordOP.php" method="post" novalidate>
            <h2 class="mt">Confirm Current Password</h2>
            <input class="inputBox" id="password" name="password" type="password"
                placeholder="Enter your current password">
            <?php
            if (isset($_COOKIE["passwordEmptyMsg"]) && $_COOKIE["passwordEmptyMsg"]) {
                echo "* Password cannot be Empty.";
                setcookie("passwordEmptyMsg", "", time() - 3600, "/");
            }
            ?>
            <?php
            if (isset($_COOKIE["invalidInfo"]) && $_COOKIE["invalidInfo"]) {
                echo "* Invalid Password";
                setcookie("invalidInfo", "", time() - 3600, "/");
            }
            ?>
            <p align="center"><input class="submitBtnCreate" type="submit" name="submit" value="Submit"></p><br>
        </form>
    </main>
    <div class="endSpace"></div>
</body>

</html>