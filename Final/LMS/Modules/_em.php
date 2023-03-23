<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
function noOutputQueryToDB($databaseName, $sql)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    if ($con->query($sql)) {
        $flag = true;
    }
    $con->close();
    return $flag;
}
function extractRaw($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function extractPhotoData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
function isValueExistsToDB($databaseName, $sql)
{
    $flag = false;
    $con = mysqli_connect('localhost', 'root', '', "$databaseName");
    if (!$con) {
        die("Failed. Error: " . mysqli_connect_error());
    }
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $flag = true;
    }
    $con->close();
    return $flag;
}
function lineSpaceProvider($numOfLines)
{
    for ($i = 0; $i < $numOfLines; $i++) {
        echo "<br>";
    }
}
function spaceProvider($numOfSpaces)
{
    for ($i = 0; $i < $numOfSpaces; $i++) {
        echo "&nbsp;";
    }
}
function validateUsername($username)
{
    if (preg_match('/^(?=.*[a-z])[a-z0-9_]{1,16}$/i', $username)) {
        return true;
    } else {
        return false;
    }
}
?>