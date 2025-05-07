<?php
$conn = new mysqli("localhost", "root", "", "profile_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuengdiaw Thiaksriboon - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --main-color: #5342ed;
            --light-color: #f7f7f7;
            --grey-color: #9f9f9f;
            --dark-color: #18161e;
            --navy-color: #222f3e;
            --blue-color: #54a0ff;
            --red-color: #ee5253;
            --pastel-blue-color: #cBd6e5;
            --cyan-color: #0abde3;
            --yellow-color: #feca57;
        }

        .card,
        .card-image,
        .card-image-1 {
            background-color: var(--dark-color) !important;
            color: #fff !important;
        }

        .cards-grid .card {
            transition: box-shadow 0.3s;
        }

        .cards-grid .card:hover {
            box-shadow: 0 0 32px 0 rgba(255, 255, 255, 0.7), 0 4px 32px 0 rgba(0, 0, 0, 0.12);
            z-index: 2;
        }

        .menu {
            width: 100%;
        }

        .main-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            width: 100%;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .main-menu .login-link {
            margin-left: auto;
        }

        /* ปุ่ม login สไตล์เดียวกับ .button a.light */
        .main-menu .login-link a {
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            min-width: 110px;
            padding: 0 2em;
            line-height: 42px;
            border: 2px solid transparent;
            border-radius: 25px;
            margin: 0 1em 1em 0;
            background-color: var(--main-color);
            border-bottom-left-radius: 0;
            box-shadow: 0px 12px 40px -12px rgba(83, 82, 237);
            transition: border-radius 0.3s, color 0.3s, box-shadow 0.3s;
        }

        .main-menu .login-link a:hover {
            border-top-right-radius: 0;
            color: #fff;
        }
    </style>
</head>

