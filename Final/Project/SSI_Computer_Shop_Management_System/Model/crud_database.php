<?php
if(strpos(getURL(),"crud_database.php")){
    header("location:../View/login.php");
}
function getSingleValueWithoutWhere($databaseName, $datatableName, $select)
{
    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', $databaseName);
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT ' . $select . ' FROM `' . $datatableName . '`';
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flag = $row[$select];
                break;
            }
        }
    } else {
        die("Error in Query");
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function getValueRevenue()
{
    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', "admindb");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "SELECT total_sales_amount-totalActualSalesAmount as revenue FROM `totalsalestb`";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flag = $row["revenue"];
                break;
            }
        }
    } else {
        die("Error in Query");
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function getSingleValue($databaseName, $datatableName, $select, $item, $value, $type)
{
    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT ' . $select . ' FROM `' . $datatableName . '` WHERE ' . $item . '=?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val);
    $val = $value;
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flag = $row[$select];
                break;
            }
        }
    } else {
        die("Error in Query");
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function getSingleValueWith3Param($databaseName, $datatableName, $select, $item1, $value1,$item2, $value2,$item3, $value3, $type)
{
    $flag = null;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT ' . $select . ' FROM `' . $datatableName . '` WHERE ' . $item1 . '=? and '.$item2.'=? and '.$item3.'=?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val1,$val2,$val3);
    $val1 = $value1;
    $val2 = $value2;
    $val3 = $value3;
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flag = $row[$select];
                break;
            }
        }
    } else {
        die("Error in Query");
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function updateSingleValue($databaseName, $datatableName, $item, $value, $type, $keyItem, $key)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'UPDATE `' . $datatableName . '` SET `' . $item . '`=? WHERE ' . $keyItem . ' = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val, $keyVal);
    $val = $value;
    $keyVal = $key;
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function update2Value($databaseName, $datatableName, $item1, $value1,$item2, $value2, $keyItem, $key, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'UPDATE `' . $datatableName . '` SET `' . $item1 . '`=?, `'.$item2.'`=? WHERE ' . $keyItem . ' = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val1, $val2, $keyVal);
    $val1 = $value1;
    $val2 = $value2;
    $keyVal = $key;
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function update3Value($databaseName, $datatableName, $item1, $value1,$item2, $value2,$item3, $value3, $keyItem, $key, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'UPDATE `' . $datatableName . '` SET `' . $item1 . '`=?, `'.$item2.'`=?, `'.$item3.'`=? WHERE ' . $keyItem . ' = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val1, $val2, $val3, $keyVal);
    $val1 = $value1;
    $val2 = $value2;
    $val3 = $value3;
    $keyVal = $key;
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function updateSingleValueWith2Param($databaseName, $datatableName, $item, $value, $keyItem1, $key1, $keyItem2, $key2, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'UPDATE `' . $datatableName . '` SET `' . $item . '`=? WHERE ' . $keyItem1 . ' = ? and ' . $keyItem2 . '=?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val, $keyVal1, $keyVal2);
    $val = $value;
    $keyVal1 = $key1;
    $keyVal2 = $key2;
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function insertSingleValue($databaseName, $datatableName, $item, $value, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'INSERT INTO `' . $datatableName . '`(`' . $item . '`) VALUES (?)';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val);
    $val = $value;
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function insert2Value($databaseName, $datatableName, $item1, $value1, $item2, $value2, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'INSERT INTO `' . $datatableName . '`(`' . $item1 . '`, `' . $item2 . '`) (?,?)';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val1, $val2);
    $val1 = $value1;
    $val2 = $value2;
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function insertForSignup($username, $password, $email,$fullname,$address, $nid, $gender,$phone, $dob,$profilepic_name)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "admindb");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO `admintb`(`username`, `password`, `email`, `fullname`, `address`, `nid`, `gender`, `phone`, `dob`, `profilepic_name`) VALUES (?, ?, ?,?,?, ?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssssss",$username, $password, $email,$fullname,$address, $nid, $gender,$phone, $dob,$profilepic_name);
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function getURL()
{
    $data = trim($_SERVER['REQUEST_URI']);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function deleteSingleValue($databaseName, $datatableName, $item, $value, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'DELETE FROM `' . $datatableName . '` WHERE ' . $item . '=?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val);
    $val = $value;
    if ($stmt->execute()) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function isSingleValueExistsToDB($databaseName, $datatableName, $item, $value, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT ' . $item . ' FROM `' . $datatableName . '` WHERE ' . $item . '=?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val);
    $val = $value;
    if (!$stmt->execute()) {
        die("Database Error");
    }
    if ($stmt->get_result()->num_rows > 0) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function isValueExistsToWith3Param($databaseName, $datatableName, $select, $item1, $value1,$item2, $value2,$item3, $value3, $type)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT ' . $select . ' FROM `' . $datatableName . '` WHERE ' . $item1 . '=? and '.$item2.'=? and '.$item3.'=?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param($type, $val1,$val2,$val3);
    $val1 = $value1;
    $val2 = $value2;
    $val3 = $value3;
    if (!$stmt->execute()) {
        die("Database Error");
    }
    if ($stmt->get_result()->num_rows > 0) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
function isValueExistsToDbAccSet($username, $password)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "admindb");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $sql = 'SELECT username FROM `admintb` WHERE username=? and password=? and active=1';
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $uname, $pass);
    $uname = $username;
    $pass = $password;
    if (!$stmt->execute()) {
        die("Database Error");
    }
    if ($stmt->get_result()->num_rows > 0) {
        $flag = true;
    }
    $stmt->close();
    $con->close();
    return $flag;
}
?>