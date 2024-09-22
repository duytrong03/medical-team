<?php
session_start();

// Kiểm tra xem người dùng có được phép truy cập vào trang admin không
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
    header('Location: ../../error.php'); // Chuyển hướng đến trang lỗi
    exit(); // Dừng kịch bản
}

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '../../../connect.php');
// Include header
include('../includes/header.php');
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
// Lấy danh sách các bệnh viện từ cơ sở dữ liệu
$sql_hospitals = "SELECT DISTINCT name_hopital FROM appointments";
$result_hospitals = $conn->query($sql_hospitals);

// Lấy danh sách các dịch vụ từ cơ sở dữ liệu
$sql_services = "SELECT DISTINCT package FROM appointments";
$result_services = $conn->query($sql_services);

// Lấy danh sách các ngày từ cơ sở dữ liệu
$sql_dates = "SELECT DISTINCT DATE_FORMAT(appointment_date, '%Y-%m-%d') AS appointment_date FROM appointments";
$result_dates = $conn->query($sql_dates);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Lịch hẹn</title>
</head>
<body>
    <div class="container pb-5 pt-5">
        <h2>Lịch hẹn</h2>
        
        <!-- Form lọc -->
        <form class="mb-3">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="hospitalSelect">Bệnh viện</label>
                    <select id="hospitalSelect" class="form-control">
                        <option selected disabled>Tất cả</option>
                        <?php while ($row = $result_hospitals->fetch_assoc()) { ?>
                            <option value="<?php echo $row['name_hopital']; ?>"><?php echo $row['name_hopital']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="serviceSelect">Dịch vụ</label>
                    <select id="serviceSelect" class="form-control">
                        <option selected disabled>Tất cả</option>
                        <?php while ($row = $result_services->fetch_assoc()) { ?>
                            <option value="<?php echo $row['package']; ?>"><?php echo $row['package']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="dateSelect">Ngày</label>
                    <select id="dateSelect" class="form-control">
                        <option selected disabled>Tất cả</option>
                        <?php while ($row = $result_dates->fetch_assoc()) { ?>
                            <option value="<?php echo $row['appointment_date']; ?>"><?php echo $row['appointment_date']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>
        
        <!-- Bảng hiển thị lịch hẹn -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Bệnh Viện</th>
                    <th>ID Người Dùng</th>
                    <th>Tên Bệnh Viện</th>
                    <th>Tên Người Dùng</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Ngày Hẹn</th>
                    <th>Gói</th>
                    <th>Triệu Chứng</th>
                    <th>Ngày Tạo</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_appointments']; ?></td>
                    <td><?php echo $row['id_hopital']; ?></td>
                    <td><?php echo $row['id_user']; ?></td>
                    <td><?php echo $row['name_hopital']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['package']; ?></td>
                    <td><?php echo $row['symptoms']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id_appointments']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="delete.php?id=<?php echo $row['id_appointments']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
// Include footer
include('../includes/footer.php');
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy các phần tử HTML của các dropdown
        const hospitalSelect = document.getElementById("hospitalSelect");
        const serviceSelect = document.getElementById("serviceSelect");
        const dateSelect = document.getElementById("dateSelect");

        // Lắng nghe sự kiện khi form lọc được submit
        document.querySelector("form").addEventListener("submit", function(event) {
            event.preventDefault(); // Ngăn chặn việc gửi form đi để tránh tải lại trang

            // Lấy giá trị được chọn từ các dropdown
            const selectedHospital = hospitalSelect.value;
            const selectedService = serviceSelect.value;
            const selectedDate = dateSelect.value;

            // Lấy tất cả các dòng trong bảng
            const rows = document.querySelectorAll("tbody tr");

            // Duyệt qua từng dòng và ẩn hoặc hiển thị dựa trên điều kiện lọc
            rows.forEach(row => {
                const hospitalCell = row.querySelector("td:nth-child(4)").textContent;
                const serviceCell = row.querySelector("td:nth-child(9)").textContent;
                const dateCell = row.querySelector("td:nth-child(8)").textContent;

                // Kiểm tra xem dòng hiện tại phù hợp với điều kiện lọc không
                const hospitalMatch = selectedHospital === 'Tất cả' || hospitalCell === selectedHospital;
                const serviceMatch = selectedService === 'Tất cả' || serviceCell === selectedService;
                const dateMatch = selectedDate === 'Tất cả' || dateCell === selectedDate;

                // Hiển thị hoặc ẩn dòng tùy thuộc vào kết quả kiểm tra
                if (hospitalMatch && serviceMatch && dateMatch) {
                    row.style.display = ""; // Hiển thị dòng
                } else {
                    row.style.display = "none"; // Ẩn dòng
                }
            });
        });
    });
</script>
</body>
</html>
