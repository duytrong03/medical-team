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
$sql = "SELECT * FROM crud_hopital_location WHERE id_hopital=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $introduction = $_POST['introduction'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $district = $_POST['district'];
    $specialist = $_POST['specialist'];
    $coordinates = $_POST['coordinates'];

    // Xử lý tải ảnh lên thư mục ../image
    $target_dir = "../image/imagesBvien/";  // Đường dẫn muốn lưu vào db
    $target_upload_dir = __ROOT__ . "/../../image/imagesBvien/"; // Đường dẫn thực tế của file ảnh
    $image = $row['image'];  // Giá trị mặc định là ảnh cũ
    if (!empty($_FILES["image"]["name"])) {
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $target_upload_file = $target_upload_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image = $target_file;

        // Kiểm tra xem tệp đã tồn tại chưa
        if (file_exists($target_upload_file)) {
            echo "Xin lỗi, tệp ảnh đã tồn tại.";
            $uploadOk = 0;
        }

        // Kiểm tra kích thước tệp ảnh
        if ($_FILES["image"]["size"] > 500000) {
            echo "Xin lỗi, tệp ảnh quá lớn.";
            $uploadOk = 0;
        }

        // Cho phép các định dạng tệp ảnh nhất định
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Xin lỗi, chỉ các tệp ảnh JPG, JPEG, PNG & GIF được phép.";
            $uploadOk = 0;
        }

        // Kiểm tra nếu $uploadOk = 0
        if ($uploadOk == 0) {
            echo "Xin lỗi, tệp ảnh của bạn không được tải lên.";
        // nếu mọi thứ đều ổn, cố gắng tải tệp lên
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_upload_file)) {
                echo "Tệp " . htmlspecialchars(basename($_FILES["image"]["name"])) . " đã được tải lên thành công.";
            } else {
                echo "Xin lỗi, đã xảy ra lỗi khi tải lên tệp của bạn.";
            }
        }
    }

    // Cập nhật bệnh viện vào cơ sở dữ liệu
    $sql = "UPDATE crud_hopital_location SET name='$name', introduction='$introduction', address='$address', phone='$phone', image='$image', district='$district', specialist='$specialist', coordinates='$coordinates' WHERE id_hopital=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: read.php");
    } else {
        echo "Lỗi cập nhật bản ghi: " . $conn->error;
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
    <title>Chỉnh sửa bệnh viện</title>
</head>

<body>

    <div class="container pb-5 pt-5">
        <a href="./read.php">Trở về</a>

        <h2>Chỉnh sửa bệnh viện</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Giới thiệu</label>
                <textarea name="introduction" class="form-control"><?php echo $row['introduction']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
            </div>
            <div class="form-group">
                <label>Điện thoại</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
            </div>
            <div class="form-group">
                <label>Ảnh</label>
                <input type="text" hidden value="<?php echo $row['image']; ?>">
                <input type="file" name="image" value="<?php echo $row['image']; ?>" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Quận</label>
                <input type="text" name="district" class="form-control" value="<?php echo $row['district']; ?>">
            </div>
            <div class="form-group">
                <label>Chuyên khoa</label>
                <input type="text" name="specialist" class="form-control" value="<?php echo $row['specialist']; ?>">
            </div>
            <div class="form-group">
                <label>Tọa độ</label>
                <input type="text" name="coordinates" class="form-control" value="<?php echo $row['coordinates']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>

</html>
