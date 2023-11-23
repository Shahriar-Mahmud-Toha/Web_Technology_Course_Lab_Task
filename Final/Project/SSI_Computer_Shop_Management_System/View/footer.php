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
    <?php lineSpaceProvider(8) ?>
    <hr>
    <div align="center">
        <table>
            <tr>
                <td>
                    <h3>ABOUT US</h3>
                </td>
                <td>
                    <?php spaceProvider(100) ?>
                </td>
                <td>
                    <h3>CONTACT US</h3>
                </td>
            </tr>
            <tr>
                <td>
                    This website is created for manage SSI Computer Shop administrator department. <br>
                    SSI Computer Shop is ecommerce website where Computer parts are sold.
                </td>
                <td></td>
                <td>
                    <b>SSI Computer Shop</b><br><br>
                    <Address>
                        Kuril-Bishshoroad, Dhaka, Bangladesh.
                    </Address>
                    Phone: 017xxxxxxxx <br>
                    Email: info@ssicomputershop.com
                </td>
            </tr>
        </table>
    </div>
</footer>