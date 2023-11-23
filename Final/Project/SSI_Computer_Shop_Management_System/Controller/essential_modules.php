<?php
$web_url = extractRaw($_SERVER['REQUEST_URI']);
if(strpos($web_url,"essential_modules.php")){
    header("location:../View/login.php");
}
function extractRaw($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function extractPhotoData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
function imageValidation($uniqueAttributeName, $fileExt, $fileSize)
{
    // $fileSize = extractPhotoData($_FILES["pp"]["size"]);
    // $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowedFileType = array("png", "jpg", "jpeg");
    if (in_array($fileExt, $allowedFileType)) {
        if ($fileSize <= 10000000) { // <10 MB
            return uniqid("$uniqueAttributeName-IMG-", true) . '.' . $fileExt;
        } else {
            return -1;
        }
    } else {
        return false;
    }
}
function storePhotoToServer($actualFileName, $tempLocationFileName, $uniqueAttributeName, $desnitation, $previousDesnitation)
{
    // format:
    // $actualFileName = extractPhotoData($_FILES["-> inputFieldName <-"]["name"]);
    // $tempLocationFileName = extractPhotoData($_FILES["-> inputFieldName <-"]["tmp_name"]);
    // $desnitation = 'pic\\' . $databaseStoredFileName;

    $databaseStoredFileName = $uniqueAttributeName . "_" . mt_rand(10000000, 99999999);
    if ($previousDesnitation != "") {
        unlink($previousDesnitation);
    }
    if (file_exists($desnitation)) {
        unlink($desnitation);
    }
    if (move_uploaded_file($tempLocationFileName, $desnitation)) {
        return $databaseStoredFileName;
    }
}
function sendOtp($email, $databaseName, $databaseTableName, $isExist)
{
    $flag = false;
    $otp = mt_rand(10000000, 99999999);
    $name = "SSI Computer Shop";
    $from = "authenticator.smt@outlook.com";
    $headers = "MIME-Version: 1.0" . "\r\n" .
        "Content-type:text/html;charset=UTF-8" . "\r\n" .
        'From: ' . $name . '<' . $from . '>' . "\r\n";
    $subject = "SSI Computer Shop - OTP verification";
    $message = "Verification code: " . $otp . "<br><br>Do Not reply this mail.";
    if (mail($email, $subject, $message, $headers)) {
        if ($isExist) {
            $flag = updateSingleValue($databaseName, $databaseTableName, "otp", $otp, "ss", "email", $email);
        } else {
            $flag = insert2Value($databaseName, $databaseTableName, "email", $email, "otp", $otp, "ss");
        }
    }
    return $flag;
}
function sendOtpForUpdateEmail($email, $username, $databaseName, $databaseTableName)
{
    $flag = false;
    $otp = mt_rand(10000000, 99999999);
    $name = "SSI Computer Shop";
    $from = "authenticator.smt@outlook.com";
    $headers = "MIME-Version: 1.0" . "\r\n" .
        "Content-type:text/html;charset=UTF-8" . "\r\n" .
        'From: ' . $name . '<' . $from . '>' . "\r\n";
    $subject = "SSI Computer Shop - OTP verification";
    $message = "Verification code: " . $otp . "<br><br>Do Not reply this mail.";
    if (mail($email, $subject, $message, $headers)) {
        if (updateSingleValue($databaseName, $databaseTableName, "otp", $otp, "ss", "username", $username)) {
            $flag = true;
        } else {
            echo "Database ERROR";
        }
    }
    return $flag;
}
function verifyOtp($email, $userProvidedOtp, $databaseName, $databaseTableName)
{
    $flag = false;
    $otp = getSingleValue($databaseName, $databaseTableName, "otp", "email", $email, "s");
    if ($otp != null) {
        if ($userProvidedOtp == $otp) {
            if (updateSingleValue($databaseName, $databaseTableName, "otp", null, "ss", "email", $email)) {
                $flag = true;
            }
        }
    }
    return $flag;
}
function lineSpaceProvider($numOfLines)
{
    for ($i = 0; $i < $numOfLines; $i++) {
        echo "<br>";
    }
}
function spaceProvider($numOfSpaces)
{
    for ($i = 0; $i < $numOfSpaces; $i++) {
        echo "&nbsp;";
    }
}
function convertToReadableSize($size)
{
    $base = log($size) / log(1024);
    $suffix = array("", "KB", "MB", "GB", "TB");
    $f_base = floor($base);
    return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}
function validateUsername($username)
{
    if (preg_match('/^(?=.*[a-z])[a-z0-9_]{1,16}$/i', $username)) {
        return true;
    } else {
        return false;
    }
}
function validateEmail($email)
{
    if (preg_match("/^(?=.{1,256}$)[a-z][a-z0-9.-]*[a-z0-9]@[a-z]{2,}(?:\.[a-z0-9]+)*\.[a-z]{2,}$/i", $email)) {
        return true;
    } else {
        return false;
    }
}
function validatePhone($phone)
{
    if (preg_match('/^(017|013|018|016|015|019)\d{8}$/', $phone)) {
        return true;
    } else {
        return false;
    }
}
function validateNid($nid)
{
    if (preg_match('/^\d{1,10}$/', $nid)) {
        return true;
    } else {
        return false;
    }
}
?>