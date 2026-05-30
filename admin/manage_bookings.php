<?php

require_once("../config/database.php");

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
";

$result = mysqli_query($conn,$sql);

?>

<table border="1">

<tr>
    <th>ID</th>
    <th>Khách hàng</th>
    <th>Sân</th>
    <th>Ngày</th>
    <th>Trạng thái</th>
    <th></th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)): ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= $row['full_name'] ?></td>

<td><?= $row['field_name'] ?></td>

<td><?= $row['booking_date'] ?></td>

<td><?= $row['status'] ?></td>

<td>

<a href="
booking_detail.php?id=<?= $row['id'] ?>
">

Chi tiết

</a>

</td>

</tr>

<?php endwhile; ?>

</table>