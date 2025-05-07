<?php
require 'auth.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มข้อมูลโปรเจ็กต์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
            min-height: 100vh;
        }
        .modern-card {
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            background: #fff;
            border: none;
        }
        .img-preview-wrap {
            position: relative;
            width: 120px;
            margin: 0 auto;
        }
        .img-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 1.2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            border: 2px solid #6366f1;
            background: #f1f5f9;
            display: none;
        }
        .img-preview.show {
            display: block;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0;}
            to { opacity: 1;}
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card modern-card p-4">
                <h2 class="mb-4 text-center text-primary"><i class="ri-add-circle-line"></i> เพิ่มข้อมูลโปรเจ็กต์</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $project_name = $_POST['project_name'] ?? '';
                    $description = $_POST['description'] ?? '';
                    $github = $_POST['github'] ?? '';
                    $imagePath = '';

                    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                        $targetDir = "uploads/";
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }
                        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
                        $targetFile = $targetDir . $fileName;
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                        if (in_array($imageFileType, $allowedTypes)) {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                                $imagePath = $targetFile;
                                // --- เพิ่มลงฐานข้อมูลจริง ---
                                $stmt = $conn->prepare("INSERT INTO projects (name, description, github, image) VALUES (?, ?, ?, ?)");
                                $stmt->bind_param("ssss", $project_name, $description, $github, $imagePath);
                                if ($stmt->execute()) {
                                    echo '<div class="alert alert-success mb-2 text-center"><i class="ri-checkbox-circle-line"></i> บันทึกข้อมูลโปรเจ็กต์สำเร็จ: <b>' . htmlspecialchars($project_name) . '</b></div>';
                                    echo '<div class="img-preview-wrap mb-3"><img src="' . htmlspecialchars($imagePath) . '" alt="Project Image" class="img-preview show"></div>';
                                    echo '<div class="mb-2 text-center"><b>GitHub:</b> <a href="' . htmlspecialchars($github) . '" target="_blank">' . htmlspecialchars($github) . '</a></div>';
                                } else {
                                    echo '<div class="alert alert-danger text-center"><i class="ri-close-circle-line"></i> เกิดข้อผิดพลาดในการบันทึกข้อมูล</div>';
                                }
                                $stmt->close();
                            } else {
                                echo '<div class="alert alert-danger text-center"><i class="ri-close-circle-line"></i> เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger text-center"><i class="ri-error-warning-line"></i> อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG, GIF เท่านั้น</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning text-center"><i class="ri-image-line"></i> กรุณาเลือกรูปภาพ</div>';
                    }
                }
                ?>
                <form method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="mb-3 text-center">
                        <div class="img-preview-wrap">
                            <img id="imgPreview" class="img-preview" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="project_name" class="form-label">ชื่อโปรเจ็กต์ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="project_name" name="project_name" required placeholder="เช่น School Form Website">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">รายละเอียด</label>
                        <textarea class="form-control" id="description" name="description" rows="2" placeholder="รายละเอียดโปรเจ็กต์"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="github" class="form-label">GitHub Link <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="github" name="github" required placeholder="https://github.com/username/project">
                    </div>
                    <div class="mb-4">
                        <label for="image" class="form-label">รูปภาพโปรเจ็กต์ <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="ri-save-3-line"></i> บันทึก</button>
                        <a href="index.php" class="btn btn-outline-secondary"><i class="ri-arrow-left-line"></i> กลับแดชบอร์ด</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewImage(event) {
    const [file] = event.target.files;
    if (file) {
        const img = document.getElementById('imgPreview');
        img.src = URL.createObjectURL(file);
        img.classList.add('show');
    }
}
</script>
</body>
</html>
<?php $conn->close(); ?>