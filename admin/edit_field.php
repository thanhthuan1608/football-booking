<?php
require_once("../config/database.php");

$id = $_GET['id'];

$sql = "
SELECT *
FROM football_fields
WHERE id = $id
";

$result = mysqli_query($conn,$sql);
$field = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $name = $_POST['field_name'];
    $type = $_POST['field_type'];
    $price = $_POST['price'];

    mysqli_query($conn,"
    UPDATE football_fields
    SET
    field_name='$name',
    field_type='$type',
    price_per_hour='$price'
    WHERE id=$id
    ");

    header("Location: manage_fields.php");
}
?>

<form method="POST">

<input
value="<?= $field['field_name'] ?>"
name="field_name">

<br><br>

<input
value="<?= $field['field_type'] ?>"
name="field_type">

<br><br>

<input
value="<?= $field['price_per_hour'] ?>"
name="price">

<br><br>

<button name="update">
Cập nhật
</button>

</form>