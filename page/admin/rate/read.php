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

// Lấy tên bệnh viện và số sao từ cơ sở dữ liệu để tạo các tùy chọn lọc
$sql_hospitals = "SELECT DISTINCT c.name FROM rate_hospitals r INNER JOIN crud_hopital_location c ON r.id_hopital = c.id_hopital";
$result_hospitals = $conn->query($sql_hospitals);

$sql_ratings = "SELECT DISTINCT rating FROM rate_hospitals";
$result_ratings = $conn->query($sql_ratings);

// Kiểm tra xem người dùng đã chọn các tùy chọn lọc hay chưa
$where_clause = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['hospital']) && isset($_GET['rating'])) {
    $hospital = $_GET['hospital'];
    $rating = $_GET['rating'];

    // Xây dựng phần điều kiện WHERE cho câu lệnh SQL dựa trên các tùy chọn lọc
    if (!empty($hospital)) {
        $where_clause .= "c.name = '$hospital' AND ";
    }

    if (!empty($rating)) {
        $where_clause .= "r.rating = $rating AND ";
    }

    // Loại bỏ khoảng trắng và "AND" cuối cùng nếu có
    $where_clause = rtrim($where_clause, 'AND ');
}

// Câu lệnh SQL để lấy dữ liệu đánh giá từ cơ sở dữ liệu
$sql = "SELECT r.*, c.name AS hospital_name FROM rate_hospitals r INNER JOIN crud_hopital_location c ON r.id_hopital = c.id_hopital";
if (!empty($where_clause)) {
    $sql .= " WHERE $where_clause";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Đánh giá bệnh viện</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <div class="container pb-5 pt-5">
        <h2>Đánh giá bệnh viện</h2>
        
        <!-- Form lọc -->
        <form class="mb-3">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="hospitalSelect">Tên Bệnh Viện</label>
                    <select id="hospitalSelect" class="form-control" name="hospital">
                        <option selected disabled>Chọn bệnh viện</option>
                        <?php while ($row = $result_hospitals->fetch_assoc()) { ?>
                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="ratingSelect">Số Sao</label>
                    <select id="ratingSelect" class="form-control" name="rating">
                        <option selected disabled>Chọn số sao</option>
                        <?php while ($row = $result_ratings->fetch_assoc()) { ?>
                            <option value="<?php echo $row['rating']; ?>"><?php echo $row['rating']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>
        
        <!-- Bảng hiển thị đánh giá -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Bệnh Viện</th>
                    <th>ID Người Dùng</th>
                    <th>Tên</th>
                    <th>Đánh Giá</th>
                    <th>Bình Luận</th>
                    <th>Ngày Tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id_rate']; ?></td>
                        <td><?php echo $row['hospital_name']; ?></td>
                        <td><?php echo $row['id_user']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['rating']; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
