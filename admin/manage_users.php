<?php

require_once("../config/database.php");

$result = mysqli_query(
$conn,
"SELECT * FROM users"
);

?>

<table border="1">

<tr>
<th>ID</th>
<th>Họ tên</th>
<th>Email</th>
<th>Role</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)): ?>

<tr>

<td><?= $row['id'] ?></td>

<td><?= $row['full_name'] ?></td>

<td><?= $row['email'] ?></td>

<td><?= $row['role'] ?></td>

</tr>

<?php endwhile; ?>

</table>