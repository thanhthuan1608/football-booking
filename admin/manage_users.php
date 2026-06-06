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

// Xóa user
if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    mysqli_query(
        $conn,
        "DELETE FROM users
         WHERE id=$id
         AND role='user'"
    );

    header("Location: manage_users.php");
    exit();
}

// Tìm kiếm
$keyword = "";

if(isset($_GET['keyword']))
{
    $keyword = trim($_GET['keyword']);
}

$sql = "
SELECT *
FROM users
WHERE
full_name LIKE '%$keyword%'
OR
email LIKE '%$keyword%'
ORDER BY id DESC
";

$result = mysqli_query($conn,$sql);

// Tổng user
$totalUser = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) total FROM users"
    )
);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Quản lý người dùng</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
background:#f4f6f9;
}

.sidebar{
width:250px;
height:100vh;
background:#212529;
position:fixed;
padding:20px;
}

.sidebar a{
display:block;
padding:10px;
margin-bottom:10px;
color:white;
text-decoration:none;
border-radius:8px;
}

.sidebar a:hover{
background:#198754;
}

.content{
margin-left:270px;
padding:30px;
}

.card-dashboard{
border:none;
border-radius:15px;
box-shadow:0 0 15px rgba(0,0,0,.1);
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h3 class="text-white">
⚽ Admin
</h3>

<hr class="text-white">

<a href="dashboard.php">
📊 Dashboard
</a>

<a href="manage_fields.php">
⚽ Quản lý sân
</a>

<a href="manage_bookings.php">
📅 Đơn đặt sân
</a>

<a href="manage_users.php">
👤 Người dùng
</a>

<a href="../logout.php">
🚪 Đăng xuất
</a>

</div>

<!-- CONTENT -->

<div class="content">

<h2 class="mb-4">

👤 Quản lý người dùng

</h2>

<div class="row mb-4">

<div class="col-md-3">

<div class="card card-dashboard">

<div class="card-body text-center">

<h1>👤</h1>

<h2>

<?= $totalUser['total']; ?>

</h2>

<p>Tổng người dùng</p>

</div>

</div>

</div>

</div>

<!-- SEARCH -->

<div class="card shadow mb-4">

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="keyword"
class="form-control"
placeholder="Tìm theo tên hoặc email..."
value="<?= $keyword ?>">

</div>

<div class="col-md-2">

<button
class="btn btn-success w-100">

Tìm kiếm

</button>

</div>

</div>

</form>

</div>

</div>

<!-- TABLE -->

<div class="card shadow">

<div class="card-body">

<table
class="table table-striped table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>
<th>Họ tên</th>
<th>Email</th>
<th>SĐT</th>
<th>Vai trò</th>
<th>Thao tác</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td>

<?= $row['id']; ?>

</td>

<td>

<?= $row['full_name']; ?>

</td>

<td>

<?= $row['email']; ?>

</td>

<td>

<?= $row['phone']; ?>

</td>

<td>

<?php

if($row['role']=='admin')
{
    echo "<span class='badge bg-danger'>Admin</span>";
}
else
{
    echo "<span class='badge bg-primary'>User</span>";
}

?>

</td>

<td>

<?php if($row['role']!='admin'){ ?>

<a
href="?delete=<?= $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Xóa người dùng này?')">

Xóa

</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>