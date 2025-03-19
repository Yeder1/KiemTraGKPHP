<?php
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

<!DOCTYPE html>s
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sinh viên</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Thông tin chi tiết sinh viên</h2>
    <p><strong>Mã SV:</strong> <?= $row['MaSV'] ?></p>
    <p><strong>Họ Tên:</strong> <?= $row['HoTen'] ?></p>
    <p><strong>Giới Tính:</strong> <?= $row['GioiTinh'] ?></p>
    <p><strong>Ngày Sinh:</strong> <?= $row['NgaySinh'] ?></p>
    <p><strong>Ngành:</strong> <?= $row['TenNganh'] ?></p>
    <p><img src="../uploads/<?= basename($row['Hinh']) ?>" width="100"></p>
    <a href="edit.php?MaSV=<?= $row['MaSV'] ?>">Sửa</a>
</body>
</html>
