<?php
session_start();
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$guide_id = $_GET['id'];
$guides = [
    1 => [
        'title' => 'İstanbul Premium Rehberi',
        'price' => 149,
        'image' => 'images/guides/istanbul-guide.jpg',
        'description' => 'İstanbul\'un gizli kalmış yerlerini, en iyi restoranlarını ve yerel ipuçlarını keşfedin.',
        'features' => [
            'En iyi fotoğraf noktaları',
            'Yerel restoranlar ve kafeler',
            'Gizli turistik yerler',
            'Ulaşım tavsiyeleri',
            'Konaklama önerileri',
            'Alışveriş rehberi'
        ]
    ],
    2 => [
        'title' => 'Kapadokya Premium Rehberi',
        'price' => 129,
        'image' => 'images/guides/cappadocia-guide.jpg',
        'description' => 'Kapadokya\'nın en güzel balon turları, butik otelleri ve gizli vadileri hakkında detaylı bilgiler.',
        'features' => [
            'En iyi balon turları',
            'Butik mağara oteller',
            'Gizli vadiler',
            'Yerel lezzetler',
            'Fotoğraf rotaları',
            'Aktivite önerileri'
        ]
    ],
    3 => [
        'title' => 'Ege Premium Rehberi',
        'price' => 169,
        'image' => 'images/guides/aegean-guide.jpg',
        'description' => 'Ege\'nin en güzel koyları, antik kentleri ve yerel lezzetleri hakkında kapsamlı bilgiler.',
        'features' => [
            'En güzel koylar',
            'Antik kentler',
            'Yerel mutfak',
            'Tekne turları',
            'Plaj rehberi',
            'Gezi rotaları'
        ]
    ]
];

if (!isset($guides[$guide_id])) {
    header("Location: index.php");
    exit();
}

$guide = $guides[$guide_id];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $guide['title']; ?> - Seyahat Projesi</title>
    <link href="dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <?php include 'includes/header.php'; ?>

    <main class="flex-grow">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                <!-- Sol Taraf - Görsel ve Açıklama -->
                <div>
                    <img src="<?php echo $guide['image']; ?>" alt="<?php echo $guide['title']; ?>" class="w-full h-96 object-cover rounded-lg shadow-lg">
                    <div class="mt-8 prose prose-indigo">
                        <h1 class="text-3xl font-extrabold text-gray-900"><?php echo $guide['title']; ?></h1>
                        <p class="mt-4 text-lg text-gray-600"><?php echo $guide['description']; ?></p>
                    </div>
                </div>

                <!-- Sağ Taraf - Özellikler ve Satın Alma -->
                <div class="mt-8 lg:mt-0">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Rehber İçeriği</h2>
                        <ul class="space-y-4">
                            <?php foreach ($guide['features'] as $feature): ?>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-700"><?php echo $feature; ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="mt-8">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-3xl font-bold text-indigo-600"><?php echo $guide['price']; ?>₺</span>
                                <span class="text-sm text-gray-500">Tek seferlik ödeme</span>
                            </div>
                            <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="checkout.php?type=guide&id=<?php echo $guide_id; ?>" class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Hemen Satın Al
                            </a>
                            <?php else: ?>
                            <a href="login.php" class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Satın Almak İçin Giriş Yapın
                            </a>
                            <?php endif; ?>
                            <p class="mt-4 text-sm text-gray-500 text-center">
                                <i class="fas fa-lock mr-1"></i>
                                Güvenli ödeme sistemi
                            </p>
                        </div>
                    </div>

                    <!-- Bonus İçerik -->
                    <div class="mt-8 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
                        <h3 class="text-xl font-semibold mb-4">Bonus İçerikler</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-gift mr-3"></i>
                                <span>Özel indirim kuponları</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-map-marked-alt mr-3"></i>
                                <span>Özel rota haritaları</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-mobile-alt mr-3"></i>
                                <span>Mobil uygulama erişimi</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html> 