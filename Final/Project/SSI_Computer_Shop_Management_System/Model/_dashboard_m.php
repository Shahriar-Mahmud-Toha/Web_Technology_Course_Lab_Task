<?php
if (strpos(getURL_(), "_dashboard_m.php")) {
    header("location:../View/login.php");
}
function getTotalSales()
{
    $flag = null;
    $check = false;
    $con = mysqli_connect('localhost', 'root', '', "admindb");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "SELECT `infoDuration` FROM `totalsalestb` where sn=1 and infoDuration<=365";
    $stmt = $con->prepare($sql);
    if (!$stmt->execute()) {
        die("Database Error");
    }
    if ($stmt->get_result()->num_rows > 0) {
        $check = true;
    }
    $stmt->close();
    $con->close();

    if ($check) {
        $flag = getSingleValue("admindb", "totalsalestb", "total_sales_amount", "sn", 1, "i");
    } else {
        if (update2Value("admindb", "totalsalestb", "total_sales_amount", 0, "infoDuration", 0, "sn", 1, "iii")) {
            $flag = 0;
        } else {
            die("Database Error");
        }
    }
    return $flag;
}
function getTotalRevenue()
{
    $flag = null;
    $check = false;
    $con = mysqli_connect('localhost', 'root', '', "admindb");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "SELECT `infoDuration` FROM `totalsalestb` where sn=1 and infoDuration<=365";
    $stmt = $con->prepare($sql);
    if (!$stmt->execute()) {
        die("Database Error");
    }
    if ($stmt->get_result()->num_rows > 0) {
        $check = true;
    }
    $stmt->close();
    $con->close();

    if ($check) {
        $flag = getValueRevenue();
    } else {
        if (update3Value("admindb", "producttb", "total_sales_amount", 0, "totalActualSalesAmount", 0, "infoDuration", 0, "sn", 1, "iiii")) {
            $flag = 0;
        } else {
            die("Database Error");
        }
    }
    return $flag;
}
function getTotalNumOfCustomers()
{
    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', "admindb");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT COUNT(id) as count FROM `customertb`';
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $ans = $result->fetch_assoc();
        $flag = $ans["count"];
    }
    else{
        die("Database Error");
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function getTop3Customers()
{
    $top = null;
    $count = 0;
    $con = mysqli_connect('localhost', 'root', '', 'admindb');
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "SELECT `id`, `name`, `email`, `revenue` FROM `customertb` ORDER BY revenue DESC LIMIT 3";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($ans = $result->fetch_assoc()) {
                $id = $ans["id"];
                $arr["id"][] = $ans["id"];
                $name = $ans["name"];
                $arr["name"][] = $ans["name"];
                $email = $ans["email"];
                $arr["email"][] = $ans["email"];
                $revenue = $ans["revenue"];
                $arr["revenue"][] = $ans["revenue"];
                if ($count < 1) {
                    $top = $id;
                    $count++;
                }
            }
        }
    } else {
        echo "No Data Found";
    }
    $stmt->close();
    $con->close();
    if ($top != null) {
        return $arr;
    } else {
        return null;
    }
}
function getMostSoldProduct()
{
    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', 'admindb');
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "SELECT `id`, `pd_info`, `sold` FROM `producttb` ORDER BY sold DESC LIMIT 1";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($ans = $result->fetch_assoc()) {
                $id = $ans["id"];
                $pd_info = $ans["pd_info"];
                $sold = $ans["sold"];
            }
        }
        $flag = array($id, $pd_info, $sold);
    } else {
        echo "No Data Found";
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function getEmployeeOfTheMonth()
{
    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', 'admindb');
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "SELECT `username`, `fullname`, performance*attendance as score FROM `employeetb` ORDER BY score DESC LIMIT 1";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($ans = $result->fetch_assoc()) {
                $username = $ans["username"];
                $fullname = $ans["fullname"];
                $score = $ans["score"];
            }
            $flag = array($username, $fullname, $score);
        }
    } else {
        echo "No Data Found";
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function getURL_()
{
    $data = trim($_SERVER['REQUEST_URI']);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function getTotalSalaryWage()
{

    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', 'admindb');
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "SELECT SUM(`salary`) as wage FROM `salarysheettb`";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($ans = $result->fetch_assoc()) {
                $flag = $ans["wage"];
            }
        }
    } else {
        echo "No Data Found";
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function generateDashboardReport($totalSales, $totalRevenue, $mostSoldProduct, $empOfTheMonth, $totalEmpWage, $topCustomers)
{
    $report = "Total Sales: $totalSales Taka<br>
    Total Revenue: $totalRevenue Taka<br>
    Most Sold Product ID (till now): $mostSoldProduct<br>
    Current Employee of the Month (username): $empOfTheMonth<br>
    Current Total Employee Wage: $totalEmpWage Taka<br>
    Top Customer ID: " . $topCustomers . "<br>";
    return $report;
}
function sendReportToAdmin($report, $username)
{
    $flag = false;
    $email = getSingleValue("admindb", "admintb", "email", "username", $username, "s");
    $name = "SSI Computer Shop";
    $from = "authenticator.smt@outlook.com";
    $headers = "MIME-Version: 1.0" . "\r\n" .
        "Content-type:text/html;charset=UTF-8" . "\r\n" .
        'From: ' . $name . '<' . $from . '>' . "\r\n";
    $subject = "SSI Computer Shop - Dashboard Report";
    if (($email != null) && mail($email, $subject, $report, $headers)) {
        $flag = true;
    }
    return $flag;
}
?>