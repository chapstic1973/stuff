<?php
session_start();
require 'includes/config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $u = $_POST['username'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
    $stmt->bind_param("ss", $u, $p);
    if($stmt->execute()){
        $_SESSION['flash_success'] = "Account created successfully. You can now log in.";
    } else {
        $_SESSION['flash_error'] = "Username already exists or database error.";
    }
}

header("Location: login.php");
exit;
