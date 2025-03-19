<?php
include '../config/config.php';
session_start();

$MaSV = $_SESSION['MaSV'];
$conn->query("DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV')");
header("Location: giohang.php");
?>
