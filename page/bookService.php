<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bản đồ</title>
    <link rel="stylesheet" href="../map/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../map/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.74.0/dist/L.Control.Locate.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.74.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.4/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
    </style>
</head>

<body>
    <?php define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__ . '/connect.php');
    require_once(__ROOT__ . '/component/navbar.php'); ?>

    <div class="container mt-5 pb-5">
        <h2 class="text-center mb-4">Đăng Ký Đặt Lịch Khám</h2>
        <form action="./handle_appointment.php" method="post">
            <div class="col-md-6">
                <label for="name_hopital" class="form-label">Cơ sở y tế</label>
                <input type="number" class="form-control"  name="id_hopital" value="<?= $_POST['hospital_id'] ?>" readonly hidden/>
                <input type="text" class="form-control" id="name_hopital" name="name_hopital" value="<?= $_POST['hospital_name'] ?>" readonly>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Tên của bạn</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="appointment_date" class="form-label">Lịch khám</label>
                    <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
                </div>
                <div class="col-md-6">
                    <label for="package" class="form-label">Chọn Gói Khám</label>
                    <select class="form-control" id="package" name="package" required>
                        <option value="Gói Khám thường">Gói Khám thường</option>
                        <option value="Gói Khám Tự chọn">Gói Khám Tự chọn</option>
                        <option value="Gói Khám Bảo hiểm">Gói Khám Bảo hiểm</option>
                        <option value="Gói VIP">Gói VIP</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="symptoms" class="form-label">Triệu chứng bệnh</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" rows="3" required></textarea>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đặt Lịch Ngay</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php require_once(__ROOT__ . '/component/footer.php'); ?>
</body>

</html>