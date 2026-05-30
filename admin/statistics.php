<?php

require_once("../config/database.php");

$sql = "
SELECT
SUM(total_price) AS revenue
FROM bookings
WHERE status='completed'
";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

?>

<h2>Thống kê doanh thu</h2>

<h1>

<?= number_format($row['revenue']) ?>

VNĐ

</h1>