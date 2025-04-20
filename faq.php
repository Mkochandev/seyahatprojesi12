<?php
session_start();
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sık Sorulan Sorular - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="relative bg-teal-400 text-white py-24">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Sık Sorulan Sorular</h1>
                <p class="text-xl md:text-2xl opacity-90">Merak ettiğiniz her şeyin cevabı burada</p>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-4xl mx-auto">
                <!-- FAQ Categories -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <button class="bg-white p-6 rounded-2xl shadow-lg text-center hover:bg-teal-50 transition-colors">
                        <div class="w-12 h-12 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-ticket-alt text-xl text-teal-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Rezervasyonlar</h3>
                    </button>
                    <button class="bg-white p-6 rounded-2xl shadow-lg text-center hover:bg-teal-50 transition-colors">
                        <div class="w-12 h-12 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-money-bill-wave text-xl text-teal-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Ödemeler</h3>
                    </button>
                    <button class="bg-white p-6 rounded-2xl shadow-lg text-center hover:bg-teal-50 transition-colors">
                        <div class="w-12 h-12 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-circle text-xl text-teal-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Hesap</h3>
                    </button>
                </div>

                <!-- FAQ Items -->
                <div class="space-y-6">
                    <!-- Rezervasyonlar -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-2xl font-bold text-gray-800">Rezervasyonlar</h2>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer">
                                    <h3 class="text-lg font-semibold text-gray-800">Nasıl rezervasyon yapabilirim?</h3>
                                    <span class="ml-6 flex-shrink-0">
                                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                                    </span>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-gray-600">
                                        Rezervasyon yapmak için öncelikle hesabınıza giriş yapmanız gerekmektedir. 
                                        Ardından istediğiniz destinasyonu seçip, tarih ve kişi sayısını belirleyerek 
                                        rezervasyon işleminizi tamamlayabilirsiniz.
                                    </p>
                                </div>
                            </details>
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer">
                                    <h3 class="text-lg font-semibold text-gray-800">Rezervasyonumu nasıl iptal edebilirim?</h3>
                                    <span class="ml-6 flex-shrink-0">
                                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                                    </span>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-gray-600">
                                        Rezervasyonunuzu iptal etmek için profilinizden rezervasyonlarınıza gidip, 
                                        ilgili rezervasyonun yanındaki "İptal Et" butonuna tıklayabilirsiniz. 
                                        İptal koşulları ve iade politikası hakkında detaylı bilgi için müşteri hizmetlerimizle 
                                        iletişime geçebilirsiniz.
                                    </p>
                                </div>
                            </details>
                        </div>
                    </div>

                    <!-- Ödemeler -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-2xl font-bold text-gray-800">Ödemeler</h2>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer">
                                    <h3 class="text-lg font-semibold text-gray-800">Hangi ödeme yöntemlerini kullanabilirim?</h3>
                                    <span class="ml-6 flex-shrink-0">
                                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                                    </span>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-gray-600">
                                        Kredi kartı, banka kartı ve havale/EFT ile ödeme yapabilirsiniz. 
                                        Tüm ödemeleriniz 256-bit SSL sertifikası ile güvence altındadır.
                                    </p>
                                </div>
                            </details>
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer">
                                    <h3 class="text-lg font-semibold text-gray-800">Taksitli ödeme yapabilir miyim?</h3>
                                    <span class="ml-6 flex-shrink-0">
                                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                                    </span>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-gray-600">
                                        Evet, anlaşmalı bankaların kredi kartları ile 3, 6 ve 9 taksit seçeneklerinden 
                                        faydalanabilirsiniz. Taksit seçenekleri ödeme sayfasında görüntülenecektir.
                                    </p>
                                </div>
                            </details>
                        </div>
                    </div>

                    <!-- Hesap -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-2xl font-bold text-gray-800">Hesap</h2>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer">
                                    <h3 class="text-lg font-semibold text-gray-800">Şifremi nasıl değiştirebilirim?</h3>
                                    <span class="ml-6 flex-shrink-0">
                                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                                    </span>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-gray-600">
                                        Profilinize giriş yaptıktan sonra "Şifre Değiştir" bölümünden şifrenizi güncelleyebilirsiniz. 
                                        Şifrenizi unuttuysanız, giriş sayfasındaki "Şifremi Unuttum" linkini kullanabilirsiniz.
                                    </p>
                                </div>
                            </details>
                            <details class="group">
                                <summary class="flex items-center justify-between p-6 cursor-pointer">
                                    <h3 class="text-lg font-semibold text-gray-800">Hesabımı nasıl silebilirim?</h3>
                                    <span class="ml-6 flex-shrink-0">
                                        <i class="fas fa-chevron-down text-gray-400 group-open:rotate-180 transition-transform"></i>
                                    </span>
                                </summary>
                                <div class="px-6 pb-6">
                                    <p class="text-gray-600">
                                        Hesabınızı silmek için müşteri hizmetlerimizle iletişime geçmeniz gerekmektedir. 
                                        Hesap silme işlemi geri alınamaz ve tüm verileriniz kalıcı olarak silinir.
                                    </p>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="mt-12 text-center">
                    <p class="text-gray-600 mb-4">Sorunuza cevap bulamadınız mı?</p>
                    <a href="contact.php" 
                       class="inline-block px-6 py-3 bg-teal-400 text-white font-semibold rounded-lg hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition-colors">
                        Bize Ulaşın
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <style>
        details > summary::-webkit-details-marker {
            display: none;
        }
    </style>
</body>
</html> 