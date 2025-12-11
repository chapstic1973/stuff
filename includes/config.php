<?php
$mysqli = new mysqli("localhost", "web", "secret", "web");

if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}
