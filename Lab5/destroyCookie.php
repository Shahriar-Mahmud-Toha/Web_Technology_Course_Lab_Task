<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    setcookie("color", "", time() - 3600);
    header("location:cookie.php");
}
?>