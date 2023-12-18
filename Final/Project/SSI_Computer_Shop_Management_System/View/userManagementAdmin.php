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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="userManagementId">
    <?php require "header_admin.php"; ?>
    <br>
    <main>
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
        <div class="usrMngTbContainer">
            <table class="usrMngTb">
                <tr>
                    <th>
                        Username
                    </th>
                    <th>
                        Fullname
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        NID
                    </th>
                    <th>
                        Date of Birth
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>
                        Picture
                    </th>
                    <th>
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
                                <p>
                                    <?php echo $username ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $fullname ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $email ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $address ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $nid ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $dob ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $phone ?>
                                </p>
                            </td>
                            <td>
                                <p><img class="empProPic" src="../Model/Emp_Profile_Pictures/<?php echo $profilepic_name ?>"
                                        alt="profile-picture"></p>
                            </td>
                            <td>
                                <p class="opIconATag">
                                    <?php
                                    if (!$approval) {
                                        ?>
                                        <a href="../Controller/approveAdmin.php?username=<?php echo $username; ?>"><img
                                                class="operationsBtnIcon" src="Icons/approve.png" alt="approve-icon"></a>
                                        <?php
                                    }
                                    ?>
                                    <a href="../Controller/removeEmp.php?username=<?php echo $username; ?>"><img
                                    class="operationsBtnIcon" src="Icons/delete.png" alt="delete-icon"></a>
                                    <a href="../Controller/resetEmpPass.php?username=<?php echo $username; ?>"><img
                                    class="operationsBtnIcon" src="Icons/resetPassword.png" alt="reset-icon"></a>
                                </p>
                            </td>
                        </tr>
                        <?php
                    }
                }
                $con->close();
                ?>
            </table>
            <p class="goBackBtn"><a href="admin.php">Go Back</a></p>
        </div>
    </main>
    <div class="endSpace"></div>
</body>

</html>