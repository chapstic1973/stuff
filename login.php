<?php
session_start();
require 'includes/config.php';

// If already logged in, redirect
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header("Location: dashboard.php");
    exit;
}

// Handle login
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, username, password, role FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $u);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows === 1){
        $stmt->bind_result($id, $uname, $hash, $role);
        $stmt->fetch();

        if(password_verify($p, $hash)){
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $uname;
            $_SESSION['role'] = $role;

            header("Location: dashboard.php");
            exit;
        }
    }

    $_SESSION['flash_error'] = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="includes/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">

<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>

                        <?php
                        if(isset($_SESSION['flash_error'])){
                            echo '<div class="alert alert-danger">'.$_SESSION['flash_error'].'</div>';
                            unset($_SESSION['flash_error']);
                        }
                        if(isset($_SESSION['flash_success'])){
                            echo '<div class="alert alert-success">'.$_SESSION['flash_success'].'</div>';
                            unset($_SESSION['flash_success']);
                        }
                        ?>

                        <form class="user" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" type="submit">Login</button>
                        </form>

                        <hr>

                        <div class="text-center">
                            <a class="small" href="#" data-toggle="modal" data-target="#registerModal">Create an Account!</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="register_process.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="includes/vendor/jquery/jquery.min.js"></script>
<script src="includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="includes/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="includes/js/sb-admin-2.min.js"></script>

</body>
</html>
