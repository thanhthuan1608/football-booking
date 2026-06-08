<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Football Booking</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

.hero{
    height:85vh;
    background:linear-gradient(
        rgba(0,0,0,.5),
        rgba(0,0,0,.5)
    ),
    url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1600&q=80');

    background-size:cover;
    background-position:center;

    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;

    color:white;
    text-align:center;
}

.feature-card{
    transition:.3s;
}

.feature-card:hover{
    transform:translateY(-8px);
}

footer{
    background:#111;
    color:white;
    padding:20px;
    text-align:center;
}

</style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">

<div class="container">

<a class="navbar-brand fw-bold">
⚽ Football Booking
</a>

<div>

<a href="login.php" class="btn btn-light me-2">
Đăng nhập
</a>

<a
href="register.php"
class="btn btn-warning">

Đăng ký

</a>

</div>

</div>

</nav>

<!-- Banner -->

<section class="hero">

<h1 class="display-3 fw-bold">
Đặt Sân Bóng Trực Tuyến
</h1>

<p class="lead">
Nhanh chóng - Tiện lợi - Chính xác
</p>

<a href="pages/fields.php"
class="btn btn-success btn-lg mt-3">

Đặt sân ngay

</a>

</section>

<!-- Dịch vụ -->

<section class="container py-5">

<h2 class="text-center mb-5">
Tại sao chọn chúng tôi?
</h2>

<div class="row">

<div class="col-md-4">

<div class="card feature-card shadow h-100">

<div class="card-body text-center">

<h1>⚡</h1>

<h4>Đặt sân nhanh</h4>

<p>
Chỉ mất vài phút để hoàn tất đặt sân.
</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card feature-card shadow h-100">

<div class="card-body text-center">

<h1>📅</h1>

<h4>Quản lý lịch</h4>

<p>
Theo dõi lịch đặt sân dễ dàng.
</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card feature-card shadow h-100">

<div class="card-body text-center">

<h1>💰</h1>

<h4>Giá minh bạch</h4>

<p>
Hiển thị giá rõ ràng theo giờ.
</p>

</div>

</div>

</div>

</div>

</section>

<!-- Sân nổi bật -->

<section class="bg-light py-5">

<div class="container">

<h2 class="text-center mb-5">
Sân nổi bật
</h2>

<div class="row">

<div class="col-md-4">

<div class="card shadow">

<img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=800&q=80"
class="card-img-top">

<div class="card-body">

<h5>Sân Mini A</h5>

<p>300.000đ / giờ</p>

<a href="#" class="btn btn-success">
Đặt sân
</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<img src="https://images.unsplash.com/photo-1552667466-07770ae110d0?auto=format&fit=crop&w=800&q=80"
class="card-img-top">

<div class="card-body">

<h5>Sân Mini B</h5>

<p>500.000đ / giờ</p>

<a href="#" class="btn btn-success">
Đặt sân
</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card shadow">

<img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?auto=format&fit=crop&w=800&q=80"
class="card-img-top">

<div class="card-body">

<h5>Sân Mini C</h5>

<p>1.000.000đ / giờ</p>

<a href="#" class="btn btn-success">
Đặt sân
</a>

</div>

</div>

</div>

</div>

</div>

</section>

<footer>

<p>
© 2026 Football Booking System
</p>

</footer>

</body>
</html>