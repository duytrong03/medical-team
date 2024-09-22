<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../page/admin_style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div id="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-login" method="post">
            <div class="form-heading">
                <h2>Đăng ký</h2>
            </div>

            <br />
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Tên tài khoản" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="username" placeholder="Tên người dùng" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="address" placeholder="Địa chỉ" />
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required />
            </div>
            <input class="btn btn-success" type="submit" name="register" value="Đăng Ký" id="submit-success" />
            <div class="text-center mt-3">
                <b>Bạn đã có tài khoản?</b>
                <a href="login.php" style="color: #04aa6d; text-decoration: none; margin-left: 4px"><b>Đăng nhập</b></a>
            </div>
        </form>
    </div>

    <?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__ . '/connect.php');

    function registerUser($name, $address, $email, $username, $password, $conn)
    {
        $stmt = $conn->prepare("INSERT INTO users (name, address, email, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $address, $email, $username, password_hash($password, PASSWORD_BCRYPT));
        return $stmt->execute();    
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT id_user FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<p class='text-danger text-center'>Tên tài khoản hoặc email đã tồn tại</p>";
        } else {
            if (registerUser($name, $address, $email, $username, $password, $conn)) {
                echo "<p class='text-success text-center'>Đăng ký thành công</p>";
                header('Location: login.php');
            } else {
                echo "<p class='text-danger text-center'>Có lỗi xảy ra, vui lòng thử lại</p>";
            }
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>

</html>
