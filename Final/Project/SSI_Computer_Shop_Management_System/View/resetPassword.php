<?php
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
session_start();
if (!isset($_SESSION["otpVerified"])) {
    header("location:login.php");
    die();
}
if (!$_SESSION["otpVerified"]) {
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
    <title>SSI Computer Shop - Reset Password</title>
</head>

<body>
    <?php require "header.php"; ?>
    <div align="center">
        <table>
            <td></td>
            <td>
                <fieldset>
                    <legend align="center">
                        <h2>Reset Password</h2>
                    </legend><br>
                    <form action="../Controller/resetPasswordOP.php" method="post" novalidate>
                        <table>
                            <tr>
                                <td>
                                    <label for="npassword"><img src="Icons/password.png" height="25px" width="25px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="npassword" name="npassword" type="password"
                                        placeholder="Enter new password"><br>&nbsp;
                                    <?php
                                    // if (isset($_SESSION["npasswordEmpty"])) {
                                    //     if ($_SESSION["npasswordEmpty"]) {
                                    //         echo "* New Password field cannot be Empty.";
                                    //         // session_destroy();
                                    //     }
                                    // }
                                    if (isset($_COOKIE["npasswordEmpty"]) && $_COOKIE["npasswordEmpty"]) {
                                        echo "* New Password field cannot be Empty.";
                                        setcookie("npasswordEmpty", "", time() - 3600, "/");
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cnpassword"><img src="Icons/password.png" height="25px" width="25px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="cnpassword" name="cnpassword" type="password"
                                        placeholder="Confirm new password"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["cnpasswordEmpty"]) && $_COOKIE["cnpasswordEmpty"]) {
                                        echo "* Confirm New Password field cannot be Empty.";
                                        setcookie("cnpasswordEmpty", "", time() - 3600, "/");
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <p align="center">
                            <?php
                            if (isset($_COOKIE["bothPassUnmatched"]) && $_COOKIE["bothPassUnmatched"]) {
                                echo "* New Password and Confirm New Password does not match.";
                                setcookie("bothPassUnmatched", "", time() - 3600, "/");
                            }
                            if (isset($_COOKIE["errorMsg"]) && $_COOKIE["errorMsg"]) {
                                echo "* Password reset unsuccessful.";
                                setcookie("errorMsg", "", time() - 3600, "/");
                            }
                            ?>
                        </p>
                        <p align="center"><input type="submit" value="Send OTP"></p><br>
                    </form>
                </fieldset>
            </td>
            <td></td>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>