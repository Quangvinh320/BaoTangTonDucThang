<?php
require_once __DIR__ . '/database.php';

$allowed = [
    'home' => ['title' => 'Trang chủ', 'file' => null],
    'gioi-thieu' => ['title' => 'Giới thiệu bảo tàng', 'file' => 'gioi-thieu.php'],
    'cuoc-doi' => ['title' => 'Cuộc đời và sự nghiệp', 'file' => 'cuoc-doi.php'],
    'dau-an-lich-su' => ['title' => 'Dấu ấn lịch sử', 'file' => 'dau-an-lich-su.php'],
    'hien-vat' => ['title' => 'Hiện vật tiêu biểu', 'file' => 'hien-vat.php'],
    'tham-quan' => ['title' => 'Tham quan bảo tàng', 'file' => 'tham-quan.php'],
    'search' => ['title' => 'Tìm kiếm', 'file' => null],
];
$page = $_GET['page'] ?? 'home';
if (!isset($allowed[$page])) $page = 'home';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/navbar.php';
?>
<main class="container page-content">
<?php
if ($page === 'home') {
    $pdo = db();
    $events = $pdo->query("SELECT * FROM events ORDER BY event_year ASC LIMIT 4")->fetchAll();
    $artifacts = $pdo->query("SELECT * FROM artifacts ORDER BY id DESC LIMIT 3")->fetchAll();
    ?>
    <section class="hero">
        <div class="hero-copy">
            <span class="eyebrow">BẢO TÀNG TÔN ĐỨC THẮNG</span>
            <h1>DẤU SON<br><em>LỊCH SỬ</em></h1>
            <p>Khám phá cuộc đời, sự nghiệp và những giá trị lịch sử gắn liền với Chủ tịch Tôn Đức Thắng.</p>
            <a class="btn btn-gold" href="<?= e(site_url('index.php?page=gioi-thieu')) ?>">Khám phá bảo tàng</a>
        </div>
        <div class="hero-art">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Ton_Duc_Thang.jpg/600px-Ton_Duc_Thang.jpg" alt="Chân dung Chủ tịch Tôn Đức Thắng" onerror="this.style.display='none'">
        </div>
    </section>

    <section class="section">
        <div class="section-heading"><span class="eyebrow">KHÁM PHÁ</span><h2>Những câu chuyện lịch sử</h2><p>Mỗi dấu mốc là một câu chuyện về cuộc đời và sự nghiệp của Bác Tôn.</p></div>
        <div class="feature-grid">
            <a class="feature-card" href="index.php?page=gioi-thieu"><span>01</span><h3>Giới thiệu bảo tàng</h3><p>Tìm hiểu lịch sử hình thành và hoạt động trưng bày.</p></a>
            <a class="feature-card" href="index.php?page=cuoc-doi"><span>02</span><h3>Cuộc đời và sự nghiệp</h3><p>Những chặng đường hoạt động và cống hiến.</p></a>
            <a class="feature-card" href="index.php?page=dau-an-lich-su"><span>03</span><h3>Dấu ấn lịch sử</h3><p>Theo dõi các sự kiện qua dòng thời gian.</p></a>
        </div>
    </section>

    <section class="section muted-section">
        <div class="section-heading"><span class="eyebrow">DÒNG THỜI GIAN</span><h2>Một hành trình đáng nhớ</h2></div>
        <div class="mini-timeline">
        <?php foreach ($events as $event): ?>
            <article><strong><?= e($event['event_year']) ?></strong><div><h3><?= e($event['title']) ?></h3><p><?= e($event['description']) ?></p></div></article>
        <?php endforeach; ?>
        <?php if (!$events): ?><p>Chưa có dữ liệu sự kiện. Quản trị viên có thể bổ sung trong trang quản trị.</p><?php endif; ?>
        </div>
        <a class="text-link" href="index.php?page=dau-an-lich-su">Xem toàn bộ dòng thời gian →</a>
    </section>

    <section class="section">
        <div class="section-heading"><span class="eyebrow">TƯ LIỆU</span><h2>Hiện vật tiêu biểu</h2></div>
        <div class="artifact-grid">
        <?php foreach ($artifacts as $item): ?>
            <button class="artifact-card" type="button" data-artifact-title="<?= e($item['name']) ?>" data-artifact-desc="<?= e($item['description']) ?>" data-artifact-image="<?= e($item['image_url']) ?>">
                <img src="<?= e($item['image_url'] ?: 'assets/images/placeholder.svg') ?>" alt="<?= e($item['name']) ?>">
                <span><b><?= e($item['name']) ?></b><small><?= e($item['short_description']) ?></small></span>
            </button>
        <?php endforeach; ?>
        <?php if (!$artifacts): ?><p>Hiện chưa có hiện vật được cập nhật.</p><?php endif; ?>
        </div>
    </section>
    <?php
} elseif ($page === 'search') {
    require __DIR__ . '/includes/search.php';
} else {
    require __DIR__ . '/pages/' . $allowed[$page]['file'];
}
?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
