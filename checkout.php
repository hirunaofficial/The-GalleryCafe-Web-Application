<?php
$title = 'Checkout';
include 'include/header.php';
session_start();

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['UserID'];
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (empty($cartItems)) {
    echo "<script>alert('Your cart is empty. Please add items to your cart to proceed.'); window.location.href='menu.php';</script>";
    exit();
}

include 'config.php';

$success = true;
$conn->begin_transaction();

try {
    foreach ($cartItems as $cartItem) {
        $menuID = $cartItem['id'];
        $quantity = $cartItem['quantity'];
        $orderDate = date('Y-m-d H:i:s');

        $sql = "INSERT INTO PreOrders (UserID, MenuID, Quantity, OrderDate, Status) VALUES (?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiis', $userID, $menuID, $quantity, $orderDate);

        if (!$stmt->execute()) {
            $success = false;
            break;
        }
    }

    if ($success) {
        $conn->commit();
        unset($_SESSION['cart']);
        echo "<script>alert('Thank you for your pre-order! Your order has been successfully placed and is now being processed.'); window.location.href='manage_orders.php';</script>";
    } else {
        $conn->rollback();
        echo "<script>alert('We apologize, but we were unable to complete your pre-order. Please try again.'); window.location.href='cart.php';</script>";
    }
} catch (Exception $e) {
    $conn->rollback();
    echo "<script>alert('An error occurred while processing your order. Please try again. If the problem persists, contact our support team.'); window.location.href='cart.php';</script>";
}
?>
