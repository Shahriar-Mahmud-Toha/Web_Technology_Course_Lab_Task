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
$_SESSION["deleteOk"] = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Task</title>
</head>

<body>
    <?php require "header_admin.php"; ?>
    <br>
    <?php
    if (isset($_COOKIE["taskAddedMsg"]) && $_COOKIE["taskAddedMsg"]) {
        echo "<p align = 'center'>*** Task Added Successfully ***</p>";
        setcookie("taskAddedMsg", "", time() - 3600, "/");
    }
    if (isset($_COOKIE["taskUpdatedMsg"]) && $_COOKIE["taskUpdatedMsg"]) {
        echo "<p align = 'center'>*** Task Updated Successfully ***</p>";
        setcookie("taskUpdatedMsg", "", time() - 3600, "/");
    }
    if (isset($_COOKIE["taskDeletedMsg"]) && $_COOKIE["taskDeletedMsg"]) {
        echo "<p align = 'center'>*** Task Deleted Successfully ***</p>";
        setcookie("taskDeletedMsg", "", time() - 3600, "/");
    }
    ?>
    <br><br>
    <div align="center">
        <table>
            <td></td>
            <td>
                <form action="../Controller/addTask.php" method="post" novalidate>
                    <textarea name="task" id="task" cols="40" rows="2"></textarea><br>
                    <input type="submit" name="submit" value="Add this Task">
                    <br>
                </form>
                <?php
                if (isset($_COOKIE["taskEmptyMsg"]) && $_COOKIE["taskEmptyMsg"]) {
                    echo "*  Empty task cannnot be added.";
                    setcookie("taskEmptyMsg", "", time() - 3600, "/");
                }
                ?>
                <br><br>
                <table>
                    <tr>
                        <th width="150px" align="left">
                            <font size="6px">SN</font>
                        </th>
                        <th width="600px" align="left">
                            <font size="6px">Task</font>
                        </th>
                        <th width="200px" align="center">
                            <font size="6px">Time</font>
                        </th>
                        <th width="200px" align="center">
                            <font size="6px">Operations</font>
                        </th>
                    </tr>
                    <?php
                    $con = mysqli_connect('localhost', 'root', '', 'admindb');
                    if (!$con) {
                        die("Failed. Error: " . mysqli_connect_error());
                    }
                    $username = $_SESSION["username"];
                    $sql = 'SELECT * FROM `tasktb`';
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($ans = mysqli_fetch_assoc($result)) {
                            $sn = $ans["sn"];
                            $task = $ans["task"];
                            $time = $ans["time"];
                            echo '
                            <tr>
                                <td>
                                <p align="left"><font size="4px">' . $sn . '</font></p>
                                 </td>
                                <td>
                                <p align="left"><font size="4px">' . $task . '</font></p>
                                </td>
                                <td>
                                    <p align="center"><font size="4px">' . $time . '</font></p>
                                </td>
                                <td>
                                    <p align="center"><font size="4px"><a href="editTask.php?sn=' . $sn . '"><img src="Icons/edit.png" height="22px" width="22px" alt="edit-icon"></a>
                                    <a href="../Controller/deleteTask.php?sn=' . $sn . '"><img src="Icons/delete.png" height="22px" width="22px" alt="delete-icon"></a></font></p>
                                </td>
                            </tr>';
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