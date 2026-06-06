<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Lịch sử đặt sân</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">
📜 Lịch sử đặt sân
</h2>

<a href="../index.php"
class="btn btn-secondary mb-3">

← Trang chủ

</a>

<div class="card shadow">

<div class="card-body">

<table class="table table-striped table-hover">

<thead class="table-success">

<tr>

<th>Sân</th>

<th>Ngày</th>

<th>Giờ</th>

<th>Tổng tiền</th>

<th>Trạng thái</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)): ?>

<tr>

<td>
<?= $row['field_name'] ?>
</td>

<td>
<?= $row['booking_date'] ?>
</td>

<td>
<?= $row['start_time'] ?>
-
<?= $row['end_time'] ?>
</td>

<td class="text-success">

<?= number_format($row['total_price']) ?>

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

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>