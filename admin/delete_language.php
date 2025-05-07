<?php
require 'auth.php';
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // ลบไฟล์รูปภาพถ้ามี
    $sql = "SELECT image FROM languages WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image);
    if ($stmt->fetch() && $image && file_exists($image)) {
        unlink($image);
    }
    $stmt->close();

    // ลบข้อมูลภาษา
    $sql = "DELETE FROM languages WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: manage_data.php");
exit;