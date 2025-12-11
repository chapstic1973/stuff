<?php
require_once "includes/auth.php";
checkLogin();
?>
<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
<p>Your role: <?php echo $_SESSION['role']; ?></p>

<a href="admin.php">Admin Area</a><br>
<a href="superadmin.php">Superadmin Area</a><br>
<a href="logout.php">Logout</a>
