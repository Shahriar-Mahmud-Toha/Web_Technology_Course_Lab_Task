<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    $defPass = "321";
    session_start();
    $_SESSION["submited"] = true;
    $curpass = extractRaw($_POST["curpass"]);
    $npass = extractRaw($_POST["npass"]);
    $cnpass = extractRaw($_POST["cnpass"]);
    if (empty($curpass)) {
        $_SESSION["filledCurPass"] = false;
    } else {
        $_SESSION["filledCurPass"] = true;
        if ($defPass == $curpass) {
            $_SESSION["matchedCurPass"] = true;
        } else {
            $_SESSION["matchedCurPass"] = false;
        }
    }
    if (empty($npass)) {
        $_SESSION["filledNewPass"] = false;
    } else {
        $_SESSION["filledNewPass"] = true;
    }
    if (empty($cnpass)) {
        $_SESSION["filledCnfPass"] = false;
    } else {
        $_SESSION["filledCnfPass"] = true;
        if ($npass == $cnpass) {
            $_SESSION["matchedBothPass"] = true;
        } else {
            $_SESSION["matchedBothPass"] = false;
        }
    }
    header("location: passwordChange.php");
} else {
    $_SESSION["submited"] = false;
}

function extractRaw($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>