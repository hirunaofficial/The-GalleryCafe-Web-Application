<?php
$title = 'Search Result';
include 'include/header.php';
include 'config.php';

if (isset($_POST['query'])) {
    $query = $_POST['query'];
}

if (empty($query)) {
    header('Location: menu.php');
    exit();
}

// Fetch distinct cuisine types from the database
$sqlCuisine = "SELECT DISTINCT CuisineType FROM Menu";
$resultCuisine = $conn->query($sqlCuisine);

// Fetch search results from the database
$sqlSearch = "SELECT * FROM Menu WHERE MenuName LIKE ?";
$stmt = $conn->prepare($sqlSearch);
$searchTerm = '%' . $query . '%';
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$resultSearch = $stmt->get_result();
?>

<div class="page-title-area page-title-img-one">
  <div class="container">
    <div class="page-title-item">
      <h2>Search Result for <?php echo $_POST['query']; ?></h2>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><i class="bx bx-chevron-right"></i></li>
        <li><a href="menu.php">Menu</a></li>
        <li><i class="bx bx-chevron-right"></i></li>
        <li>Search Result</li>
        <li><i class="bx bx-chevron-right"></i></li>
        <li><?php echo $_POST['query']; ?></li>
      </ul>
    </div>
  </div>
</div>

<section class="collection-area collection-area-two pt-100 pb-70">
  <div class="container">
    <div class="d-flex mb-5">
      <form class="d-flex w-100" action="search.php" method="POST">
        <input type="text" name="query" class="form-control me-2" placeholder="Search our menu" required/>
        <button type="submit" class="btn cmn-btn">Search</button>
      </form>
    </div>
    <div class="sorting-menu">
      <ul>
        <li class="filter active" data-filter="all">All</li>
        <?php if ($resultCuisine->num_rows > 0): ?>
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
      <?php if ($resultSearch->num_rows > 0): ?>
        <?php while ($row = $resultSearch->fetch_assoc()): ?>
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
<script>
$(document).ready(function() {
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
