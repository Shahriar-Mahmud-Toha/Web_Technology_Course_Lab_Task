<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
if (isset($_SESSION["tLoginVerified"])) {
    if ($_SESSION["tLoginVerified"]) {
        header("location:home_teacher.php");
        die();
    }
}
require "Modules/_em.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS - Teacher Signup</title>
</head>

<body>

    <?php require "header.php"; ?>
    <div align="center">
        <form action="teacher_signupOP.php" method="post" novalidate enctype="multipart/form-data">
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
                                    <label for="t_username"><img src="Icons/username.png" height="25px" width="25px"
                                            alt="username-icon"></label>
                                </td>
                                <td>
                                    &nbsp; <input id="t_username" name="t_username" type="text"
                                        placeholder="Enter your username" value="<?php if (isset($_SESSION["t_username"])) {
                                            echo $_SESSION["t_username"];
                                        } ?>"><br>&nbsp;
                                    <font size="1px">* Only Lowercase letters(a-z), Underscore(_), numbers(0-9) are
                                        allowed.</font><br><br>
                                    <?php
                                    if (isset($_SESSION["t_usernameEmptyMsg"]) && $_SESSION["t_usernameEmptyMsg"]) {
                                        echo "* username cannot be Empty.";
                                    }
                                    if (isset($_SESSION["t_usernameInvalidMsg"]) && $_SESSION["t_usernameInvalidMsg"]) {
                                        echo "* Invalid t_username";
                                    }
                                    if (isset($_SESSION["t_usernameMatchedMsg"]) && $_SESSION["t_usernameMatchedMsg"]) {
                                        echo "* username already exists. Choose another username!";
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
                                        placeholder="Enter your password"><br>&nbsp;
                                    <?php
                                    if (isset($_SESSION["t_passwordEmptyMsg"]) && $_SESSION["t_passwordEmptyMsg"]) {
                                        echo "* Password cannot be Empty.";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <p align="center"><input type="submit" name="submit" value="Create New Account"></p><br>
                    </fieldset>
                    <p align="center">Already have an account? <a href="teacher_login.php">Login</a></p>
                </td>
                <td></td>
            </table>
        </form>
    </div>
</body>

</html>
<?php
session_destroy();
?>