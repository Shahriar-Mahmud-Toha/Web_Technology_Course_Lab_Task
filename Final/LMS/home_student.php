<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
if (!isset($_SESSION["stdLoginVerified"])) {
    session_destroy();
    header("location:student_login.php");
    die();
}
require "Modules/_em.php";
$std_username = $_SESSION["std_username"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Student - Home</title>
</head>

<body>
    <?php
    require "Modules/header_home.php";
    if (isset($_SESSION["successSubmitMsg"]) && $_SESSION["successSubmitMsg"]) {
        echo "<p align = 'center'>*** Application Submitted Successfully ***</p>";
        $_SESSION["successSubmitMsg"] = null;
    }
    ?>
    <form action="apply.php" method="post" enctype='multipart/form-data'>
        <label for="application">
            <h1 align="center">Application</h1>
        </label><br>
        <p align="center"><textarea name="application" placeholder="Write your leave application here" id="application"
                cols="100" rows="10"></textarea></p>
        <?php
        if (isset($_COOKIE["applicationEmptyMsg"]) && $_COOKIE["applicationEmptyMsg"]) {
            echo "<p align = 'center'>* Application cannot be Empty.</p>";
            setcookie("applicationEmptyMsg", "", time() - 3600);
        }
        ?>
        <label for="attachment">
            <h3>Add attachments</h3>
        </label><br>
        <input id="attachment" name="attachment[]" type="file" multiple>
        <p align="center"><input type="submit" name="submit" value="Submit"></p>
    </form>
</body>

</html>