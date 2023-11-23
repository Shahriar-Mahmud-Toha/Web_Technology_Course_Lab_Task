<?php
session_start();
if (!isset($_SESSION["passwordVerified"])) {
    session_destroy();
    header("location:login.php");
    die();
}
if (!$_SESSION["passwordVerified"]) {
    session_destroy();
    header("location:login.php");
    die();
}
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
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
        <form action="../Controller/changeEmailOP.php" method="post" novalidate>
            <table>
                <td></td>
                <td>
                    <fieldset>
                        <legend align="center">
                            <h2>Change Email</h2>
                        </legend><br>
                        <!-- <p align="center">* OTP has been sent to your email</p> -->
                        <table>
                            <tr>
                                <td>
                                    <label for="email"><img src="Icons/email.png" height="25px" width="25px"
                                            alt="email-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="email" name="email" type="text" placeholder="Enter your new email"
                                        value="<?php if (isset($_SESSION["emailNew"])) {
                                            echo $_SESSION["emailNew"];
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["emailEmptyMsg"]) && $_SESSION["emailEmptyMsg"]) {
                                        echo "* Email cannot be Empty.";
                                        $_SESSION["emailEmptyMsg"] = null;
                                    }
                                    if (isset($_SESSION["emailInvalidMsg"]) && $_SESSION["emailInvalidMsg"]) {
                                        echo "* Invalid email";
                                        $_SESSION["emailInvalidMsg"] = null;
                                    }
                                    if (isset($_SESSION["emailMatchedMsg"]) && $_SESSION["emailMatchedMsg"]) {
                                        echo "* This email is assosiated with another user.";
                                        $_SESSION["emailMatchedMsg"] = null;
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