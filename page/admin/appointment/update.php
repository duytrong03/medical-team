<?php
session_start();

// Kiểm tra xem người dùng có được phép truy cập vào trang admin không
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
    header('Location: ../../error.php'); // Chuyển hướng đến trang lỗi
    exit(); // Dừng kịch bản
}

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '../../../connect.php');

$id = $_GET['id'];
$sql = "SELECT * FROM appointments WHERE id_appointments=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_hopital = $_POST['id_hopital'];
    $id_user = $_POST['id_user'];
    $name_hopital = $_POST['name_hopital'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $appointment_date = $_POST['appointment_date'];
    $package = $_POST['package'];
    $symptoms = $_POST['symptoms'];

    $sql = "UPDATE appointments SET id_hopital=?, id_user=?, name_hopital=?, name=?, phone=?, address=?, appointment_date=?, package=?, symptoms=? WHERE id_appointments=?";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("iisssssssi", $id_hopital, $id_user, $name_hopital, $name, $phone, $address, $appointment_date, $package, $symptoms, $id);
        if ($stmt->execute()) {
            header("Location: read.php");
            exit(); 
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
} 

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Sửa lịch hẹn</title>
</head>
<body>
    <div class="container pb-5 pt-5">
        <a href="./read.php">Trở về</a>
        <h2>Sửa lịch hẹn</h2>
        <form method="POST">
            <div class="form-group">
                <label>ID Bệnh Viện</label>
                <input type="number" name="id_hopital" class="form-control" value="<?php echo $row['id_hopital']; ?>" required>
            </div>
            <div class="form-group">
                <label>ID Người Dùng</label>
                <input type="number" name="id_user" class="form-control" value="<?php echo $row['id_user']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tên Bệnh Viện</label>
                <input type="text" name="name_hopital" class="form-control" value="<?php echo $row['name_hopital']; ?>" required
                </div>
                <div class="form-group">
            <label>Tên Người Dùng</label>
            <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>Số Điện Thoại</label>
            <input type="tel" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
        </div>
        <div class="form-group">
            <label>Địa Chỉ</label>
            <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
        </div>
        <div class="form-group">
            <label>Ngày Hẹn</label>
            <input type="datetime-local" name="appointment_date" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row['appointment_date'])); ?>" required>
        </div>
        <div class="form-group">
            <label>Gói</label>
            <input type="text" name="package" class="form-control" value="<?php echo $row['package']; ?>" required>
        </div>
        <div class="form-group">
            <label>Triệu Chứng</label>
            <textarea name="symptoms" class="form-control" required><?php echo $row['symptoms']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
    