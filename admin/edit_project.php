<?php
require 'auth.php';
include 'db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header("Location: manage_data.php"); exit; }

// ดึงข้อมูลเดิม
$stmt = $conn->prepare("SELECT name, description, github, image FROM projects WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $description, $github, $image);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $github = $_POST['github'] ?? '';
    $new_image = $image; // ค่าเริ่มต้นคือรูปเดิม

    // ถ้ามีอัปโหลดรูปใหม่
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
                // ลบไฟล์เดิมถ้ามี
                if ($image && file_exists($image)) {
                    unlink($image);
                }
                $new_image = $targetFile;
            }
        }
    }

    $stmt = $conn->prepare("UPDATE projects SET name=?, description=?, github=?, image=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $description, $github, $new_image, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_data.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขโปรเจ็กต์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4 text-center">แก้ไขโปรเจ็กต์</h2>
    <form method="post" enctype="multipart/form-data" class="mx-auto" style="max-width:500px;">
        <div class="mb-3">
            <label class="form-label">ชื่อโปรเจ็กต์</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">รายละเอียด</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">GitHub</label>
            <input type="text" name="github" class="form-control" value="<?php echo htmlspecialchars($github); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">รูปโปรเจ็กต์</label><br>
            <?php if ($image && file_exists($image)): ?>
                <img src="<?php echo htmlspecialchars($image); ?>" alt="Project Image" style="max-width:120px;max-height:120px;border-radius:8px;">
            <?php endif; ?>
            <input type="file" name="image" class="form-control mt-2" accept="image/*">
            <div class="form-text">ถ้าไม่เลือกไฟล์ใหม่ จะใช้รูปเดิม</div>
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <a href="manage_data.php" class="btn btn-secondary">ยกเลิก</a>
    </form>
</div>
</body>
</html>