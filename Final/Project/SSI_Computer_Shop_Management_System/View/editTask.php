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
if (isset($_GET["sn"])) {
    $_SESSION["snEdit"] = extractRaw($_GET["sn"]);
    $btn = $_SESSION["snEdit"];
} else {
    $btn = false;
}
if (isset($_SESSION["editTsk"])) {
    if ($_SESSION["editTsk"]) {
        $btn = true;
        $_SESSION["editTsk"] = null;
    }
}
if (!$btn) {
    header("location:admin.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Edit Task</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="editTaskId">
    <?php require "header_admin.php"; ?>
    <br><br>
    <main align="center">
        <table>
            <td></td>
            <td>
                <form action="../Controller/editTaskOP.php" method="post" novalidate>
                    <textarea class="taskAddTextArea" name="task" id="task" cols="40" rows="2" value="<?php ?>"></textarea><br>
                    <input class="addThisTaskBtn" type="submit" name="submit" value="Edit this Task">
                    <br>
                </form>
                <?php
                if (isset($_COOKIE["taskEmptyMsg"]) && $_COOKIE["taskEmptyMsg"]) {
                    echo "*  Empty task cannnot be added.";
                    setcookie("taskEmptyMsg", "", time() - 3600, "/");
                }
                ?>
                <br>
                <p align="center"><a href="adminTask.php">Go Back</a></p>
            </td>
            <td></td>
        </table>
    </main>
    <div class="endSpace"></div>
</body>

</html>