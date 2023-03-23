<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<!-- Login -->
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $flag = true;
    if (empty($_POST["username"])) {
        $flag = false;
        echo "Fill Username <br>";
    }
    if (empty($_POST["password"])) {
        $flag = false;
        echo "Fill Password <br>";
    }
    if ($flag) {
        echo '<br><p align="center">Successfully Logged In</p><br><br>';
    }
}
function extractRaw($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>