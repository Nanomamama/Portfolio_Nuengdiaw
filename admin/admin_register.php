<?php
require 'auth.php';
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
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
            min-height: 100vh;
        }
        .register-card {
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            background: #fff;
            border: none;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card register-card p-4">
                <h2 class="mb-4 text-center text-primary"><i class="ri-user-add-line"></i> สมัครสมาชิก Admin</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = trim($_POST['username'] ?? '');
                    $email = trim($_POST['email'] ?? '');
                    $password = $_POST['password'] ?? '';
                    $confirm = $_POST['confirm'] ?? '';
                    if ($username && $email && filter_var($email, FILTER_VALIDATE_EMAIL) && $password && $password === $confirm) {
                        // ตรวจสอบซ้ำ
                        $stmt = $conn->prepare("SELECT id FROM admins WHERE username=? OR email=?");
                        $stmt->bind_param("ss", $username, $email);
                        $stmt->execute();
                        $stmt->store_result();
                        if ($stmt->num_rows > 0) {
                            echo '<div class="alert alert-danger text-center">Username หรือ Email นี้ถูกใช้แล้ว</div>';
                        } else {
                            // บันทึกฐานข้อมูล
                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            $stmt = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (?, ?, ?)");
                            $stmt->bind_param("sss", $username, $email, $hash);
                            if ($stmt->execute()) {
                                echo '<div class="alert alert-success text-center">สมัครสมาชิกสำเร็จ!<br>Username: <b>' . htmlspecialchars($username) . '</b><br>Email: <b>' . htmlspecialchars($email) . '</b></div>';
                            } else {
                                echo '<div class="alert alert-danger text-center">เกิดข้อผิดพลาด กรุณาลองใหม่</div>';
                            }
                        }
                        $stmt->close();
                    } else {
                        echo '<div class="alert alert-danger text-center">กรุณากรอกข้อมูลให้ครบ อีเมลต้องถูกต้อง และรหัสผ่านตรงกัน</div>';
                    }
                }
                ?>
                <form method="post" autocomplete="off">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control form-control-lg" id="username" name="username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                    </div>
                    <div class="mb-4">
                        <label for="confirm" class="form-label">ยืนยัน Password</label>
                        <input type="password" class="form-control form-control-lg" id="confirm" name="confirm" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg"><i class="ri-user-add-line"></i> สมัครสมาชิก</button>
                        <a href="admin_login.php" class="btn btn-outline-secondary"><i class="ri-arrow-left-line"></i> กลับหน้า Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $conn->close(); ?>
</body>
</html>