<?php
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
session_start();
if (isset($_SESSION["loginVerified"])) {
    if ($_SESSION["loginVerified"]) {
        header("location:admin.php");
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Forgot Password</title>
    <script src="validateForm.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="forgotPasswordId">
    <?php require "header.php"; ?>
    <main>
    <div align="center">
        <table>
            <td></td>
            <td>
                <fieldset>
                    <legend align="center">
                        <h2>Forgot Password</h2>
                    </legend><br>
                    <?php if (!isset($_SESSION["otpSent"])) {
                        session_destroy(); ?>

                        <form action="../Controller/forgotPasswordOP.php" method="post" novalidate onsubmit="return validForgotPasswordForm(this);">
                            <table>
                                <tr>
                                    <td>
                                        <label for="email"><img src="Icons/email.png" height="25px" width="25px"
                                                alt="email-icon"></label>
                                    </td>
                                    <td>
                                        &nbsp; <input id="email" name="email" type="text"
                                            placeholder="Enter your email"><br>&nbsp;
                                        <?php
                                        if (isset($_COOKIE["recEmailEmptyMsg"]) && $_COOKIE["recEmailEmptyMsg"]) {
                                            echo "* Email cannot be Empty.";
                                            setcookie("recEmailEmptyMsg", "", time() - 3600, "/");
                                        }
                                        if (isset($_COOKIE["otpNotSentMsg"]) && $_COOKIE["otpNotSentMsg"]) {
                                            echo "* OTP not sent to this email.";
                                            setcookie("otpNotSentMsg", "", time() - 3600, "/");
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <p align="center">
                                <?php
                                if (isset($_COOKIE["invalidRecEmail"]) && $_COOKIE["invalidRecEmail"]) {
                                    echo "* There is no user associated with this email address.";
                                    setcookie("invalidRecEmail", "", time() - 3600, "/");
                                }
                                ?>
                            </p>
                            <p align="center"><input type="submit" value="Send OTP"></p><br>
                            <p align="center"><a href="login.php">Login</a></p>
                        </form>
                    <?php }
                    ?>
                    <?php if (isset($_SESSION["otpSent"])) {
                        if ($_SESSION["otpSent"]) { ?>
                            <form action="../Controller/verifyOtp.php" method="post" novalidate>
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
                                </table>
                                <p align="center">
                                    <?php
                                    if (isset($_COOKIE["otpNotMatched"]) && $_COOKIE["otpNotMatched"]) {
                                        echo "* Invalid OTP.";
                                        setcookie("otpNotMatched", "", time() - 3600, "/");
                                    }
                                    ?>
                                </p>
                                <p align="center"><input type="submit" value="Submit OTP"></p><br>
                            </form>
                        <?php }
                    } ?>
                </fieldset>
                <p align="center">Don't have an account? <a href="signup.php">Signup</a></p>
            </td>
            <td></td>
        </table>
    </div>
    </main>
    <div class="endSpace"></div>
</body>

</html>