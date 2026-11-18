<header class="site-header">
    <a class="brand" href="<?= e(site_url('index.php')) ?>">
        <span class="brand-mark">TĐT</span>
        <span><b>BẢO TÀNG TÔN ĐỨC THẮNG</b><small>DẤU SON LỊCH SỬ</small></span>
    </a>
    <button class="menu-toggle" aria-label="Mở menu" aria-expanded="false">☰</button>
    <nav class="main-nav">
        <a href="<?= e(site_url('index.php')) ?>">Trang chủ</a>
        <a href="<?= e(site_url('index.php?page=gioi-thieu')) ?>">Giới thiệu</a>
        <a href="<?= e(site_url('index.php?page=cuoc-doi')) ?>">Cuộc đời & sự nghiệp</a>
        <a href="<?= e(site_url('index.php?page=dau-an-lich-su')) ?>">Dấu ấn lịch sử</a>
        <a href="<?= e(site_url('index.php?page=hien-vat')) ?>">Hiện vật</a>
        <a href="<?= e(site_url('index.php?page=tham-quan')) ?>">Tham quan</a>
    </nav>
    <form class="nav-search" action="<?= e(site_url('index.php')) ?>" method="get">
        <input type="hidden" name="page" value="search">
        <input type="search" name="q" placeholder="Tìm kiếm..." aria-label="Tìm kiếm">
        <button type="submit" aria-label="Tìm">⌕</button>
    </form>
</header>
