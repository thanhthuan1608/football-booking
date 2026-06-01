<?php
session_start();
require_once("config/database.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        if($user['role'] == 'admin')
        {
            header("Location: admin/dashboard.php");
        }
        else
        {
            header("Location: index.php");
        }
        exit();
    }
    else
    {
        $error = "Sai email hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Football Booking</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
height:100vh;
background:url('assets/images/banner.jpg');
background-size:cover;
display:flex;
justify-content:center;
align-items:center;
}

.login-card{
width:420px;
backdrop-filter:blur(10px);
background:rgba(255,255,255,.9);
border-radius:20px;
padding:30px;
box-shadow:0 0 20px rgba(0,0,0,.2);
}
</style>

</head>
<body>

<div class="login-card">

<h2 class="text-center mb-4">
⚽ Football Booking
</h2>

<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
required>
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
name="login"
class="btn btn-success w-100">

Đăng nhập

</button>

</form>

</div>

</body>
</html>