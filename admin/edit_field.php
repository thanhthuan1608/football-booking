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

$id = (int)$_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM football_fields
     WHERE id = $id"
);

$field = mysqli_fetch_assoc($result);

if(!$field)
{
    die("Không tìm thấy sân!");
}

if(isset($_POST['update']))
{
    $name = $_POST['field_name'];
    $type = $_POST['field_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Giữ ảnh cũ
    $image = $field['image'];

    // Upload ảnh mới
    if(!empty($_FILES['image']['name']))
    {
        $image =
            time() .
            "_" .
            $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../assets/images/" . $image
        );
    }

    mysqli_query(
        $conn,
        "
        UPDATE football_fields
        SET
            field_name='$name',
            field_type='$type',
            price_per_hour='$price',
            description='$description',
            image='$image',
            status='$status'
        WHERE id=$id
        "
    );

    header("Location: manage_fields.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Cập nhật sân</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3 class="mb-0">
✏️ Cập nhật sân bóng
</h3>

</div>

<div class="card-body">

<form
method="POST"
enctype="multipart/form-data">

<div class="row">

<div class="col-md-4 text-center">

<?php if(!empty($field['image'])){ ?>

<img
src="../assets/images/<?= $field['image']; ?>"
class="img-fluid rounded shadow mb-3">

<?php } else { ?>

<img
src="../assets/images/default-field.jpg"
class="img-fluid rounded shadow mb-3">

<?php } ?>

<div class="mb-3">

<label class="form-label">

Đổi ảnh sân

</label>

<input
type="file"
name="image"
class="form-control">

</div>

</div>

<div class="col-md-8">

<div class="mb-3">

<label class="form-label">

Tên sân

</label>

<input
type="text"
name="field_name"
class="form-control"
value="<?= $field['field_name']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Loại sân

</label>

<select
name="field_type"
class="form-select">

<option
value="5 người"
<?= $field['field_type']=='5 người'?'selected':'' ?>>

5 người

</option>

<option
value="7 người"
<?= $field['field_type']=='7 người'?'selected':'' ?>>

7 người

</option>

<option
value="11 người"
<?= $field['field_type']=='11 người'?'selected':'' ?>>

11 người

</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">

Giá thuê / giờ

</label>

<input
type="number"
name="price"
class="form-control"
value="<?= $field['price_per_hour']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">

Mô tả sân

</label>

<textarea
name="description"
class="form-control"
rows="5"><?= $field['description']; ?></textarea>

</div>

<div class="mb-3">

<label class="form-label">

Trạng thái

</label>

<select
name="status"
class="form-select">

<option
value="available"
<?= $field['status']=='available'?'selected':'' ?>>

🟢 Còn trống

</option>

<option
value="maintenance"
<?= $field['status']=='maintenance'?'selected':'' ?>>

🔴 Bảo trì

</option>

</select>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

💾 Cập nhật

</button>

<a
href="manage_fields.php"
class="btn btn-secondary">

↩ Quay lại

</a>

</div>

</div>

</form>

</div>

</div>

</div>

</body>

</html>