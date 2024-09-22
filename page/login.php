<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../page/admin_style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <div id="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-login" method="post">
            <div class="form-heading">
                <h2>Đăng nhập</h2>
            </div>

            <br />
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Tên tài khoản" required />
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required />
            </div>
            <input class="btn btn-success" type="submit" name="login" value="Đăng Nhập" id="submit-success" />

            <div class="text-center mt-3">
                <b>Bạn không có tài khoản?</b>
                <a href="signup.php" style="color: #04aa6d; text-decoration: none; margin-left: 4px"><b>Đăng kí ngay</b></a>
            </div>
        </form>
    </div>

    <?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__ . '/connect.php');

    function checkUser($name, $password, $conn)
    {
        $stmt = $conn->prepare("SELECT id_user, role, password FROM users WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Return user data if password is verified
            return [
                'id_user' => $user['id_user'],
                'role' => $user['role']
            ];
        }
        return false;
    }

    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $user = checkUser($name, $password, $conn);
        var_dump($user);
        if ($user) {
            $_SESSION['role'] = $user['role'];
            $_SESSION['id_user'] = $user['id_user'];
            if ($user['role'] == 1) {
                header('Location: ./admin/dashboard/dashboard.php');
            } elseif ($user['role'] == 0) {
                header('Location: ./homePage.php');
            } else {
                header('Location: ./login.php');
            }
        } else {
            echo "<p class='text-danger text-center'>Tên đăng nhập hoặc mật khẩu không đúng</p>";
        }
    }
    ?>
</body>

</html>
