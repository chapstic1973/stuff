<?php require 'includes/auth.php'; checkLogin(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<title>Dashboard</title>
</head>
<body id="page-top">
<div class="container mt-4">
<h1 class="h3">Welcome, <?php echo $_SESSION['username']; ?></h1>
<p>Your role: <?php echo $_SESSION['role']; ?></p>
<a href="admin.php">Admin Area</a> |
<a href="superadmin.php">Superadmin Area</a> |
<a href="logout.php">Logout</a>
</div>
</body>
</html>