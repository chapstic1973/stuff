<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['loggedin'])) {
        header("Location: login.php");
        exit;
    }
}

function requireRole($role) {
    checkLogin();

    $roles = [
        'user' => 1,
        'admin' => 2,
        'superadmin' => 3
    ];

    $current = $roles[$_SESSION['role']];
    $required = $roles[$role];

    if ($current < $required) {
        header("Location: unauthorized.php");
        exit;
    }
}
