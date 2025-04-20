<?php
session_start();
require_once 'includes/config.php';

// Kullanıcı girişi kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// POST verilerini kontrol et
if (!isset($_POST['destination_id'], $_POST['booking_date'], $_POST['number_of_people'])) {
    header('Location: destinations.php');
    exit;
}

$destination_id = $_POST['destination_id'];
$booking_date = $_POST['booking_date'];
$number_of_people = (int)$_POST['number_of_people'];

// Destinasyon bilgilerini al
$stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->bind_param("i", $destination_id);
$stmt->execute();
$destination = $stmt->get_result()->fetch_assoc();

if (!$destination) {
    header('Location: destinations.php');
    exit;
}

// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_booking'])) {
    try {
        // Ana rezervasyon kaydını oluştur
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, destination_id, booking_date, number_of_people, total_price, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        $total_price = $destination['price'] * $number_of_people;
        $stmt->bind_param("iisid", $_SESSION['user_id'], $destination_id, $booking_date, $number_of_people, $total_price);
        $stmt->execute();
        $booking_id = $conn->insert_id;

        // Yolcu bilgilerini kaydet
        $stmt = $conn->prepare("INSERT INTO passengers (booking_id, name, surname, identity_number, phone, email, birth_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        for ($i = 1; $i <= $number_of_people; $i++) {
            $name = $_POST["name_$i"];
            $surname = $_POST["surname_$i"];
            $identity = $_POST["identity_$i"];
            $phone = $_POST["phone_$i"];
            $email = $_POST["email_$i"];
            $birth_date = $_POST["birth_date_$i"];
            
            $stmt->bind_param("issssss", $booking_id, $name, $surname, $identity, $phone, $email, $birth_date);
            $stmt->execute();
        }

        // Başarılı kayıt sonrası yönlendirme
        header('Location: profile.php?booking_success=1');
        exit;
    } catch (Exception $e) {
        $error_message = 'Rezervasyon oluşturulurken bir hata oluştu. Lütfen daha sonra tekrar deneyin.';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervasyon Bilgileri - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/tr.js"></script>
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    
    <div class="min-h-screen container mx-auto px-4 py-24">
        <?php if (isset($error_message)): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-8" role="alert">
            <span class="block sm:inline"><?php echo $error_message; ?></span>
        </div>
        <?php endif; ?>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8 mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Rezervasyon Bilgileri</h1>
                
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="space-y-2">
                        <p class="text-gray-600">Destinasyon:</p>
                        <p class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($destination['city']); ?></p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600">Tarih:</p>
                        <p class="text-lg font-semibold text-gray-800"><?php echo $booking_date; ?></p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600">Kişi Sayısı:</p>
                        <p class="text-lg font-semibold text-gray-800"><?php echo $number_of_people; ?> kişi</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600">Toplam Tutar:</p>
                        <p class="text-lg font-semibold text-teal-600">
                            <?php echo number_format($destination['price'] * $number_of_people, 2); ?> ₺
                        </p>
                    </div>
                </div>
            </div>

            <form method="POST" class="space-y-8">
                <input type="hidden" name="submit_booking" value="1">
                <input type="hidden" name="destination_id" value="<?php echo htmlspecialchars($destination_id); ?>">
                <input type="hidden" name="booking_date" value="<?php echo htmlspecialchars($booking_date); ?>">
                <input type="hidden" name="number_of_people" value="<?php echo htmlspecialchars($number_of_people); ?>">
                
                <?php for ($i = 1; $i <= $number_of_people; $i++): ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6"><?php echo $i; ?>. Yolcu Bilgileri</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name_<?php echo $i; ?>" class="block text-sm font-medium text-gray-700 mb-2">Ad</label>
                            <input type="text" id="name_<?php echo $i; ?>" name="name_<?php echo $i; ?>" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="surname_<?php echo $i; ?>" class="block text-sm font-medium text-gray-700 mb-2">Soyad</label>
                            <input type="text" id="surname_<?php echo $i; ?>" name="surname_<?php echo $i; ?>" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="identity_<?php echo $i; ?>" class="block text-sm font-medium text-gray-700 mb-2">T.C. Kimlik No</label>
                            <input type="text" id="identity_<?php echo $i; ?>" name="identity_<?php echo $i; ?>" required
                                   pattern="[0-9]{11}" maxlength="11"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="birth_date_<?php echo $i; ?>" class="block text-sm font-medium text-gray-700 mb-2">Doğum Tarihi</label>
                            <input type="text" id="birth_date_<?php echo $i; ?>" name="birth_date_<?php echo $i; ?>" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="phone_<?php echo $i; ?>" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                            <input type="tel" id="phone_<?php echo $i; ?>" name="phone_<?php echo $i; ?>" required
                                   pattern="[0-9]{10}" maxlength="10"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="email_<?php echo $i; ?>" class="block text-sm font-medium text-gray-700 mb-2">E-posta</label>
                            <input type="email" id="email_<?php echo $i; ?>" name="email_<?php echo $i; ?>" required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        </div>
                    </div>
                </div>
                <?php endfor; ?>

                <div class="flex justify-end space-x-4">
                    <a href="javascript:history.back()" 
                       class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-colors">
                        Geri Dön
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-teal-400 text-white font-semibold rounded-lg hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 transition-colors">
                        Rezervasyonu Tamamla
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        // Doğum tarihi için flatpickr
        document.querySelectorAll('input[id^="birth_date_"]').forEach(input => {
            flatpickr(input, {
                locale: "tr",
                dateFormat: "Y-m-d",
                maxDate: new Date(),
                disableMobile: true
            });
        });
    </script>
</body>
</html> 