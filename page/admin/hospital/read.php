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
include('../includes/header.php');
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '../../../connect.php');

// Initialize variables
$search_name = '';
if(isset($_GET['search'])) {
    $search_name = $_GET['search'];
}

// Fetch data for display
$sql = "SELECT * FROM crud_hopital_location";
if(!empty($search_name)) {
    $sql .= " WHERE name LIKE '%$search_name%'";
}
$result = $conn->query($sql);
?>
<h2>Quản lý vị trí bệnh viện</h2>
<form action="" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Tìm kiếm tên bệnh viện..." name="search" value="<?php echo $search_name; ?>">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
        </div>
    </div>
</form>
<a href="./add.php" class="btn btn-primary mb-3">Thêm Bệnh Viện</a>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giới Thiệu</th>
                <th>Địa Chỉ</th>
                <th>Điện Thoại</th>
                <th>Hình Ảnh</th>
                <th>Quận</th>
                <th>Chuyên Khoa</th>
                <th>Tọa Độ</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_hopital']; ?></td>
                <td><?php echo strlen($row['name']) > 100 ? substr($row['name'], 0, 100) . '...' : $row['name']; ?></td>
                <td><?php echo strlen($row['introduction']) > 100 ? substr($row['introduction'], 0, 100) . '...' : $row['introduction']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><img src="../../<?php echo $row['image']; ?>" alt=""></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo strlen($row['specialist']) > 100 ? substr($row['specialist'], 0, 100) . '...' : $row['specialist']; ?></td>
                <td><?php echo $row['coordinates']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id_hopital']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete.php?id=<?php echo $row['id_hopital']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include('../includes/footer.php'); ?>
