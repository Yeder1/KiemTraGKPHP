<?php
include '../shared/header.php';
include '../config/config.php';

// Kiểm tra nếu MaSV được truyền qua URL
if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    $sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sinh viên!";
        exit();
    }
} else {
    echo "Mã sinh viên không hợp lệ!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    $sql = "UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #ffe6f2;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h2 {
            color: #ff66b2;
        }
        .card {
            background-color: #fff0f5;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px #ff99cc;
        }
        .btn-success {
            background-color: #ff66b2;
            border: none;
        }
        .btn-danger {
            background-color: #ff3385;
            border: none;
        }
        .btn-success:hover {
            background-color: #ff3385;
        }
    </style>
</head>
<body class="container mt-4">
    <div class="card mx-auto" style="max-width: 500px;">
        <h2 class="text-center">Sửa Thông Tin Sinh Viên</h2>
        <form method="post">
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên</label>
                <input type="text" name="HoTen" class="form-control" id="HoTen" value="<?= $row['HoTen'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính</label>
                <select name="GioiTinh" class="form-select" id="GioiTinh" required>
                    <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" name="NgaySinh" class="form-control" id="NgaySinh" value="<?= $row['NgaySinh'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="MaNganh" class="form-label">Ngành</label>
                <input type="text" name="MaNganh" class="form-control" id="MaNganh" value="<?= $row['MaNganh'] ?>" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="index.php" class="btn btn-danger">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
