<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 3 Task</title>
</head>

<body>
    <form action="#">
        <label for="number">Enter a value</label>
        <input type="text" name="number" id="number">
        <input type = "submit" name = "submit" value = "Submit">
    </form>

</body>

</html>
<?php
if (isset($_GET['submit'])) {
    $value = $_GET['number'];

    for ($i=1; $i <= 10; $i++) { 
        $mul = $value * $i;
        //5 * 1 = 5
        // echo "$value * $i = $mul<br>";
        echo "<table border='2' align='center'>
        <tr>
            <td>$value</td><td>*</td><td>$i<td> = </td></td><td>$mul</td>
        </tr>
    </table>";
    }
}

?>