<?php 
session_start();

// Kiểm tra xem người dùng có được phép truy cập vào trang admin không
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
    header('Location: ../../error.php'); // Chuyển hướng đến trang lỗi
    exit(); // Dừng kịch bản
}

require_once '../../../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Kiểm tra xem email hoặc username đã tồn tại chưa
    $check_query = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email hoặc username đã tồn tại
        echo "<script>alert('Email hoặc Tên đăng nhập đã tồn tại!');</script>";
    } else {
        // Thêm người dùng mới vào cơ sở dữ liệu
        $insert_query = "INSERT INTO users (name, username, address, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sssssi", $name, $username, $address, $email, $password, $role);

        if ($stmt->execute()) {
            // Thêm thành công
            echo "<script>alert('Thêm mới người dùng thành công!');</script>";
            header('Location: ./read.php'); // Chuyển hướng về trang danh sách người dùng
            exit();
        } else {
            // Thêm thất bại
            echo "<script>alert('Đã có lỗi xảy ra. Vui lòng thử lại!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Thêm mới người dùng</title>
</head>

<body>

    <div class="container pb-5 pt-5">
        <a href="./read.php">Trở về</a>
        <h2>Thêm mới người dùng</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Tên Người Dùng</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tên Đăng Nhập</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Địa Chỉ</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mật Khẩu</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Vai Trò</label>
                <select name="role" id="role" class="form-control">
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>
