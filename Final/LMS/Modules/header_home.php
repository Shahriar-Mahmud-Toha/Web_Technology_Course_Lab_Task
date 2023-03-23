<!-- Name: Md. Shahriar Mahmud
ID: 21-44498-1 -->

<?php
if ((!isset($_SESSION["stdLoginVerified"])) && (!isset($_SESSION["tLoginVerified"]))) {
    die();
}
?>
<header>
    <div align="center">
        <?php
        if (isset($_SESSION["std_username"])) {
            echo '<h1>LMS Student - Home</h1>';
        } else if (isset($_SESSION["t_username"])) {
            echo '<h1>LMS Teacher - Home</h1>';
        }
        ?>
        <section align="right">
            Welcome,
            <?php spaceProvider(43); ?><br>
            <?php
            if (isset($_SESSION["std_username"])) {
                echo $_SESSION["std_username"];
            } else if (isset($_SESSION["t_username"])) {
                echo $_SESSION["t_username"];
            }

            spaceProvider(44); ?>
            <a href="logout.php?logout=1"><img src="Icons/logout.png" alt="logout-icon" height="35px" width="35px"></a>
        </section>
    </div>
</header>