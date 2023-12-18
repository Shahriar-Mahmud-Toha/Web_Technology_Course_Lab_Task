<?php
if (!function_exists("getURL")) {
    function getURL()
    {
        $data = trim($_SERVER['REQUEST_URI']);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (strpos(getURL(), "footer.php")) {
        header("location:../View/login.php");
        die();
    }
} else {
    if (strpos(getURL(), "footer.php")) {
        header("location:../View/login.php");
        die();
    }
}
?>
<footer>
    <div id="aboutUsDiv">
        <h3>ABOUT US</h3>
        <p>
            This website is created for manage SSI Computer Shop administrator department.
            SSI Computer Shop is ecommerce website where Computer parts are sold.
        </p>
    </div>
    <div id="contactUsDiv">
        <h3>CONTACT US</h3>
        <p id="footerTitle"><b>SSI Computer Shop</b></p>
        <Address>
            Kuril-Bishshoroad, Dhaka, Bangladesh.
        </Address>
        <p>Phone: 017xxxxxxxx</p>
        <p>Email: info@ssicomputershop.com</p>
    </div>
</footer>