<?php
require 'auth.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>จัดการข้อมูล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            background: #f8fafc;
        }

        .table thead {
            background: #6366f1;
            color: #fff;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .img-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4 text-center text-primary"><i class="ri-database-2-line"></i> จัดการข้อมูล</h2>
        <ul class="nav nav-tabs mb-4 justify-content-center" id="manageTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="lang-tab" data-bs-toggle="tab" data-bs-target="#lang" type="button" role="tab" aria-controls="lang" aria-selected="true">ภาษา</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="proj-tab" data-bs-toggle="tab" data-bs-target="#proj" type="button" role="tab" aria-controls="proj" aria-selected="false">โปรเจ็กต์</button>
            </li>
        </ul>
        <div class="tab-content" id="manageTabContent">
            <!-- แท็บภาษา -->
            <div class="tab-pane fade show active" id="lang" role="tabpanel" aria-labelledby="lang-tab">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รูป</th>
                                <th>ชื่อภาษา</th>
                                <th>รายละเอียด</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id, language, description, image FROM languages ORDER BY id DESC";
                            $result = $conn->query($sql);
                            if ($result && $result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                    <td>' . $i++ . '</td>
                                    <td><img src="' . htmlspecialchars($row['image']) . '" class="img-thumb"></td>
                                    <td>' . htmlspecialchars($row['language']) . '</td>
                                    <td>' . htmlspecialchars($row['description']) . '</td>
                                    <td>
                                        <a href="edit_language.php?id=' . $row['id'] . '" class="btn btn-sm btn-warning"><i class="ri-edit-2-line"></i></a>
                                        <a href="delete_language.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'ยืนยันการลบ?\')"><i class="ri-delete-bin-2-line"></i></a>
                                    </td>
                                </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center text-muted">ไม่มีข้อมูล</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- แท็บโปรเจ็กต์ -->
            <div class="tab-pane fade" id="proj" role="tabpanel" aria-labelledby="proj-tab">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รูป</th>
                                <th>ชื่อโปรเจ็กต์</th>
                                <th>รายละเอียด</th>
                                <th>GitHub</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id, name, description, github, image FROM projects ORDER BY id DESC";
                            $result = $conn->query($sql);
                            if ($result && $result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                    <td>' . $i++ . '</td>
                                    <td><img src="' . htmlspecialchars($row['image']) . '" class="img-thumb"></td>
                                    <td>' . htmlspecialchars($row['name']) . '</td>
                                    <td>' . htmlspecialchars($row['description']) . '</td>
                                    <td><a href="' . htmlspecialchars($row['github']) . '" target="_blank"><i class="ri-github-fill"></i> GitHub</a></td>
                                    <td>
                                        <a href="edit_project.php?id=' . $row['id'] . '" class="btn btn-sm btn-warning"><i class="ri-edit-2-line"></i></a>
<a href="delete_project.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'ยืนยันการลบ?\')"><i class="ri-delete-bin-2-line"></i></a>
                                        </td>
                                </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center text-muted">ไม่มีข้อมูล</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-secondary"><i class="ri-arrow-left-line"></i> กลับแดชบอร์ด</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php $conn->close(); ?>