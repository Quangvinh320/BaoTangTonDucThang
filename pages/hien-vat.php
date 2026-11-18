<?php $items = db()->query("SELECT * FROM artifacts ORDER BY id DESC")->fetchAll(); ?>
<section class="page-hero"><span class="eyebrow">KHO TƯ LIỆU</span><h1 class="page-title">Hiện vật tiêu biểu</h1><p>Khám phá hình ảnh, tên gọi và câu chuyện lịch sử của các hiện vật được giới thiệu.</p></section>
<div class="artifact-grid">
<?php foreach ($items as $item): ?>
<button class="artifact-card" type="button" data-artifact-title="<?= e($item['name']) ?>" data-artifact-desc="<?= e($item['description']) ?>" data-artifact-image="<?= e($item['image_url']) ?>">
<img src="<?= e($item['image_url'] ?: 'assets/images/placeholder.svg') ?>" alt="<?= e($item['name']) ?>"><span><b><?= e($item['name']) ?></b><small><?= e($item['short_description']) ?></small></span>
</button>
<?php endforeach; ?>
<?php if (!$items): ?><p>Chưa có hiện vật. Quản trị viên có thể thêm dữ liệu trong trang quản trị.</p><?php endif; ?>
</div>
