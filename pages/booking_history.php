<?php

session_start();

require_once("../config/database.php");

$user_id = $_SESSION['user_id'];

$sql = "
SELECT
b.*,
f.field_name

FROM bookings b

JOIN football_fields f
ON b.field_id = f.id

WHERE b.user_id = $user_id

ORDER BY b.id DESC
";

$result = mysqli_query($conn,$sql);

?>

<h1>Lịch sử đặt sân</h1>

<table border="1">

<tr>
    <th>Sân</th>
    <th>Ngày</th>
    <th>Giờ</th>
    <th>Tiền</th>
    <th>Trạng thái</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)): ?>

<tr>

<td><?= $row['field_name'] ?></td>

<td><?= $row['booking_date'] ?></td>

<td>
<?= $row['start_time'] ?>
-
<?= $row['end_time'] ?>
</td>

<td>
<?= number_format($row['total_price']) ?>
VNĐ
</td>

<td><?= $row['status'] ?></td>

</tr>

<?php endwhile; ?>

</table>