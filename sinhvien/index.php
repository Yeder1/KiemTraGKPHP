<?php
include '../shared/header.php';
include '../config/config.php';

$sql = "SELECT sv.MaSV, sv.HoTen, sv.GioiTinh, sv.NgaySinh, sv.Hinh, nh.TenNganh 
        FROM SinhVien sv 
        JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
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
        a {
            background-color: #ff66b2;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #ff3385;
        }
    </style>
</head>
<body>
    <h2>Danh sách sinh viên</h2>
    <a href="create.php">Thêm sinh viên</a>
    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Hình Ảnh</th>
            <th>Ngành</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaSV'] ?></td>
                <td><?= $row['HoTen'] ?></td>
                <td><?= $row['GioiTinh'] ?></td>
                <td><?= $row['NgaySinh'] ?></td>
                <td><img src="../uploads/<?= basename($row['Hinh']) ?>" width="150"></td>
                <td><?= $row['TenNganh'] ?></td>
                <td>
                    <a href="edit.php?MaSV=<?= $row['MaSV'] ?>">Sửa</a> | 
                    <a href="delete.php?MaSV=<?= $row['MaSV'] ?>">Xóa</a> | 
                    <a href="detail.php?MaSV=<?= $row['MaSV'] ?>">Chi tiết</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
