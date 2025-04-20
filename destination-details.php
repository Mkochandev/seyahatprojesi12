<?php
session_start();
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    header('Location: destinations.php');
    exit;
}

$destination_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->bind_param("i", $destination_id);
$stmt->execute();
$destination = $stmt->get_result()->fetch_assoc();

if (!$destination) {
    header('Location: destinations.php');
    exit;
}

// Varsayılan değerleri ayarla
$destination['min_people'] = $destination['min_people'] ?? 1;
$destination['rating'] = $destination['rating'] ?? 0;
$destination['duration'] = $destination['duration'] ?? 'Günübirlik';

// Rezervasyon işlemi
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $booking_date = $_POST['booking_date'];
    $number_of_people = (int)$_POST['number_of_people'];
    $total_price = $destination['price'] * $number_of_people;

    try {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, destination_id, booking_date, number_of_people, total_price, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("iisid", $user_id, $destination_id, $booking_date, $number_of_people, $total_price);
        
        if ($stmt->execute()) {
            $success_message = 'Rezervasyonunuz başarıyla alındı! Onay bekliyor.';
        } else {
            $error_message = 'Rezervasyon oluşturulurken bir hata oluştu.';
        }
    } catch (Exception $e) {
        $error_message = 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.';
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($destination['city']); ?> - TravelGuide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/tr.js"></script>
    <style>
        .flatpickr-calendar {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .flatpickr-day.selected {
            background: #2DD4BF !important;
            border-color: #2DD4BF !important;
        }
        .flatpickr-day.today {
            border-color: #2DD4BF !important;
        }
        .flatpickr-day:hover {
            background: #CCFBF1 !important;
            border-color: #CCFBF1 !important;
        }
        .flatpickr-months .flatpickr-prev-month:hover svg,
        .flatpickr-months .flatpickr-next-month:hover svg {
            fill: #2DD4BF !important;
        }
        .flatpickr-current-month {
            color: #1F2937;
        }
        .flatpickr-weekday {
            color: #4B5563;
        }
        .flatpickr-day {
            color: #1F2937;
        }
        .flatpickr-day.flatpickr-disabled {
            color: #9CA3AF !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php include 'header.php'; ?>
    <div class="w-full border-b border-gray-200"></div>

    <div class="min-h-screen container mx-auto px-4 py-24">
        <?php if ($success_message): ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8" role="alert">
            <span class="block sm:inline"><?php echo $success_message; ?></span>
        </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-8" role="alert">
            <span class="block sm:inline"><?php echo $error_message; ?></span>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Destinasyon Detayları -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="<?php echo htmlspecialchars($destination['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($destination['city']); ?>" 
                     class="w-full h-96 object-cover">
                <div class="p-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        <?php echo htmlspecialchars($destination['city']); ?>
                    </h1>
                    <div class="flex items-center mb-6">
                        <span class="text-3xl font-bold text-teal-600">
                            <?php echo number_format($destination['price'], 2); ?> ₺
                        </span>
                        <span class="text-gray-600 ml-2">/ kişi başı</span>
                    </div>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($destination['description'])); ?>
                    </p>
                    <div class="grid grid-cols-2 gap-6 text-gray-600">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-teal-600 text-xl"></i>
                            <span><?php echo htmlspecialchars($destination['city']); ?></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-clock text-teal-600 text-xl"></i>
                            <span><?php echo htmlspecialchars($destination['duration']); ?> gün</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-users text-teal-600 text-xl"></i>
                            <span>Min. <?php echo htmlspecialchars($destination['min_people']); ?> kişi</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-star text-teal-600 text-xl"></i>
                            <span><?php echo number_format($destination['rating'], 1); ?>/5.0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rezervasyon Formu -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Rezervasyon Yap</h2>
                <?php if (isset($_SESSION['user_id'])): ?>
                <form method="POST" action="booking-form.php" class="space-y-6">
                    <input type="hidden" name="destination_id" value="<?php echo $destination_id; ?>">
                    <div>
                        <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-2">Tarih Seçin</label>
                        <div class="relative">
                            <input type="text" id="booking_date" name="booking_date" required 
                                   class="appearance-none w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent hover:border-teal-400 transition-colors cursor-pointer"
                                   placeholder="Tarih seçmek için tıklayın">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-teal-500">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="number_of_people" class="block text-sm font-medium text-gray-700 mb-2">Kişi Sayısı</label>
                        <div class="relative">
                            <input type="number" id="number_of_people" name="number_of_people" required 
                                   min="<?php echo $destination['min_people']; ?>" max="10" value="1"
                                   class="appearance-none w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent hover:border-teal-400 transition-colors">
                            <div class="absolute inset-y-0 right-0 flex">
                                <div class="flex flex-col border-l border-gray-200">
                                    <button type="button" onclick="incrementNumber(1)"
                                            class="flex-1 px-2 bg-gray-50 hover:bg-teal-400 hover:text-white transition-colors rounded-tr-lg border-b border-gray-200">
                                        <i class="fas fa-chevron-up text-xs"></i>
                                    </button>
                                    <button type="button" onclick="incrementNumber(-1)"
                                            class="flex-1 px-2 bg-gray-50 hover:bg-teal-400 hover:text-white transition-colors rounded-br-lg">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Fiyat Hesaplama</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-gray-600">
                                <span>Kişi Başı:</span>
                                <span><?php echo number_format($destination['price'], 2); ?> ₺</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Kişi Sayısı:</span>
                                <span id="selected_people">1</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3 mt-3">
                                <div class="flex justify-between text-lg font-semibold">
                                    <span class="text-gray-800">Toplam:</span>
                                    <span id="total_price" class="text-teal-600"><?php echo number_format($destination['price'], 2); ?> ₺</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full px-6 py-4 bg-teal-400 text-white text-lg font-semibold rounded-lg hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition-colors">
                        Rezervasyona Devam Et
                    </button>
                </form>

               
                <?php else: ?>
                <div class="text-center py-8">
                    <p class="text-gray-600 mb-6">Rezervasyon yapabilmek için giriş yapmalısınız.</p>
                    <a href="login.php" 
                       class="inline-block px-8 py-4 bg-teal-400 text-white text-lg font-semibold rounded-lg hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition-colors">
                        Giriş Yap
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        const pricePerPerson = <?php echo $destination['price']; ?>;
        const numberOfPeopleInput = document.getElementById('number_of_people');
        const selectedPeopleSpan = document.getElementById('selected_people');
        const totalPriceSpan = document.getElementById('total_price');
        const confirmationModal = document.getElementById('confirmationModal');
        const modalDate = document.getElementById('modalDate');
        const modalPeople = document.getElementById('modalPeople');
        const modalTotal = document.getElementById('modalTotal');
        const bookingForm = document.querySelector('form');

        function updatePrice() {
            const people = parseInt(numberOfPeopleInput.value) || 1;
            const total = people * pricePerPerson;
            selectedPeopleSpan.textContent = people;
            totalPriceSpan.textContent = total.toLocaleString('tr-TR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + ' ₺';
        }

        function incrementNumber(increment) {
            const currentValue = parseInt(numberOfPeopleInput.value) || 1;
            const newValue = currentValue + increment;
            const minValue = <?php echo $destination['min_people']; ?>;
            const maxValue = 10;

            if (newValue >= minValue && newValue <= maxValue) {
                numberOfPeopleInput.value = newValue;
                updatePrice();
            }
        }

        numberOfPeopleInput.addEventListener('input', updatePrice);
        updatePrice(); // İlk yükleme için fiyatı güncelle

        // Flatpickr takvim ayarları
        flatpickr("#booking_date", {
            locale: "tr",
            dateFormat: "d.m.Y",
            minDate: "today",
            disableMobile: true,
            monthSelectorType: "static",
            nextArrow: '<i class="fas fa-chevron-right"></i>',
            prevArrow: '<i class="fas fa-chevron-left"></i>',
            onChange: function(selectedDates, dateStr, instance) {
                // Seçilen tarih için özel işlemler buraya eklenebilir
            }
        });

        function showConfirmationModal() {
            const date = document.getElementById('booking_date').value;
            const people = numberOfPeopleInput.value;
            const total = (parseInt(people) * pricePerPerson).toLocaleString('tr-TR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + ' ₺';

            if (!date) {
                alert('Lütfen bir tarih seçin.');
                return;
            }

            modalDate.textContent = date;
            modalPeople.textContent = people + ' kişi';
            modalTotal.textContent = total;
            confirmationModal.classList.remove('hidden');
        }

        document.getElementById('cancelBtn').addEventListener('click', () => {
            confirmationModal.classList.add('hidden');
        });

        document.getElementById('confirmBtn').addEventListener('click', () => {
            bookingForm.submit();
        });

        // Modalın dışına tıklandığında kapanması
        confirmationModal.addEventListener('click', (e) => {
            if (e.target === confirmationModal) {
                confirmationModal.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
