<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $fullname = extractRaw($_POST["fullname"]);
    $username = extractRaw($_POST["username"]);
    $_SESSION["username"] = $username;
    $password = extractRaw($_POST["password"]);
    $email = extractRaw($_POST["email"]);
    $address = extractRaw($_POST["address"]);
    $nid = extractRaw($_POST["nid"]);
    $gender = extractRaw($_POST["gender"]);
    $phone = extractRaw($_POST["phone"]);
    $dob = extractRaw($_POST["dob"]);
    $profilepic_name = extractPhotoData($_FILES["profilepic"]["name"]);
    $profilepic_temp_name = extractPhotoData($_FILES["profilepic"]["tmp_name"]);
    $profilepic_Size = extractPhotoData($_FILES["profilepic"]["size"]);
    $accesskey = extractRaw($_POST["accesskey"]);

    $_SESSION["fullname"] = $fullname;
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    $_SESSION["email"] = $email;
    $_SESSION["address"] = $address;
    $_SESSION["nid"] = $nid;
    $_SESSION["phone"] = $phone;
    $_SESSION["dob"] = $dob;
    $_SESSION["accesskey"] = $accesskey;

    if (empty($fullname)) {
        $flag = false;
        $_SESSION["fullnameEmptyMsg"] = true;
    }
    if (empty($username)) {
        $flag = false;
        $_SESSION["usernameEmptyMsg"] = true;
    }
    if (empty($password)) {
        $flag = false;
        $_SESSION["passwordEmptyMsg"] = true;
    }
    if (empty($email)) {
        $flag = false;
        $_SESSION["emailEmptyMsg"] = true;
    }
    if (empty($address)) {
        $flag = false;
        $_SESSION["addressEmptyMsg"] = true;
    }
    if (empty($nid)) {
        $flag = false;
        $_SESSION["nidEmptyMsg"] = true;
    }
    if (empty($gender)) {
        $flag = false;
        $_SESSION["genderEmptyMsg"] = true;
    } else {
        if (!(($gender == "male") || ($gender == "female"))) {
            $flag = false;
        }
    }
    if (empty($phone)) {
        $flag = false;
        $_SESSION["phoneEmptyMsg"] = true;
    }
    if (empty($dob)) {
        $flag = false;
        $_SESSION["dobEmptyMsg"] = true;
    }
    if (empty($profilepic_name) || empty($profilepic_temp_name)) {
        $flag = false;
        $_SESSION["profilepicEmptyMsg"] = true;
    }
    if (empty($accesskey)) {
        $flag = false;
        $_SESSION["accesskeyEmptyMsg"] = true;
    }
    if ($flag) {
        $validFlag = true;
        if (!validateUsername($username)) {
            $validFlag = false;
            $_SESSION["usernameInvalidMsg"] = true;
        }
        $email = strtolower($email);
        if (!validateEmail($email)) {
            $validFlag = false;
            $_SESSION["emailInvalidMsg"] = true;
        }
        if (!validateNid($nid)) {
            $validFlag = false;
            $_SESSION["nidInvalidMsg"] = true;
        }
        if (!validatePhone($phone)) {
            $validFlag = false;
            $_SESSION["phoneInvalidMsg"] = true;
        }
        if ($validFlag) {
            $uniFlag = true;
            if (isSingleValueExistsToDB("admindb","admintb","username",$username,"s")) {
                $_SESSION["usernameMatchedMsg"] = true;
                $uniFlag = false;
            }
            if (isSingleValueExistsToDB("admindb","admintb","email",$email,"s")) {
                $_SESSION["emailMatchedMsg"] = true;
                $uniFlag = false;
            }
            if (isSingleValueExistsToDB("admindb","admintb","nid",$nid,"s")) {
                $_SESSION["nidMatchedMsg"] = true;
                $uniFlag = false;
            }
            if (isSingleValueExistsToDB("admindb","admintb","phone",$phone,"s")) {
                $_SESSION["phoneMatchedMsg"] = true;
                $uniFlag = false;
            }
            if ($uniFlag) {
                if (!isSingleValueExistsToDB("admindb","ownerauthtb","accesskey",$accesskey,"i")) {
                    $_SESSION["invalidAccessKeyMsg"] = true;
                    header("location:../View/signup.php");
                    die();
                }
                $fileExt = strtolower(pathinfo($profilepic_name, PATHINFO_EXTENSION));
                $profilepic_name = imageValidation($username, $fileExt, $profilepic_Size);
                $desnitation = '../Model/profile_pictures/' . $profilepic_name;
                $clean = false;
                if ($profilepic_name > 0) {
                    if (file_exists($desnitation)) {
                        unlink($desnitation);
                    }
                    if (move_uploaded_file($profilepic_temp_name, $desnitation)) {
                        $clean = true;
                    }
                } else if ($profilepic_name == -1) {
                    $_SESSION["fileSizeInvalidMsg"] = true;
                    header("location:../View/signup.php");
                    die();
                } else {
                    $_SESSION["fileTypeInvalidMsg"] = true;
                    header("location:../View/signup.php");
                    die();
                }
                if ($clean) {
                    if (insertForSignup($username, $password, $email,$fullname,$address, $nid, $gender,$phone, $dob,$profilepic_name)) {
                        if (sendOtp($email, "admindb", "admintb", true)) {
                            $_SESSION["emailSignUp"] = $email;
                            $_SESSION["signupVerfified"] = true;
                            header("location:../View/otpVerify.php");
                        } else {
                            $_SESSION["otpNotSentMsg"] = true;
                            header("location:../View/signup.php");
                        }
                    } else {
                        echo "Database Error";
                        die();
                    }
                }
            } else {
                header("location:../View/signup.php");
            }
        } else {
            header("location:../View/signup.php");
        }
    } else {
        header("location:../View/signup.php");
    }
} else {
    header("location:../View/login.php");
}
?>