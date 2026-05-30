<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "football_booking";

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}