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
    <script src="validateForm.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="adminTaskId">
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
    <main>
        <div class="taskContainer">
            <form action="../Controller/addTask.php" method="post" novalidate
                onsubmit="return validAdminTaskForm(this);">
                <textarea class="taskAddTextArea" name="task" id="task" cols="40" rows="2"></textarea>
                <p><input class="addThisTaskBtn" type="submit" name="submit" value="Add this Task"></p>
            </form>
            <?php
            if (isset($_COOKIE["taskEmptyMsg"]) && $_COOKIE["taskEmptyMsg"]) {
                echo "*  Empty task cannnot be added.";
                setcookie("taskEmptyMsg", "", time() - 3600, "/");
            }
            ?>
            <table class="taskTb">
                <tr>
                    <th class="snTask">
                        SN
                    </th>
                    <th class="taskTask">
                        Task
                    </th>
                    <th>
                        Time
                    </th>
                    <th class="opTask">
                        Operations
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
                                <p class="snTaskContent">' . $sn . '</p>
                                 </td>
                                <td>
                                <p class="snTaskContent">' . $task . '</p>
                                </td>
                                <td>
                                    <p class="timeTaskContent">' . $time . '</p>
                                </td>
                                <td>
                                    <p class="timeTaskContent"><a href="editTask.php?sn=' . $sn . '"><img src="Icons/edit.png" height="22px" width="22px" alt="edit-icon"></a>
                                    <a href="../Controller/deleteTask.php?sn=' . $sn . '"><img src="Icons/delete.png" height="22px" width="22px" alt="delete-icon"></a></font></pgn=>
                                </td>
                            </tr>';
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