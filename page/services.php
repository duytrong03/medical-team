<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dịch vụ khám</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <style>
    table {
      width: 100%;
      margin-top: 20px;
    }

    table th,
    table td {
      text-align: left;
      padding: 8px;
    }

    .hospital-list {
      list-style-type: none;
      /* Loại bỏ bullet point */
      padding: 0;
    }

    .hospital-item:hover {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      /* Hiệu ứng bóng đổ */
      border: 1px solid red;
      /* Đường viền của mỗi mục */
    }

    .hospital-item {
      margin-bottom: 30px;
      /* Khoảng cách giữa các mục */
      border: 1px solid #ddd;
      /* Đường viền của mỗi mục */
      background-color: #f9f9f9;
      /* Màu nền của mỗi mục */
      border-radius: 5px;
      /* Bo góc của mỗi mục */
      padding: 15px;
      /* Khoảng cách bên trong mỗi mục */
    }

    .hospital-item img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      display: block;
      /* Hiển thị ảnh là một khối */
      margin-bottom: 10px;
      /* Khoảng cách giữa ảnh và nội dung */
    }

    .hospital-item button {
      margin: 5px 5px 5px;
    }

    .hospital-item a {
      text-decoration: none;
    }

    .hospital-item h5 {
      margin-top: 0;
      /* Loại bỏ khoảng cách trên cùng của tiêu đề */
      margin-bottom: 10px;
      /* Khoảng cách giữa tiêu đề và nội dung */
    }

    .hospital-item p {
      font-size: 13px;
      margin-bottom: 5px;
      /* Khoảng cách giữa các đoạn văn */
    }
  </style>
</head>

<body>
  <?php
  define('__ROOT__', dirname(dirname(__FILE__)));
  require_once(__ROOT__ . '/connect.php');
  require_once(__ROOT__ . '/component/navbar.php');

  // Truy vấn để lấy tất cả các chuyên khoa
  $sql = "WITH RECURSIVE split_values AS (
            SELECT 
            id_hopital  , 
                TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(specialist, ',', numbers.n), ',', -1)) AS value
            FROM 
                (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5) numbers INNER JOIN crud_hopital_location
                    ON CHAR_LENGTH(specialist) - CHAR_LENGTH(REPLACE(specialist, ',', '')) >= numbers.n - 1
            )
            SELECT DISTINCT value
            FROM split_values
            WHERE value != '';
            ";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $special_list = ($result->fetch_all(MYSQLI_ASSOC));
  } else {
    echo "0 results";
  }


  ?>
  <form>

    <div class="container pt-5 pb-5">
      <div class="row">
        <!-- Chọn Chuyên Khoa -->
        <div class="col-md-4 mb-3">
          <label for="specialist-select">Chọn Chuyên Khoa:</label>
          <select id="specialist-select" name="specialist" class="form-control select2">
    <?php
    if (!empty($special_list)) {
        foreach ($special_list as $special) {
            $selected = ($_GET['specialist'] ?? null) === $special['value'] ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($special['value']) . '" ' . $selected . '>' . htmlspecialchars($special['value']) . '</option>';
        }
    }
    ?>
</select>

        </div>


        <!-- Chọn Gói Dịch Vụ -->
        <div class="col-md-4 mb-3">
          <label for="package-select">Chọn Gói Dịch Vụ:</label>
          <select id="package-select" class="form-control select2">
            <option value="Gói Khám thường">Gói Khám thường</option>
            <option value="Gói Khám Tự chọn">Gói Khám Tự chọn</option>
            <option value="Gói Khám Bảo hiểm">Gói Khám Bảo hiểm</option>
            <option value="Gói VIP">Gói VIP</option>
          </select>
        </div>
      </div>


      <div class="col-md-4 mb-3">
        <button id="search-btn" class="btn btn-primary">Tìm Kiếm</button>
      </div>
  </form>
  <div id="results" class="mt-4">
    <?php

    $specialist_params = $_GET['specialist'] ?? null;
    if ($specialist_params) {
      // Query database for hospitals based on specialist
      $sql = "SELECT * FROM crud_hopital_location WHERE specialist LIKE '%$specialist_params%' ";
      $stmt = $conn->prepare($sql);
    } else {
      $sql = "SELECT * FROM crud_hopital_location";
      $stmt = $conn->prepare($sql);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      echo '<ul class="hospital-list row mb-4">';
      while ($row = $result->fetch_assoc()) {
        echo '<li class="hospital-item col-md-3">';
        echo '<img src="' . $row['image'] . '" class="img-fluid mb-2">';
        echo '<a href="./rateAction.php?hospitalName='. $row['name'].'">'.'<h6>' . $row['name'] . '</h6></a>';
        echo '<p><strong>Địa chỉ:</strong> ' . $row['address'] . '</p>';
        echo '<p><strong>SĐT:</strong> ' . $row['phone'] . '</p>';
        echo '<form action="./bookService.php" method="post">'; // Thay đổi 'datlich.php' bằng đường dẫn xử lý form của bạn
        echo '<input type="hidden" name="hospital_id" value="' . $row['id_hopital'] . '">'; // Trường ẩn lưu ID của bệnh viện
        echo '<input type="hidden" name="hospital_name" value="' . $row['name'] . '">'; // Trường ẩn lưu ID của bệnh viện
        echo '<button type="submit" class="btn btn-primary">Đặt lịch ngay</button>';
        echo '</form>';
        echo '</li>';
      }
      echo '</ul>';
    } else {
      echo "Không tìm thấy bệnh viện phù hợp.";
    }
    ?>
  </div>


  <script>
    $(document).ready(function() {
      $('#search-btn').click(function() {
        var specialist = $('#specialist-select').val();
        var package = $('#package-select').val();

        $.ajax({
          url: 'search_hospital.php',
          type: 'GET',
          data: {
            specialist: specialist,
            package: package
          },
          success: function(response) {
            $('#results').html(response);
          },
          error: function() {
            $('#results').html('<p>An error has occurred</p>');
          }
        });
      });

      $('.select2').select2({
        placeholder: "Chọn một lựa chọn",
        allowClear: true,
        width: '100%'
      });
    });
  </script>



  <?php
  require_once(__ROOT__ . '/component/footer.php');
  ?>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/location.js"></script>


</body>

</html>