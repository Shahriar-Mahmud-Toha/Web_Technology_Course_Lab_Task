<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
session_start();
require "Modules/_em.php";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["stdLoginVerified"])) {
    $flag = true;
    $application = extractRaw($_POST["application"]);
    $username = $_SESSION["std_username"];
    $files = $_FILES['attachment']['name'];
    if (empty($application)) {
        $flag = false;
        setcookie("applicationEmptyMsg", true, time() + 120);
    }
    if ($flag) {
        date_default_timezone_set('Asia/Dhaka');
        $time = date('Y-m-d H:i:s');
        $sql = 'UPDATE `studenttb` SET `application`="' . $application . '" ,`application_submit_time`="' . $time . '" WHERE username="' . $username . '"';
        if (noOutputQueryToDB("lmsdb", $sql)) {
            if (!empty($files)) {
                $total_count = count($_FILES['attachment']['name']);
                for ($i = 0; $i < $total_count; $i++) {
                    $tmpFilePath = $_FILES['attachment']['tmp_name'][$i];
                    if ($tmpFilePath != "") {
                        $newFilePath = 'uploadedFiles\\' . $username . '\\' . $_FILES['attachment']['name'][$i];
                        if (file_exists($newFilePath)) {
                            unlink($newFilePath);
                            $tbname = $username."_files";
                            $sql = 'DELETE FROM `'.$tbname.'` WHERE filename="' . $_FILES['attachment']['name'][$i] . '"';
                            noOutputQueryToDB("lmsdb", $sql);
                        }
                        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $sql = 'INSERT INTO `' . $username . '_files`(`filename`) VALUES ("' . $_FILES['attachment']['name'][$i] . '")';
                            if (!noOutputQueryToDB("lmsdb", $sql)) {
                                die("Files Database Error");
                            }
                        }
                    }
                }
            }
            $_SESSION["successSubmitMsg"] = true;
            header("location:home_student.php");
        } else {
            die("Database Error");
        }
    } else {
        header("location:home_student.php");
    }
} else {
    header("location:student_login.php");
}
?>