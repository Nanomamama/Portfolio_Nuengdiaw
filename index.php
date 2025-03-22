<?php
require_once 'db_connect.php'; // ไฟล์เชื่อมต่อฐานข้อมูลจากโค้ดก่อนหน้า
$skills = $conn->query("SELECT * FROM skills"); // ดึงข้อมูลทักษะ
$projects = $conn->query("SELECT * FROM projects"); // ดึงข้อมูลโปรเจกต์
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuengdiaw Thiaksriboon - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="page" class="site">
        <header class="header">
            <div class="container">
                <nav>
                    <div class="logo"><img src="/assets/image/logo.png" alt="Logo"></div>
                    <div class="button">
                        <a href="#" class="menu-trigger" title="Open menu"><i class="ri-menu-3-line"></i></a>
                    </div>
                    <div class="menu">
                        <a href="#" class="close" aria-label="Close menu"><i class="ri-close-line"></i></a>
                        <ul>
                            <li><a href="#page">Home</a></li>
                            <li><a href="#Members">About</a></li>
                            <li><a href="#Projects">Projects</a></li>
                            <li><a href="#Footer">Footer</a></li>
                            <li><a href="#Footer">Contact</a></li>
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
                        <div class="pic"><img src="/assets/image/nano.jpg" alt="Nuengdiaw"></div>
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
                    <?php while ($skill = $skills->fetch_assoc()) { ?>
                        <div class="card">
                            <div class="card-image">
                                <img src="<?php echo $skill['image']; ?>" alt="<?php echo $skill['name']; ?>">
                            </div>
                            <div class="card-content">
                                <h3><?php echo $skill['name']; ?></h3>
                                <p><?php echo $skill['description']; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- ส่วน Projects ที่นำเสนอ -->
        <section id="Projects" class="projects-section">
            <div class="container">
                <div class="container_h1 text-center">
                    <h1>My Projects</h1>
                    <br>
                    <p>Here are some of the projects I've worked on as a Full-Stack Developer. These projects showcase my skills in web development, database management, and user interface design. Each project is designed to solve real-world problems and improve user experiences.</p>
                    <hr>
                </div>
                <div class="cards-grid">
                    <?php while ($project = $projects->fetch_assoc()) { ?>
                        <div class="card">
                            <div class="card-image-1">
                                <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>">
                            </div>
                            <div class="card-content">
                                <h3><?php echo $project['title']; ?></h3>
                                <p><?php echo $project['description']; ?></p>
                                <a href="<?php echo $project['github_link']; ?>" target="_blank" class="btn btn-light">View on GitHub</a>
                            </div>
                        </div>
                    <?php } ?>
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
                    <p class="text-secondary">© 2025 NanoDev . /
                        <a href="#">Terms of Use</a> /
                        <a href="#">Privacy Policy</a> /
                        <a href="#">Code of Conduct</a> /
                        <a href="#">System Status</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>

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

        let textIndex = 0;
        let charIndex = 0;
        let isTyping = true;

        function typeLoop() {
            const currentText = textList[textIndex];
            if (isTyping) {
                if (charIndex < currentText.length) {
                    textElement.textContent = currentText.slice(0, charIndex + 1);
                    charIndex++;
                    setTimeout(typeLoop, 100);
                } else {
                    isTyping = false;
                    setTimeout(typeLoop, 1000);
                }
            } else {
                if (charIndex > 1) {
                    textElement.textContent = currentText.slice(0, charIndex - 1);
                    charIndex--;
                    setTimeout(typeLoop, 50);
                } else {
                    isTyping = true;
                    textIndex = (textIndex + 1) % textList.length;
                    setTimeout(typeLoop, 500);
                }
            }
        }

        typeLoop();
    </script>
</body>

</html>

<?php $conn->close(); ?>