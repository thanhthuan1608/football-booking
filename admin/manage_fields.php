<?php
require_once("../config/database.php");

$sql = "SELECT * FROM football_fields";
$result = mysqli_query($conn,$sql);
?>

<h2>Quản lý sân bóng</h2>

<a href="add_field.php">Thêm sân mới</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Tên sân</th>
    <th>Loại sân</th>
    <th>Giá</th>
    <th>Thao tác</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>

<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['field_name'] ?></td>
    <td><?= $row['field_type'] ?></td>
    <td><?= number_format($row['price_per_hour']) ?></td>

    <td>
        <a href="edit_field.php?id=<?= $row['id'] ?>">Sửa</a>
        <a href="delete_field.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Xóa sân?')">
           Xóa
        </a>
    </td>
</tr>

<?php endwhile; ?>

</table>