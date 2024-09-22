<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/connect.php');



$id_user = $_SESSION['id_user'] ?? NULL;
if(!$id_user) {
    header("Location:" ."./login.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id_hopital = $_POST['id_hopital'];
    $name_hopital = $_POST['name_hopital'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $appointment_date = $_POST['appointment_date'];
    $package = $_POST['package'];
    $symptoms = $_POST['symptoms'];

    // Chuẩn bị và thực thi câu lệnh SQL
    $sql = "INSERT INTO appointments (id_hopital, id_user, name_hopital, name, phone, address, appointment_date, package, symptoms) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Kiểm tra xem câu lệnh prepare có thành công không
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind các tham số với câu lệnh prepare
    $stmt->bind_param("iisssssss", $id_hopital, $id_user, $name_hopital, $name, $phone, $address, $appointment_date, $package, $symptoms);

    // Thực thi câu lệnh và kiểm tra kết quả
    if ($stmt->execute()) {
        header("Location:" . "./my_appointment.php");
        // Điều hướng hoặc thực hiện các hành động khác tại đây
    } else {
        echo "Có lỗi xảy ra: " . htmlspecialchars($stmt->error);
    }

    // Đóng câu lệnh và kết nối
    $stmt->close();
    $conn->close();
}
?>
