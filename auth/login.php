<?php
include '../config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];

    $sql = "SELECT * FROM SinhVien WHERE MaSV = '$MaSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['MaSV'] = $MaSV;
        header("Location: ../hocphan/dangkyhocphan.php");
        exit();
    } else {
        $error = "Mã Sinh Viên không hợp lệ!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h2 class="text-center text-primary">Đăng Nhập</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Mã Sinh Viên</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
            </div>
        </form>
        <?php if (isset($error)): ?>
            <p class="text-danger text-center mt-2"><?= $error ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
