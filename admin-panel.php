<?php
session_start();
require_once 'includes/config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch statistics
$stats = [
    'total_users' => 0,
    'active_listings' => 0,
    'sold_listings' => 0,
    'total_revenue' => 0,
    'pending_bookings' => 0,
    'confirmed_bookings' => 0
];

// Get total users
$result = $conn->query("SELECT COUNT(*) as count FROM users");
$stats['total_users'] = $result->fetch_assoc()['count'];

// Get active listings (all destinations for now)
$result = $conn->query("SELECT COUNT(*) as count FROM destinations");
$stats['active_listings'] = $result->fetch_assoc()['count'];

// Get sold listings
$result = $conn->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'confirmed'");
$stats['sold_listings'] = $result->fetch_assoc()['count'];

// Get total revenue
$result = $conn->query("SELECT SUM(total_price) as total FROM bookings WHERE status = 'confirmed'");
$stats['total_revenue'] = $result->fetch_assoc()['total'] ?? 0;

// Get pending bookings
$result = $conn->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'pending'");
$stats['pending_bookings'] = $result->fetch_assoc()['count'];

// Get confirmed bookings
$result = $conn->query("SELECT COUNT(*) as count FROM bookings WHERE status = 'confirmed'");
$stats['confirmed_bookings'] = $result->fetch_assoc()['count'];

// Get recent bookings
$recent_bookings = [];
$result = $conn->query("
    SELECT b.*, u.username, d.city as destination_name 
    FROM bookings b 
    JOIN users u ON b.user_id = u.id 
    JOIN destinations d ON b.destination_id = d.id 
    ORDER BY b.created_at DESC 
    LIMIT 5
");

while ($row = $result->fetch_assoc()) {
    $recent_bookings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="tr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - Gezi Rehberi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#D0C7B6]/10">
    <?php include 'header.php'; ?>

    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-[#101D23]/95 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <h1 class="text-xl font-bold text-white">Admin Paneli</h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-300 mr-4">Hoş geldiniz, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                        <a href="logout.php" class="text-[#D85128] hover:text-[#D85128]/80">Çıkış Yap</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-[#101D23]/95 overflow-hidden shadow rounded-lg border border-[#687E3F]/20">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-2xl text-[#D85128]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-300 truncate">Toplam Kullanıcı</dt>
                                    <dd class="text-3xl font-semibold text-white"><?php echo $stats['total_users']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Listings -->
                <div class="bg-[#101D23]/95 overflow-hidden shadow rounded-lg border border-[#687E3F]/20">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-2xl text-[#D85128]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-300 truncate">Toplam İlanlar</dt>
                                    <dd class="text-3xl font-semibold text-white"><?php echo $stats['active_listings']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sold Listings -->
                <div class="bg-[#101D23]/95 overflow-hidden shadow rounded-lg border border-[#687E3F]/20">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-shopping-cart text-2xl text-[#D85128]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-300 truncate">Satılan İlanlar</dt>
                                    <dd class="text-3xl font-semibold text-white"><?php echo $stats['sold_listings']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->
                <div class="bg-[#101D23]/95 overflow-hidden shadow rounded-lg border border-[#687E3F]/20">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-money-bill-wave text-2xl text-[#D85128]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-300 truncate">Toplam Gelir</dt>
                                    <dd class="text-3xl font-semibold text-white"><?php echo number_format($stats['total_revenue'], 2); ?> ₺</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Bookings -->
                <div class="bg-[#101D23]/95 overflow-hidden shadow rounded-lg border border-[#687E3F]/20">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-2xl text-[#D85128]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-300 truncate">Bekleyen Rezervasyonlar</dt>
                                    <dd class="text-3xl font-semibold text-white"><?php echo $stats['pending_bookings']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmed Bookings -->
                <div class="bg-[#101D23]/95 overflow-hidden shadow rounded-lg border border-[#687E3F]/20">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-2xl text-[#D85128]"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-300 truncate">Onaylanan Rezervasyonlar</dt>
                                    <dd class="text-3xl font-semibold text-white"><?php echo $stats['confirmed_bookings']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="bg-[#101D23]/95 shadow overflow-hidden sm:rounded-lg border border-[#687E3F]/20">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-white">Son Rezervasyonlar</h3>
                </div>
                <div class="border-t border-[#687E3F]/20">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[#687E3F]/20">
                            <thead class="bg-[#101D23]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Kullanıcı</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Destinasyon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tarih</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Durum</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fiyat</th>
                                </tr>
                            </thead>
                            <tbody class="bg-[#101D23]/80 divide-y divide-[#687E3F]/20">
                                <?php foreach ($recent_bookings as $booking): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($booking['username']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo htmlspecialchars($booking['destination_name']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo date('d.m.Y', strtotime($booking['booking_date'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <?php if ($booking['status'] == 'pending'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Beklemede
                                            </span>
                                        <?php elseif ($booking['status'] == 'confirmed'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Onaylandı
                                            </span>
                                        <?php else: ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                İptal Edildi
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                        <?php echo number_format($booking['total_price'], 2); ?> ₺
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($recent_bookings)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-300">Henüz rezervasyon bulunmuyor</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 