<?php
$title = 'Menu';
include 'include/header.php';
include 'config.php';

// Fetch distinct cuisine types from the database
$sqlCuisine = "SELECT DISTINCT CuisineType FROM Menu";
$resultCuisine = $conn->query($sqlCuisine);

// Fetch menu items from the database
$sqlMenu = "SELECT * FROM Menu";
$resultMenu = $conn->query($sqlMenu);

// Fetch promotions from the database
$sqlPromotions = "SELECT * FROM Promotions";
$resultPromotions = $conn->query($sqlPromotions);
?>

<div class="page-title-area page-title-img-one">
  <div class="container">
    <div class="page-title-item">
      <h2>Our Menu</h2>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><i class="bx bx-chevron-right"></i></li>
        <li>Menu</li>
      </ul>
    </div>
  </div>
</div>

<section class="promotions-slider mt-5">
  <div class="container">
    <div class="owl-carousel owl-theme">
      <?php if ($resultPromotions && $resultPromotions->num_rows > 0): ?>
        <?php while ($rowPromotion = $resultPromotions->fetch_assoc()): ?>
          <div class="item">
            <div class="promotion-info text-center">
              <h3><?php echo htmlspecialchars($rowPromotion['PromotionName']); ?></h3>
              <p><?php echo htmlspecialchars($rowPromotion['Description']); ?></p>
            </div>
            <img class="rounded-5" src="<?php echo htmlspecialchars($rowPromotion['ImageURL']); ?>" alt="<?php echo htmlspecialchars($rowPromotion['PromotionName']); ?>">
            <div class="promotion-info text-center mt-3">
              <p><strong>Valid from:</strong> <?php echo htmlspecialchars($rowPromotion['StartDate']); ?> <strong>to</strong> <?php echo htmlspecialchars($rowPromotion['EndDate']); ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No current promotions.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="collection-area collection-area-two pt-100 pb-70">
  <div class="container">
    <div class="d-flex mb-5">
      <form class="d-flex w-100" action="search.php" method="POST">
        <input type="text" name="query" class="form-control me-2" placeholder="Search our menu" required />
        <button type="submit" class="btn cmn-btn">Search</button>
      </form>
    </div>
    <div class="sorting-menu">
      <ul>
        <li class="filter active" data-filter="all">All</li>
        <?php if ($resultCuisine && $resultCuisine->num_rows > 0): ?>
          <?php while ($rowCuisine = $resultCuisine->fetch_assoc()): ?>
            <li class="filter" data-filter=".<?php echo strtolower(str_replace(' ', '-', $rowCuisine['CuisineType'])); ?>">
              <?php echo htmlspecialchars($rowCuisine['CuisineType']); ?>
            </li>
          <?php endwhile; ?>
        <?php else: ?>
          <li>No cuisines found</li>
        <?php endif; ?>
      </ul>
    </div>
    <div id="Container" class="row">
      <?php if ($resultMenu && $resultMenu->num_rows > 0): ?>
        <?php while ($row = $resultMenu->fetch_assoc()): ?>
          <div class="col-sm-6 col-lg-3 mix <?php echo strtolower(str_replace(' ', '-', $row['CuisineType'])); ?>">
            <div class="collection-item">
              <div class="collection-top">
                <img src="<?php echo htmlspecialchars($row['ImageURL']); ?>" alt="Collection">
                <div class="add-cart">
                  <a href="#" class="btn add-to-cart" 
                     data-id="<?php echo $row['MenuID']; ?>" 
                     data-name="<?php echo htmlspecialchars($row['MenuName']); ?>" 
                     data-price="<?php echo $row['Price']; ?>"
                     data-image="<?php echo htmlspecialchars($row['ImageURL']); ?>">
                    <i class="bx bxs-cart"></i> Add to Cart
                  </a>
                </div>
              </div>
              <div class="collection-bottom">
                <h3><?php echo htmlspecialchars($row['MenuName']); ?></h3>
                <ul>
                  <li>
                    <span><?php echo number_format($row['Price']); ?>LKR</span>
                  </li>
                  <li>
                    <div class="number">
                      <span class="minus">-</span>
                      <input type="text" class="form-control quantity" value="1" />
                      <span class="plus">+</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No menu items found.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include 'include/footer.php'; ?>
<?php $conn->close(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
$(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    autoplayTimeout: 5000,
    responsive: {
      0: { items: 1 }
    }
  });

  $('.add-to-cart').on('click', function(event) {
    event.preventDefault();

    let button = $(this);
    let itemId = button.data('id');
    let itemName = button.data('name');
    let itemPrice = button.data('price');
    let itemImage = button.data('image');
    let itemQuantity = button.closest('.collection-item').find('.quantity').val();

    $.ajax({
        url: 'add_to_cart.php',
        method: 'POST',
        data: {
            item_id: itemId,
            item_name: itemName,
            item_price: itemPrice,
            item_quantity: itemQuantity,
            item_image: itemImage
        },
        success: function(response) {
            let data = JSON.parse(response);

            if (data.redirect) {
                alert("You must be logged in to add items to your cart.");
                window.location.href = data.redirect;
            } else if (data.success) {
                alert(data.message);
            } else {
                alert(data.message);
            }
        },
        error: function() {
            alert('An error occurred. Please try again.');
        }
    });
  });

  $('.minus').on('click', function() {
    let $input = $(this).parent().find('input');
    let count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    return false;
  });

  $('.plus').on('click', function() {
    let $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    return false;
  });
});
</script>
