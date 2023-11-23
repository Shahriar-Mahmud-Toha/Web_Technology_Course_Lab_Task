<?php
if (!isset($_SESSION["loginVerified"])) {
    header("location:login.php");
    die();
}
?>
<header>
    <div align="center">
        <a href="admin.php">
            <img src="Icons/ssi_cs_logo.png" height="80px" width="80px" alt="Company Logo">
        </a>
        <h1>SSI Computer Shop - Administrator</h1>
        <section align="right"><a href="viewAdminProfile.php?view=1"><img
                    src="../Model/profile_pictures/<?php echo $_SESSION["profilepic_name"] ?>" alt="profile picture"
                    height="60px" width="60px"></a>
            <?php spaceProvider(3) ?><a href="../Controller/logout.php?logout=1"><img src="Icons/logout.png"
                    alt="logout-icon" height="35px" width="35px"></a>
            <?php spaceProvider(3) ?><a href="accSettings.php?accset=1"><img src="Icons/settings.png"
                    alt="account-settings-icon" height="35px" width="35px"></a>
            <?php spaceProvider(3) ?><a href="adminTask.php?task=1"><img src="Icons/task.png" alt="account-task-icon"
                    height="35px" width="35px"></a>
            <?php spaceProvider(6) ?>
            <br>Welcome,
            <?php spaceProvider(43); ?><br>
            <?php echo $_SESSION["username"];
            spaceProvider(45); ?>
        </section>
    </div>
</header>