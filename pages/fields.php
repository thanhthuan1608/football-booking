<?php

require_once("../config/database.php");

$sql = "SELECT * FROM football_fields";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Danh sách sân</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2 class="mb-4">Danh sách sân bóng</h2>

<div class="row">

<?php while($field = mysqli_fetch_assoc($result)) { ?>

<div class="col-md-4 mb-4">

<div class="card shadow">

<img
src="https://via.placeholder.com/400x250"
class="card-img-top">

<div class="card-body">

<h5><?= $field['field_name']; ?></h5>

<p>Loại sân: <?= $field['field_type']; ?></p>

<p>
<?= number_format($field['price_per_hour']); ?>
VNĐ / giờ
</p>

<a
href="booking.php?id=<?= $field['id']; ?>"
class="btn btn-success">

Đặt sân

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>