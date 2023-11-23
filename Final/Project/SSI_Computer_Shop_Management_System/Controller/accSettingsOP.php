<?php
session_start();
require "../Model/crud_database.php";
require "essential_modules.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $fullname = extractRaw($_POST["fullname"]);
    $username = $_SESSION["username"];
    $curpassword = extractRaw($_POST["curpassword"]);
    $npassword = extractRaw($_POST["npassword"]);
    $address = extractRaw($_POST["address"]);
    $nid = extractRaw($_POST["nid"]);
    $phone = extractRaw($_POST["phone"]);
    $dob = extractRaw($_POST["dob"]);
    $profilepic_name = extractPhotoData($_FILES["profilepic"]["name"]);
    $profilepic_temp_name = extractPhotoData($_FILES["profilepic"]["tmp_name"]);
    $profilepic_Size = extractPhotoData($_FILES["profilepic"]["size"]);
    $currentProfilePictureName = $_SESSION["profilepic_name"];
    if (!empty($fullname)) {
        $flag = false;
    }
    if (!empty($curpassword) && !empty($npassword)) {
        $flag = false;
    }
    if (!empty($address)) {
        $flag = false;
    }
    if (!empty($nid)) {
        $flag = false;
    }
    if (!empty($phone)) {
        $flag = false;
    }
    if (!empty($dob)) {
        $flag = false;
    }
    if (!empty($profilepic_name)) {
        $flag = false;
    }
    $_SESSION["fullname"] = $fullname;
    $_SESSION["address"] = $address;
    $_SESSION["nid"] = $nid;
    $_SESSION["phone"] = $phone;
    $_SESSION["dob"] = $dob;

    if (!$flag) {
        $passFlag = false;
        $nidFlag = false;
        $phoneFlag = false;
        $picFlag = false;
        if (!empty($curpassword) && !empty($npassword)) {
            if (!isValueExistsToDbAccSet($username, $curpassword)) {
                $_SESSION["passNotMatched"] = true;
                $_SESSION["accSetPass"] = true;
                header("location:../View/accSettings.php");
                die();
            }
            $passFlag = true;
        } else {
            $passFlag = true;
        }
        if (!empty($nid)) {
            if (!validateNid($nid)) {
                $_SESSION["nidInvalidMsg"] = true;
                $_SESSION["accSetPass"] = true;
                header("location:../View/accSettings.php");
                die();
            }
            if (isSingleValueExistsToDB("admindb","admintb","nid",$nid,"s")) {
                $_SESSION["nidMatchedMsg"] = true;
                $_SESSION["accSetPass"] = true;
                header("location:../View/accSettings.php");
                die();
            }
            $nidFlag = true;
        } else {
            $nidFlag = true;
        }
        if (!empty($phone)) {
            if (!validatePhone($phone)) {
                $_SESSION["phoneInvalidMsg"] = true;
                $_SESSION["accSetPass"] = true;
                header("location:../View/accSettings.php");
                die();
            }
            if (isSingleValueExistsToDB("admindb","admintb","phone",$phone,"s")) {
                $_SESSION["phoneMatchedMsg"] = true;
                $_SESSION["accSetPass"] = true;
                header("location:../View/accSettings.php");
                die();
            }
            $phoneFlag = true;
        } else {
            $phoneFlag = true;
        }
        if (!empty($profilepic_name)) {
            $fileExt = strtolower(pathinfo($profilepic_name, PATHINFO_EXTENSION));
            $profilepic_name = imageValidation($username, $fileExt, $profilepic_Size);
            $desnitation = '../Model/profile_pictures/' . $profilepic_name;
            $preDesnitation = '../Model/profile_pictures/' . $currentProfilePictureName;
            if ($profilepic_name > 0) {
                $picFlag = true;
            } else if ($profilepic_name == -1) {
                $_SESSION["fileSizeInvalidMsg"] = true;
                $_SESSION["accSetPass"] = true;
                header("location:../View/accSettings.php");
                die();
            } else {
                $_SESSION["fileTypeInvalidMsg"] = true;
                $_SESSION["accSetPass"] = true;
                header("location:../View/accSettings.php");
                die();
            }
        } else {
            $picFlag = true;
        }
        if ($passFlag && $nidFlag && $phoneFlag && $picFlag) {
            $update = false;
            if (!empty($fullname)) {
                if (!updateSingleValue("admindb","admintb","fullname",$fullname,"ss","username",$username)) {
                    echo "Database Error";
                    die();
                }
                $update = true;
            }
            if (!empty($curpassword) && !empty($npassword)) {
                if (!updateSingleValue("admindb","admintb","password",$npassword,"ss","username",$username)) {
                    echo "Database Error";
                    die();
                }
                $update = true;
            }
            if (!empty($address)) {
                if (!updateSingleValue("admindb","admintb","address",$address,"ss","username",$username)) {
                    echo "Database Error";
                    die();
                }
                $update = true;
            }
            if (!empty($nid)) {
                if (!updateSingleValue("admindb","admintb","nid",$nid,"ss","username",$username)) {
                    echo "Database Error";
                    die();
                }
                $update = true;
            }
            if (!empty($phone)) {
                if (!updateSingleValue("admindb","admintb","phone",$phone,"ss","username",$username)) {
                    echo "Database Error";
                    die();
                }
                $update = true;
            }
            if (!empty($dob)) {
                if (!updateSingleValue("admindb","admintb","dob",$dob,"ss","username",$username)) {
                    echo "Database Error";
                    die();
                }
                $update = true;
            }
            if (!empty($profilepic_name)) {
                if (file_exists($preDesnitation)) {
                    unlink($preDesnitation);
                }
                if (file_exists($desnitation)) {
                    unlink($desnitation);
                }
                if (move_uploaded_file($profilepic_temp_name, $desnitation)) {
                    if (!updateSingleValue("admindb","admintb","profilepic_name",$profilepic_name,"ss","username",$username)) {
                        echo "Database Error";
                        die();
                    }
                    $update = true;
                }
            }
            if ($update) {
                $_SESSION["accSetPass"] = true;
                $_SESSION["fullname"] = null;
                $_SESSION["password"] = null;
                $_SESSION["address"] = null;
                $_SESSION["nid"] = null;
                $_SESSION["phone"] = null;
                $_SESSION["dob"] = null;
                $_SESSION["updateSuccessMsg"] = true;
                header("location:../View/admin.php");
            }
        } else {
            header("location:../View/accSettings.php");
        }
    } else {
        header("location:../View/admin.php");
    }
} else {
    header("location:../View/login.php");
}
?>