<?php
// Hata raporlamayı aç
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantı bilgileri
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'seyahatprojesi');

// Veritabanına bağlanma
try {
    // Önce veritabanı olmadan bağlan
    $temp_conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    
    if ($temp_conn->connect_error) {
        throw new Exception("MySQL bağlantısı başarısız: " . $temp_conn->connect_error);
    }

    // Veritabanını oluştur
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    if (!$temp_conn->query($sql)) {
        throw new Exception("Veritabanı oluşturma hatası: " . $temp_conn->error);
    }

    // Geçici bağlantıyı kapat
    $temp_conn->close();

    // Veritabanına bağlan
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    // Türkçe karakter desteği için karakter setini ayarla
    $conn->set_charset("utf8mb4");

    // Tabloları oluştur
    $tables = [
        "CREATE TABLE IF NOT EXISTS users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) UNIQUE NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            is_admin TINYINT(1) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS destinations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            city VARCHAR(100) NOT NULL,
            country_code CHAR(2) NOT NULL,
            description TEXT,
            image_url VARCHAR(255),
            price DECIMAL(10,2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "CREATE TABLE IF NOT EXISTS bookings (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT,
            destination_id INT,
            booking_date DATE NOT NULL,
            number_of_people INT NOT NULL,
            total_price DECIMAL(10,2) NOT NULL,
            status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (destination_id) REFERENCES destinations(id)
        )",
        "CREATE TABLE IF NOT EXISTS passengers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            booking_id INT NOT NULL,
            name VARCHAR(100) NOT NULL,
            surname VARCHAR(100) NOT NULL,
            identity_number VARCHAR(11) NOT NULL,
            phone VARCHAR(15) NOT NULL,
            email VARCHAR(100) NOT NULL,
            birth_date DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
        )"
    ];

    foreach ($tables as $sql) {
        if (!$conn->query($sql)) {
            throw new Exception("Tablo oluşturma hatası: " . $conn->error);
        }
    }

    // Örnek destinasyon verileri ekle
    $sample_destinations = [
        ["İstanbul", "TR", "Tarihi yarımada, Boğaz manzarası ve zengin kültürü ile eşsiz bir şehir.", "images/destinations/istanbul.jpg", 1999.99],
        ["Antalya", "TR", "Muhteşem plajları ve antik kentleri ile tatil cenneti.", "images/destinations/antalya.jpg", 2499.99],
        ["İzmir", "TR", "Ege'nin incisi, modern ve tarihi bir arada yaşatan şehir.", "images/destinations/izmir.jpg", 1799.99]
    ];

    $stmt = $conn->prepare("INSERT IGNORE INTO destinations (city, country_code, description, image_url, price) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Hazırlama hatası: " . $conn->error);
    }

    foreach ($sample_destinations as $dest) {
        $stmt->bind_param("ssssd", $dest[0], $dest[1], $dest[2], $dest[3], $dest[4]);
        if (!$stmt->execute()) {
            throw new Exception("Veri ekleme hatası: " . $stmt->error);
        }
    }
    $stmt->close();

    // Check if admin user exists
    $result = $conn->query("SELECT id FROM users WHERE email = 'admin@example.com'");
    if ($result->num_rows == 0) {
        // Create admin user
        $admin_password = password_hash('admin123', PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, is_admin) VALUES ('admin', 'admin@example.com', ?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $admin_password);
        $stmt->execute();
    }

    // Insert sample destinations if table is empty
    $result = $conn->query("SELECT COUNT(*) as count FROM destinations");
    if ($result->fetch_assoc()['count'] == 0) {
        $destinations = [
            ['İstanbul', 'Türkiye', 'İstanbul şehri açıklaması', 1000.00, 'istanbul.jpg'],
            ['Paris', 'Fransa', 'Paris şehri açıklaması', 1500.00, 'paris.jpg'],
            ['Roma', 'İtalya', 'Roma şehri açıklaması', 1200.00, 'roma.jpg']
        ];

        $stmt = $conn->prepare("INSERT INTO destinations (city, country_code, description, image_url, price) VALUES (?, ?, ?, ?, ?)");
        foreach ($destinations as $destination) {
            $stmt->bind_param("ssssd", $destination[0], $destination[1], $destination[2], $destination[3], $destination[4]);
            $stmt->execute();
        }
    }

} catch (Exception $e) {
    // Hata durumunda kullanıcı dostu bir mesaj göster
    error_log($e->getMessage());
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?> 