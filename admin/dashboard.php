<?php
require_once __DIR__ . '/../database.php';
require_admin();
if (isset($_GET['logout'])) { $_SESSION = []; session_destroy(); header('Location: login.php'); exit; }
$artifactCount = (int)db()->query("SELECT COUNT(*) FROM artifacts")->fetchColumn();
$eventCount = (int)db()->query("SELECT COUNT(*) FROM events")->fetchColumn();
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Quản trị</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="admin-body">
<div class="admin-wrap"><header class="admin-top"><div><b>QUẢN TRỊ BẢO TÀNG</b><small>Xin chào, <?= e($_SESSION['admin_name']) ?></small></div><a href="?logout=1">Đăng xuất</a></header>
<h1>Dashboard</h1><div class="admin-stats"><div><strong><?= $artifactCount ?></strong><span>Hiện vật</span></div><div><strong><?= $eventCount ?></strong><span>Sự kiện</span></div></div>
<div class="admin-links"><a href="quan-ly-hien-vat.php">Quản lý hiện vật →</a><a href="quan-ly-su-kien.php">Quản lý sự kiện →</a><a href="../index.php" target="_blank">Xem website →</a></div></div></body></html>
