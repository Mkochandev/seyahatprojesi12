<?php
session_start();
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="relative bg-teal-400 text-white py-24">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Hakkımızda</h1>
                <p class="text-xl md:text-2xl opacity-90">Seyahat tutkunları için en iyi deneyimleri sunuyoruz</p>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto">
                <!-- Mission Section -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Misyonumuz</h2>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        TravelGuide olarak misyonumuz, seyahat tutkunlarına unutulmaz deneyimler yaşatmak ve her bütçeye uygun, 
                        kaliteli seyahat seçenekleri sunmaktır. Müşterilerimizin güvenliği ve memnuniyeti bizim için her şeyden önemlidir.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
                            <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-heart text-2xl text-teal-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Müşteri Odaklılık</h3>
                            <p class="text-gray-600">Müşterilerimizin ihtiyaçlarını en iyi şekilde anlıyor ve karşılıyoruz.</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
                            <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-shield-alt text-2xl text-teal-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Güvenilirlik</h3>
                            <p class="text-gray-600">Güvenli ve şeffaf hizmet anlayışıyla çalışıyoruz.</p>
                        </div>
                        <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
                            <div class="w-16 h-16 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-star text-2xl text-teal-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Kalite</h3>
                            <p class="text-gray-600">En yüksek kalitede hizmet sunmayı taahhüt ediyoruz.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Section -->
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Ekibimiz</h2>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        Deneyimli ve tutkulu ekibimiz, sizlere en iyi seyahat deneyimini yaşatmak için çalışıyor.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4">
                                <img src="images/team/team1.jpg" alt="CEO" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Muhammed Koçhan</h3>
                            <p class="text-gray-600">CEO</p>
                        </div>
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4">
                                <img src="images/team/team2.jpg" alt="Operasyon Müdürü" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Kerem Yılmaz</h3>
                            <p class="text-gray-600">Operasyon Müdürü</p>
                        </div>
                        <div class="text-center">
                            <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4">
                                <img src="images/team/team3.jpg" alt="Müşteri İlişkileri" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Barış Burak Tiken</h3>
                            <p class="text-gray-600">Müşteri İlişkileri</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                        <div>
                            <div class="text-4xl font-bold text-teal-400 mb-2">1000+</div>
                            <p class="text-gray-600">Mutlu Müşteri</p>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-teal-400 mb-2">50+</div>
                            <p class="text-gray-600">Destinasyon</p>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-teal-400 mb-2">5</div>
                            <p class="text-gray-600">Yıllık Deneyim</p>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-teal-400 mb-2">4.8</div>
                            <p class="text-gray-600">Müşteri Puanı</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 