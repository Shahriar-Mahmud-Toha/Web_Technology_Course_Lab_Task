<?php
session_start();
if (isset($_SESSION["loginVerified"])) {
    if ($_SESSION["loginVerified"]) {
        header("location:admin.php");
        die();
    }
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
    <title>SSI Computer Shop - Signup</title>
</head>

<body>

    <?php require "header.php"; ?>
    <div align="center">
        <form action="../Controller/signupOP.php" method="post" novalidate enctype="multipart/form-data">
            <table>
                <td></td>
                <td>
                    <fieldset>
                        <legend align="center">
                            <h2>Sign Up</h2>
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
                                    <?php
                                    if (isset($_SESSION["fullnameEmptyMsg"]) && $_SESSION["fullnameEmptyMsg"]) {
                                        echo "* Fullname cannot be Empty.";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="username"><img src="Icons/username.png" height="25px" width="25px"
                                            alt="username-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="username" name="username" type="text"
                                        placeholder="Enter your username" value="<?php if (isset($_SESSION["username"])) {
                                            echo $_SESSION["username"];
                                        } ?>"><br>&nbsp;
                                    <font size="1px">* Only Lowercase letters(a-z), Underscore(_), numbers(0-9) are
                                        allowed.</font><br><br>
                                    <?php
                                    if (isset($_SESSION["usernameEmptyMsg"]) && $_SESSION["usernameEmptyMsg"]) {
                                        echo "* Username cannot be Empty.";
                                    }
                                    if (isset($_SESSION["usernameInvalidMsg"]) && $_SESSION["usernameInvalidMsg"]) {
                                        echo "* Invalid Username";
                                    }
                                    if (isset($_SESSION["usernameMatchedMsg"]) && $_SESSION["usernameMatchedMsg"]) {
                                        echo "* Username already exists. Choose another username!";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password"><img src="Icons/password.png" height="20px" width="20px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="password" name="password" type="password"
                                        placeholder="Enter your password"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["passwordEmptyMsg"]) && $_SESSION["passwordEmptyMsg"]) {
                                        echo "* Password cannot be Empty.";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email"><img src="Icons/email.png" height="25px" width="25px"
                                            alt="email-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="email" name="email" type="text" placeholder="Enter your email"
                                        value="<?php if (isset($_SESSION["email"])) {
                                            echo $_SESSION["email"];
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["emailEmptyMsg"]) && $_SESSION["emailEmptyMsg"]) {
                                        echo "* Email cannot be Empty.";
                                    }
                                    if (isset($_SESSION["emailInvalidMsg"]) && $_SESSION["emailInvalidMsg"]) {
                                        echo "* Invalid email";
                                    }
                                    if (isset($_SESSION["emailMatchedMsg"]) && $_SESSION["emailMatchedMsg"]) {
                                        echo "* This email is assosiated with another user.";
                                    }
                                    ?>
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
                                    <?php
                                    if (isset($_SESSION["addressEmptyMsg"]) && $_SESSION["addressEmptyMsg"]) {
                                        echo "* Address cannot be Empty.";
                                    }
                                    ?>
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
                                    if (isset($_SESSION["nidEmptyMsg"]) && $_SESSION["nidEmptyMsg"]) {
                                        echo "* NID number cannot be Empty.";
                                    }
                                    if (isset($_SESSION["nidInvalidMsg"]) && $_SESSION["nidInvalidMsg"]) {
                                        echo "* Invalid nid number format. Only <= 10 digit numbers are allowed";
                                    }
                                    if (isset($_SESSION["nidMatchedMsg"]) && $_SESSION["nidMatchedMsg"]) {
                                        echo "* This nid is assosiated with another user.";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="male"><img src="Icons/gender.png" height="25px" width="25px"
                                            alt="gender-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="male" type="radio" name="gender" value="male">Male
                                    <input type="radio" name="gender" id="female" value="female">Female<br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["genderEmptyMsg"]) && $_SESSION["genderEmptyMsg"]) {
                                        echo "* Gender must be selected.";
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
                                    if (isset($_SESSION["phoneEmptyMsg"]) && $_SESSION["phoneEmptyMsg"]) {
                                        echo "* Phone number cannot be Empty.";
                                    }
                                    if (isset($_SESSION["phoneInvalidMsg"]) && $_SESSION["phoneInvalidMsg"]) {
                                        echo "* Invalid phone number. Phone number must be contain 11 digits and only numbers.";
                                    }
                                    if (isset($_SESSION["phoneMatchedMsg"]) && $_SESSION["phoneMatchedMsg"]) {
                                        echo "* This phone is assosiated with another user.";
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
                                    <?php
                                    if (isset($_SESSION["dobEmptyMsg"]) && $_SESSION["dobEmptyMsg"]) {
                                        echo "* Date of birth must be selected.";
                                    }
                                    ?>
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
                                    if (isset($_SESSION["profilepicEmptyMsg"]) && $_SESSION["profilepicEmptyMsg"]) {
                                        echo "* Profile picture must be selected.";
                                    }
                                    if (isset($_SESSION["fileTypeInvalidMsg"]) && $_SESSION["fileTypeInvalidMsg"]) {
                                        echo "* Invalid picture type.";
                                    }
                                    if (isset($_SESSION["fileSizeInvalidMsg"]) && $_SESSION["fileSizeInvalidMsg"]) {
                                        echo "* Picture size must be less than 10 MB";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="accesskey"><img src="Icons/accesskey.png" height="25px" width="25px"
                                            alt="accesskey-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="accesskey" name="accesskey" type="text"
                                        placeholder="Enter your grant access key" value="<?php if (isset($_SESSION["accesskey"])) {
                                            echo $_SESSION["accesskey"];
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["accesskeyEmptyMsg"]) && $_SESSION["accesskeyEmptyMsg"]) {
                                        echo "* Accesskey cannot be Empty.";
                                    }
                                    if (isset($_SESSION["invalidAccessKeyMsg"]) && $_SESSION["invalidAccessKeyMsg"]) {
                                        echo "* Invalid Access Key.";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    if (isset($_SESSION["otpNotSentMsg"]) && $_SESSION["otpNotSentMsg"]) {
                                        echo "* OTP Cannot be sent to this email. Try using different email.";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <p align="center"><input type="submit" name="submit" value="Create New Account"></p><br>
                    </fieldset>
                    <p align="center">Already have an account? <a href="login.php">Login</a></p>
                </td>
                <td></td>
            </table>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>
<?php
session_destroy();
?>