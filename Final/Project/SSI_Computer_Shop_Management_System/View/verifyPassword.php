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
</head>

<body>

    <?php require "header.php"; ?>
    <div align="center">
        <form action="../Controller/verifyPasswordOP.php" method="post" novalidate>
            <table>
                <td></td>
                <td>
                    <fieldset>
                        <legend align="center">
                            <h2>Confirm Current Password</h2>
                        </legend><br>
                        <table>
                            <tr>
                                <td>
                                    <label for="password"><img src="Icons/password.png" height="20px" width="20px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="password" name="password" type="password"
                                        placeholder="Enter your current password"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["passwordEmptyMsg"]) && $_COOKIE["passwordEmptyMsg"]) {
                                        echo "* Password cannot be Empty.";
                                        setcookie("passwordEmptyMsg", "", time() - 3600, "/");
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    if (isset($_COOKIE["invalidInfo"]) && $_COOKIE["invalidInfo"]) {
                                        echo "* Invalid Password";
                                        setcookie("invalidInfo", "", time() - 3600, "/");
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <p align="center"><input type="submit" name="submit" value="Submit"></p><br>
                    </fieldset>
                </td>
                <td></td>
            </table>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>