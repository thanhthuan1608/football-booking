<?php
session_start();
require_once("../config/database.php");

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// Tổng số sân
$sqlFields = "SELECT COUNT(*) AS total FROM football_fields";
$resultFields = mysqli_query($conn, $sqlFields);
$totalFields = mysqli_fetch_assoc($resultFields)['total'];

// Tổng số khách hàng
$sqlUsers = "SELECT COUNT(*) AS total FROM users WHERE role='user'";
$resultUsers = mysqli_query($conn, $sqlUsers);
$totalUsers = mysqli_fetch_assoc($resultUsers)['total'];

// Tổng số đơn đặt sân
$sqlBookings = "SELECT COUNT(*) AS total FROM bookings";
$resultBookings = mysqli_query($conn, $sqlBookings);
$totalBookings = mysqli_fetch_assoc($resultBookings)['total'];

// Tổng doanh thu
$sqlRevenue = "SELECT SUM(total_price) AS revenue
               FROM bookings
               WHERE status='completed'";

$resultRevenue = mysqli_query($conn, $sqlRevenue);
$revenue = mysqli_fetch_assoc($resultRevenue)['revenue'];

if ($revenue == null) {
    $revenue = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">ADMIN DASHBOARD</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Tổng Sân</h5>
                    <h3><?= $totalFields ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Khách Hàng</h5>
                    <h3><?= $totalUsers ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Đơn Đặt</h5>
                    <h3><?= $totalBookings ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Doanh Thu</h5>
                    <h3><?= number_format($revenue) ?> VNĐ</h3>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <h4>Menu Quản Trị</h4>

    <a href="manage_fields.php" class="btn btn-primary">
        Quản Lý Sân
    </a>

    <a href="manage_bookings.php" class="btn btn-success">
        Quản Lý Đặt Sân
    </a>

    <a href="manage_users.php" class="btn btn-warning">
        Quản Lý Người Dùng
    </a>

    <a href="../logout.php" class="btn btn-danger">
        Đăng Xuất
    </a>

</div>

</body>
</html>