<?php
include('../shared/header.php');
include '../config/config.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../auth/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$sql = "SELECT dk.MaDK, hp.MaHP, hp.TenHP, hp.SoTinChi 
        FROM ChiTietDangKy cdk
        JOIN HocPhan hp ON cdk.MaHP = hp.MaHP
        JOIN DangKy dk ON cdk.MaDK = dk.MaDK
        WHERE dk.MaSV = '$MaSV'";

$result = $conn->query($sql);

$HoTen = $_SESSION['HoTen'] ?? 'Chưa có tên';
$NgaySinh = $_SESSION['NgaySinh'] ?? 'Chưa có ngày sinh';
$Nganh = $_SESSION['Nganh'] ?? 'Chưa có ngành';
$NgayDK = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #ffe6f2;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h2, h3 {
            color: #ff66b2;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff0f5;
        }
        th, td {
            border: 1px solid #ff99cc;
            padding: 10px;
        }
        th {
            background-color: #ff4d94;
            color: white;
        }
        a.btn {
            background-color: #ff66b2;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        a.btn-danger {
            background-color: #ff3385;
        }
        a.btn-warning {
            background-color: #ffcccb;
            color: black;
        }
        a.btn:hover {
            background-color: #ff3385;
        }
    </style>
</head>
<body class="container mt-4">
    <h2 class="text-center">Học Phần Đã Đăng Ký</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Mã HP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['MaHP'] ?></td>
                    <td><?= $row['TenHP'] ?></td>
                    <td><?= $row['SoTinChi'] ?></td>
                    <td><a href="xoa_hocphan.php?MaDK=<?= $row['MaDK'] ?>&MaHP=<?= $row['MaHP'] ?>" class="btn btn-danger">Xóa</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h3 class="text-center">Thông Tin Đăng Ký</h3>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Mã Sinh Viên:</strong> <?= $MaSV ?></p>
            <p><strong>Họ Tên Sinh Viên:</strong> <?= $HoTen ?></p>
            <p><strong>Ngày Sinh:</strong> <?= $NgaySinh ?></p>
            <p><strong>Ngành:</strong> <?= $Nganh ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Ngày Đăng Ký:</strong> <?= $NgayDK ?></p>
        </div>
    </div>

    <div class="text-center">
        <a href="luu_dangky.php" class="btn btn-success">Lưu Đăng Ký</a>
        <a href="xoa_toan_bo.php" class="btn btn-warning">Xóa Tất Cả</a>
    </div>
</body>
</html>
