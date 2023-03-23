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
if (isset($_GET["username"])) {
    $username = extractRaw($_GET["username"]);
} else {
    header("location:teacher_login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Teacher - Student Leave Application</title>
</head>

<body>
    <?php
    require "Modules/header_home.php";
    $con = mysqli_connect('localhost', 'root', '', 'lmsdb');
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT `username`, `fullname`, `application`, `application_submit_time`, `approved` FROM `studenttb` WHERE username="' . $username . '"';
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($ans = mysqli_fetch_assoc($result)) {
            $username = $ans["username"];
            $fullname = $ans["fullname"];
            $application = $ans["application"];
            $submit_time = $ans["application_submit_time"];
            $approval = $ans["approved"];
        }
    }
    // if ($approval) {
    //     header("location:teacher_login.php");
    //     die();
    // }
    $_SESSION["process"] = true;
    ?>
    <h1 align="center">Student Leave Application</h1>
    Student ID:
    <?php echo $username ?><br>
    Student Full Name:
    <?php echo $fullname ?><br>
    Application Submit Time:
    <?php echo $submit_time ?><br>
    <h3 align="center">Application</h3>
    <p align="center">
        <?php echo $application ?><br>
    </p><br>
    <h3 align="center">Attachments</h3><br>
    <div align="center">
        <table>
            <td></td>
            <td>
                <table>
                    <tr>
                        <th width="200px" align="center">
                            Filename
                        </th>
                        <th width="200px" align="center">
                            Option
                        </th>
                    </tr>
                    <?php
                    $con = mysqli_connect('localhost', 'root', '', 'lmsdb');
                    if (!$con) {
                        die("Failed. Error: " . mysqli_connect_error());
                    }
                    $sql = 'SELECT * FROM ' . $username . '_files';
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($ans = mysqli_fetch_assoc($result)) {
                            $filename = $ans["filename"];
                            ?>
                            <tr>
                                <td>
                                    <p align="center">
                                        <?php echo $filename ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center">
                                        <a href="uploadedFiles/<?php echo "$username/$filename" ?>">Download</a>
                                    </p>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    $con->close();
                    ?>
                </table>
                <br><br>
                <?php
                if ($approval == 0) {
                    ?>
                    <p align="center">
                        <a href="processApplication.php?approve=1&username=<?php echo $username; ?>"><img
                                src="Icons/approve.png" height="25px" width="25px" alt="approve-icon"></a>&nbsp;&nbsp;
                        <a href="processApplication.php?approve=0&username=<?php echo $username; ?>"><img
                                src="Icons/cancel.png" height="22px" width="22px" alt="cancel-icon"></a>
                    </p><br><br>
                    <?php
                }
                ?>
                <p align="center"><a href="home_teacher.php">Go Back</a></p>
            </td>
            <td></td>
        </table>
    </div>

</body>

</html>