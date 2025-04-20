<?php
session_start();
require_once 'includes/config.php';

// Kullanıcı girişi kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Kullanıcı bilgilerini al
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Kullanıcının rezervasyonlarını al
$stmt = $conn->prepare("
    SELECT b.*, d.city, d.image_url 
    FROM bookings b 
    JOIN destinations d ON b.destination_id = d.id 
    WHERE b.user_id = ? 
    ORDER BY b.created_at DESC
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$bookings = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilim - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    
    <div class="min-h-screen container mx-auto px-4 py-24">
        <?php if (isset($_GET['booking_success'])): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8" role="alert">
            <p class="font-medium">Rezervasyon başarıyla oluşturuldu!</p>
            <p>Rezervasyon detaylarını aşağıda görebilirsiniz.</p>
        </div>
        <?php endif; ?>

        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8 mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Profilim</h1>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <p class="text-gray-600">Kullanıcı Adı:</p>
                        <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($user['username']); ?></p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600">E-posta:</p>
                        <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Rezervasyonlarım</h2>
                
                <?php if ($bookings->num_rows > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php while ($booking = $bookings->fetch_assoc()): ?>
                    <div class="bg-gray-50 rounded-xl overflow-hidden shadow">
                        <img src="<?php echo htmlspecialchars($booking['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($booking['city']); ?>" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                                <?php echo htmlspecialchars($booking['city']); ?>
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between text-gray-600">
                                    <span>Tarih:</span>
                                    <span class="font-medium"><?php echo date('d.m.Y', strtotime($booking['booking_date'])); ?></span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Kişi Sayısı:</span>
                                    <span class="font-medium"><?php echo $booking['number_of_people']; ?> kişi</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Toplam Tutar:</span>
                                    <span class="font-medium text-teal-600">
                                        <?php echo number_format($booking['total_price'], 2); ?> ₺
                                    </span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Durum:</span>
                                    <span class="font-medium <?php 
                                        echo match($booking['status']) {
                                            'confirmed' => 'text-green-600',
                                            'cancelled' => 'text-red-600',
                                            default => 'text-yellow-600'
                                        };
                                    ?>">
                                        <?php 
                                        echo match($booking['status']) {
                                            'confirmed' => 'Onaylandı',
                                            'cancelled' => 'İptal Edildi',
                                            default => 'Onay Bekliyor'
                                        };
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-gray-600 mb-4">Henüz bir rezervasyonunuz bulunmuyor.</p>
                    <a href="destinations.php" 
                       class="inline-block px-6 py-3 bg-teal-400 text-white font-semibold rounded-lg hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 transition-colors">
                        Destinasyonları Keşfet
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 