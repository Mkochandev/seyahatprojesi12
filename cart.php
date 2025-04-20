<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_query = "SELECT c.*, d.city, d.description, d.price, d.image_url 
               FROM cart c 
               JOIN destinations d ON c.destination_id = d.id 
               WHERE c.user_id = ?";
$stmt = $conn->prepare($cart_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim - Gezi Rehberi</title>
    <link rel="stylesheet" href="dist/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="pt-16 bg-[#D0C7B6]/10">
    <?php include 'header.php'; ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-[#101D23] mb-8">Sepetim</h1>

        <?php if ($cart_items->num_rows > 0): ?>
            <div class="grid grid-cols-1 gap-6">
                <?php 
                $total = 0;
                while($item = $cart_items->fetch_assoc()): 
                    $total += $item['price'];
                ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="flex items-center p-6">
                        <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['city']; ?>" class="w-32 h-32 object-cover rounded-lg">
                        <div class="ml-6 flex-1">
                            <h3 class="text-xl font-semibold text-[#101D23]"><?php echo $item['city']; ?></h3>
                            <p class="text-[#101D23]/70 mt-2"><?php echo $item['description']; ?></p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-2xl font-bold text-[#D85128]"><?php echo number_format($item['price'], 2); ?>₺</span>
                                <form action="remove_from_cart.php" method="POST" class="inline">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                        <i class="fas fa-trash mr-2"></i>
                                        Sepetten Çıkar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>

                <div class="bg-white rounded-lg shadow-lg p-6 mt-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg text-[#101D23]/70">Toplam Tutar:</p>
                            <p class="text-3xl font-bold text-[#D85128]"><?php echo number_format($total, 2); ?>₺</p>
                        </div>
                        <a href="checkout.php" class="px-8 py-3 bg-[#D85128] text-white rounded-lg hover:bg-[#D85128]/80 transition-colors duration-200">
                            Ödemeye Geç
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <i class="fas fa-shopping-cart text-6xl text-[#101D23]/30 mb-4"></i>
                <p class="text-xl text-[#101D23]/70">Sepetiniz boş</p>
                <a href="index.php" class="inline-block mt-4 px-6 py-3 bg-[#D85128] text-white rounded-lg hover:bg-[#D85128]/80 transition-colors duration-200">
                    Destinasyonları Keşfet
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
