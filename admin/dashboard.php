<?php
require 'auth.php';
include 'db.php';

// นับจำนวนภาษา
$lang_sql = "SELECT COUNT(*) AS total FROM languages";
$lang_result = $conn->query($lang_sql);
$lang_count = $lang_result ? $lang_result->fetch_assoc()['total'] : 0;

// นับจำนวนโปรเจ็กต์
$proj_sql = "SELECT COUNT(*) AS total FROM projects";
$proj_result = $conn->query($proj_sql);
$proj_count = $proj_result ? $proj_result->fetch_assoc()['total'] : 0;

// ดึงชื่อภาษา
$lang_names = [];
$lang_name_sql = "SELECT language FROM languages LIMIT 8";
if ($res = $conn->query($lang_name_sql)) {
    while ($row = $res->fetch_assoc()) {
        $lang_names[] = $row['language'];
    }
}

// ดึงชื่อโปรเจ็กต์
$proj_names = [];
$proj_name_sql = "SELECT name FROM projects LIMIT 4";
if ($res = $conn->query($proj_name_sql)) {
    while ($row = $res->fetch_assoc()) {
        $proj_names[] = $row['name'];
    }
}

// ดึงชื่อผู้ดูแลระบบ
$admin_name = $_SESSION['admin_name'] ?? 'Admin';

// ดึงชื่อผู้ดูแลระบบ (username)
$admin_username = $_SESSION['admin_username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Nuengdiaw Thiaksriboon</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="page" class="site"></div>
    <!-- <header class="header">
            <div class="container">
                <nav>
                    <div class="logo"><img src="/user/image/logo.png" alt="Logo"></div>
                    <div class="button">
                        <a href="#" class="menu-trigger" title="Open menu"><i class="ri-menu-3-line"></i></a>
                    </div>
                    <div class="menu">
                        <a href="#" class="close" aria-label="Close menu"><i class="ri-close-line"></i></a>
                        <ul>
                            <li><a href="index.html">Portfolio</a></li>
                            <li><a href="index.php" class="active">Dashboard</a></li>
                            <li><a href="#Footer">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header> -->

    <main class="dashboard-main py-5">
        <div class="container">
            <h2 class="mb-4 text-center">ยินดีต้อนรับ Admin  <?php echo htmlspecialchars($admin_name); ?></h2>
            <!-- <div class="alert alert-success text-center mb-4">
                ยินดีต้อนรับ <?php echo htmlspecialchars($admin_name); ?>
            </div> -->
            <!-- สรุปข้อมูล -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="card shadow text-center border-0">
                        <div class="card-body">
                            <i class="ri-code-s-slash-line display-3 text-primary mb-2"></i>
                            <h5 class="card-title">จำนวนภาษาที่เขียนได้</h5>
                            <p class="display-5 fw-bold mb-0"><?php echo $lang_count; ?></p>
                            <small class="text-muted">
                                <?php echo $lang_count > 0 ? implode(', ', $lang_names) : '-'; ?>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow text-center border-0">
                        <div class="card-body">
                            <i class="ri-folder-3-line display-3 text-success mb-2"></i>
                            <h5 class="card-title">จำนวนโปรเจ็กต์ที่ทำได้</h5>
                            <p class="display-5 fw-bold mb-0"><?php echo $proj_count; ?></p>
                            <small class="text-muted">
                                <?php echo $proj_count > 0 ? implode(', ', $proj_names) : '-'; ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- เมนูหลัก -->
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-bg-primary h-100">
                        <div class="card-body text-center">
                            <i class="ri-add-circle-line display-4 mb-3"></i>
                            <h5 class="card-title">เพิ่มข้อมูลภาษา</h5>
                            <p class="card-text">เพิ่มข้อมูลภาษาเข้าสู่ระบบ</p>
                            <a href="admin_add.php" class="btn btn-light">เพิ่มภาษา</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-success h-100">
                        <div class="card-body text-center">
                            <i class="ri-add-box-line display-4 mb-3"></i>
                            <h5 class="card-title">เพิ่มข้อมูลโปรเจ็กต์</h5>
                            <p class="card-text">เพิ่มโปรเจ็กต์ใหม่เข้าสู่ระบบ</p>
                            <a href="project_add.php" class="btn btn-light">เพิ่มโปรเจ็กต์</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-bg-info h-100">
                        <div class="card-body text-center">
                            <i class="ri-database-2-line display-4 mb-3"></i>
                            <h5 class="card-title">จัดการข้อมูล</h5>
                            <p class="card-text">ดู/แก้ไข/ลบ ข้อมูล</p>
                            <a href="manage_data.php" class="btn btn-light">จัดการข้อมูล</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-bg-warning h-100">
                        <div class="card-body text-center">
                            <i class="ri-logout-box-r-line display-4 mb-3"></i>
                            <h5 class="card-title">ออกจากระบบ</h5>
                            <p class="card-text">ออกจากระบบผู้ดูแล</p>
                            <a href="logout.php" class="btn btn-light">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="../user/index.php" class="btn btn-outline-secondary"><i class="ri-arrow-left-line"></i> กลับหน้า Portfolio</a>
            </div>
        </div>
    </main>

    <!-- <footer id="Footer" class="footer mt-5">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>Nuengdiaw</h3>
                    <p>Full-Stack Developer & Computer Science Student</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.html">Portfolio</a></li>
                        <li><a href="index.php">Dashboard</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Me</h4>
                    <ul>
                        <li><i class="ri-mail-line"></i>nanoone342@gmail.com</li>
                        <li><i class="ri-phone-line"></i>065 107 8576</li>
                        <li><i class="ri-map-pin-line"></i>Loei, Thailand</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Follow Me</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/na.no.936910/" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                        <a href="#" aria-label="Twitter"><i class="ri-twitter-fill"></i></a>
                        <a href="#" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                        <a href="https://github.com/Nanomamama" aria-label="GitHub"><i class="ri-github-fill"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                <p class="text-secondary">Developed and maintained by Nuengdiaw Thiaksriboon, Full-Stack Developer</p>
                <p class="text-secondary">© 2025 NanoDev</p>
            </div>
        </div>
    </footer>
     -->
    </div>
    <script>
        // เมนู Dashboard
        const menuTrigger = document.querySelector('.menu-trigger'),
            closeTrigger = document.querySelector('.close'),
            giveClass = document.querySelector('.site');
        menuTrigger.addEventListener('click', function() {
            giveClass.classList.toggle('showmenu');
        });
        closeTrigger.addEventListener('click', function() {
            giveClass.classList.toggle('showmenu');
        });
    </script>
</body>

</html>
<?php $conn->close(); ?>