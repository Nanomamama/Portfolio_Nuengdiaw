<?php
require 'auth.php';
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // ดึง path รูปภาพเพื่อลบไฟล์จริง (ถ้ามี)
    $sql = "SELECT image FROM projects WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image);
    if ($stmt->fetch() && $image && file_exists($image)) {
        unlink($image);
    }
    $stmt->close();

    // ลบข้อมูล
    $sql = "DELETE FROM projects WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: manage_data.php");
exit;