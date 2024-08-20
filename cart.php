<?php
$title = 'Cart';
include 'include/header.php';

// Fetch cart items from the session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$total = 0;
foreach ($cartItems as $cartItem) {
    $subtotal = $cartItem['price'] * $cartItem['quantity'];
    $total += $subtotal;
}

?>

<div class="page-title-area page-title-img-one">
    <div class="container">
        <div class="page-title-item">
            <h2>Cart</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Cart</li>
            </ul>
        </div>
    </div>
</div>

<section class="cart-area ptb-100">
    <div class="container">
        <div class="cart-wrap">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th class="table-head" scope="col">Images</th>
                        <th class="table-head" scope="col">Items</th>
                        <th class="table-head" scope="col">Prices</th>
                        <th class="table-head" scope="col">Quantity</th>
                        <th class="table-head" scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $index => $item): ?>
                            <tr data-index="<?php echo $index; ?>">
                                <th class="table-item" scope="row">
                                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Image">
                                </th>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td class="price"><?php echo number_format($item['price'], 2); ?> LKR</td>
                                <td>
                                    <div class="quantity">
                                        <input type="number" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="remove-item">
                                        <i class="bx bx-x"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Your cart is empty.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="shop-back">
                <a href="menu.php">Continue Shopping</a>
            </div>
            <div class="total-shopping">
                <h2>Total Order</h2>
                <h3>Total: <span id="total"><?php echo number_format($total, 2); ?> LKR</span></h3>
                <a href="checkout.php">Pre-Order</a>
            </div>
        </div>
    </div>
</section>

<?php include 'include/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function updateTotal() {
        var total = 0;
        $('.quantity-input').each(function() {
            var quantity = parseFloat($(this).val());
            var priceText = $(this).closest('tr').find('.price').text();
            var price = parseFloat(priceText.replace(/[^0-9.-]+/g, ''));
            if (!isNaN(quantity) && !isNaN(price)) {
                total += quantity * price;
            }
        });
        $('#total').text(total.toFixed(2) + ' LKR');
    }

    $(document).on('click', '.remove-item', function(e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var index = row.data('index');
        
        $.ajax({
            url: 'cart_remove_item.php',
            method: 'POST',
            data: { index: index },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    row.remove();
                    updateTotal();
                } else {
                    alert('Failed to remove item from cart.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });

    $('.quantity-input').on('input', function() {
        var row = $(this).closest('tr');
        var index = row.data('index');
        var quantity = $(this).val();

        $.ajax({
            url: 'cart_update_quantity.php',
            method: 'POST',
            data: { index: index, quantity: quantity },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    updateTotal();
                } else {
                    alert('Failed to update quantity.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });

    updateTotal(); // Initial total calculation
});
</script>
