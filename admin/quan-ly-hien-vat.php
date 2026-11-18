<?php
require_once __DIR__ . '/../database.php';
require_admin();
$pdo = db(); $message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM artifacts WHERE id=?"); $stmt->execute([(int)$_POST['id']]); $message='Đã xóa hiện vật.';
    } else {
        $data = [trim($_POST['name'] ?? ''), trim($_POST['short_description'] ?? ''), trim($_POST['description'] ?? ''), trim($_POST['image_url'] ?? '')];
        if ($data[0] !== '') {
            if ($action === 'update') {
                $stmt=$pdo->prepare("UPDATE artifacts SET name=?, short_description=?, description=?, image_url=? WHERE id=?"); $stmt->execute([...$data,(int)$_POST['id']]); $message='Đã cập nhật hiện vật.';
            } else {
                $stmt=$pdo->prepare("INSERT INTO artifacts(name,short_description,description,image_url) VALUES(?,?,?,?)"); $stmt->execute($data); $message='Đã thêm hiện vật.';
            }
        } else $message='Tên hiện vật không được để trống.';
    }
}
$edit = null;
if (isset($_GET['edit'])) { $st=$pdo->prepare("SELECT * FROM artifacts WHERE id=?"); $st->execute([(int)$_GET['edit']]); $edit=$st->fetch(); }
$items=$pdo->query("SELECT * FROM artifacts ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Quản lý hiện vật</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="admin-body"><div class="admin-wrap"><a href="dashboard.php">← Dashboard</a><h1>Quản lý hiện vật</h1><?php if($message): ?><p class="form-success"><?= e($message) ?></p><?php endif; ?>
<form class="admin-form" method="post"><h2><?= $edit?'Sửa hiện vật':'Thêm hiện vật' ?></h2><input type="hidden" name="action" value="<?= $edit?'update':'create' ?>"><?php if($edit): ?><input type="hidden" name="id" value="<?= (int)$edit['id'] ?>"><?php endif; ?>
<label>Tên hiện vật<input name="name" required value="<?= e($edit['name']??'') ?>"></label><label>Mô tả ngắn<input name="short_description" value="<?= e($edit['short_description']??'') ?>"></label><label>Mô tả chi tiết<textarea name="description" rows="4"><?= e($edit['description']??'') ?></textarea></label><label>URL hình ảnh<input name="image_url" type="url" value="<?= e($edit['image_url']??'') ?>"></label><button class="btn btn-red">Lưu hiện vật</button><?php if($edit): ?> <a href="quan-ly-hien-vat.php">Hủy sửa</a><?php endif; ?></form>
<div class="admin-table"><table><tr><th>Tên hiện vật</th><th>Thao tác</th></tr><?php foreach($items as $item): ?><tr><td><?= e($item['name']) ?></td><td><a href="?edit=<?= (int)$item['id'] ?>">Sửa</a><form method="post" class="inline-form" onsubmit="return confirm('Bạn chắc chắn muốn xóa?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><button>Xóa</button></form></td></tr><?php endforeach; ?></table></div></div></body></html>
