<?php
require_once __DIR__ . '/../database.php';
require_admin();
$pdo=db(); $message='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $action=$_POST['action']??'';
    if($action==='delete'){ $st=$pdo->prepare("DELETE FROM events WHERE id=?");$st->execute([(int)$_POST['id']]);$message='Đã xóa sự kiện.'; }
    else {
        $year=(int)($_POST['event_year']??0);$title=trim($_POST['title']??'');$desc=trim($_POST['description']??'');
        if($year>0 && $title!==''){
            if($action==='update'){ $st=$pdo->prepare("UPDATE events SET event_year=?,title=?,description=? WHERE id=?");$st->execute([$year,$title,$desc,(int)$_POST['id']]);$message='Đã cập nhật sự kiện.'; }
            else { $st=$pdo->prepare("INSERT INTO events(event_year,title,description) VALUES(?,?,?)");$st->execute([$year,$title,$desc]);$message='Đã thêm sự kiện.'; }
        } else $message='Vui lòng nhập năm và tên sự kiện hợp lệ.';
    }
}
$edit=null;if(isset($_GET['edit'])){$st=$pdo->prepare("SELECT * FROM events WHERE id=?");$st->execute([(int)$_GET['edit']]);$edit=$st->fetch();}
$items=$pdo->query("SELECT * FROM events ORDER BY event_year,id")->fetchAll();
?>
<!DOCTYPE html><html lang="vi"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Quản lý sự kiện</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="admin-body"><div class="admin-wrap"><a href="dashboard.php">← Dashboard</a><h1>Quản lý sự kiện</h1><?php if($message): ?><p class="form-success"><?= e($message) ?></p><?php endif; ?>
<form class="admin-form" method="post"><h2><?= $edit?'Sửa sự kiện':'Thêm sự kiện' ?></h2><input type="hidden" name="action" value="<?= $edit?'update':'create' ?>"><?php if($edit): ?><input type="hidden" name="id" value="<?= (int)$edit['id'] ?>"><?php endif; ?><label>Năm<input type="number" name="event_year" min="1800" max="2100" required value="<?= e($edit['event_year']??'') ?>"></label><label>Tên sự kiện<input name="title" required value="<?= e($edit['title']??'') ?>"></label><label>Mô tả<textarea name="description" rows="4"><?= e($edit['description']??'') ?></textarea></label><button class="btn btn-red">Lưu sự kiện</button><?php if($edit): ?> <a href="quan-ly-su-kien.php">Hủy sửa</a><?php endif; ?></form>
<div class="admin-table"><table><tr><th>Năm</th><th>Sự kiện</th><th>Thao tác</th></tr><?php foreach($items as $item): ?><tr><td><?= e($item['event_year']) ?></td><td><?= e($item['title']) ?></td><td><a href="?edit=<?= (int)$item['id'] ?>">Sửa</a><form method="post" class="inline-form" onsubmit="return confirm('Bạn chắc chắn muốn xóa?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$item['id'] ?>"><button>Xóa</button></form></td></tr><?php endforeach; ?></table></div></div></body></html>
