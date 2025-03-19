<?php
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
    <title>Sửa sinh viên</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Sửa thông tin sinh viên</h2>
    <form method="post">
        <label>Họ Tên:</label><input type="text" name="HoTen" value="<?= $row['HoTen'] ?>"><br>
        <label>Giới Tính:</label>
        <select name="GioiTinh">
            <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
        </select><br>
        <label>Ngày Sinh:</label><input type="date" name="NgaySinh" value="<?= $row['NgaySinh'] ?>"><br>
        <label>Ngành:</label><input type="text" name="MaNganh" value="<?= $row['MaNganh'] ?>"><br>
        <input type="submit" value="Lưu">
    </form>
</body>
</html>
