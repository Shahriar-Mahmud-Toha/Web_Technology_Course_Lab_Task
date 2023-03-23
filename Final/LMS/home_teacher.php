<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
if (!isset($_SESSION["tLoginVerified"])) {
    session_destroy();
    header("location:teacher_login.php");
    die();
}
require "Modules/_em.php";
$t_username = $_SESSION["t_username"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Teacher - Home</title>
</head>

<body>
    <?php
    require "Modules/header_home.php";
    if (isset($_SESSION["apvMsg"]) && $_SESSION["apvMsg"]) {
        echo "<p align = 'center'>*** Application Approved Successfully ***</p>";
        $_SESSION["apvMsg"] = null;
    }
    ?>
    <div align="center">
        <table>
            <td></td>
            <td>
                <table>
                    <tr>
                        <th width="200px" align="center">
                            Student ID
                        </th>
                        <th width="200px" align="center">
                            Student Full Name
                        </th>
                        <th width="200px" align="center">
                            Application
                        </th>
                    </tr>
                    <?php

                    $con = mysqli_connect('localhost', 'root', '', 'lmsdb');
                    if (!$con) {
                        die("Failed. Error: " . mysqli_connect_error());
                    }
                    $sql = 'SELECT `username`, `fullname`, `approved` FROM `studenttb`';
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($ans = mysqli_fetch_assoc($result)) {
                            $username = $ans["username"];
                            $fullname = $ans["fullname"];
                            ?>
                            <tr>
                                <td>
                                    <p align="center">
                                        <?php echo $username ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center">
                                        <?php echo $fullname ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center">
                                        <a href="viewApplication.php?username=<?php echo $username; ?>"><img
                                                src="Icons/view.png" height="22px" width="22px" alt="reset-icon"></a>
                                    </p>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    $con->close();
                    ?>
                </table>
            </td>
            <td></td>
        </table>
    </div>
</body>

</html>