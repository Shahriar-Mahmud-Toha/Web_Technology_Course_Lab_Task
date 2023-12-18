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
if (isset($_GET["view"])) {
    $btn = extractRaw($_GET["view"]);
} else {
    $btn = false;
}
if (!$btn) {
    header("location:admin.php");
    die();
}
$con = mysqli_connect('localhost', 'root', '', 'admindb');
if (!$con) {
    die("Failed. Error: " . mysqli_connect_error());
}
$username = $_SESSION["username"];
$sql = 'SELECT `username`,`email`, `fullname`, `address`, `nid`,`gender`, `phone`, `dob`, `profilepic_name` FROM `admintb` WHERE username="' . $username . '"';
$result = mysqli_query($con, $sql);
if ($result) {
    while ($ans = mysqli_fetch_assoc($result)) {
        $email = $ans["email"];
        $fullname = $ans["fullname"];
        $address = $ans["address"];
        $nid = $ans["nid"];
        $gender = $ans["gender"];
        $phone = $ans["phone"];
        $dob = $ans["dob"];
        $profilepic_name = $ans["profilepic_name"];
    }
} else {
    echo "No Data Found";
}
$con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Profile Information</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="viewAdminProfileId">
    <?php require "header_admin.php"; ?>
    <main align="center">
        <table>
            <td></td>
            <td>
                <fieldset>
                    <legend align="center">
                        <h2>Profile Information</h2>
                    </legend><br>
                    <table>
                        <tr>
                            <td>
                                <label for="fullname"><img src="Icons/fullname.png" height="25px" width="25px"
                                        alt="fullname-icon"></label>
                            </td>
                            <td>
                                &nbsp;
                                <?php echo $fullname; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="username"><img src="Icons/username.png" height="25px" width="25px"
                                        alt="username-icon"></label>
                            </td>
                            <td>
                                &nbsp;
                                <?php echo $username; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email"><img src="Icons/email.png" height="25px" width="25px"
                                        alt="email-icon"></label>
                            </td>
                            <td>
                                &nbsp;
                                <?php echo $email; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="address"><img src="Icons/address.png" height="25px" width="25px"
                                        alt="address-icon"></label>
                            </td>
                            <td>
                                &nbsp;&nbsp;
                                <?php echo $address; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="nid"><img src="Icons/nid.png" height="25px" width="25px"
                                        alt="nid-icon"></label>
                            </td>
                            <td>
                                &nbsp;
                                <?php echo $nid; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="male"><img src="Icons/gender.png" height="25px" width="25px"
                                        alt="gender-icon"></label>
                            </td>
                            <td>
                                &nbsp;
                                <?php echo $gender; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="phone"><img src="Icons/phone.png" height="19px" width="19px"
                                        alt="phone-icon"></label>
                            </td>
                            <td>
                                &nbsp;
                                <?php echo $phone; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="dob"><img src="Icons/dob.png" height="25px" width="25px"
                                        alt="dob-icon"></label>
                            </td>
                            <td>
                                &nbsp;
                                <?php echo $dob; ?><br>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="profilepic"><img src="Icons/profilepic.png" height="25px" width="25px"
                                        alt="profilepic-icon"></label>
                            </td>
                            <td>
                                &nbsp;<img src="../Model/profile_pictures/<?php echo $profilepic_name ?>"
                                    alt="profile picture" height="200px" width="200"><br>&nbsp;
                            </td>
                        </tr>
                    </table>
                    <br>
                </fieldset>
                <p class="goBackBtn"><a href="admin.php">Go Back</a></p>
            </td>
            <td></td>
        </table>
    </main>
    <div class="endSpace"></div>
</body>

</html>