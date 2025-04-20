<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="index.php" class="flex items-center space-x-2">
                <span class="text-2xl font-bold text-teal-400">TravelGuide</span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="index.php" class="text-gray-600 hover:text-teal-400 transition-colors">Ana Sayfa</a>
                <a href="destinations.php" class="text-gray-600 hover:text-teal-400 transition-colors">Destinasyonlar</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="my-bookings.php" class="text-gray-600 hover:text-teal-400 transition-colors">Rezervasyonlarım</a>
                    <a href="profile.php" class="text-gray-600 hover:text-teal-400 transition-colors">Profilim</a>
                    <a href="logout.php" class="px-6 py-2 bg-teal-400 text-white rounded-full hover:bg-teal-500 transition-colors">Çıkış Yap</a>
                <?php else: ?>
                    <a href="login.php" class="text-gray-600 hover:text-teal-400 transition-colors">Giriş Yap</a>
                    <a href="register.php" class="px-6 py-2 bg-teal-400 text-white rounded-full hover:bg-teal-500 transition-colors">Üye Ol</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-gray-600 hover:text-teal-400 focus:outline-none" id="mobile-menu-button">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="flex flex-col space-y-4 mt-4 pb-4">
                <a href="index.php" class="text-gray-600 hover:text-teal-400 transition-colors">Ana Sayfa</a>
                <a href="destinations.php" class="text-gray-600 hover:text-teal-400 transition-colors">Destinasyonlar</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="my-bookings.php" class="text-gray-600 hover:text-teal-400 transition-colors">Rezervasyonlarım</a>
                    <a href="profile.php" class="text-gray-600 hover:text-teal-400 transition-colors">Profilim</a>
                    <a href="logout.php" class="px-6 py-2 bg-teal-400 text-white rounded-full hover:bg-teal-500 transition-colors inline-block text-center">Çıkış Yap</a>
                <?php else: ?>
                    <a href="login.php" class="text-gray-600 hover:text-teal-400 transition-colors">Giriş Yap</a>
                    <a href="register.php" class="px-6 py-2 bg-teal-400 text-white rounded-full hover:bg-teal-500 transition-colors inline-block text-center">Üye Ol</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>