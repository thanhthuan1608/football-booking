<?php

session_start();

require_once("../config/database.php");

if(!isset($_SESSION['role']))
{
    header("Location: ../login.php");
    exit();
}

if($_SESSION['role'] != 'admin')
{
    header("Location: ../index.php");
    exit();
}

// Tổng sân
$fieldResult = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM football_fields"
);

$totalFields = mysqli_fetch_assoc($fieldResult);

// Tổng đơn
$bookingResult = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM bookings"
);

$totalBookings = mysqli_fetch_assoc($bookingResult);

// Tổng người dùng
$userResult = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM users"
);

$totalUsers = mysqli_fetch_assoc($userResult);

// Tổng doanh thu
$revenueResult = mysqli_query(
    $conn,
    "SELECT SUM(total_price) AS total
     FROM bookings
     WHERE status != 'cancelled'"
);

$totalRevenue = mysqli_fetch_assoc($revenueResult);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Dashboard Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
background:#f5f7fa;
}

.sidebar{
width:250px;
height:100vh;
background:#212529;
position:fixed;
left:0;
top:0;
padding:20px;
}

.sidebar a{
display:block;
padding:10px;
color:white;
text-decoration:none;
margin-bottom:10px;
border-radius:8px;
}

.sidebar a:hover{
background:#198754;
}

.content{
margin-left:270px;
padding:30px;
}

.card-dashboard{
border:none;
border-radius:15px;
box-shadow:0 0 15px rgba(0,0,0,.1);
}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h3 class="text-white">
⚽ Admin
</h3>

<hr class="text-white">

<a href="dashboard.php">
📊 Dashboard
</a>

<a href="manage_fields.php">
⚽ Quản lý sân
</a>

<a href="manage_bookings.php">
📅 Quản lý đặt sân
</a>

<a href="manage_users.php">
👤 Người dùng
</a>

<a href="../logout.php">
🚪 Đăng xuất
</a>

</div>

<!-- Content -->

<div class="content">

<h2 class="mb-4">

📊 Dashboard Admin

</h2>

<div class="row">

<div class="col-md-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1>⚽</h1>

<h2>

<?= $totalFields['total']; ?>

</h2>

<p>Tổng sân</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1>📅</h1>

<h2>

<?= $totalBookings['total']; ?>

</h2>

<p>Đơn đặt sân</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1>👤</h1>

<h2>

<?= $totalUsers['total']; ?>

</h2>

<p>Người dùng</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1>💰</h1>

<h2>

<?= number_format($totalRevenue['total'] ?? 0); ?>

</h2>

<p>Doanh thu</p>

</div>

</div>

</div>

</div>

<hr>

<div class="card mt-4 shadow">

<div class="card-header bg-success text-white">

📌 Chức năng nhanh

</div>

<div class="card-body">

<a
href="manage_fields.php"
class="btn btn-success me-2">

⚽ Quản lý sân

</a>

<a
href="manage_bookings.php"
class="btn btn-primary me-2">

📅 Quản lý đơn

</a>

<a
href="../pages/history.php"
class="btn btn-warning">

📜 Lịch sử đặt sân

</a>

</div>

</div>

</div>

</body>

</html>