<?php
// Cấu hình chung. Khi đưa lên hosting, thay thông tin database tại đây.
define('DB_HOST', 'localhost');
define('DB_NAME', 'baotang_tond_duc_thang'); // Tên database mặc định // Đổi thành tên database thực tế trên hosting // Đổi thành tên database thực tế, ví dụ baotang_tond ucthang
define('DB_USER', 'root');
define('DB_PASS', '');

define('SITE_NAME', 'Bảo tàng Tôn Đức Thắng');
define('SITE_TAGLINE', 'DẤU SON LỊCH SỬ');
define('BASE_URL', ''); // Để trống khi chạy ở thư mục gốc hoặc localhost/BaoTangTonDucThang

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
