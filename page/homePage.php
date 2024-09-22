<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<body>
  <?php 
  define('__ROOT__', dirname(dirname(__FILE__)));

  require_once(__ROOT__.'/component/navbar.php');
  
  ?>

  <div class="container pt-5 pb-5 ">
    <h2>Chào mừng bạn đến với trang web y tế của chúng tôi</h2>
    <p class="fs-7 mt-4">
      Trang web sẽ cung cấp cho bạn thông tin y tế hữu ích, và có chức năng chẩn đoán để giúp bạn linh hoạt trong các tình huống khẩn cấp.
    </p>
    <p class="fs-7">
      <b>Lưu ý:</b> Chức năng này chỉ để tham khảo nên không thể thay thế việc kiểm tra y tế trực tiếp. Vui lòng đến trung tâm y tế để được hỗ trợ.
    </p>
    <p class="fs-7">
      Click <a href="#" class="text-decoration-none">BẢN ĐỒ CƠ SỞ Y TẾ</a> để tìm kiếm tất cả thông tin về bệnh viện và cơ sở y tế gần nhất.
    </p>

    <div class="row mt-5">
      <div class="col-lg-6">
        <img src="../image/endometriosis_sharing_featured.png" alt="" class="w-100" />
      </div>
      <div class="col-lg-6">
        <div class="infomation">
          <h5 class="mt-4">CHỦ ĐỀ NỔI BẬT</h5>
          <h4 class="mt-4">Endometriosis</h4>
          <p class="fs-7">
            Endometriosis xảy ra khi mô tương tự như niêm mạc tử cung phát triển ở những nơi khác trên cơ thể. Không có phương pháp chữa trị nhưng có các liệu pháp điều trị cho các triệu chứng.
          </p>
          <button class="btn btn-primary mt-3">Tìm hiểu thêm</button>
        </div>
      </div>
    </div>

    <div class="mt-5">
      <h5>NỔI BẬT</h5>
      <hr class="mt-2" />
      <div class="row mt-4">
        <div class="col-lg-3">
          <div class="card">
            <img src="../image/image1.jpg" alt="" class="card-img-top" />
            <div class="card-body">
              <a href="#" class="text-decoration-none text-dark"><h5 class="card-title">Kiểm soát động kinh</h5></a>
              <p class="card-text">Học cách điều chỉnh các động kinh không kiểm soát được.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card">
            <img src="../image/image2.jpg" alt="" class="card-img-top" />
            <div class="card-body">
              <a href="#" class="text-decoration-none text-dark"><h5 class="card-title">Nhiễm HPV</h5></a>
              <p class="card-text">HPV, hoặc vi rút papilloma người, là một vi rút phổ biến có thể gây ra các bệnh ung thư sau này trong cuộc đời.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card">
            <img src="../image/image3.jpg" alt="" class="card-img-top" />
            <div class="card-body">
              <a href="#" class="text-decoration-none text-dark"><h5 class="card-title">An toàn khi sử dụng thang</h5></a>
              <p class="card-text">Học cách tự bảo vệ và ngăn chặn chấn thương khi sử dụng thang.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card">
            <img src="../image/image4.jpg" alt="" class="card-img-top" />
            <div class="card-body">
              <a href="#" class="text-decoration-none text-dark"><h5 class="card-title">Bệnh về hô hấp</h5></a>
              <p class="card-text">Có những biện pháp bạn có thể thực hiện để bảo vệ bản thân và người khác khỏi cúm, COVID-19 và RSV.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php 
 
  require_once(__ROOT__.'/component/footer.php');
  
?>

</body>
</html>
