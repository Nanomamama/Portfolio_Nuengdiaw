<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "profile_db"); // เปลี่ยนชื่อฐานข้อมูลตามจริง
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
            min-height: 100vh;
        }
        .login-card {
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            background: #fff;
            border: none;
        }
    </style>
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card login-card p-4">
                <h2 class="mb-4 text-center text-primary"><i class="ri-lock-2-line"></i> Admin Login</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'] ?? '';
                    $password = $_POST['password'] ?? '';
                    // ตรวจสอบ username/email และ password จากฐานข้อมูล
                    $stmt = $conn->prepare("SELECT id, password, username FROM admins WHERE username=? OR email=?");
                    $stmt->bind_param("ss", $username, $username);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows === 1) {
                        $stmt->bind_result($id, $hash, $db_username);
                        $stmt->fetch();
                        if (password_verify($password, $hash)) {
                            $_SESSION['admin_logged_in'] = true;
                            $_SESSION['admin_id'] = $id;
                            $_SESSION['admin_name'] = $db_username; // ใช้ username เป็นชื่อจริง
                            $_SESSION['admin_username'] = $db_username;
                            header("Location: dashboard.php");
                            exit;
                        } else {
                            echo '<div class="alert alert-danger text-center">ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger text-center">ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</div>';
                    }
                    $stmt->close();
                }
                ?>
                <form method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username or Email</label>
                        <input type="text" class="form-control form-control-lg" id="username" name="username" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="ri-login-box-line"></i> Login</button>
                        <!-- <a href="admin_register.php" class="btn btn-outline-success btn-lg"><i class="ri-user-add-line"></i> สมัครสมาชิก</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>