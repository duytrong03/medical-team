<?php
session_start();

// Kiểm tra xem người dùng có được phép truy cập vào trang admin không
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
    header('Location: ../../error.php'); // Chuyển hướng đến trang lỗi
    exit(); // Dừng kịch bản
}

require_once '../includes/header.php';
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__ . '../../../connect.php';

// Xử lý khi người dùng gửi biểu mẫu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $introduction = $_POST['introduction'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $district = $_POST['district'];
    $specialist = $_POST['specialist'];
    $coordinates = $_POST['coordinates'];

    // Đường dẫn lưu file ảnh
    $target_dir = "../image/imagesBvien/";  // Đường dẫn muốn lưu vào db
    $target_upload_dir = __ROOT__ . "/../../image/imagesBvien/"; // Đường dẫn thực tế của file ảnh
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $target_dir . basename($_FILES['image']['name']);
        $target_file = $target_upload_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    // Chèn dữ liệu vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO crud_hopital_location (name, introduction, address, phone, image, district, specialist, coordinates) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $introduction, $address, $phone, $image, $district, $specialist, $coordinates);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm mới bệnh viện thành công!'); window.location.href='./read.php';</script>";
    } else {
        echo "<script>alert('Đã xảy ra lỗi khi thêm mới bệnh viện.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Thêm mới bệnh viện</title>
</head>

<body>

    <div class="container pb-5 pt-5">
        <a href="./read.php">Trở về</a>
        <h2>Thêm mới bệnh viện</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Giới Thiệu</label>
                <textarea name="introduction" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Địa Chỉ</label>
                <input type="text" name="address" id="address" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Điện Thoại</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>
            <div class="form-group">
                <label>Ảnh</label>
                <input type="file" name="image" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Quận</label>
                <input type="text" name="district" id="district" class="form-control">
            </div>
            <div class="form-group">
                <label>Chuyên Khoa</label>
                <input type="text" name="specialist" id="specialist" class="form-control">
            </div>
            <div class="form-group">
                <label>Tọa Độ</label>
                <input type="text" name="coordinates" id="coordinates" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#name').blur(function(){
                var name = $(this).val();
                // Gửi yêu cầu AJAX để lấy dữ liệu từ API
                $.ajax({
                    url: 'https://nominatim.openstreetmap.org/search',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        q: name,
                        format: 'json'
                    },
                    success: function(data){
                        if(data && data.length > 0) {
                            $('#address').val(data[0].display_name);
                            $('#coordinates').val(data[0].lon + ', ' + data[0].lat);
                        } else {
                            alert('Không tìm thấy thông tin cho bệnh viện này.');
                        }
                    },
                    error: function(){
                        alert('Đã xảy ra lỗi khi gửi yêu cầu.');
                    }
                });
            });
        });
    </script>

</body>

</html>
