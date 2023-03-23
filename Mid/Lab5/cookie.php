<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Cookie</title>
</head>

<body <?php
if (key_exists("color", $_COOKIE)) {
    echo 'bgcolor=' . $_COOKIE['color'];
} ?>>
    <h1>Cookie Example</h1>Time Zone: Asia/Dhaka
    <hr>
    <h2><br>Set Cookie <br><br></h2>
    <hr>
    <form action="set_cookie.php" method="post">
        Select a color: <input type="color" name="color"><br><br>
        Expire on: <input type="datetime-local" name="time"><br><br>
        <input type="submit" value="Set Cookie">
    </form><br>
    <hr>
    <h2><br>Destroy Cookie <br><br></h2>
    <hr>
    <form action="destroyCookie.php" method="post">
        <input type="submit" value="Destroy Cookie">
    </form>
</body>

</html>