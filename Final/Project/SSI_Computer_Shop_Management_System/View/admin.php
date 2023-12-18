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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="responsive_smallPhone.css">
</head>

<body id="adminId">
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
    $totalSales = getTotalSales();
    $totalRevenue = getTotalRevenue();
    $totalEmpWage = getTotalSalaryWage();
    $empInfo = getEmployeeOfTheMonth();
    $info = getMostSoldProduct();
    $topCustomers = getTop3Customers();
    $_SESSION["report"] = generateDashboardReport($totalSales, $totalRevenue, $mostSoldProduct, $empOfTheMonth, $totalEmpWage, $topCustomers["id"][0]);
    ?>
    <section id="dashBoard">
        <div class="dashboardItemContainer1">
            <div class="dashboardItem">
                Total Sales
                <p>(BDT)</p>
                <div class="dashboardItemContent">
                    <!-- <?php echo $totalSales; ?> -->
                    <span id="totalSales"></span>
                </div>
            </div>
            <div class="dashboardItem">
                Total Revenue
                <p>(BDT)</p>
                <div class="dashboardItemContent">
                    <!-- <?php echo $totalRevenue; ?> -->
                    <span id="totalRevenue"></span>
                </div>
            </div>
            <div class="dashboardItem">
                Total Employee Wage
                <p>(BDT)</p>
                <div class="dashboardItemContent">
                    <!-- <?php echo $totalEmpWage; ?> -->
                    <span id="totalEmpWage"></span>
                </div>
            </div>
        </div>
        <div class="dashboardItemContainer2">
            <div class="dashboardItem">
                Employee of the Month
                <div class="dashboardItemContentEmp">
                    <?php
                    if ($empInfo != null) {
                        $empOfTheMonth = $empInfo[0];
                        // echo "Username: " . $empInfo[0] . "<br>" . "Fullname: " . $empInfo[1] . "<br>" . "Score: " . $empInfo[2];
                        ?>
                        <span id="empOfMonthUsername">Username: </span>
                        <span id="empOfMonthFullName">Fullname: </span>
                        <span id="empOfMonthScore">Score: </span>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="dashboardItem">
                <div id="dashboardItemContentSubmitBtn">
                    <a href="../Controller/sendReportAdmin.php?send=1"><button class="submitReportBtn">Send
                            Report</button></a>
                </div>
            </div>
            <div class="dashboardItem">
                Most Sold Product
                <div class="dashboardItemContentEmp">
                    <?php
                    $mostSoldProduct = $info[0];
                    // echo "Product ID: " . $info[0] . "<br>" . "Name: " . $info[1] . "<br>" . "Number of Sales: " . $info[2];
                    ?>
                    <span id="mostSoldProductId">Product ID: </span>
                    <span id="mostSoldProductName">Name: </span>
                    <span id="mostSoldProductNumOfSales">Number of Sales: </span>
                </div>
            </div>
        </div>
        <div class="dashboardItem">
            Top 3 Customers
            <div class="dashboardItemContentTopCus">
                <div class="cusDetails">
                    <?php
                    // echo "<p id='topCus1Id'>ID: " . $topCustomers["id"][0] . "</p>";
                    // echo "<p id='topCus1Name'>Name: " . $topCustomers["name"][0] . "</p>";
                    // echo "<p id='topCus1Email'>Email: " . $topCustomers["email"][0] . "</p>";
                    ?>
                    <p id='topCus1Id'>ID: </p>
                    <p id='topCus1Name'>Name: </p>
                    <p id='topCus1Email'>Email: </p>
                </div>
                <div class="cusDetails">
                    <p id='topCus2Id'>ID: </p>
                    <p id='topCus2Name'>Name: </p>
                    <p id='topCus2Email'>Email: </p>
                    <?php
                    // echo "<p id='topCus2Id'>ID: " . $topCustomers["id"][1] . "</p>";
                    // echo "<p id='topCus2Name'>Name: " . $topCustomers["name"][1] . "</p>";
                    // echo "<p id='topCus2Email'>Email: " . $topCustomers["email"][1] . "</p>";
                    ?>
                </div>
                <div class="cusDetails">
                    <!-- <?php
                    echo "<p id='topCus3Id'>ID: " . $topCustomers["id"][2] . "</p>";
                    echo "<p id='topCus3Name'>Name: " . $topCustomers["name"][2] . "</p>";
                    echo "<p id='topCus3Email'>Email: " . $topCustomers["email"][2] . "</p>";
                    ?> -->
                    <p id='topCus3Id'>ID: </p>
                    <p id='topCus3Name'>Name: </p>
                    <p id='topCus3Email'>Email: </p>
                </div>
            </div>
        </div>
    </section>
    <div class="numOfCusDiv">
        <span id="numOfCus">Total Number of Customers: </span>
    </div>
    <div class="endSpace"></div>
    <script src="dashboardData.js"></script>
</body>

</html>