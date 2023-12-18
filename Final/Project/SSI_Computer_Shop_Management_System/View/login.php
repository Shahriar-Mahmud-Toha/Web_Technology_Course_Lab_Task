<?php
session_start();
if (isset($_SESSION["loginVerified"])) {
    if ($_SESSION["loginVerified"]) {
        header("location:admin.php");
        die();
    }
} else {
    session_destroy();
}

$username = null;
$password = null;
$remember = null;

require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
if (isset($_COOKIE["remember"])) {
    if ($_COOKIE["remember"]) {
        if (isset($_COOKIE["ckid"])) {
            $ckid = extractRaw($_COOKIE["ckid"]);
            if (strlen($ckid) <= 146) {
                if (str_contains($ckid, "=-")) {
                    $cookieInfo = explode("=-", $ckid);
                    if ((strlen($cookieInfo[0]) <= 16) && (strlen($cookieInfo[1]) <= 128)) {
                        $con = mysqli_connect('localhost', 'root', '', 'admindb');
                        if (!$con) {
                            die("Failed. Error: " . mysqli_connect_error());
                        }
                        $sql = 'SELECT username, password, remember FROM `admintb` WHERE username="' . $cookieInfo[0] . '" and ckid="' . $ckid . '"';
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($ans = mysqli_fetch_assoc($result)) {
                                $username = $ans["username"];
                                $password = $ans["password"];
                                $remember = $ans["remember"];
                            }
                            $con->close();
                        } else {
                            setcookie("ckid", "", time() - 3600, "/");
                            setcookie("remember", "", time() - 3600, "/");
                            header("location:login.php");
                            $con->close();
                            die();
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Login</title>
    <script src="validateForm.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="loginId">
    <?php require "header.php"; ?>
    <main>
        <div class="mainDiv">
            <?php
            if (isset($_COOKIE["resetSuccessMsg"]) && $_COOKIE["resetSuccessMsg"]) {
                echo "<span class='successMsg'>*** Password reset Successfully ***</span>";
                setcookie("resetSuccessMsg", "", time() - 3600, "/");
            }
            if (isset($_COOKIE["successAcCrMsg"]) && $_COOKIE["successAcCrMsg"]) {
                echo "<span class='successMsg'>*** Account created Successfully ***</span>";
                setcookie("successAcCrMsg", "", time() - 3600, "/");
            }
            $usernameEmptyFlag = false;
            $passwordEmptyFlag = false;
            $invalidInfoFlag = false;
            if (isset($_COOKIE["usernameEmptyMsg"]) && $_COOKIE["usernameEmptyMsg"]) {
                $usernameEmptyFlag = true;
            }
            if (isset($_COOKIE["passwordEmptyMsg"]) && $_COOKIE["passwordEmptyMsg"]) {
                $passwordEmptyFlag = true;
            }
            if (isset($_COOKIE["invalidInfo"]) && $_COOKIE["invalidInfo"]) {
                $invalidInfoFlag = true;
            }
            ?>
            <form action="../Controller/loginOP.php" method="post" novalidate onsubmit="return validLoginForm(this);">
                <img id="demoUserLogo" src="Icons/user-white.png" alt="Demo User Logo">
                <h2 class="mt">Login</h2>
                <!-- <label for="username"><img src="Icons/username.png" height="25px" width="25px" alt="username-icon"></label> -->
                <input class="inputBox <?php if ($usernameEmptyFlag || $invalidInfoFlag) {echo "emptyInputBox";} ?>" id="username" name="username" value="<?php if (isset($_SESSION["username"])) {
                    echo $_SESSION["username"];
                } else if (($username != null) && $remember) {
                    echo $username;
                } ?>" type="text" placeholder="Enter your username">
                <?php
                if ($usernameEmptyFlag) {
                    echo "<span class='invalidMsg'>* Username cannot be Empty.</span>";
                    setcookie("usernameEmptyMsg", "", time() - 3600, "/");
                }
                ?>
                <!-- <label for="password"><img src="Icons/password.png" height="20px" width="20px" alt="password-icon"></label> -->
                <input class="inputBox <?php if ($passwordEmptyFlag || $invalidInfoFlag) {echo "emptyInputBox";} ?>" id="password" name="password" type="password" placeholder="Enter your password"
                    value="<?php if (($password != null) && $remember) {
                        echo $password;
                    } ?>">
                <?php
                if ($passwordEmptyFlag) {
                    echo "<span class='invalidMsg'>* Password cannot be Empty.</span>";
                    setcookie("passwordEmptyMsg", "", time() - 3600, "/");
                }
                ?>
                <?php
                if ($invalidInfoFlag) {
                    echo "<span class='invalidMsg'>* Invalid Username or Password</span>";
                    setcookie("invalidInfo", "", time() - 3600, "/");
                }
                ?>
                <p id="rememberMeBlock">
                    <input class="checkbox" id="remember" name="remember" type="checkbox">
                    <label id="rememberLabel" for="remember">Remember Me (max 1 Device)</label>
                </p>
                <button class="submitBtn" type="submit" name="submit">Login</button>
                <p class="regularText"><a href="forgotPassword.php" class="textType1">Forgotten Password?</a></p>
                <p class="regularText">Don't have an account? <a href="signup.php">Signup</a></p>
            </form>
        </div>
    </main>
    <div class="endSpace"></div>
</body>

</html>