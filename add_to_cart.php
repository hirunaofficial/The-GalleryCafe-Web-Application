<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if the user is logged in
    if (!isset($_SESSION['UserID'])) {
        echo json_encode(['success' => false, 'redirect' => 'login.php']);
        exit();
    }

    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];
    $itemQuantity = $_POST['item_quantity'];
    $itemImage = $_POST['item_image'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the item is already in the cart
    $itemExists = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $itemId) {
            $itemExists = true;
            $cartItem['quantity'] += $itemQuantity; // Update quantity if item exists
            break;
        }
    }

    // If the item does not exist in the cart, add it
    if (!$itemExists) {
        $item = [
            'id' => $itemId,
            'name' => $itemName,
            'price' => $itemPrice,
            'quantity' => $itemQuantity,
            'image' => $itemImage
        ];

        $_SESSION['cart'][] = $item;
    }

    echo json_encode([
        'success' => true, 
        'message' => $itemExists ? 'The quantity of "' . $itemName . '" has been updated in your cart.' : '"' . $itemName . '" has been added to your cart.'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Sorry, there was an error with your request. Please try again.']);
}
