<?php
$q = trim($_GET['q'] ?? '');
$results = [];
if ($q !== '') {
    $stmt = db()->prepare("SELECT 'Hiện vật' AS type, name AS title, description AS detail, CONCAT('index.php?page=hien-vat') AS url FROM artifacts WHERE name LIKE :q OR description LIKE :q
        UNION ALL
        SELECT 'Sự kiện', title, description, 'index.php?page=dau-an-lich-su' FROM events WHERE title LIKE :q OR description LIKE :q
        ORDER BY title");
    $stmt->execute(['q' => '%' . $q . '%']);
    $results = $stmt->fetchAll();
}
?>
<section class="section">
    <span class="eyebrow">TRA CỨU TƯ LIỆU</span><h1 class="page-title">Tìm kiếm</h1>
    <form class="search-large" method="get"><input type="hidden" name="page" value="search"><input name="q" value="<?= e($q) ?>" placeholder="Nhập tên hiện vật hoặc sự kiện..."><button class="btn btn-red">Tìm kiếm</button></form>
    <?php if ($q !== ''): ?><h2>Kết quả cho “<?= e($q) ?>”</h2>
        <?php if ($results): foreach ($results as $r): ?><article class="search-result"><small><?= e($r['type']) ?></small><h3><a href="<?= e($r['url']) ?>"><?= e($r['title']) ?></a></h3><p><?= e($r['detail']) ?></p></article><?php endforeach; else: ?><p>Không tìm thấy kết quả phù hợp.</p><?php endif; ?>
    <?php endif; ?>
</section>
