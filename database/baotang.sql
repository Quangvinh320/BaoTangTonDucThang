CREATE DATABASE IF NOT EXISTS baotang_tond_duc_thang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE baotang_tond_duc_thang;

CREATE TABLE IF NOT EXISTS admins (
 id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(60) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS artifacts (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(255) NOT NULL,
 short_description VARCHAR(500) DEFAULT '',
 description TEXT,
 image_url TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS events (
 id INT AUTO_INCREMENT PRIMARY KEY,
 event_year VARCHAR(30) NOT NULL,
 title VARCHAR(255) NOT NULL,
 description TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tài khoản mẫu: admin / Admin@12345. Hãy đổi mật khẩu ngay sau khi đăng nhập.
INSERT IGNORE INTO admins(username,password_hash)
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/IGe.');

INSERT INTO events(event_year,title,description) VALUES
('1888','Bác Tôn ra đời','Chủ tịch Tôn Đức Thắng sinh ngày 20/8/1888 tại Cù Lao Ông Hổ, tỉnh An Giang ngày nay.'),
('1919','Tham gia phong trào công nhân','Giai đoạn hoạt động gắn với phong trào công nhân và phong trào yêu nước.'),
('1945','Trở về nước','Bác Tôn tiếp tục tham gia sự nghiệp cách mạng của dân tộc.'),
('1969','Được bầu làm Chủ tịch nước','Bác Tôn được Quốc hội bầu giữ chức Chủ tịch nước Việt Nam Dân chủ Cộng hòa.');

INSERT INTO artifacts(name,short_description,description,image_url) VALUES
('Tư liệu về cuộc đời Bác Tôn','Hình ảnh và tư liệu lịch sử','Bổ sung câu chuyện, nguồn tư liệu và giá trị lịch sử của hiện vật tại đây.',''),
('Kỷ vật cách mạng','Nhóm hiện vật gắn với hoạt động cách mạng','Cập nhật thông tin chính xác theo hồ sơ hiện vật của bảo tàng.',''),
('Hình ảnh hoạt động của Bác Tôn','Tư liệu ảnh lưu trữ','Bổ sung chú thích, niên đại và nguồn ảnh được phép sử dụng.','');
