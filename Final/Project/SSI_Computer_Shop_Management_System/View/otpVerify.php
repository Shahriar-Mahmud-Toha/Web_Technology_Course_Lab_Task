<?php
session_start();
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
if (isset($_SESSION["loginVerified"])) {
    if ($_SESSION["loginVerified"]) {
        header("location:login.php");
        die();
    }
}
if (!isset($_SESSION["signupVerfified"])) {
    session_destroy();
    header("location:login.php");
    die();
}
if (!$_SESSION["signupVerfified"]) {
    session_destroy();
    header("location:login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Email Verification</title>
</head>

<body>

    <?php require "header.php"; ?>
    <div align="center">
        <form action="../Controller/otpVerifyOP.php" method="post" novalidate>
            <table>
                <td></td>
                <td>
                    <fieldset>
                        <legend align="center">
                            <h2>Email Verification</h2>
                        </legend><br>
                        <p align="center">* OTP has been sent to your email</p>
                        <table>
                            <tr>
                                <td>
                                    <label for="otp"><img src="Icons/otp.png" height="25px" width="25px"
                                            alt="otp-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="otp" name="otp" type="text"
                                        placeholder="Enter your OTP"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["otpEmpty"]) && $_COOKIE["otpEmpty"]) {
                                        echo "* OTP cannot be Empty.";
                                        setcookie("otpEmpty", "", time() - 3600, "/");
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    if (isset($_COOKIE["otpNotMatched"]) && $_COOKIE["otpNotMatched"]) {
                                        echo "* OTP Not Matched.";
                                        setcookie("otpNotMatched", "", time() - 3600, "/");
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