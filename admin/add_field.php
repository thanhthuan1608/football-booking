<?php
require_once("../config/database.php");

if(isset($_POST['submit']))
{
    $name = $_POST['field_name'];
    $type = $_POST['field_type'];
    $price = $_POST['price'];

    $sql = "
    INSERT INTO football_fields
    (
        field_name,
        field_type,
        price_per_hour
    )
    VALUES
    (
        '$name',
        '$type',
        '$price'
    )";

    mysqli_query($conn,$sql);

    header("Location: manage_fields.php");
}
?>

<form method="POST">

    <input
        type="text"
        name="field_name"
        placeholder="Tên sân">

    <br><br>

    <input
        type="text"
        name="field_type"
        placeholder="Loại sân">

    <br><br>

    <input
        type="number"
        name="price"
        placeholder="Giá">

    <br><br>

    <button name="submit">
        Thêm sân
    </button>

</form>