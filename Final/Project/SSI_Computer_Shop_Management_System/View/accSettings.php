<?php
session_start();
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
$status = false;
$check = true;
if (isset($_GET["accset"])) {
    $btn = extractRaw($_GET["accset"]);
} else {
    $btn = false;
}
if (isset($_SESSION["accSetPass"])) {
    if ($_SESSION["accSetPass"]) {
        $status = true;
        $check = false;
    }
}
if ($check) {
    if ($btn) {
        if (isset($_SESSION["loginVerified"])) {
            if ($_SESSION["loginVerified"]) {
                $status = true;
            } else {
                header("location:login.php");
            }
        } else {
            header("location:login.php");
        }
    } else {
        header("location:login.php");
    }
}
if (!$status) {
    header("location:login.php");
    die();
}
$_SESSION["accSetPass"] = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Account Settings</title>
</head>

<body>

    <?php require "header.php"; ?>
    <div align="center">
        <form action="../Controller/accSettingsOP.php" method="post" novalidate enctype="multipart/form-data">
            <table>
                <td></td>
                <td>
                    <fieldset>
                        <legend align="center">
                            <h2>Account Settings</h2>
                        </legend><br>
                        <table>
                            <tr>
                                <td>
                                    <label for="fullname"><img src="Icons/fullname.png" height="25px" width="25px"
                                            alt="fullname-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="fullname" name="fullname" type="text"
                                        placeholder="Enter your full name" value="<?php if (isset($_SESSION["fullname"])) {
                                            echo $_SESSION["fullname"];
                                        } ?>"><br>&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="curpassword"><img src="Icons/password.png" height="20px" width="20px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="curpassword" name="curpassword" type="password"
                                        placeholder="Enter your current password"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["passNotMatched"]) && $_SESSION["passNotMatched"]) {
                                        echo "*  Incorrect current password";
                                        $_SESSION["passNotMatched"] = null;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="npassword"><img src="Icons/password.png" height="20px" width="20px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="npassword" name="npassword" type="password"
                                        placeholder="Enter new password"><br>&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="Icons/email.png" height="25px" width="25px" alt="email-icon">
                                </td>
                                <td>
                                    &nbsp; <a href="verifyPassword.php?change=1">Change Email</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="address"><img src="Icons/address.png" height="25px" width="25px"
                                            alt="address-icon"></label>
                                </td>
                                <td>
                                    &nbsp;&nbsp;<textarea id="address" name="address" cols="21" rows="2"
                                        placeholder="Enter your home address" value="<?php if (isset($_SESSION["address"])) {
                                            echo $_SESSION["address"];
                                        } ?>"></textarea><br>&nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="nid"><img src="Icons/nid.png" height="25px" width="25px"
                                            alt="nid-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="nid" name="nid" type="text" placeholder="Enter your NID number"
                                        value="<?php if (isset($_SESSION["nid"])) {
                                            echo $_SESSION["nid"];
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["nidInvalidMsg"]) && $_SESSION["nidInvalidMsg"]) {
                                        echo "* Invalid nid number format. Only <= 10 digit numbers are allowed";
                                        $_SESSION["nidInvalidMsg"] = null;
                                    }
                                    if (isset($_SESSION["nidMatchedMsg"]) && $_SESSION["nidMatchedMsg"]) {
                                        echo "* This nid is assosiated with another user.";
                                        $_SESSION["nidMatchedMsg"] = null;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phone"><img src="Icons/phone.png" height="19px" width="19px"
                                            alt="phone-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="phone" name="phone" type="text"
                                        placeholder="Enter your phone number" value="<?php if (isset($_SESSION["phone"])) {
                                            echo $_SESSION["phone"];
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["phoneInvalidMsg"]) && $_SESSION["phoneInvalidMsg"]) {
                                        echo "* Invalid phone number. Phone number must be contain 11 digits and only numbers.";
                                        $_SESSION["phoneInvalidMsg"] = null;
                                    }
                                    if (isset($_SESSION["phoneMatchedMsg"]) && $_SESSION["phoneMatchedMsg"]) {
                                        echo "* This phone is assosiated with another user.";
                                        $_SESSION["phoneMatchedMsg"] = null;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="dob"><img src="Icons/dob.png" height="25px" width="25px"
                                            alt="dob-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="dob" name="dob" type="date" value="<?php if (isset($_SESSION["dob"])) {
                                        echo $_SESSION["dob"];
                                    } ?>"><br>&nbsp;
                                    <font size="2px">Enter your date of birth</font><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="profilepic"><img src="Icons/profilepic.png" height="25px" width="25px"
                                            alt="profilepic-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="profilepic" name="profilepic" type="file"><br>&nbsp;
                                    <font size="2px">Supported File Type( .png, .jpg, .jpeg )</font><br><br>
                                    <?php
                                    if (isset($_SESSION["fileTypeInvalidMsg"]) && $_SESSION["fileTypeInvalidMsg"]) {
                                        echo "* Invalid picture type.";
                                        $_SESSION["fileTypeInvalidMsg"] = null;
                                    }
                                    if (isset($_SESSION["fileSizeInvalidMsg"]) && $_SESSION["fileSizeInvalidMsg"]) {
                                        echo "* Picture size must be less than 10 MB";
                                        $_SESSION["fileSizeInvalidMsg"] = null;
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <p align="center"><input type="submit" name="submit" value="Update Changes"></p><br>
                    </fieldset>
                    <p align="center"><a href="admin.php">Go Back</a></p>
                </td>
                <td></td>
            </table>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>