<?php
session_start();
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gizlilik Politikası - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="relative bg-teal-400 text-white py-24">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Gizlilik Politikası</h1>
                <p class="text-xl md:text-2xl opacity-90">Verilerinizin güvenliği bizim için önemli</p>
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
                            TravelGuide olarak, gizliliğinize saygı duyuyor ve verilerinizi korumayı taahhüt ediyoruz. 
                            Bu gizlilik politikası, web sitemizi kullanırken toplanan bilgilerin nasıl kullanıldığını 
                            ve korunduğunu açıklamaktadır.
                        </p>
                    </div>

                    <!-- Toplanan Bilgiler -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Toplanan Bilgiler</h2>
                        <div class="space-y-4">
                            <p class="text-gray-600 leading-relaxed">
                                Aşağıdaki bilgileri toplayabiliriz:
                            </p>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>Ad, soyad ve iletişim bilgileri</li>
                                <li>E-posta adresi</li>
                                <li>Telefon numarası</li>
                                <li>Doğum tarihi</li>
                                <li>Ödeme bilgileri</li>
                                <li>IP adresi ve tarayıcı bilgileri</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bilgilerin Kullanımı -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Bilgilerin Kullanımı</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Topladığımız bilgileri aşağıdaki amaçlarla kullanıyoruz:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>Rezervasyon işlemlerini gerçekleştirmek</li>
                            <li>Müşteri hizmetleri sağlamak</li>
                            <li>Yasal yükümlülükleri yerine getirmek</li>
                            <li>Hizmetlerimizi geliştirmek</li>
                            <li>Güvenliği sağlamak</li>
                        </ul>
                    </div>

                    <!-- Bilgi Güvenliği -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Bilgi Güvenliği</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Verilerinizin güvenliği için aşağıdaki önlemleri alıyoruz:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>SSL şifreleme teknolojisi</li>
                            <li>Güvenli veri depolama sistemleri</li>
                            <li>Düzenli güvenlik güncellemeleri</li>
                            <li>Erişim kontrolü ve yetkilendirme</li>
                        </ul>
                    </div>

                    <!-- Çerezler -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Çerezler</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Web sitemiz, kullanıcı deneyimini geliştirmek için çerezler kullanmaktadır. 
                            Çerezler, tarayıcınız tarafından cihazınızda saklanan küçük metin dosyalarıdır. 
                            Çerezleri tarayıcı ayarlarınızdan kontrol edebilir veya silebilirsiniz.
                        </p>
                    </div>

                    <!-- Üçüncü Taraflar -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Üçüncü Taraflarla Bilgi Paylaşımı</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Bilgilerinizi üçüncü taraflarla yalnızca aşağıdaki durumlarda paylaşırız:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>Yasal zorunluluk durumunda</li>
                            <li>Hizmet sağlayıcılarımızla (ödeme işlemcileri gibi)</li>
                            <li>Açık rızanız olması durumunda</li>
                        </ul>
                    </div>

                    <!-- Haklarınız -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Haklarınız</h2>
                        <p class="text-gray-600 leading-relaxed">
                            KVKK kapsamında aşağıdaki haklara sahipsiniz:
                        </p>
                        <ul class="list-disc list-inside text-gray-600 mt-4 space-y-2">
                            <li>Verilerinize erişim hakkı</li>
                            <li>Verilerinizin düzeltilmesini talep etme hakkı</li>
                            <li>Verilerinizin silinmesini talep etme hakkı</li>
                            <li>Veri işlemeye itiraz etme hakkı</li>
                        </ul>
                    </div>

                    <!-- İletişim -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">İletişim</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Gizlilik politikamız hakkında sorularınız için bizimle iletişime geçebilirsiniz:
                        </p>
                        <div class="mt-4 space-y-2">
                            <p class="text-gray-600">E-posta: privacy@travelguide.com</p>
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