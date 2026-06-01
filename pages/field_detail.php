<?php

require_once("../config/database.php");

$id = $_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM football_fields WHERE id=$id"
);

$field = mysqli_fetch_assoc($result);

?>

<h1><?= $field['field_name'] ?></h1>

<p>Loại sân: <?= $field['field_type'] ?></p>

<p>Giá: <?= number_format($field['price_per_hour']) ?> VNĐ/giờ</p>

<p><?= $field['description'] ?></p>

<a href="booking.php?id=<?= $field['id'] ?>">
    Đặt sân
</a>