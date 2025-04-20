<?php
require_once 'includes/config.php';
?>
<footer class="bg-gray-50 border-t border-gray-100">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-teal-400">TravelGuide</h3>
                <p class="text-gray-600">Unutulmaz seyahat deneyimleri için yanınızdayız.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-800">Hızlı Bağlantılar</h4>
                <ul class="space-y-2">
                    <li><a href="about.php" class="text-gray-600 hover:text-teal-400 transition-colors">Hakkımızda</a></li>
                    <li><a href="destinations.php" class="text-gray-600 hover:text-teal-400 transition-colors">Destinasyonlar</a></li>
                    <li><a href="contact.php" class="text-gray-600 hover:text-teal-400 transition-colors">İletişim</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-800">Destek</h4>
                <ul class="space-y-2">
                    <li><a href="faq.php" class="text-gray-600 hover:text-teal-400 transition-colors">Sık Sorulan Sorular</a></li>
                    <li><a href="privacy.php" class="text-gray-600 hover:text-teal-400 transition-colors">Gizlilik Politikası</a></li>
                    <li><a href="terms.php" class="text-gray-600 hover:text-teal-400 transition-colors">Kullanım Şartları</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-800">Bülten</h4>
                <p class="text-gray-600">En güncel seyahat fırsatları için abone olun.</p>
                <form class="flex">
                    <input type="email" placeholder="E-posta adresiniz" 
                           class="flex-1 px-4 py-2 bg-white border border-gray-200 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                    <button type="submit" 
                            class="px-6 py-2 bg-teal-400 text-white rounded-r-lg hover:bg-teal-500 transition-colors">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200">
            <p class="text-center text-gray-600">
                &copy; <?php echo date('Y'); ?> TravelGuide. Tüm hakları saklıdır.
            </p>
        </div>
    </div>
</footer>
</body>
</html>