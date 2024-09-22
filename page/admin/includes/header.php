<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        img{
            width: 100px;
            height: 50px;
            object-fit: cover;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">Trang quản trị</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../dashboard/dashboard.php">Báo cáo thống kê</a></li>
                <li class="nav-item"><a class="nav-link" href="../hospital/read.php">Cơ sở y tế</a></li>
                <li class="nav-item"><a class="nav-link" href="../users/read.php">Người dùng</a></li>
                <li class="nav-item"><a class="nav-link" href="../rate/read.php">Đánh giá</a></li>
                <li class="nav-item"><a class="nav-link" href="../appointment/read.php">Lịch hẹn</a></li>
                <li class="nav-item"><a class="nav-link text-info" href="../../homePage.php">Quay lại trang dịch vụ</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4 pb-5">