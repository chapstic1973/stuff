<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="includes/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>

                        <?php
                        require 'includes/config.php';

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $u = $_POST['username'];
                            $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

                            $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
                            $stmt->bind_param("ss", $u, $p);
                            if ($stmt->execute()) {
                                echo '<div class="alert alert-success">Account created. <a href="login.php">Login</a></div>';
                            } else {
                                echo '<div class="alert alert-danger">User exists or DB error.</div>';
                            }
                        }
                        ?>

                        <form class="user" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" type="submit">Register Account</button>
                        </form>

                        <hr>

                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
