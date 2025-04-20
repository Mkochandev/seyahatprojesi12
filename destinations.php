<?php
session_start();
require_once 'includes/config.php';

// Sayfalama için parametreleri al
$items_per_page = 15;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Filtreleme için parametreleri al
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 100000;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'price_asc';

// Toplam ilan sayısını al
$count_sql = "SELECT COUNT(*) as total FROM destinations WHERE price BETWEEN ? AND ?";
if (!empty($search)) {
    $count_sql .= " AND (city LIKE ? OR description LIKE ?)";
}

$count_stmt = $conn->prepare($count_sql);
if (!empty($search)) {
    $search_param = "%$search%";
    $count_stmt->bind_param("ddss", $min_price, $max_price, $search_param, $search_param);
} else {
    $count_stmt->bind_param("dd", $min_price, $max_price);
}

$count_stmt->execute();
$total_result = $count_stmt->get_result()->fetch_assoc();
$total_items = $total_result['total'];
$total_pages = ceil($total_items / $items_per_page);

// SQL sorgusunu oluştur
$sql = "SELECT * FROM destinations WHERE price BETWEEN ? AND ?";
if (!empty($search)) {
    $sql .= " AND (city LIKE ? OR description LIKE ?)";
}

// Sıralama seçeneğini ekle
switch ($sort) {
    case 'price_desc':
        $sql .= " ORDER BY price DESC";
        break;
    case 'name_asc':
        $sql .= " ORDER BY city ASC";
        break;
    case 'name_desc':
        $sql .= " ORDER BY city DESC";
        break;
    default: // price_asc
        $sql .= " ORDER BY price ASC";
}

// Sayfalama limitini ekle
$sql .= " LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);

// Parametreleri bağla
if (!empty($search)) {
    $search_param = "%$search%";
    $stmt->bind_param("ddssii", $min_price, $max_price, $search_param, $search_param, $items_per_page, $offset);
} else {
    $stmt->bind_param("ddii", $min_price, $max_price, $items_per_page, $offset);
}

$stmt->execute();
$result = $stmt->get_result();
$destinations = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasyonlar - Gezi Rehberi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white">
    <?php include 'header.php'; ?>

    <div class="min-h-screen container mx-auto px-4 py-24">
        <!-- Filtreler -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Arama</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" 
                           placeholder="Şehir veya açıklama ara...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Fiyat</label>
                    <input type="number" name="min_price" value="<?php echo $min_price; ?>" 
                           class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Maksimum Fiyat</label>
                    <input type="number" name="max_price" value="<?php echo $max_price; ?>" 
                           class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sıralama</label>
                    <select name="sort" 
                            class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>Fiyat (Artan)</option>
                        <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>Fiyat (Azalan)</option>
                        <option value="name_asc" <?php echo $sort == 'name_asc' ? 'selected' : ''; ?>>İsim (A-Z)</option>
                        <option value="name_desc" <?php echo $sort == 'name_desc' ? 'selected' : ''; ?>>İsim (Z-A)</option>
                    </select>
                </div>
                <div class="md:col-span-4 flex justify-end">
                    <button type="submit" 
                            class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-search mr-2"></i>Filtrele
                    </button>
                </div>
                <input type="hidden" name="page" value="1">
            </form>
        </div>

        <!-- Destinasyonlar Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($destinations as $destination): ?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img src="<?php echo htmlspecialchars($destination['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($destination['city']); ?>" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        <?php echo htmlspecialchars($destination['city']); ?>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        <?php echo htmlspecialchars($destination['description']); ?>
                    </p>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-2xl font-bold text-teal-600">
                            <?php echo number_format($destination['price'], 2); ?> ₺
                        </span>
                        <a href="destination-details.php?id=<?php echo $destination['id']; ?>" 
                           class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-colors">
                            Detaylar
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <?php if (empty($destinations)): ?>
            <div class="col-span-full text-center py-8">
                <p class="text-gray-600 text-lg">Aradığınız kriterlere uygun destinasyon bulunamadı.</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sayfalama -->
        <?php if ($total_pages > 1): ?>
        <div class="mt-8 flex justify-center space-x-2">
            <?php if ($current_page > 1): ?>
            <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $current_page - 1])); ?>" 
               class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-chevron-left mr-2"></i>Önceki
            </a>
            <?php endif; ?>

            <?php
            $start_page = max(1, $current_page - 2);
            $end_page = min($total_pages, $current_page + 2);
            
            if ($start_page > 1) {
                echo '<span class="px-4 py-2 text-gray-600">...</span>';
            }
            
            for ($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" 
                   class="px-4 py-2 <?php echo $i === $current_page ? 'bg-teal-600 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50'; ?> rounded-lg transition-colors">
                    <?php echo $i; ?>
                </a>
            <?php endfor;

            if ($end_page < $total_pages) {
                echo '<span class="px-4 py-2 text-gray-600">...</span>';
            }
            ?>

            <?php if ($current_page < $total_pages): ?>
            <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $current_page + 1])); ?>" 
               class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Sonraki<i class="fas fa-chevron-right ml-2"></i>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 