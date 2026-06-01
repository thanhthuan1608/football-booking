<?php

session_start();

require_once("../config/database.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$field_id = $_GET['id'];

$fieldResult = mysqli_query(
    $conn,
    "SELECT * FROM football_fields WHERE id=$field_id"
);

$field = mysqli_fetch_assoc($fieldResult);

$success = false;

if(isset($_POST['book']))
{
    $user_id = $_SESSION['user_id'];

    $booking_date = $_POST['booking_date'];

    $start_time = $_POST['start_time'];

    $end_time = $_POST['end_time'];

    $hours =
        strtotime($end_time)
        -
        strtotime($start_time);

    $hours = $hours / 3600;

    $total_price =
        $hours *
        $field['price_per_hour'];

    $sql = "
    INSERT INTO bookings
    (
        user_id,
        field_id,
        booking_date,
        start_time,
        end_time,
        total_price
    )
    VALUES
    (
        '$user_id',
        '$field_id',
        '$booking_date',
        '$start_time',
        '$end_time',
        '$total_price'
    )";

    mysqli_query($conn,$sql);

    $success = true;
}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Đặt sân</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-3">

<a href="fields.php"
class="btn btn-secondary">

← Quay lại danh sách sân

</a>

</div>

<div class="container mt-4">

<div class="row">

<!-- Thông tin sân -->

<div class="col-md-6">

<div class="card shadow">

<img
src="../assets/images/<?=
empty($field['image'])
? 'default-field.jpg'
: $field['image'];
?>"
class="card-img-top"
style="height:400px;object-fit:cover;">

<div class="card-body">

<h2>

⚽ <?= $field['field_name']; ?>

</h2>

<span class="badge bg-success">

Còn trống

</span>

<hr>

<p>

<b>Loại sân:</b>

<?= $field['field_type']; ?>

</p>

<div class="alert alert-success">

<h4 class="mb-0">

💰
<?= number_format(
$field['price_per_hour']
); ?>

VNĐ / giờ

</h4>

</div>

<p>

<?= $field['description']; ?>

</p>

</div>

</div>

</div>

<!-- Form đặt sân -->

<div class="col-md-6">

<div class="card shadow">

<div class="card-body">

<h3 class="mb-4">

📅 Thông tin đặt sân

</h3>

<?php if($success){ ?>

<div class="alert alert-success">

✅ Đặt sân thành công!

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Ngày đặt

</label>

<input
type="date"
name="booking_date"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Giờ bắt đầu

</label>

<input
type="time"
name="start_time"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Giờ kết thúc

</label>

<input
type="time"
name="end_time"
class="form-control"
required>

</div>

<div class="alert alert-info">

📌 Sân:

<b>
<?= $field['field_name']; ?>
</b>

<br><br>

💰 Giá:

<b>
<?= number_format(
$field['price_per_hour']
); ?>
VNĐ/giờ
</b>

</div>

<button
type="submit"
name="book"
class="btn btn-success w-100">

⚽ Xác nhận đặt sân

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<footer
class="bg-dark text-white text-center p-3 mt-5">

Cantho booking football 
</footer>

</body>
</html>