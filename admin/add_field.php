<?php
// Hãy đảm bảo đường dẫn này đúng với vị trí file hiện tại của bạn
require_once("../config/database.php"); 

// Khởi tạo biến thông báo lỗi hoặc thành công nếu cần
$error = "";

if (isset($_POST['submit'])) {
    // 1. Lấy dữ liệu và loại bỏ khoảng trắng thừa
    $name = trim($_POST['field_name']);
    $type = trim($_POST['field_type']);
    $price = trim($_POST['price']);

    // 2. Kiểm tra không cho phép để trống dữ liệu
    if (empty($name) || empty($type) || empty($price)) {
        $error = "Vui lòng nhập đầy đủ tất cả các trường!";
    } elseif (!is_numeric($price) || $price < 0) {
        $error = "Giá sân phải là một số hợp lệ và lớn hơn hoặc bằng 0!";
    } else {
        // 3. Sử dụng Prepared Statement để chống SQL Injection
        $sql = "INSERT INTO football_fields (field_name, field_type, price_per_hour) VALUES (?, ?, ?)";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // "ssd" nghĩa là: s (string - tên), s (string - loại), d (double/number - giá)
            mysqli_stmt_bind_param($stmt, "ssd", $name, $type, $price);
            
            // Thực thi câu lệnh
            if (mysqli_stmt_execute($stmt)) {
                // Đóng statement trước khi chuyển trang
                mysqli_stmt_close($stmt);
                // Chuyển hướng về trang quản lý nếu thành công
                header("Location: manage_fields.php");
                exit(); // Luôn luôn dùng exit() sau header để dừng script
            } else {
                $error = "Có lỗi xảy ra khi lưu vào cơ sở dữ liệu: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sân Bóng</title>
</head>
<body>

    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if (!empty($error)): ?>
        <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Tên sân bóng:</label><br>
        <input type="text" name="field_name" placeholder="Ví dụ: Sân 5A" required>
        <br><br>

        <label>Loại sân:</label><br>
        <input type="text" name="field_type" placeholder="Ví dụ: Sân 5 người, Sân 7 người" required>
        <br><br>

        <label>Giá thuê (mỗi giờ):</label><br>
        <input type="number" name="price" placeholder="Ví dụ: 200000" min="0" required>
        <br><br>

        <button type="submit" name="submit">Thêm sân</button>
    </form>

</body>
</html>