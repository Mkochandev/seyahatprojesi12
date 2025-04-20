<?php
require_once 'includes/config.php';

// Önce bookings tablosunu temizle
$conn->query("SET FOREIGN_KEY_CHECKS=0");
$conn->query("TRUNCATE TABLE bookings");
$conn->query("TRUNCATE TABLE destinations");
$conn->query("SET FOREIGN_KEY_CHECKS=1");

// Yeni destinasyonları ekle
$destinations = [
    [
        'city' => 'Santorini, Yunanistan',
        'description' => 'Beyaz badanalı evleri, muhteşem gün batımı ve Ege Denizi manzarasıyla büyüleyici bir ada',
        'price' => 15999.90,
        'image_url' => 'images/destinations/santorini.jpg'
    ],
    [
        'city' => 'Kapadokya, Türkiye',
        'description' => 'Peri bacaları, sıcak hava balonları ve eşsiz kaya oluşumlarıyla masalsı bir deneyim',
        'price' => 5999.90,
        'image_url' => 'images/destinations/cappadocia.jpg'
    ],
    [
        'city' => 'Maldivler',
        'description' => 'Turkuaz suları, beyaz kumlu plajları ve lüks su üstü villarıyla cennet',
        'price' => 29999.90,
        'image_url' => 'images/destinations/maldives.jpg'
    ],
    [
        'city' => 'Paris, Fransa',
        'description' => 'Eyfel Kulesi, Louvre Müzesi ve romantik atmosferiyle sanatın başkenti',
        'price' => 12999.90,
        'image_url' => 'images/destinations/paris.jpg'
    ],
    [
        'city' => 'Antalya, Türkiye',
        'description' => 'Antik kentler, muhteşem plajlar ve lüks resortlarıyla Türk Rivierası',
        'price' => 4999.90,
        'image_url' => 'images/destinations/antalya.jpg'
    ],
    [
        'city' => 'Dubai, BAE',
        'description' => 'Modern mimari, lüks alışveriş ve çöl safarileriyle göz kamaştırıcı bir metropol',
        'price' => 18999.90,
        'image_url' => 'images/destinations/dubai.jpg'
    ]
];

$stmt = $conn->prepare("INSERT INTO destinations (city, description, price, image_url) VALUES (?, ?, ?, ?)");

foreach ($destinations as $dest) {
    $stmt->bind_param("ssds", $dest['city'], $dest['description'], $dest['price'], $dest['image_url']);
    $stmt->execute();
}

echo "Destinasyonlar başarıyla güncellendi!";
?>
