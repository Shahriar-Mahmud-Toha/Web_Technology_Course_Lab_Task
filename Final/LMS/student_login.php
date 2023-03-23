<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
if (isset($_SESSION["stdLoginVerified"])) {
    if ($_SESSION["stdLoginVerified"]) {
        header("location:home_student.php");
        die();
    }
} else {
    session_destroy();
}

$std_username = null;
$std_password = null;

require "Modules/_em.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - student Login</title>
</head>

<body>
    <?php require "header.php"; ?>
    <div align="center">
        <?php
        if (isset($_COOKIE["successAcCrMsg"]) && $_COOKIE["successAcCrMsg"]) {
            echo "*** Account created Successfully ***";
            setcookie("successAcCrMsg", "", time() - 3600);
        }
        ?>
        <form action="student_loginOP.php" method="post" novalidate>
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
                                    <label for="std_username"><img src="Icons/username.png" height="25px" width="25px"
                                            alt="username-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="std_username" name="std_username" value="<?php if (isset($_SESSION["std_username"])) {
                                        echo $_SESSION["std_username"];
                                    } else if (($std_username != null) && $remember) {
                                        echo $std_username;
                                    } ?>" type="text" placeholder="Enter your username"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["std_usernameEmptyMsg"]) && $_COOKIE["std_usernameEmptyMsg"]) {
                                        echo "* username cannot be Empty.";
                                        setcookie("std_usernameEmptyMsg", "", time() - 3600);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="std_password"><img src="Icons/password.png" height="20px" width="20px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="std_password" name="std_password" type="std_password"
                                        placeholder="Enter your password" value="<?php if (($std_password != null) && $remember) {
                                            echo $std_password;
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["std_passwordEmptyMsg"]) && $_COOKIE["std_passwordEmptyMsg"]) {
                                        echo "* password cannot be Empty.";
                                        setcookie("std_passwordEmptyMsg", "", time() - 3600);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    if (isset($_COOKIE["invalidInfo"]) && $_COOKIE["invalidInfo"]) {
                                        echo "* Invalid username or password";
                                        setcookie("invalidInfo", "", time() - 3600);
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <p align="center"><button type="submit" name="submit">Login</button></p><br>
                    </fieldset>
                    <p align="center">Don't have an account? <a href="student_signup.php">Signup</a></p>
                </td>
                <td></td>
            </table>
        </form>
    </div>
</body>

</html>