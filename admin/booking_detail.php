<?php

require_once("../config/database.php");

$id = $_GET['id'];

$sql = "
SELECT
b.*,
u.full_name,
f.field_name

FROM bookings b

JOIN users u
ON b.user_id=u.id

JOIN football_fields f
ON b.field_id=f.id

WHERE b.id=$id
";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

?>

<h2>Chi tiết đơn</h2>

<p>Khách: <?= $row['full_name'] ?></p>

<p>Sân: <?= $row['field_name'] ?></p>

<p>Ngày: <?= $row['booking_date'] ?></p>

<p>Từ: <?= $row['start_time'] ?></p>

<p>Đến: <?= $row['end_time'] ?></p>

<p>Tiền: <?= number_format($row['total_price']) ?></p>