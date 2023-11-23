<?php
if (!function_exists("getURL")) {
    function getURL()
    {
        $data = trim($_SERVER['REQUEST_URI']);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (strpos(getURL(), "header.php")) {
        header("location:../View/login.php");
        die();
    }
} else {
    if (strpos(getURL(), "header.php")) {
        header("location:../View/login.php");
        die();
    }
}
?>
<header align="center">
    <a href="admin.php">
        <img src="Icons/ssi_cs_logo.png" height="80px" width="80px" alt="Company Logo">
    </a>
    <h1>SSI Computer Shop - Administrator</h1>
</header>