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
    <script src="validateForm.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="signupId">

    <?php require "header.php"; ?>
    <main class="mainDiv">
        <?php
        $fullnameEmptyFlag = false;
        $usernameEmptyFlag = false;
        $UsernameInvalidInfoFlag = false;
        $usernameMatchedMsgFlag = false;
        $passwordEmptyFlag = false;
        $emailEmptyFlag = false;
        $emailInvalidMsgFlag = false;
        $emailMatchedMsgFlag = false;
        $addressEmptyFlag = false;
        $nidEmptyFlag = false;
        $nidInvalidMsg = false;
        $nidMatchedMsg = false;
        $genderEmptyFlag = false;
        $phoneEmptyFlag = false;
        $phoneInvalidMsg = false;
        $phoneMatchedMsg = false;
        $dobEmptyFlag = false;
        $profilepicEmptyFlag = false;
        $fileTypeInvalidMsg = false;
        $fileSizeInvalidMsg = false;
        $accesskeyEmptyFlag = false;
        $invalidAccessKeyMsg = false;
        if (isset($_SESSION["fullnameEmptyMsg"]) && $_SESSION["fullnameEmptyMsg"]) {
            $fullnameEmptyFlag = true;
        }
        if (isset($_SESSION["usernameEmptyMsg"]) && $_SESSION["usernameEmptyMsg"]) {
            $usernameEmptyFlag = true;
        }
        if (isset($_SESSION["usernameInvalidMsg"]) && $_SESSION["usernameInvalidMsg"]) {
            $UsernameInvalidInfoFlag = true;
        }
        if (isset($_SESSION["usernameMatchedMsg"]) && $_SESSION["usernameMatchedMsg"]) {
            $usernameMatchedMsgFlag = true;
        }
        if (isset($_SESSION["passwordEmptyMsg"]) && $_SESSION["passwordEmptyMsg"]) {
            $passwordEmptyFlag = true;
        }
        if (isset($_SESSION["emailEmptyMsg"]) && $_SESSION["emailEmptyMsg"]) {
            $emailEmptyFlag = true;
        }
        if (isset($_SESSION["emailInvalidMsg"]) && $_SESSION["emailInvalidMsg"]) {
            $emailInvalidMsgFlag = true;
        }
        if (isset($_SESSION["emailMatchedMsg"]) && $_SESSION["emailMatchedMsg"]) {
            $emailMatchedMsgFlag = true;
        }
        if (isset($_SESSION["addressEmptyMsg"]) && $_SESSION["addressEmptyMsg"]) {
            $addressEmptyFlag = true;
        }
        if (isset($_SESSION["nidEmptyMsg"]) && $_SESSION["nidEmptyMsg"]) {
            $nidEmptyFlag = true;
        }
        if (isset($_SESSION["nidInvalidMsg"]) && $_SESSION["nidInvalidMsg"]) {
            $nidInvalidMsg = true;
        }
        if (isset($_SESSION["nidMatchedMsg"]) && $_SESSION["nidMatchedMsg"]) {
            $nidMatchedMsg = true;
        }
        if (isset($_SESSION["genderEmptyMsg"]) && $_SESSION["genderEmptyMsg"]) {
            $genderEmptyFlag = true;
        }
        if (isset($_SESSION["phoneEmptyMsg"]) && $_SESSION["phoneEmptyMsg"]) {
            $phoneEmptyFlag = true;
        }
        if (isset($_SESSION["phoneInvalidMsg"]) && $_SESSION["phoneInvalidMsg"]) {
            $phoneInvalidMsg = true;
        }
        if (isset($_SESSION["phoneMatchedMsg"]) && $_SESSION["phoneMatchedMsg"]) {
            $phoneMatchedMsg = true;
        }
        if (isset($_SESSION["dobEmptyMsg"]) && $_SESSION["dobEmptyMsg"]) {
            $dobEmptyFlag = true;
        }
        if (isset($_SESSION["profilepicEmptyMsg"]) && $_SESSION["profilepicEmptyMsg"]) {
            $profilepicEmptyFlag = true;
        }
        if (isset($_SESSION["fileTypeInvalidMsg"]) && $_SESSION["fileTypeInvalidMsg"]) {
            $fileTypeInvalidMsg = true;
        }
        if (isset($_SESSION["fileSizeInvalidMsg"]) && $_SESSION["fileSizeInvalidMsg"]) {
            $fileSizeInvalidMsg = true;
        }
        if (isset($_SESSION["accesskeyEmptyMsg"]) && $_SESSION["accesskeyEmptyMsg"]) {
            $accesskeyEmptyFlag = true;
        }
        if (isset($_SESSION["invalidAccessKeyMsg"]) && $_SESSION["invalidAccessKeyMsg"]) {
$invalidAccessKeyMsg = true;
        }
        ?>
        <form action="../Controller/signupOP.php" method="post" novalidate enctype="multipart/form-data" onsubmit="return validSignupForm(this);">
            <h2 class="mt">Sign Up</h2>
            <!-- <label for="fullname"><img src="Icons/fullname.png" height="25px" width="25px" alt="fullname-icon"></label> -->
            <input class="inputBox <?php if ($fullnameEmptyFlag) {
                echo "emptyInputBox";
            } ?>" id="fullname" name="fullname" type="text" placeholder="Enter your full name" value="<?php if (isset($_SESSION["fullname"])) {
                 echo $_SESSION["fullname"];
             } ?>">
            <?php
            if ($fullnameEmptyFlag) {
                echo "<span class='invalidMsg'>* Fullname cannot be Empty.</span>";
            }
            ?>
            <!-- <label for="username"><img src="Icons/username.png" height="25px" width="25px" alt="username-icon"></label> -->
            <input class="inputBox <?php if ($usernameEmptyFlag || $UsernameInvalidInfoFlag || $usernameMatchedMsgFlag) {
                echo "emptyInputBox";
            } ?>" id="username" name="username" type="text" placeholder="Enter your username" value="<?php if (isset($_SESSION["username"])) {
                 echo $_SESSION["username"];
             } ?>">
            <p class="spMsg">* Only Lowercase letters(a-z), Underscore(_), numbers(0-9) are
                allowed.</p>
            <?php
            if ($usernameEmptyFlag) {
                echo "<span class='invalidMsg'>* Username cannot be Empty.</span>";
            }
            if ($UsernameInvalidInfoFlag) {
                echo "<span class='invalidMsg'>* Invalid Username</span>";
            }
            if ($usernameMatchedMsgFlag) {
                echo "<span class='invalidMsg'>* Username already exists. Choose another username!</span>";
            }
            ?>
            <!-- <label for="password"><img src="Icons/password.png" height="20px" width="20px" alt="password-icon"></label> -->
            <input class="inputBox <?php if ($passwordEmptyFlag) {
                echo "emptyInputBox";
            } ?>" id="password" name="password" type="password" placeholder="Enter your password">
            <?php
            if ($passwordEmptyFlag) {
                echo "<span class='invalidMsg'>* Password cannot be Empty.</span>";
            }
            ?>
            <!-- <label for="email"><img src="Icons/email.png" height="25px" width="25px" alt="email-icon"></label> -->
            <input class="inputBox <?php if ($emailEmptyFlag || $emailInvalidMsgFlag || $emailMatchedMsgFlag) {
                echo "emptyInputBox";
            } ?>" id="email" name="email" type="text" placeholder="Enter your email" value="<?php if (isset($_SESSION["email"])) {
                 echo $_SESSION["email"];
             } ?>">
            <?php
            if ($emailEmptyFlag) {
                echo "<span class='invalidMsg'>* Email cannot be Empty.</span>";
            }
            if ($emailInvalidMsgFlag) {
                echo "<span class='invalidMsg'>* Invalid email</span>";
            }
            if ($emailMatchedMsgFlag) {
                echo "<span class='invalidMsg'>* This email is associated with another user.</span>";
            }
            ?>
            <!-- <label for="address"><img src="Icons/address.png" height="25px" width="25px" alt="address-icon"></label> -->
            <textarea class="txtArea <?php if ($addressEmptyFlag) {
                echo "emptyInputBox";
            } ?>" id="address" name="address" cols="21" rows="2" placeholder="Enter your home address" value="<?php if (isset($_SESSION["address"])) {
                 echo $_SESSION["address"];
             } ?>"></textarea>
            <?php
            if ($addressEmptyFlag) {
                echo "<span class='invalidMsg'>* Address cannot be Empty.</span>";
            }
            ?>
            <!-- <label for="nid"><img src="Icons/nid.png" height="25px" width="25px" alt="nid-icon"></label> -->
            <input class="inputBox <?php if ($nidEmptyFlag || $nidInvalidMsg || $nidMatchedMsg) {
                echo "emptyInputBox";
            } ?>" id="nid" name="nid" type="text" placeholder="Enter your NID number" value="<?php if (isset($_SESSION["nid"])) {
                 echo $_SESSION["nid"];
             } ?>">
            <?php
            if ($nidEmptyFlag) {
                echo "<span class='invalidMsg'>* NID number cannot be Empty.</span>";
            }
            if ($nidInvalidMsg) {
                echo "<span class='invalidMsg'>* Invalid nid number format. Only <= 10 digit numbers are allowed</span>";
            }
            if ($nidMatchedMsg) {
                echo "<span class='invalidMsg'>* This nid is assosiated with another user.</span>";
            }
            ?>
            <!-- <label for="male"><img src="Icons/gender.png" height="25px" width="25px" alt="gender-icon"></label> -->
            <div class="genderDiv">
                <span><input class="radioBtn" id="male" type="radio" name="gender" value="male"><label class="lblGender"
                        for="male">Male</label></span>
                <span><input class="radioBtn" type="radio" name="gender" id="female" value="female"><label
                        class="lblGender" for="female">Female</label></span>
            </div>
            <?php
            if ($genderEmptyFlag) {
                echo "<span class='invalidMsg'>* Gender must be selected.</span>";
            }
            ?>
            <!-- <label for="phone"><img src="Icons/phone.png" height="19px" width="19px" alt="phone-icon"></label> -->
            <input class="inputBox <?php if ($phoneEmptyFlag || $phoneInvalidMsg || $phoneMatchedMsg) {
                echo "emptyInputBox";
            } ?>" id="phone" name="phone" type="text" placeholder="Enter your phone number" value="<?php if (isset($_SESSION["phone"])) {
                 echo $_SESSION["phone"];
             } ?>">
            <?php
            if ($phoneEmptyFlag) {
                echo "<span class='invalidMsg'>* Phone number cannot be Empty.</span>";
            }
            if ($phoneInvalidMsg) {
                echo "<span class='invalidMsg'>* Invalid phone number. Phone number must be contain 11 digits and only numbers.</span>";
            }
            if ($phoneMatchedMsg) {
                echo "<span class='invalidMsg'>* This phone is assosiated with another user.</span>";
            }
            ?>
            <!-- <label for="dob"><img src="Icons/dob.png" height="25px" width="25px" alt="dob-icon"></label> -->
            <label for="dob" class="msg">Enter your date of birth</label>
            <input class="datePicker <?php if ($dobEmptyFlag) {
                echo "emptyInputBox";
            } ?>" placeholder="Enter" id="dob" name="dob" type="date" value="<?php if (isset($_SESSION["dob"])) {
                 echo $_SESSION["dob"];
             } ?>">
            <?php
            if ($dobEmptyFlag) {
                echo "<span class='invalidMsg'>* Date of birth must be selected.</span>";
            }
            ?>
            <label class="spMsg2" for="profilepic"><img id="demoProfilePicIcon" src="Icons/profilepic.png"
                    alt="profilepic-icon"></label>
            <input id="profilepic" name="profilepic" type="file">
            <p>Supported File Type( .png, .jpg, .jpeg )</p>
            <?php
            if ($profilepicEmptyFlag) {
                echo "<span class='invalidMsg'>* Profile picture must be selected.</span>";
            }
            if ($fileTypeInvalidMsg) {
                echo "<span class='invalidMsg'>* Invalid picture type.</span>";
            }
            if ($fileSizeInvalidMsg) {
                echo "<span class='invalidMsg'>* Picture size must be less than 10 MB</span>";
            }
            ?>
            <!-- <label for="accesskey"><img src="Icons/accesskey.png" height="25px" width="25px" -->
            <!-- alt="accesskey-icon"></label> -->
            <input class="inputBox <?php if ($accesskeyEmptyFlag || $invalidAccessKeyMsg) {
                echo "emptyInputBox";
            } ?>" id="accesskey" name="accesskey" type="text" placeholder="Enter your grant access key" value="<?php if (isset($_SESSION["accesskey"])) {
                 echo $_SESSION["accesskey"];
             } ?>">
            <?php
            if ($accesskeyEmptyFlag) {
                echo "<span class='invalidMsg'>* Accesskey cannot be Empty.</span>";
            }
            if ($invalidAccessKeyMsg) {
                echo "<span class='invalidMsg'>* Invalid Access Key.</span>";
            }
            ?>
            <?php
            if (isset($_SESSION["otpNotSentMsg"]) && $_SESSION["otpNotSentMsg"]) {
                echo "<span class='invalidMsg'>* OTP Cannot be sent to this email. Try using different email.</span>";
            }
            ?>
            <p align="center"><input class="submitBtnCreate" type="submit" name="submit" value="Create New Account"></p>
        </form>
        <p align="center">Already have an account? <a href="login.php">Login</a></p>
    </main>
    <div class="endSpace"></div>
</body>

</html>
<?php
session_destroy();
?>