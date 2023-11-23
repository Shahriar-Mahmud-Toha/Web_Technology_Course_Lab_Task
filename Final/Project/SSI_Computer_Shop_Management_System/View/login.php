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
</head>

<body>
    <?php require "header.php"; ?>
    <div align="center">
        <?php
        if (isset($_COOKIE["resetSuccessMsg"]) && $_COOKIE["resetSuccessMsg"]) {
            echo "*** Password reset Successfully ***";
            setcookie("resetSuccessMsg", "", time() - 3600, "/");
        }
        if (isset($_COOKIE["successAcCrMsg"]) && $_COOKIE["successAcCrMsg"]) {
            echo "*** Account created Successfully ***";
            setcookie("successAcCrMsg", "", time() - 3600, "/");
        }
        ?>
        <form action="../Controller/loginOP.php" method="post" novalidate>
            <table>
                <td></td>
                <td>
                    <fieldset>
                        <legend align="center">
                            <h2>Login</h2>
                        </legend><br>
                        <table>
                            <tr>
                                <td>
                                    <label for="username"><img src="Icons/username.png" height="25px" width="25px"
                                            alt="username-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="username" name="username" value="<?php if (isset($_SESSION["username"])) {
                                        echo $_SESSION["username"];
                                    } else if (($username != null) && $remember) {
                                        echo $username;
                                    } ?>" type="text" placeholder="Enter your username"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["usernameEmptyMsg"]) && $_COOKIE["usernameEmptyMsg"]) {
                                        echo "* Username cannot be Empty.";
                                        setcookie("usernameEmptyMsg", "", time() - 3600, "/");
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
                                        placeholder="Enter your password" value="<?php if (($password != null) && $remember) {
                                            echo $password;
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["passwordEmptyMsg"]) && $_COOKIE["passwordEmptyMsg"]) {
                                        echo "* Password cannot be Empty.";
                                        setcookie("passwordEmptyMsg", "", time() - 3600, "/");
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    if (isset($_COOKIE["invalidInfo"]) && $_COOKIE["invalidInfo"]) {
                                        echo "* Invalid Username or Password";
                                        setcookie("invalidInfo", "", time() - 3600, "/");
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div align="center">
                            &nbsp;<input id="remember" name="remember" type="checkbox">
                            <label for="remember">Remember Me</label><br>
                            <label for="remember">(max 1 Device)</label>
                        </div>
                        <p align="center"><button type="submit" name="submit">Login</button></p><br>
                        <p align="center"><a href="forgotPassword.php">Forgotten Password?</a></p>
                    </fieldset>
                    <p align="center">Don't have an account? <a href="signup.php">Signup</a></p>
                </td>
                <td></td>
            </table>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>