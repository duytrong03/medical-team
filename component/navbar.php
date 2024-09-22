<?php session_start() ?>
<header class="bg-white py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="https://static.wixstatic.com/media/9d8ed5_f0d7ea50fd804ba9a93d9f34029d8695~mv2.png/v1/fit/w_500,h_500,q_90/file.png" alt="" width="60" height="60">
            </div>
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <input type="search" class="form-control me-2" placeholder="Search..." />
                    <img src="../image/search-icon.jpg" alt="" style="width: 30px" />
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="./home_page.php" style="color: white !important;" class="text-decoration-none">MEDICAL WEB</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="./homePage.php">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="./services.php">Dịch vụ khám</a></li>
                <li class="nav-item"><a class="nav-link" href="./rateHopital.php">Đánh giá bệnh viện</a></li>
                <li class="nav-item"><a class="nav-link" href="./map.php">Bản đồ</a></li>
                <li class="nav-item"><a class="nav-link" href="./location.php">Cơ sở y tế gần nhất</a></li>
                <li class="nav-item"><a class="nav-link" href="./my_appointment.php">Lịch khám của tôi</a></li>
                <?php

                // Kiểm tra xem người dùng có được phép truy cập vào trang admin không
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
                    echo '<li class="nav-item"><a class="nav-link text-info" href="./admin/dashboard/dashboard.php">Quản lý (Dành cho QTV)</a></li>';
                }

                // Kiểm tra xem người dùng có được phép truy cập vào trang admin không
                if (!isset($_SESSION['role'])) {
                    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
                    echo '<li class="nav-item"><a class="nav-link" href="./login.php">Đăng nhập</a></li>';
                }
                // Kiểm tra xem người dùng có được phép truy cập vào trang admin không
                if (isset($_SESSION['role'])) {
                    // Nếu người dùng không có Session hoặc không có vai trò admin, chuyển hướng về trang khác, hoặc hiển thị thông báo lỗi
                    echo '<li class="nav-item"><a class="nav-link text-danger" href="./logout.php">Đăng xuất</a></li>';
                }
                ?>


            </ul>
        </div>
    </div>
</nav>