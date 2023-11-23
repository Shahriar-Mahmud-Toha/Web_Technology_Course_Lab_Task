<?php
session_start();
if (!isset($_SESSION["loginVerified"])) {
    session_destroy();
    header("location:login.php");
    die();
}
require "../Model/crud_database.php";
require "../Controller/essential_modules.php";
$username = $_SESSION["username"];
$con = mysqli_connect('localhost', 'root', '', 'admindb');
if (!$con) {
    die("Failed. Error: " . mysqli_connect_error());
}
$sql = 'SELECT `password`, `email`, `fullname`, `address`, `nid`, `phone`, `dob`, `profilepic_name` FROM `admintb` WHERE username="' . $username . '"';
$result = mysqli_query($con, $sql);
if ($result) {
    while ($ans = mysqli_fetch_assoc($result)) {
        $fullname = $ans["fullname"];
        $password = $ans["password"];
        $email = $ans["email"];
        $_SESSION["email"] = $email;
        $address = $ans["address"];
        $nid = $ans["nid"];
        $phone = $ans["phone"];
        $dob = $ans["dob"];
        $dob = $ans["dob"];
        $profilepic_name = $ans["profilepic_name"];
        $_SESSION["profilepic_name"] = $profilepic_name;
    }
} else {
    echo "No Data Found";
}
$con->close();
$totalSales = null;
$totalRevenue = null;
$mostSoldProduct = null;
$empOfTheMonth = null;
$totalEmpWage = null;
$topCustomers = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSI Computer Shop - Admin</title>
</head>

<body>
    <?php
    require "header_admin.php";
    require "../Model/_dashboard_m.php";
    if (isset($_SESSION["successEmailUpdateMsg"]) && $_SESSION["successEmailUpdateMsg"]) {
        echo "<p align = 'center'>*** Email Changed Successfully ***</p>";
        $_SESSION["successEmailUpdateMsg"] = null;
        $_SESSION["emailNew"] = null;
        $_SESSION["passwordVerified"] = null;
        $_SESSION["cngPassChecked"] = null;
        $_SESSION["otpSentCheck"] = null;
    }
    if (isset($_SESSION["updateSuccessMsg"]) && $_SESSION["updateSuccessMsg"]) {
        echo "<p align = 'center'>*** Profile Updated Successfully ***</p>";
        $_SESSION["updateSuccessMsg"] = null;
    }
    if (isset($_SESSION["reportSntSuccss"]) && $_SESSION["reportSntSuccss"]) {
        echo "<p align = 'center'>*** Report Sent Successfully ***</p>";
        $_SESSION["reportSntSuccss"] = null;
    }
    ?>
    <br><br>
    <a href="userManagementAdmin.php"><img src="Icons/manageUser.png" alt="manage-user-icon" height="18px" width="18px">
        <button>Manage User</button></a>
    <br><br>
    <table>
        <tr>
            <th width="800px" align="center"></th>
            <th width="800px" align="center"></th>
            <th width="800px" align="center"></th>
        </tr>
        <tr height="200px">
            <td>
                <b>
                    <font size="10px">Total Sales (BDT)</font>
                </b><br>
                <span>
                    <font size="6px">
                        <?php $totalSales = getTotalSales();
                        echo $totalSales; ?>
                    </font>
                </span>
            </td>
            <td>
                <b>
                    <font size="10px">Total Revenue (BDT)</font>
                </b><br>
                <span>
                    <font size="6px">
                        <?php $totalRevenue = getTotalRevenue();
                        echo $totalRevenue; ?>
                    </font>
                </span>
            </td>
            <td>
                <b>
                    <font size="10px">Total Employee Wage (BDT)</font>
                </b><br>
                <span>
                    <font size="6px">
                        <?php
                        $totalEmpWage = getTotalSalaryWage();
                        echo $totalEmpWage;
                        ?>
                    </font>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <b>
                    <font size="10px">Employee of the Month</font>
                </b><br>
                <span>
                    <font size="6px">
                        <?php
                        $info = getEmployeeOfTheMonth();
                        if ($info != null) {
                            $empOfTheMonth = $info[0];
                            echo "Username: " . $info[0] . "<br>" . "Fullname: " . $info[1] . "<br>" . "Score: " . $info[2];
                        }
                        ?>
                    </font>
                </span>
            </td>
            <td>
                <b>
                    <font size="10px">Most Sold Product</font>
                </b><br>
                <span>
                    <font size="6px">
                        <?php
                        $info = getMostSoldProduct();
                        $mostSoldProduct = $info[0];
                        echo "ID: " . $info[0] . "<br>" . "Name: " . $info[1] . "<br>" . "Number of Sales: " . $info[2];
                        ?>
                    </font>
                </span>
            </td>
            <td>
                <?php $topCustomers = getTop3Customers(); ?>
            </td>
        </tr>
    </table>
    <br><br>
    <?php
    $_SESSION["report"] = generateDashboardReport($totalSales, $totalRevenue, $mostSoldProduct, $empOfTheMonth, $totalEmpWage, $topCustomers);
    ?>
    <p align="center">
        <font size="6px"><a href="../Controller/sendReportAdmin.php?send=1"><button>Send Report</button></a></font>
    </p>
    <?php
    include "footer.php"; ?>
</body>

</html>