<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>

<body>
    <br><br>
    <div align="center">
        <form action="changePassOP.php" method="post" novalidate>
            <table>
                <td></td>
                <td>
                    <fieldset>
                        <legend align="center"><b>Change Password</b></legend>
                        <table>
                            <tr>
                                <td>
                                    <label for="curpass"><b>Current Password</b></label>
                                </td>
                                <td>
                                    <b>: </b><input id="curpass" name="curpass" type="password"><br>
                                    <?php
                                    if (key_exists("submited", $_SESSION)) {
                                        if ($_SESSION["submited"]) {
                                            if (!$_SESSION["filledCurPass"]) {
                                                echo "* Current Password Field Cannot be empty<br>";
                                            }
                                            if (key_exists("matchedCurPass", $_SESSION)) {
                                                if (!$_SESSION["matchedCurPass"]) {
                                                    echo "* Current Password Does Not Matched<br>";
                                                } else {
                                                    $flag = true;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="npass"><b>New Password</b></label>
                                </td>
                                <td>
                                    <b>: </b><input id="npass" name="npass" type="password"><br>
                                    <?php
                                    if (key_exists("submited", $_SESSION)) {
                                        if ($_SESSION["submited"]) {
                                            if (!$_SESSION["filledNewPass"]) {
                                                echo "* New Password Field Cannot be empty<br>";
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cnpass"><b>Confirm New Password</b></label>
                                </td>
                                <td>
                                    <b>: </b><input id="cnpass" name="cnpass" type="password"><br>
                                    <?php
                                    if (key_exists("submited", $_SESSION)) {
                                        if ($_SESSION["submited"]) {
                                            if (!$_SESSION["filledCnfPass"]) {
                                                echo "* Confirm New Password Field Cannot be empty<br>";
                                            }
                                            if (key_exists("matchedBothPass", $_SESSION)) {
                                                if (!$_SESSION["matchedBothPass"]) {
                                                    echo "* New Password and Confirm New Password Does Not Matched<br>";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <p align="center"><button type="submit" name="submit">Change Password</button></p>
                    </fieldset>
                </td>
                <td></td>
            </table>
        </form>
    </div>
    <?php
    if (key_exists("matchedCurPass", $_SESSION)) {
        if ($_SESSION["matchedCurPass"]) {
            if (key_exists("matchedBothPass", $_SESSION)) {
                if ($_SESSION["matchedBothPass"]) {
                    echo "<br><br><h2 align='center'>Password Changed Successfully</h2>";
                }
            }
        }
    }
    ?>
</body>

</html>

<?php
session_unset();
session_destroy();
?>