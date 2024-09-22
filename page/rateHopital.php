<?php
define('__ROOT__', dirname(dirname(__FILE__)));

// Kết nối vào cơ sở dữ liệu
require_once(__ROOT__ . '/connect.php');

// Truy vấn lấy 10 bệnh viện có lượng avgrating cao nhất
$sql = "SELECT name, AVG(rating) AS avgrating FROM rate_hospitals GROUP BY name ORDER BY avgrating DESC LIMIT 10";
$result = $conn->query($sql);

// Khởi tạo mảng chứa tên bệnh viện và avgrating tương ứng
$hospitalNames = [];
$ratings = [];

// Lặp qua kết quả truy vấn và lấy dữ liệu
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $hospitalNames[] = $row['name'];
    $ratings[] = $row['avgrating'];
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top 10 Hospitals</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
  <?php require_once(__ROOT__ . '/component/navbar.php'); ?>
  <div class="container pt-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h3 class="text-center mb-4">Top 10 bệnh viện được đánh giá tốt nhất</h3>
        <p class="text-danger text-center">(* Dựa theo đánh giá của người bệnh)</p>
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>
  <?php require_once(__ROOT__ . '/component/footer.php'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script>
    // Dữ liệu của biểu đồ
    var hospitalNames = <?php echo json_encode($hospitalNames); ?>;
    var ratings = <?php echo json_encode($ratings); ?>;

    // Tạo mảng chứa chuỗi tên bệnh viện đã cắt ngắn
    var truncatedHospitalNames = hospitalNames.map(function(name) {
      return name.length > 10 ? name.substring(0, 10) + '...' : name;
    });

    // Tạo biểu đồ
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: truncatedHospitalNames,
        datasets: [{
          label: 'Ratings',
          data: ratings,
          backgroundColor: 'rgba(220,53,69, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            max: 5
          }
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: function(context) {
                var label = context.dataset.label || '';
                if (context.parsed.x !== null) {
                  label += ': ' + hospitalNames[context.parsed.x];
                }
                return label;
              }
            }
          }
        },
        onClick: function(event, elements) {
          if (elements.length > 0) {
            // Lấy chỉ số của cột được nhấp vào
            var index = elements[0].index;
            // Lấy tên của bệnh viện tương ứng với cột được nhấp vào
            var hospitalName = hospitalNames[index];
            // Chuyển trang đến URL mong muốn, ví dụ: hospitalDetail.php?hospitalName=<tên_bệnh_viện>
            window.location.href = './rateAction.php?hospitalName=' + encodeURIComponent(hospitalName);
          }
        }
      }
    });
  </script>
</body>

</html>