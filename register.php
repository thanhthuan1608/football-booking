<?php

session_start();

require_once("config/database.php");

$message = "";

if(isset($_POST['register']))
{
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);

    $check = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0)
    {
        $message = "
        <div class='alert alert-danger'>
        Email đã tồn tại!
        </div>";
    }
    else
    {
        mysqli_query(
            $conn,
            "
            INSERT INTO users
            (
                full_name,
                email,
                password,
                phone,
                role
            )
            VALUES
            (
                '$full_name',
                '$email',
                '$password',
                '$phone',
                'user'
            )
            "
        );

        $message = "
        <div class='alert alert-success'>
        Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>
        </div>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Đăng ký tài khoản</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
height:100vh;
background:url('assets/images/banner.jpg');
background-size:cover;
background-position:center;
display:flex;
justify-content:center;
align-items:center;
}

.register-card{
width:500px;
background:rgba(255,255,255,.95);
padding:30px;
border-radius:20px;
box-shadow:0 0 20px rgba(0,0,0,.2);
}

</style>

</head>

<body>

<div class="register-card">

<h2 class="text-center mb-4">

⚽ Đăng ký tài khoản

</h2>

<?= $message ?>

<form method="POST">

<div class="mb-3">

<label>Họ và tên</label>

<input
type="text"
name="full_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Số điện thoại</label>

<input
type="text"
name="phone"
class="form-control">

</div>

<div class="mb-3">

<label>Mật khẩu</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
name="register"
class="btn btn-success w-100">

Đăng ký

</button>

</form>

<hr>

<div class="text-center">

Đã có tài khoản?

<a href="login.php">

Đăng nhập

</a>

</div>

</div>

</body>
</html>