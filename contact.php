<?php
session_start();
require_once 'includes/config.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = 'Lütfen tüm alanları doldurun.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Lütfen geçerli bir e-posta adresi girin.';
    } else {
        // Burada e-posta gönderme işlemi yapılabilir
        $success_message = 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="relative bg-teal-400 text-white py-24">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">İletişim</h1>
                <p class="text-xl md:text-2xl opacity-90">Sizden haber almayı çok isteriz</p>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-6xl mx-auto">
                <?php if ($success_message): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8" role="alert">
                    <p class="font-medium"><?php echo $success_message; ?></p>
                </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-8" role="alert">
                    <p class="font-medium"><?php echo $error_message; ?></p>
                </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Contact Information -->
                    <div class="lg:col-span-1 space-y-8">
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">İletişim Bilgileri</h2>
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-teal-50 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-xl text-teal-400"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Adres</h3>
                                        <p class="text-gray-600">Atatürk Cad. No:123<br>Şişli, İstanbul</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-teal-50 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-phone text-xl text-teal-400"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Telefon</h3>
                                        <p class="text-gray-600">+90 (212) 123 45 67</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-teal-50 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-envelope text-xl text-teal-400"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 mb-1">E-posta</h3>
                                        <p class="text-gray-600">info@travelguide.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Çalışma Saatleri</h2>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pazartesi - Cuma</span>
                                    <span class="text-gray-800 font-medium">09:00 - 18:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Cumartesi</span>
                                    <span class="text-gray-800 font-medium">10:00 - 14:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pazar</span>
                                    <span class="text-gray-800 font-medium">Kapalı</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Bize Ulaşın</h2>
                            <form method="POST" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Adınız Soyadınız</label>
                                        <input type="text" id="name" name="name" required
                                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-posta Adresiniz</label>
                                        <input type="email" id="email" name="email" required
                                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                                    </div>
                                </div>
                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Konu</label>
                                    <input type="text" id="subject" name="subject" required
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mesajınız</label>
                                    <textarea id="message" name="message" rows="6" required
                                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent"></textarea>
                                </div>
                                <button type="submit"
                                        class="w-full px-6 py-4 bg-teal-400 text-white font-semibold rounded-lg hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition-colors">
                                    Mesaj Gönder
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="mt-16">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Konum</h2>
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3008.443816959558!2d28.987875815415827!3d41.03797497929828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab7650656bd63%3A0x8ca058b28c20b6c3!2zxZ5pxZ9saSwgxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1625764428050!5m2!1str!2str"
                                    class="w-full h-[400px] rounded-lg" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 