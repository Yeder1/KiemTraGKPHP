<?php
include '../shared/header.php';
include '../config/config.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../auth/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Học Phần</title>
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
    <h2>DANH SÁCH HỌC PHẦN</h2>
    <table>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Số lượng dự kiến</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['MaHP'] ?></td>
                <td><?= $row['TenHP'] ?></td>
                <td><?= $row['SoTinChi'] ?></td>
                <td><?= $row['SoLuong'] ?></td>
                <td>
                    <?php if ($row['SoLuong'] > 0): ?>
                        <a href="../hocphan/xulydangky.php?MaHP=<?= $row['MaHP'] ?>">Đăng Ký</a>
                    <?php else: ?>
                        <span style="color: #ff3385; font-weight: bold;">Hết chỗ</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
