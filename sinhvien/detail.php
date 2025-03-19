<?php
include '../shared/header.php';
include '../config/config.php';

// Kiểm tra nếu MaSV được truyền qua URL
if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    $sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv 
            JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh
            WHERE MaSV='$MaSV'";

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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Sinh Viên</title>
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
        .btn-primary {
            background-color: #ff66b2;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff3385;
        }
    </style>
</head>
<body class="container mt-4">
    <div class="card mx-auto" style="max-width: 500px;">
        <h2 class="text-center">Thông Tin Chi Tiết Sinh Viên</h2>
        <p><strong>Mã SV:</strong> <?= $row['MaSV'] ?></p>
        <p><strong>Họ Tên:</strong> <?= $row['HoTen'] ?></p>
        <p><strong>Giới Tính:</strong> <?= $row['GioiTinh'] ?></p>
        <p><strong>Ngày Sinh:</strong> <?= $row['NgaySinh'] ?></p>
        <p><strong>Ngành:</strong> <?= $row['TenNganh'] ?></p>
        <p><img src="../uploads/<?= basename($row['Hinh']) ?>" width="100" class="img-thumbnail"></p>
        <a href="edit.php?MaSV=<?= $row['MaSV'] ?>" class="btn btn-primary">Sửa</a>
    </div>
</body>
</html>
