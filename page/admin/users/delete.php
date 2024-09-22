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

// Kiểm tra xem biến $_GET['id'] có tồn tại không
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sử dụng prepared statement để xóa người dùng từ cơ sở dữ liệu
    $sql = "DELETE FROM users WHERE id_user = ?";
    
    // Chuẩn bị truy vấn
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Gắn giá trị vào truy vấn và thực thi
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Chuyển hướng người dùng trở lại trang đọc danh sách người dùng
            header("Location: read.php");
            exit(); // Dừng kịch bản sau khi chuyển hướng
        } else {
            // Xử lý lỗi nếu không thể thực thi truy vấn
            echo "Error deleting record: " . $stmt->error;
        }
        // Đóng truy vấn
        $stmt->close();
    } else {
        // Xử lý lỗi nếu không thể chuẩn bị truy vấn
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Xử lý lỗi nếu không có id được cung cấp trong URL
    echo "User ID not provided.";
}

// Đóng kết nối với cơ sở dữ liệu
$conn->close();
?>
