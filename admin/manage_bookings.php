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

if(isset($_GET['confirm']))
{
    $id = $_GET['confirm'];

    mysqli_query(
        $conn,
        "UPDATE bookings
         SET status='confirmed'
         WHERE id=$id"
    );
}

if(isset($_GET['cancel']))
{
    $id = $_GET['cancel'];

    mysqli_query(
        $conn,
        "UPDATE bookings
         SET status='cancelled'
         WHERE id=$id"
    );
}

$sql = "
SELECT
b.*,
u.full_name,
f.field_name

FROM bookings b

JOIN users u
ON b.user_id = u.id

JOIN football_fields f
ON b.field_id = f.id

ORDER BY b.id DESC
";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Quản lý đặt sân</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">

📅 Quản lý đơn đặt sân

</h2>

<a href="dashboard.php"
class="btn btn-secondary mb-3">

← Dashboard

</a>

<div class="card shadow">

<div class="card-body">

<table class="table table-striped table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Khách hàng</th>
<th>Sân</th>
<th>Ngày</th>
<th>Giờ</th>
<th>Tiền</th>
<th>Trạng thái</th>
<th>Hành động</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td>
<?= $row['id']; ?>
</td>

<td>
<?= $row['full_name']; ?>
</td>

<td>
<?= $row['field_name']; ?>
</td>

<td>
<?= $row['booking_date']; ?>
</td>

<td>

<?= $row['start_time']; ?>

-

<?= $row['end_time']; ?>

</td>

<td class="text-success">

<?= number_format($row['total_price']); ?>

VNĐ

</td>

<td>

<?php

if($row['status']=='pending')
{
    echo "<span class='badge bg-warning'>Chờ xác nhận</span>";
}
elseif($row['status']=='confirmed')
{
    echo "<span class='badge bg-primary'>Đã xác nhận</span>";
}
elseif($row['status']=='completed')
{
    echo "<span class='badge bg-success'>Hoàn thành</span>";
}
else
{
    echo "<span class='badge bg-danger'>Đã hủy</span>";
}

?>

</td>

<td>

<a
href="?confirm=<?= $row['id']; ?>"
class="btn btn-success btn-sm">

✓ Xác nhận

</a>

<a
href="?cancel=<?= $row['id']; ?>"
class="btn btn-danger btn-sm">

✕ Hủy

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>