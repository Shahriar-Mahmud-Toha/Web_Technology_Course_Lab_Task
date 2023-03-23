<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
if (isset($_SESSION["tLoginVerified"])) {
    if ($_SESSION["tLoginVerified"]) {
        header("location:home_teacher.php");
        die();
    }
} else {
    session_destroy();
}

$t_username = null;
$t_password = null;

require "Modules/_em.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Teacher Login</title>
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
        <form action="teacher_loginOP.php" method="post" novalidate>
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
                                    <label for="t_username"><img src="Icons/username.png" height="25px" width="25px"
                                            alt="username-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="t_username" name="t_username" value="<?php if (isset($_SESSION["t_username"])) {
                                        echo $_SESSION["t_username"];
                                    } else if (($t_username != null) && $remember) {
                                        echo $t_username;
                                    } ?>" type="text" placeholder="Enter your username"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["t_usernameEmptyMsg"]) && $_COOKIE["t_usernameEmptyMsg"]) {
                                        echo "* username cannot be Empty.";
                                        setcookie("t_usernameEmptyMsg", "", time() - 3600);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="t_password"><img src="Icons/password.png" height="20px" width="20px"
                                            alt="password-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="t_password" name="t_password" type="t_password"
                                        placeholder="Enter your password" value="<?php if (($t_password != null) && $remember) {
                                            echo $t_password;
                                        } ?>"><br>&nbsp;
                                    <?php
                                    if (isset($_COOKIE["t_passwordEmptyMsg"]) && $_COOKIE["t_passwordEmptyMsg"]) {
                                        echo "* password cannot be Empty.";
                                        setcookie("t_passwordEmptyMsg", "", time() - 3600);
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
                    <p align="center">Don't have an account? <a href="teacher_signup.php">Signup</a></p>
                </td>
                <td></td>
            </table>
        </form>
    </div>
</body>

</html>