<?php
if (!isset($_SESSION["loginVerified"])) {
    header("location:login.php");
    die();
}
?>
<header id="header-admin">
    <div>
        <a href="admin.php">
            <img id="comLogoAdmin" src="Icons/ssi_cs_logo.png" alt="Company Logo">
        </a>
        <h1>SSI Computer Shop - Administrator</h1>
    </div>
    <div>
        <nav id="navAdmin">
            <ul>
                <li><a href="userManagementAdmin.php"><img id="manageUserIcon" src="Icons/manageUser.png" alt="manage-user-icon">Manage user</a></li>
                <li><a href="adminTask.php?task=1"><img id="taskIcon" src="Icons/task.png" alt="account-task-icon">Task</a></li>
                <li><a href="accSettings.php?accset=1"><img id="accSetIcon" src="Icons/settings.png"
                alt="account-settings-icon"></a></li>
                <li id="profilePicL"><a href="viewAdminProfile.php?view=1"><img id="profilePicAdmin" src="../Model/profile_pictures/<?php echo $_SESSION["profilepic_name"] ?>" alt="profile picture"></a></li>
                <li id="logoutL"><a href="../Controller/logout.php?logout=1"><img src="Icons/logout.png"
                alt="logout-icon" id="logoutIcon"></a></li>
            </ul>
        </nav>
        <!-- <?php echo $_SESSION["username"]; ?> -->
    </div>
</header>