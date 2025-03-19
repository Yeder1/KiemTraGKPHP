<?php
include('../shared/header.php');
include '../config/config.php';
session_start();

if (!isset($_SESSION['MaSV'])) {
    header("Location: ../auth/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$NgayDK = date("Y-m-d");

// Kiểm tra sinh viên đã có đăng ký chưa
$check_sql = "SELECT * FROM DangKy WHERE MaSV = '$MaSV'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows == 0) {
    // Chưa đăng ký, tiến hành lưu thông tin vào bảng DangKy
    $conn->query("INSERT INTO DangKy (NgayDK, MaSV) VALUES ('$NgayDK', '$MaSV')");
}

// Lưu thông tin học phần đã chọn vào bảng ChiTietDangKy
if (isset($_POST['MaHP'])) {
    $MaHP_array = $_POST['MaHP']; // Các mã học phần đã chọn
    foreach ($MaHP_array as $MaHP) {
        // Kiểm tra nếu học phần đã được đăng ký
        $check_hp_sql = "SELECT * FROM ChiTietDangKy WHERE MaSV = '$MaSV' AND MaHP = '$MaHP'";
        $check_hp_result = $conn->query($check_hp_sql);
        if ($check_hp_result->num_rows == 0) {
            $conn->query("INSERT INTO ChiTietDangKy (MaSV, MaHP) VALUES ('$MaSV', '$MaHP')");
        }
    }
}

// Giảm số lượng học phần trong bảng HocPhan
foreach ($MaHP_array as $MaHP) {
    $conn->query("UPDATE HocPhan SET Soluong = Soluong - 1 WHERE MaHP = '$MaHP'");
}

// Chuyển hướng đến trang thông báo đăng ký thành công
header("Location: thongbao.php");
exit();
?>