<?php
session_start();
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanım Şartları - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="relative bg-teal-400 text-white py-24">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Kullanım Şartları</h1>
                <p class="text-xl md:text-2xl opacity-90">Hizmetlerimizi kullanırken uymanız gereken kurallar</p>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8 space-y-8">
                    <!-- Giriş -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Giriş</h2>
                        <p class="text-gray-600 leading-relaxed">
                            TravelGuide web sitesini kullanarak aşağıdaki kullanım şartlarını kabul etmiş olursunuz. 
                            Bu şartları dikkatlice okumanızı ve anlamanızı öneririz. Site hizmetlerini kullanmaya 
                            devam etmeniz, bu şartları kabul ettiğiniz anlamına gelir.
                        </p>
                    </div>

                    <!-- Hesap Oluşturma -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Hesap Oluşturma ve Kullanımı</h2>
                        <div class="space-y-4">
                            <p class="text-gray-600 leading-relaxed">
                                Sitemizde hesap oluşturabilmek için:
                            </p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>18 yaşından büyük olmalısınız</li>
                                <li>Gerçek ve doğru bilgiler vermelisiniz</li>
                                <li>Hesap güvenliğinizden siz sorumlusunuz</li>
                                <li>Hesabınızı başkalarıyla paylaşmamalısınız</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Rezervasyon Kuralları -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Rezervasyon Kuralları</h2>
                        <div class="space-y-4">
                            <p class="text-gray-600 leading-relaxed">
                                Rezervasyon yaparken aşağıdaki kurallara uymanız gerekmektedir:
                            </p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>Rezervasyon bilgilerinin doğruluğundan siz sorumlusunuz</li>
                                <li>İptal ve değişiklik politikalarına uymalısınız</li>
                                <li>Ödeme şartlarına uygun hareket etmelisiniz</li>
                                <li>Rezervasyon onayı almadan seyahat planı yapmamalısınız</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Ödeme Şartları -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Ödeme Şartları</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Ödemeler konusunda aşağıdaki kurallar geçerlidir:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>Tüm ödemeler güvenli ödeme sistemleri üzerinden yapılır</li>
                            <li>Fiyatlar ve vergiler rezervasyon sırasında belirtilir</li>
                            <li>İptal durumunda iade politikalarımız geçerlidir</li>
                            <li>Ödeme bilgilerinizin güvenliğinden biz sorumluyuz</li>
                        </ul>
                    </div>

                    <!-- İptal ve İade -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">İptal ve İade Politikası</h2>
                        <p class="text-gray-600 leading-relaxed">
                            İptal ve iade durumlarında aşağıdaki kurallar geçerlidir:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>Rezervasyondan 48 saat öncesine kadar ücretsiz iptal</li>
                            <li>48 saatten kısa sürede iptal durumunda ceza uygulanır</li>
                            <li>İadeler 5-10 iş günü içinde yapılır</li>
                            <li>Mücbir sebep durumlarında özel şartlar uygulanır</li>
                        </ul>
                    </div>

                    <!-- Yasaklı Davranışlar -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Yasaklı Davranışlar</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Aşağıdaki davranışlar kesinlikle yasaktır:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>Sahte rezervasyon yapmak</li>
                            <li>Sistemin güvenliğini tehdit etmek</li>
                            <li>Başkalarının hesaplarını kullanmak</li>
                            <li>Yanıltıcı bilgi vermek</li>
                            <li>Siteye zarar vermeye çalışmak</li>
                        </ul>
                    </div>

                    <!-- Sorumluluk Reddi -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Sorumluluk Reddi</h2>
                        <p class="text-gray-600 leading-relaxed">
                            TravelGuide aşağıdaki durumlarda sorumluluk kabul etmez:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>Doğal afetler ve mücbir sebepler</li>
                            <li>Üçüncü taraf hizmet sağlayıcıların hataları</li>
                            <li>Kullanıcı hatalarından kaynaklanan sorunlar</li>
                            <li>İnternet bağlantısı kaynaklı problemler</li>
                        </ul>
                    </div>

                    <!-- Değişiklikler -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Şartlarda Değişiklik</h2>
                        <p class="text-gray-600 leading-relaxed">
                            TravelGuide, bu kullanım şartlarını önceden haber vermeksizin değiştirme hakkını saklı tutar. 
                            Değişiklikler sitede yayınlandığı anda yürürlüğe girer. Siteyi kullanmaya devam etmeniz, 
                            güncellenmiş şartları kabul ettiğiniz anlamına gelir.
                        </p>
                    </div>

                    <!-- İletişim -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">İletişim</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Kullanım şartları hakkında sorularınız için bizimle iletişime geçebilirsiniz:
                        </p>
                        <div class="mt-4 space-y-2">
                            <p class="text-gray-600">E-posta: terms@travelguide.com</p>
                            <p class="text-gray-600">Telefon: +90 (212) 123 45 67</p>
                            <p class="text-gray-600">Adres: Atatürk Cad. No:123, Şişli, İstanbul</p>
                        </div>
                    </div>

                    <!-- Son Güncelleme -->
                    <div class="pt-8 border-t border-gray-200">
                        <p class="text-gray-500 text-sm">
                            Son güncelleme tarihi: <?php echo date('d.m.Y'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 