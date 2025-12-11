<?php 
require 'includes/auth.php'; 
checkLogin(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="includes/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Application Name</div>
        </a>

        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Admin Section -->
        <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'superadmin'): ?>
        <li class="nav-item">
            <a class="nav-link" href="admin.php">
                <i class="fas fa-fw fa-user-cog"></i>
                <span>Admin Area</span>
            </a>
        </li>
        <?php endif; ?>

        <!-- Superadmin Section -->
        <?php if($_SESSION['role'] === 'superadmin'): ?>
        <li class="nav-item">
            <a class="nav-link" href="superadmin.php">
                <i class="fas fa-fw fa-shield-alt"></i>
                <span>Superadmin Area</span>
            </a>
        </li>
        <?php endif; ?>

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            Logged in as: <?php echo $_SESSION['username']; ?> (<?php echo $_SESSION['role']; ?>)
                        </span>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Welcome to your Dashboard</h1>

                <div class="row">

                    <div class="col-lg-6 mb-4">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                Quick links:
                                <ul class="mt-2">
                                    <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'superadmin'): ?>
                                    <li><a class="text-white" href="admin.php">Admin Area</a></li>
                                    <?php endif; ?>
                                    <?php if($_SESSION['role'] === 'superadmin'): ?>
                                    <li><a class="text-white" href="superadmin.php">Superadmin Area</a></li>
                                    <?php endif; ?>
                                    <li><a class="text-white" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="text-center my-auto">
                    <span>© <?php echo date('Y'); ?> Auth System</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scripts -->
<script src="includes/vendor/jquery/jquery.min.js"></script>
<script src="includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="includes/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="includes/js/sb-admin-2.min.js"></script>

</body>
</html>
