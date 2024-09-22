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
require_once(__ROOT__ . '../../../connect.php');

// Hàm để lấy dữ liệu top 10 bệnh viện đánh giá tốt nhất
function getTopRatedHospitalsData()
{
    global $conn;
    $sql = "SELECT name, AVG(rating) AS average_rating FROM rate_hospitals GROUP BY id_hopital ORDER BY average_rating DESC LIMIT 10";
    $result = $conn->query($sql);

    $labels = [];
    $averageRatings = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['name'];
            $averageRatings[] = $row['average_rating'];
        }
    }

    return [
        'labels' => $labels,
        'averageRatings' => $averageRatings
    ];
}

// Hàm để lấy dữ liệu top 10 bệnh viện có lịch đặt nhiều nhất
function getTopBookedHospitalsData()
{
    global $conn;
    $sql = "SELECT name_hopital, COUNT(*) AS appointment_count FROM appointments GROUP BY id_hopital ORDER BY appointment_count DESC LIMIT 10";
    $result = $conn->query($sql);

    $labels = [];
    $appointmentCounts = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['name_hopital'];
            $appointmentCounts[] = $row['appointment_count'];
        }
    }

    return [
        'labels' => $labels,
        'appointmentCounts' => $appointmentCounts
    ];
}

// Hàm để lấy dữ liệu số người dùng mới trong tuần
function getNewUsersInCurrentMonthData()
{
    global $conn;
    $sql = "SELECT WEEK(created_at) AS week_number, COUNT(*) AS new_user_count FROM users WHERE MONTH(created_at) = MONTH(NOW()) GROUP BY WEEK(created_at)";
    $result = $conn->query($sql);

    $labels = [];
    $newUserCounts = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = 'Tuần ' . $row['week_number'];
            $newUserCounts[] = $row['new_user_count'];
        }
    }

    return [
        'labels' => $labels,
        'newUserCounts' => $newUserCounts
    ];
}

// Hàm để lấy dữ liệu số bệnh viện theo quận
function getHospitalCountByDistrictData()
{
    global $conn;
    $sql = "SELECT district, COUNT(*) AS hospital_count FROM crud_hopital_location GROUP BY district";
    $result = $conn->query($sql);

    $labels = [];
    $hospitalCounts = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['district'];
            $hospitalCounts[] = $row['hospital_count'];
        }
    }

    return [
        'labels' => $labels,
        'hospitalCounts' => $hospitalCounts
    ];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Báo cáo</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Top 10 Bệnh viện có Đánh giá tốt nhất</h3>
                <canvas id="topRatedHospitalsChart"></canvas>
            </div>
            <div class="col-md-6">
                <h3>Top 10 Bệnh viện có Số lượng lịch đặt nhiều nhất</h3>
                <canvas id="topBookedHospitalsChart"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>Số người dùng mới trong tháng hiện tại</h3>
                <canvas id="newUsersInCurrentMonthChart"></canvas>
            </div>
            <div class="col-md-6">
                <h3>Số lượng bệnh viện theo Quận</h3>
                <canvas id="hospitalCountByDistrictChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        var topRatedHospitalsData = <?php echo json_encode(getTopRatedHospitalsData()); ?>;
        var topBookedHospitalsData = <?php echo json_encode(getTopBookedHospitalsData()); ?>;
        var newUsersInCurrentMonthData = <?php echo json_encode(getNewUsersInCurrentMonthData()); ?>;
        var hospitalCountByDistrictData = <?php echo json_encode(getHospitalCountByDistrictData()); ?>;

        // Truncate tên bệnh viện dài hơn 20 ký tự
        topRatedHospitalsData.labels = topRatedHospitalsData.labels.map(label => {
            return label.length > 20 ? label.substring(0, 20) + '...' : label;
        });

        topBookedHospitalsData.labels = topBookedHospitalsData.labels.map(label => {
            return label.length > 20 ? label.substring(0, 20) + '...' : label;
        });

        hospitalCountByDistrictData.labels = hospitalCountByDistrictData.labels.map(label => {
            return label.length > 20 ? label.substring(0, 20)
            + '...' : label;
        });

        // Tạo biểu đồ bằng Chart.js
        var topRatedHospitalsChart = new Chart(document.getElementById('topRatedHospitalsChart'), {
            type: 'bar',
            data: {
                labels: topRatedHospitalsData.labels,
                datasets: [{
                    label: 'Đánh giá trung bình',
                    data: topRatedHospitalsData.averageRatings,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var topBookedHospitalsChart = new Chart(document.getElementById('topBookedHospitalsChart'), {
            type: 'bar',
            data: {
                labels: topBookedHospitalsData.labels,
                datasets: [{
                    label: 'Số lượng lịch đặt',
                    data: topBookedHospitalsData.appointmentCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var newUsersInCurrentMonthChart = new Chart(document.getElementById('newUsersInCurrentMonthChart'), {
            type: 'line',
            data: {
                labels: newUsersInCurrentMonthData.labels,
                datasets: [{
                    label: 'Số người dùng mới',
                    data: newUsersInCurrentMonthData.newUserCounts,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var hospitalCountByDistrictChart = new Chart(document.getElementById('hospitalCountByDistrictChart'), {
            type: 'bar',
            data: {
                labels: hospitalCountByDistrictData.labels,
                datasets: [{
                    label: 'Số lượng bệnh viện',
                    data: hospitalCountByDistrictData.hospitalCounts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php require_once '../includes/footer.php'; ?>
