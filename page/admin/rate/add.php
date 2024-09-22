<?php 
session_start();

// Kiểm tra xem người dùng có được phép truy cập vào trang admin không
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
    header('Location: ../../error.php'); // Chuyển hướng đến trang lỗi
    exit(); // Dừng kịch bản
}

?>

<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '../../../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_hopital = $_POST['id_hopital'];
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO rate_hospitals (id_hopital, id_user, name, rating, comment) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("iisds", $id_hopital, $id_user, $name, $rating, $comment);
        if ($stmt->execute()) {
            header("Location: read.php");
            exit(); 
        } else {
            echo "Error: " . $stmt->error;
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
    <title>Thêm đánh giá bệnh viện</title>
</head>
<body>
    <div class="container pb-5 pt-5">
        <a href="./read.php">Trở về</a>
        <h2>Thêm đánh giá bệnh viện</h2>
        <form method="POST">
            <div class="form-group">
                <label>ID Bệnh Viện</label>
                <input type="number" name="id_hopital" class="form-control" required>
            </div>
            <div class="form-group">
                <label>ID Người Dùng</label>
                <input type="number" name="id_user" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Đánh Giá</label>
                <input type="number" name="rating" class="form-control" step="0.01" min="0" max="5" required>
            </div>
            <div class="form-group">
                <label>Bình Luận</label>
                <textarea name="comment" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</body>
</html>
