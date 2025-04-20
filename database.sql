-- Veritabanını oluştur
CREATE DATABASE IF NOT EXISTS seyahatprojesi;
USE seyahatprojesi;

-- Admin tablosu
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Kullanıcılar tablosu
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Destinasyonlar tablosu
CREATE TABLE IF NOT EXISTS destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    country_code VARCHAR(2) NOT NULL,
    country_name VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Rezervasyonlar tablosu
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    destination_id INT NOT NULL,
    booking_date DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (destination_id) REFERENCES destinations(id)
);

-- Örnek admin hesabı
INSERT INTO admin (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com');

-- Örnek destinasyonlar
INSERT INTO destinations (country_code, country_name, city, description, image_url, price) VALUES
('TR', 'Türkiye', 'Antalya', 'Akdeniz\'in incisi Antalya, muhteşem plajları ve tarihi dokusuyla unutulmaz bir tatil deneyimi sunar.', 'images/antalya.jpg', 1500.00),
('GR', 'Yunanistan', 'Santorini', 'Ege Denizi\'nin mavi sularına bakan beyaz evleriyle ünlü Santorini, romantik bir kaçış için ideal.', 'images/santorini.jpg', 2000.00),
('IT', 'İtalya', 'Roma', 'Tarih, sanat ve lezzetli mutfağın buluştuğu Roma, her ziyaretçiye unutulmaz anılar bırakır.', 'images/roma.jpg', 1800.00),
('ES', 'İspanya', 'Barselona', 'Modernist mimarisi ve canlı kültürüyle Barselona, Avrupa\'nın en renkli şehirlerinden biridir.', 'images/barselona.jpg', 1700.00),
('FR', 'Fransa', 'Paris', 'Aşkın ve sanatın başkenti Paris, dünyanın en romantik şehirlerinden biridir.', 'images/paris.jpg', 2200.00),
('PT', 'Portekiz', 'Lizbon', 'Tarihi tramvayları ve renkli binalarıyla Lizbon, Portekiz\'in başkenti olarak ziyaretçilerini büyüler.', 'images/lizbon.jpg', 1600.00); 