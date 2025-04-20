<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Kullanıcının satın aldığı rehberleri getir
$stmt = $conn->prepare("
    SELECT g.*, r.purchase_date 
    FROM guides g 
    JOIN reservations r ON g.id = r.guide_id 
    WHERE r.user_id = ? 
    ORDER BY r.purchase_date DESC
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$guides = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehberlerim - Gezi Rehberi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <?php include 'header.php'; ?>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Rehberlerim</h1>
            
            <?php if (empty($guides)): ?>
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <p class="text-gray-600 dark:text-gray-300">Henüz hiç rehber satın almadınız.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($guides as $guide): ?>
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                            <img src="<?php echo htmlspecialchars($guide['image_url']); ?>" alt="<?php echo htmlspecialchars($guide['title']); ?>" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                    <?php echo htmlspecialchars($guide['title']); ?>
                                </h2>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    <?php echo htmlspecialchars($guide['description']); ?>
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        Satın Alınma: <?php echo date('d.m.Y', strtotime($guide['purchase_date'])); ?>
                                    </span>
                                    <a href="guide-detail.php?id=<?php echo $guide['id']; ?>" 
                                       class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                                        Rehberi Görüntüle
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 