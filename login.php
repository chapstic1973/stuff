<!DOCTYPE html>
<div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<div class="p-5">
<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
</div>
<?php
require 'includes/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$u = $_POST['username'];
$p = $_POST['password'];


$stmt = $mysqli->prepare("SELECT id, username, password, role FROM users WHERE username=? LIMIT 1");
$stmt->bind_param("s", $u);
$stmt->execute();
$stmt->store_result();


if ($stmt->num_rows === 1) {
$stmt->bind_result($id, $uname, $hash, $role);
$stmt->fetch();


if (password_verify($p, $hash)) {
session_start();
$_SESSION['loggedin'] = true;
$_SESSION['id'] = $id;
$_SESSION['username'] = $uname;
$_SESSION['role'] = $role;
header("Location: dashboard.php");
exit;
}
}
echo '<div class="alert alert-danger text-center">Invalid credentials</div>';
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
<a class="small" href="register.php">Create an Account!</a>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
</body>
</html>
