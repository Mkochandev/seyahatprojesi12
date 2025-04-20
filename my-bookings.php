<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Rezervasyonları getir
$stmt = $conn->prepare("
    SELECT b.*, d.city, d.image_url, d.price 
    FROM bookings b 
    JOIN destinations d ON b.destination_id = d.id 
    WHERE b.user_id = ? 
    ORDER BY b.booking_date DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$bookings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyonlarım - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>

    <div class="min-h-screen py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-800 mb-8">Rezervasyonlarım</h1>

                <?php if (empty($bookings)): ?>
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-xmark text-gray-400 text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Henüz bir rezervasyonunuz bulunmuyor</h2>
                    <p class="text-gray-600 mb-6">Yeni bir maceraya başlamak için hemen bir tur rezervasyonu yapın.</p>
                    <a href="destinations.php" 
                       class="inline-block px-6 py-3 bg-teal-400 text-white rounded-lg hover:bg-teal-500 transition-colors">
                        Turları Keşfet
                    </a>
                </div>
                <?php else: ?>
                <div class="space-y-6">
                    <?php foreach ($bookings as $booking): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-64 h-48 md:h-auto">
                                <img src="<?php echo htmlspecialchars($booking['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($booking['city']); ?>"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 p-6">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                            <?php echo htmlspecialchars($booking['city']); ?>
                                        </h2>
                                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar text-teal-400 mr-2"></i>
                                                <span>
                                                    <?php echo date('d.m.Y', strtotime($booking['booking_date'])); ?>
                                                </span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-users text-teal-400 mr-2"></i>
                                                <span><?php echo $booking['number_of_people']; ?> Kişi</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-money-bill-wave text-teal-400 mr-2"></i>
                                                <span><?php echo number_format($booking['total_price'], 2); ?> ₺</span>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-info-circle text-teal-400 mr-2"></i>
                                                <span class="<?php echo $booking['status'] === 'confirmed' ? 'text-green-600' : ($booking['status'] === 'pending' ? 'text-yellow-600' : 'text-red-600'); ?> font-medium">
                                                    <?php
                                                    echo $booking['status'] === 'confirmed' ? 'Onaylandı' : 
                                                         ($booking['status'] === 'pending' ? 'Onay Bekliyor' : 'İptal Edildi');
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 md:mt-0 md:ml-6">
                                        <div class="inline-flex items-center px-4 py-2 rounded-full 
                                            <?php echo $booking['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                                     ($booking['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                     'bg-red-100 text-red-800'); ?>">
                                            <i class="fas <?php echo $booking['status'] === 'confirmed' ? 'fa-check-circle' : 
                                                                  ($booking['status'] === 'pending' ? 'fa-clock' : 
                                                                  'fa-times-circle'); ?> mr-2"></i>
                                            <?php
                                            echo $booking['status'] === 'confirmed' ? 'Onaylandı' : 
                                                 ($booking['status'] === 'pending' ? 'Onay Bekliyor' : 'İptal Edildi');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 flex items-center justify-end space-x-4">
                                    <a href="destination-details.php?id=<?php echo $booking['destination_id']; ?>" 
                                       class="inline-flex items-center text-teal-400 hover:text-teal-500">
                                        <span>Tur Detayları</span>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                    <?php if ($booking['status'] === 'pending'): ?>
                                    <button type="button" 
                                            class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                                        <i class="fas fa-times mr-2"></i>
                                        İptal Et
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 