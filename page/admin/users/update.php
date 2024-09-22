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

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id_user=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Cập nhật thông tin người dùng vào cơ sở dữ liệu
    $sql = "UPDATE users SET name=?, address=?, email=?, username=?, password=?, role=? WHERE id_user=?";
    
    // Chuẩn bị truy vấn
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Gắn giá trị vào truy vấn và thực thi
        $stmt->bind_param("ssssssi", $name, $address, $email, $username, $password, $role, $id);
        if ($stmt->execute()) {
            header("Location: read.php");
            exit(); // Dừng kịch bản sau khi chuyển hướng
        } else {
            echo "Lỗi cập nhật bản ghi: " . $stmt->error;
        }
        // Đóng truy vấn
        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị truy vấn: " . $conn->error;
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
    <title>Chỉnh sửa người dùng</title>
</head>

<body>

    <div class="container pb-5 pt-5">
        <a href="./read.php">Trở về</a>

        <h2>Chỉnh sửa người dùng</h2>
        <form method="POST">
            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $row['password']; ?>" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="0" <?php echo $row['role'] == 0 ? 'selected' : ''; ?>>Người dùng</option>
                    <option value="1" <?php echo $row['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>

</html>
