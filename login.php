<?php
require_once "includes/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $mysqli->prepare("SELECT id, username, password, role FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $uname, $hashed, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $uname;
            $_SESSION["role"] = $role;

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = "Invalid username or password.";
}
?>
<form method="post">
    <input type="text" name="username" placeholder="user">
    <input type="password" name="password" placeholder="pass">
    <button type="submit">Login</button>
</form>
<?php if(isset($error)) echo $error; ?>
