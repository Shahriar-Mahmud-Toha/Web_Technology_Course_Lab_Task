<?php
session_start();
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
if (!isset($_SESSION["loginVerified"])) {
    session_destroy();
    header("location:login.php");
    die();
}
if (!($_SESSION["loginVerified"])) {
    session_destroy();
    header("location:login.php");
    die();
}
$_SESSION["manageOk"] = true;
$_SESSION["manageROk"] = true;
$_SESSION["manageReOk"] = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - User Management</title>
</head>

<body>
    <?php require "header_admin.php"; ?>
    <br>
    <?php
    if (isset($_COOKIE["empApvMsg"]) && $_COOKIE["empApvMsg"]) {
        echo "<p align = 'center'>*** Employee Approved ***</p>";
        setcookie("empApvMsg", "", time() - 3600, "/");
    }
    if (isset($_COOKIE["empDeletedMsg"]) && $_COOKIE["empDeletedMsg"]) {
        echo "<p align = 'center'>*** Employee Removed ***</p>";
        setcookie("empDeletedMsg", "", time() - 3600, "/");
    }
    if (isset($_COOKIE["empPasReMsg"]) && $_COOKIE["empPasReMsg"]) {
        echo "<p align = 'center'>*** Password Reset Successfully ***</p>";
        setcookie("empPasReMsg", "", time() - 3600, "/");
    }
    ?>
    <br><br>
    <div align="center">
        <table>
            <td></td>
            <td>
                <table>
                    <tr>
                        <th width="200px" align="center">
                            Username
                        </th>
                        <th width="200px" align="center">
                            Fullname
                        </th>
                        <th width="150px" align="center">
                            Email
                        </th>
                        <th width="200px" align="center">
                            Address
                        </th>
                        <th width="100px" align="center">
                            NID
                        </th>
                        <th width="100px" align="center">
                            Date of Birth
                        </th>
                        <th width="100px" align="center">
                            Phone
                        </th>
                        <th width="100px" align="center">
                            Picture
                        </th>
                        <th width="100px" align="center">
                            Operations
                        </th>
                    </tr>
                    <?php

                    $con = mysqli_connect('localhost', 'root', '', 'admindb');
                    if (!$con) {
                        die("Failed. Error: " . mysqli_connect_error());
                    }
                    $adminUsername = $_SESSION["username"];
                    $sql = 'SELECT `username`, `fullname`, `email`, `address`, `nid`, `gender`, `dob`, `phone`, `profilepic_name`, `approval` FROM `employeetb` where verified=1';
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($ans = mysqli_fetch_assoc($result)) {
                            $username = $ans["username"];
                            $fullname = $ans["fullname"];
                            $email = $ans["email"];
                            $address = $ans["address"];
                            $nid = $ans["nid"];
                            $gender = $ans["gender"];
                            $dob = $ans["dob"];
                            $phone = $ans["phone"];
                            $profilepic_name = $ans["profilepic_name"];
                            $approval = $ans["approval"];
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
                                        <?php echo $email ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center">
                                        <?php echo $address ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center">
                                        <?php echo $nid ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center">
                                        <?php echo $dob ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center">
                                        <?php echo $phone ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center"><img src="../Model/Emp_Profile_Pictures/<?php echo $profilepic_name ?>"
                                            height="80px" width="80" alt="profile-picture"></p>
                                </td>
                                <td>
                                    <p align="center">
                                        <?php
                                        if (!$approval) {
                                            ?>
                                            <a href="../Controller/approveAdmin.php?username=<?php echo $username; ?>"><img
                                                    src="Icons/approve.png" height="22px" width="22px"
                                                    alt="approve-icon"></a>&nbsp;&nbsp;
                                            <?php
                                        }
                                        ?>
                                        <a href="../Controller/removeEmp.php?username=<?php echo $username; ?>"><img
                                                src="Icons/delete.png" height="22px" width="22px"
                                                alt="delete-icon"></a>&nbsp;&nbsp;
                                        <a href="../Controller/resetEmpPass.php?username=<?php echo $username; ?>"><img
                                                src="Icons/resetPassword.png" height="22px" width="22px" alt="reset-icon"></a>
                                    </p>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    $con->close();
                    ?>
                </table>
                <br>
                <p align="center"><a href="admin.php">Go Back</a></p>
            </td>
            <td></td>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>