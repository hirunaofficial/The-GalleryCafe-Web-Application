<?php
session_start();

$cartItemCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartItemCount += $item['quantity'];
    }
}

echo $cartItemCount;
?>
