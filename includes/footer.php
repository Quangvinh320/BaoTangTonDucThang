<footer class="site-footer">
    <div class="container footer-grid">
        <div><b>BẢO TÀNG TÔN ĐỨC THẮNG</b><p>DẤU SON LỊCH SỬ</p></div>
        <p>Website giới thiệu và khám phá lịch sử trực tuyến.</p>
        <a href="<?= e(site_url('admin/login.php')) ?>">Quản trị viên</a>
    </div>
    <div class="copyright">© <?= date('Y') ?> Bảo tàng Tôn Đức Thắng</div>
</footer>
<div class="modal" id="artifactModal" aria-hidden="true">
    <div class="modal-panel"><button class="modal-close" aria-label="Đóng">×</button><img id="modalImage" alt=""><h2 id="modalTitle"></h2><p id="modalDescription"></p></div>
</div>
<script src="<?= e(site_url('assets/js/main.js')) ?>"></script>
</body></html>
