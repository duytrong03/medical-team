<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/component/navbar.php');
require_once(__ROOT__ . '/connect.php');

$id_user = $_SESSION['id_user'] ?? null;
if (!$id_user) {
    header("Location: ./login.php");
    die();
}

// Initialize the appointment_date variable
$appointment_date = '';

// Check if a date is selected
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['appointment_date'])) {
    $appointment_date = $_POST['appointment_date'];
}

// Prepare the SQL query
if ($appointment_date) {
    $sql = "SELECT * FROM appointments WHERE id_user = ? AND DATE(appointment_date) = ?";
} else {
    $sql = "SELECT * FROM appointments WHERE id_user = ?";
}

$stmt = $conn->prepare($sql);

if ($appointment_date) {
    $stmt->bind_param("is", $id_user, $appointment_date);
} else {
    $stmt->bind_param("i", $id_user);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .my_appointment-container {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container my_appointment-container pt-5 pb-5">
        <h3 class="text-center mb-4">Lịch khám của tôi</h3>
        <form method="post" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <input type="date" name="appointment_date" class="form-control" value="<?php echo htmlspecialchars($appointment_date); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
                <div class="col-md-2">
                    <a href="logout.php" class="btn btn-danger">Đăng xuất</a>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã phiếu khám</th>
                    <th>Tên bệnh viện</th>
                    <th>Tên khách hàng</th>
                    <th>SĐT</th>
                    <th>Địa chỉ thường trú</th>
                    <th>Ngày hẹn</th>
                    <th>Gói dịch vụ</th>
                    <th>Triệu chứng bổ sung</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_appointments']); ?></td>
                            <td><?php echo htmlspecialchars($row['name_hopital']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['package']); ?></td>
                            <td><?php echo htmlspecialchars($row['symptoms']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Chưa có lịch khám.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php require_once(__ROOT__ . '/component/footer.php'); ?>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>