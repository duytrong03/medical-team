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

// Fetch data for display
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
<h2>Quản lý người dùng</h2>
<a href="./add.php" class="btn btn-primary mb-3">Thêm Người Dùng</a>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên tài khoản</th>
                <th>Địa Chỉ</th>
                <th>Email</th>
                <th>Tên người dùng</th>
                <th>Vai Trò</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id_user']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['role'] == 1 ? 'Admin' : 'User'; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id_user']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete.php?id=<?php echo $row['id_user']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include('../includes/footer.php'); ?>
