<?php

session_start();
require_once("config/database.php");

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "
    SELECT *
    FROM users
    WHERE email='$email'
    AND password='$password'
    ";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['full_name'];

        if($user['role'] == 'admin')
        {
            header("Location: admin/dashboard.php");
        }
        else
        {
            header("Location: index.php");
        }
    }
    else
    {
        echo "Sai tài khoản hoặc mật khẩu";
    }
}

?>

<form method="POST">

<input
type="email"
name="email"
placeholder="Email">

<br><br>

<input
type="password"
name="password"
placeholder="Mật khẩu">

<br><br>

<button name="login">
Đăng nhập
</button>

</form>