<?php
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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">

</head>
<body class="container mt-4">
    <h2 class="text-center text-info">Học Phần Đã Đăng Ký</h2>
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
    <div class="text-center">
        <a href="luu_dangky.php" class="btn btn-success">Lưu Đăng Ký</a>
        <a href="xoa_toan_bo.php" class="btn btn-warning">Xóa Tất Cả</a>
    </div>
</body>
</html>
