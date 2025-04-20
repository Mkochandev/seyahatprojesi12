<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['user_id']) || !isset($_POST['cart_id'])) {
    header('Location: cart.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$cart_id = $_POST['cart_id'];

$delete_query = "DELETE FROM cart WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($delete_query);
$stmt->bind_param("ii", $cart_id, $user_id);
$stmt->execute();

header('Location: cart.php');
exit;
