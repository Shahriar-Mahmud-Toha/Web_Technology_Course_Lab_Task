<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    date_default_timezone_set('Asia/Dhaka');
    $color = $_POST["color"];
    $time = $_POST["time"];
    $date = new DateTime();
    $expireTime = strtotime($time) - $date->getTimestamp();
    if ($expireTime > 0) {
        setcookie("color", $color, time() + $expireTime);
    }
    header("location:cookie.php");
}
?>