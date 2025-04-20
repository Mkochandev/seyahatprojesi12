<?php
session_start();
require_once 'includes/config.php';

// En popüler destinasyonları getir
$stmt = $conn->prepare("SELECT * FROM destinations LIMIT 6");
$stmt->execute();
$popular_destinations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// İstatistikleri getir
$stats = [
    'destinations' => $conn->query("SELECT COUNT(*) as count FROM destinations")->fetch_assoc()['count'],
    'users' => $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'],
    'bookings' => $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count']
];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGuide - Unutulmaz Seyahat Deneyimleri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-white">
    <?php include 'header.php'; ?>
    <div class="w-full border-b border-gray-200"></div>

    <!-- Hero Section -->
    <section class="relative h-[600px] flex items-center justify-center">
        <div class="absolute inset-0">
            <img src="images/hero.jpg" alt="Hero Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/30"></div>
        </div>
        <div class="relative container mx-auto px-4 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Hayalinizdeki Tatili Keşfedin</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">En iyi fiyatlarla unutulmaz tatil deneyimleri için doğru adrestesiniz.</p>
            <div class="flex justify-center space-x-4">
                <a href="destinations.php" class="px-8 py-3 bg-teal-400 text-white rounded-full hover:bg-teal-500 transition-colors text-lg font-semibold">
                    Turları Keşfet
                </a>
                <a href="#about" class="px-8 py-3 bg-white text-gray-800 rounded-full hover:bg-gray-100 transition-colors text-lg font-semibold">
                    Daha Fazla Bilgi
                </a>
            </div>
        </div>
    </section>

    <!-- Partner Logos -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-center items-center space-x-12">
                <img src="images/partner1.jpg" alt="Partner 1" class="h-13 w-22 opacity-50 hover:opacity-100 transition-opacity">
                <img src="images/partner2.jpg" alt="Partner 2" class="h-12 w-22 opacity-50 hover:opacity-100 transition-opacity">
             
            </div>
        </div>
    </section>

    <!-- Popular Destinations -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Popüler Destinasyonlar</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">En çok tercih edilen destinasyonlarımızı keşfedin ve unutulmaz bir yolculuğa çıkın.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($popular_destinations as $destination): ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
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
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-teal-400">
                                <?php echo number_format($destination['price'], 2); ?> ₺
                            </span>
                            <a href="destination-details.php?id=<?php echo $destination['id']; ?>" 
                               class="px-4 py-2 bg-teal-400 text-white rounded-lg hover:bg-teal-500 transition-colors">
                                Detayları Gör
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-12">
                <a href="destinations.php" 
                   class="inline-block px-8 py-3 bg-teal-400 text-white rounded-full hover:bg-teal-500 transition-colors text-lg font-semibold">
                    Tüm Destinasyonları Gör
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Nasıl Çalışır?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Bu basit adımlarla mükemmel seyahatinizi planlayın.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-teal-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Destinasyon Seçin</h3>
                    <p class="text-gray-600">Özenle seçilmiş destinasyonlarımız arasından size en uygun olanı bulun.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-teal-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Rezervasyon Yapın</h3>
                    <p class="text-gray-600">Tercih ettiğiniz tarihleri seçin ve birkaç tıklamayla rezervasyonunuzu tamamlayın.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-teal-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-plane-departure text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Maceraya Başlayın</h3>
                    <p class="text-gray-600">Bavulunuzu hazırlayın ve unutulmaz bir deneyime hazır olun.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-teal-400 mb-2"><?php echo $stats['destinations']; ?>+</div>
                    <p class="text-gray-600">Destinasyon</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-teal-400 mb-2"><?php echo $stats['users']; ?>+</div>
                    <p class="text-gray-600">Mutlu Gezgin</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-teal-400 mb-2"><?php echo $stats['bookings']; ?>+</div>
                    <p class="text-gray-600">Başarılı Tur</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials Section -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Müşterilerimiz Ne Diyor?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                            <img src="images/profile1.jpg" alt="Ömer Can Atalamış" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Ömer Can Atalamış</h3>
                            <p class="text-gray-600">İstanbul</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Antalya'da harika bir tatil yaptık. Rezervasyon süreci çok kolaydı ve müşteri hizmetleri her konuda yardımcı oldu. Kesinlikle tekrar tercih edeceğim."
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                            <img src="images/profile2.jpg" alt="Emirhan Tunga Yumurtaoğlu" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Emirhan Tunga Yumurtaoğlu</h3>
                            <p class="text-gray-600">Ankara</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Kapadokya balon turu için rezervasyon yaptık. Her şey mükemmeldi! Özellikle gün doğumu manzarası unutulmazdı. Emeği geçen herkese teşekkürler."
                    </p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                            <img src="images/profile3.jpg" alt="Orhan Ecemiş" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Orhan Ecemiş</h3>
                            <p class="text-gray-600">İzmir</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        "Bodrum'da muhteşem bir hafta sonu geçirdik. Otel seçimi ve transfer hizmetleri çok iyiydi. Fiyat/performans açısından çok memnun kaldık."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Bültenimize Abone Olun</h2>
                <p class="text-gray-600 mb-8">En güncel turlarımız ve özel tekliflerimizden haberdar olun.</p>
                <form class="flex max-w-md mx-auto">
                    <input type="email" placeholder="E-posta adresinizi girin" 
                           class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded-l-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                    <button type="submit" 
                            class="px-6 py-3 bg-teal-400 text-white rounded-r-lg hover:bg-teal-500 transition-colors">
                        Abone Ol
                    </button>
                </form>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>