<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <div id="page" class="site">
        <header class="header">
            <div class="container">
                <nav>
                    <div class="logo"><img src="./image/logo.png" alt="Logo"></div>
                    <div class="button">
                        <a href="#" class="menu-trigger" title="Open menu"><i class="ri-menu-3-line"></i></a>
                    </div>
                    <div class="menu">
                        <a href="#" class="close" aria-label="Close menu"><i class="ri-close-line"></i></a>
                        <ul class="main-menu">
                            <li><a href="#page">Home</a></li>
                            <li><a href="#Members">About</a></li>
                            <li><a href="#Projects">Projects</a></li>
                            <li><a href="#Footer">Footer</a></li>
                            <li><a href="#Footer">Contact</a></li>
                            <li class="login-link"><a href="../admin/admin_login.php">log in</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <main class="hero">
            <div class="container grid">
                <div class="half">
                    <div class="grid__text">
                        <h1>Nuengdiaw Thiaksriboon</h1>
                        <h2 id="typing-text">Full-Stack Developer</h2>
                        <p>I'm a Computer Science student at Loei Rajabhat University (Batch 66, 2023). Passionate about
                            web development, coding, and creating innovative solutions.</p>
                        <div class="button">
                            <a href="#Members" class="light">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="half">
                    <div class="hero__image">
                        <div class="pic"><img src="./image/nano.jpg" alt="Nuengdiaw"></div>
                    </div>
                </div>
            </div>
        </main>

        <!-- ส่วนภาษาที่เขียน -->
        <section id="Members" class="cards-section">
            <div class="container">
                <div class="container_h1 text-center">
                    <h1>My Skills</h1>
                    <br>
                    <p>As a passionate and dedicated Full-Stack Developer, I have gained expertise in various
                        programming languages, frameworks, and technologies that allow me to build dynamic, responsive,
                        and high-performing web applications. My skill set spans both front-end and back-end
                        development, enabling me to create seamless user experiences and efficient system architectures.
                    </p>
                    <p>Here are some of the programming languages, tools, and technologies I am proficient in:</p>
                    <p>With my experience and continuous learning, I am always looking to improve my skills and stay
                        up-to-date with the latest advancements in web development.</p>
                    <hr>
                </div>
                <div class="cards-grid">
                    <?php
                    $sql = "SELECT language, description, image FROM languages ORDER BY id DESC";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="card">';
                            echo '<div class="card-image">';
                            echo '<img src="../admin/' . htmlspecialchars($row['image']) . '" alt="..." onerror="this.onerror=null;this.src=\'../admin/uploads/default.png\';">';
                            echo '</div>';
                            echo '<div class="card-content">';
                            echo '<h3>' . htmlspecialchars($row['language']) . '</h3>';
                            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                            echo '</div></div>';
                        }
                    } else {
                        echo '<p class="text-center text-muted">ยังไม่มีข้อมูลภาษา</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <!-- ส่วน Projects ที่นำเสอน -->
    <section id="Projects" class="projects-section">
        <div class="container">
            <div class="container_h1 text-center">
                <h1>My Projects</h1>
                <br>
                <p>Here are some of the projects I've worked on as a Full-Stack Developer. These projects showcase my skills in web development, database management, and user interface design. Each project is designed to solve real-world problems and improve user experiences.</p>
                <hr>
            </div>
            <div class="cards-grid">
                <?php
                $sql = "SELECT name, description, github, image FROM projects ORDER BY id DESC";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<div class="card-image-1"><img src="../admin/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" onerror="this.onerror=null;this.src=\'../admin/uploads/default.png\';"></div>';
                        echo '<div class="card-content">';
                        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                        if ($row['github']) {
                            echo '<a href="' . htmlspecialchars($row['github']) . '" target="_blank" class="btn btn-light">View on GitHub</a>';
                        }
                        echo '</div></div>';
                    }
                } else {
                    echo '<p class="text-center text-muted">ยังไม่มีข้อมูลโปรเจ็กต์</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <footer id="Footer" class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <div class="footer-logo">
                        <h3>Nuengdiaw</h3>
                    </div>
                    <p>Full-Stack Developer & Computer Science Student</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#page">Home</a></li>
                        <li><a href="#Members">About</a></li>
                        <li><a href="#Projects">Projects</a></li>
                        <li><a href="#Footer">Footer</a></li>
                        <li><a href="#Footer">Contact</a></li>
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
                        <a href="https://www.facebook.com/na.no.936910/" aria-label="Facebook"><i
                                class="ri-facebook-fill"></i></a>
                        <a href="#" aria-label="Twitter"><i class="ri-twitter-fill"></i></a>
                        <a href="#" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                        <a href="https://github.com/Nanomamama" aria-label="GitHub"><i class="ri-github-fill"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                <p class="text-secondary">Developed and maintained by Nuengdiaw Thiaksriboon, Full-Stack Developer</p>
                <p class="text-secondary">© 2025 NanoDev . /
                    <a href="#">Terms of Use</a> /
                    <a href="#">Privacy Policy</a> /
                    <a href="#">Code of Conduct</a> /
                    <a href="#">System Status</a>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // การจัดการเมนู
        const menuTrigger = document.querySelector('.menu-trigger'),
            closeTrigger = document.querySelector('.close'),
            giveClass = document.querySelector('.site');

        menuTrigger.addEventListener('click', function() {
            giveClass.classList.toggle('showmenu');
        });

        closeTrigger.addEventListener('click', function() {
            giveClass.classList.toggle('showmenu');
        });

        // การพิมพ์ข้อความแบบวนลูป
        const textElement = document.getElementById('typing-text');

        // ลิสต์ของข้อความที่จะวนแสดง
        const textList = [
            "Full-Stack Developer",
            "Programmer",
            "Senior Programmer",
            "Application Developer",
            "iOS Developer",
            "Android Developer",
            "Java Developer",
            "Front-end Developer",
            "Test Engineer",
            "E-Commerce Developer",
            "VB Developer",
            "PHP Programmer",
            "Software Tester",
            "Software Engineer",
            "Project Manager"
        ];

        let textIndex = 0; // ดัชนีของข้อความปัจจุบัน
        let charIndex = 0; // ดัชนีของตัวอักษร
        let isTyping = true; // สถานะว่ากำลังพิมพ์หรือลบ

        function typeLoop() {
            const currentText = textList[textIndex]; // ข้อความปัจจุบัน

            if (isTyping) {
                // พิมพ์ข้อความทีละตัว
                if (charIndex < currentText.length) {
                    textElement.textContent = currentText.slice(0, charIndex + 1);
                    charIndex++;
                    setTimeout(typeLoop, 100); // ความเร็วในการพิมพ์
                } else {
                    // เมื่อพิมพ์ครบ หยุดพักแล้วเปลี่ยนไปลบ
                    isTyping = false;
                    setTimeout(typeLoop, 1000); // หยุดพักก่อนลบ
                }
            } else {
                // ลบข้อความทีละตัว
                if (charIndex > 1) {
                    textElement.textContent = currentText.slice(0, charIndex - 1);
                    charIndex--;
                    setTimeout(typeLoop, 50); // ความเร็วในการลบ
                } else {
                    // เมื่อลบหมด เปลี่ยนข้อความใหม่แล้วเริ่มพิมพ์
                    isTyping = true;
                    textIndex = (textIndex + 1) % textList.length; // วนลูปกลับไปข้อความแรกเมื่อถึงตัวสุดท้าย
                    setTimeout(typeLoop, 500); // หยุดพักก่อนเริ่มข้อความใหม่
                }
            }
        }

        // เริ่มการพิมพ์ข้อความ
        typeLoop();
    </script>
</body>

</html>
<?php $conn->close(); ?>