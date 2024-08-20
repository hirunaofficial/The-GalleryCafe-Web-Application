<?php $title = 'Home'; include 'include/header.php'; ?> 
<?php include 'config.php'; ?>

<div class="banner-area">
  <div class="d-table">
    <div class="d-table-cell">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6">
          <div class="banner-content">
            <h1>Welcome to The Gallery Cafe</h1>
            <p> Experience exceptional dining in a unique setting. Discover our gourmet menu, crafted with the freshest ingredients, and enjoy an unforgettable meal in the heart of Colombo. </p>
            <form action="search.php" method="POST">
              <input type="text" name="query" class="form-control" placeholder="Search our menu" required/>
              <button type="submit" class="btn banner-form-btn"> Search Now </button>
            </form>
          </div>
          </div>
          <div class="col-lg-6">
            <div class="banner-slider owl-theme owl-carousel">
              <div class="slider-item">
                <img src="assets/img/home/banner/banner-slider1.png" alt="Slider" />
              </div>
              <div class="slider-item">
                <img src="assets/img/home/banner/banner-slider2.png" alt="Slider" />
              </div>
              <div class="slider-item">
                <img src="assets/img/home/banner/banner-slider3.png" alt="Slider" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="restant-area">
  <div class="restant-shape">
    <img src="assets/img/service/service-shape2.png" alt="Shape" />
  </div>
  <div class="container-fluid">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-6">
        <div class="restant-img">
          <img src="assets/img/home/restant.png" alt="Restant" />
          <img src="assets/img/home/restant2.png" alt="Restant" />
          <img src="assets/img/home/restant3.png" alt="Restant" />
          <img src="assets/img/home/restant4.png" alt="Restant" />
          <img src="assets/img/home/restant5.png" alt="Restant" />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="restant-content">
          <div class="section-title">
            <h2>About The Gallery Cafe</h2>
            <p> The Gallery Cafe, located in the heart of Colombo, is celebrated for its unique dining experience. Housed in a beautifully restored colonial building, our cafe combines historical elegance with modern comfort. </p>
            <p> Our menu features a diverse selection of gourmet dishes crafted from the freshest local ingredients and inspired by international flavors. From leisurely brunches to sophisticated dinners and delightful afternoon teas, every visit promises a memorable experience. </p>
            <p> We also host themed dining nights and special events, offering a vibrant atmosphere and exceptional service to all our guests. </p>
          </div>
          <a class="cmn-btn" href="about.php">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="service-area ptb-100">
  <div class="container">
    <div class="section-title">
      <h2>The Gallery Cafe Services</h2>
      <p> At The Gallery Cafe, we offer a variety of services to enhance your dining experience. </p>
    </div>
    <div class="service-slider owl-theme owl-carousel">
      <div class="service-item">
          <img src="assets/img/service/service1.png" alt="Service" />
          <img class="service-shape" src="assets/img/service/service-shape.png" alt="Service" />
          <h3>Fresh, Healthy Food</h3>
          <p> Enjoy our freshly prepared, healthy meals made with the finest ingredients. Perfect for those looking for nutritious options. </p>
      </div>
      <div class="service-item">
          <img src="assets/img/service/service2.png" alt="Service" />
          <img class="service-shape" src="assets/img/service/service-shape.png" alt="Service" />
          <h3>Artisan Coffee</h3>
          <p> Savor our expertly brewed coffee, crafted from the best beans to give you a perfect start to your day. </p>
      </div>
      <div class="service-item">
          <img src="assets/img/service/service3.png" alt="Service" />
          <img class="service-shape" src="assets/img/service/service-shape.png" alt="Service" />
          <h3>Free Wi-Fi</h3>
          <p> Stay connected with our complimentary high-speed Wi-Fi, available throughout the cafe. </p>
      </div>
      <div class="service-item">
          <img src="assets/img/service/service4.png" alt="Service" />
          <img class="service-shape" src="assets/img/service/service-shape.png" alt="Service" />
          <h3>Art Exhibitions</h3>
          <p> Enjoy our rotating art exhibitions featuring works from local artists, creating a vibrant and inspiring atmosphere. </p>
      </div>
      <div class="service-item">
          <img src="assets/img/service/service5.png" alt="Service" />
          <img class="service-shape" src="assets/img/service/service-shape.png" alt="Service" />
          <h3>Online Table Reservations</h3>
          <p> Book your table in advance with our convenient online reservation system, ensuring you have a spot waiting for you. </p>
      </div>
      <div class="service-item">
          <img src="assets/img/service/service6.png" alt="Service" />
          <img class="service-shape" src="assets/img/service/service-shape.png" alt="Service" />
          <h3>Pre-order Foods</h3>
          <p> Save time by pre-ordering your meals online. Have your food ready when you arrive and enjoy a seamless dining experience. </p>
      </div>
    </div>
  </div>
</section>


<section class="chef-area chef-area-two pb-70">
  <div class="container">
    <div class="section-title">
      <h2>Our Special Chefs</h2>
      <p>Meet the talented chefs behind our culinary creations. Our team is dedicated to bringing you the best dining experience possible.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-6 col-lg-3">
        <div class="chef-item">
          <div class="chef-top">
            <img src="assets/img/chef/1.jpg" alt="Chef">
            <div class="chef-inner">
              <h3>Nuwan Perera</h3>
              <span>Head Chef</span>
            </div>
          </div>
          <div class="chef-bottom">
            <ul>
              <li>
                <a href="https://www.facebook.com/nuwanperera">
                  <i class="bx bxl-facebook"></i>
                </a>
              </li>
              <li>
                <a href="https://twitter.com/nuwanperera">
                  <i class="bx bxl-twitter"></i>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/nuwanperera">
                  <i class="bx bxl-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="chef-item">
          <div class="chef-top">
            <img src="assets/img/chef/2.jpg" alt="Chef">
            <div class="chef-inner">
              <h3>Amali Silva</h3>
              <span>Assistant Chef</span>
            </div>
          </div>
          <div class="chef-bottom">
            <ul>
              <li>
                <a href="https://www.facebook.com/amalisilva">
                  <i class="bx bxl-facebook"></i>
                </a>
              </li>
              <li>
                <a href="https://twitter.com/amalisilva">
                  <i class="bx bxl-twitter"></i>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/amalisilva">
                  <i class="bx bxl-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="chef-item">
          <div class="chef-top">
            <img src="assets/img/chef/3.jpg" alt="Chef">
            <div class="chef-inner">
              <h3>Kamal Wijesuriya</h3>
              <span>Pastry Chef</span>
            </div>
          </div>
          <div class="chef-bottom">
            <ul>
              <li>
                <a href="https://www.facebook.com/kamalwijesuriya">
                  <i class="bx bxl-facebook"></i>
                </a>
              </li>
              <li>
                <a href="https://twitter.com/kamalwijesuriya">
                  <i class="bx bxl-twitter"></i>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/kamalwijesuriya">
                  <i class="bx bxl-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="chef-item">
          <div class="chef-top">
            <img src="assets/img/chef/4.jpg" alt="Chef">
            <div class="chef-inner">
              <h3>Ruwan Fernando</h3>
              <span>Sous Chef</span>
            </div>
          </div>
          <div class="chef-bottom">
            <ul>
              <li>
                <a href="https://www.facebook.com/ruwanfernando">
                  <i class="bx bxl-facebook"></i>
                </a>
              </li>
              <li>
                <a href="https://twitter.com/ruwanfernando">
                  <i class="bx bxl-twitter"></i>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/ruwanfernando">
                  <i class="bx bxl-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
// Fetch distinct cuisine types
$sql = "SELECT DISTINCT CuisineType FROM Menu";
$result = $conn->query($sql);

// Initialize an array to store the cuisine types
$cuisineTypes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cuisineTypes[] = $row['CuisineType'];
    }
} else {
    echo "No cuisine types found.";
}

?>

<section class="menu-area pt-100 pb-70">
  <div class="container">
    <div class="section-title">
      <h2>Explore Our Cuisine Types</h2>
      <p>Discover a variety of cuisine types from around the world, each offering unique flavors and dishes to tantalize your taste buds.</p>
    </div>
    <div class="row justify-content-center">
      <?php foreach ($cuisineTypes as $cuisineType): ?>
      <div class="col-sm-6 col-lg-3">
        <div class="menu-item">
          <img class="menu-shape" src="assets/img/service/service-shape.png" alt="Menu" />
          <h3><?php echo htmlspecialchars($cuisineType); ?></h3>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
// Fetch 8 random menu items from the database
$sqlMenu = "SELECT * FROM Menu ORDER BY RAND() LIMIT 8";
$resultMenu = $conn->query($sqlMenu);
?>

<section class="collection-area pt-100 pb-70">
  <div class="container">
  <div class="section-title">
  <h2>The Gallery Cafe's Regular Food Collections</h2>
  <p>Discover our exquisite menu, crafted with the finest ingredients to deliver an unforgettable dining experience.</p>
</div>
    <div id="Container" class="row">
      <?php if ($resultMenu->num_rows > 0): ?>
        <?php while ($row = $resultMenu->fetch_assoc()): ?>
          <div class="col-sm-6 col-lg-3 mix">
            <div class="collection-item">
              <div class="collection-top">
                <img src="<?php echo htmlspecialchars($row['ImageURL']); ?>" alt="Collection" />
              </div>
              <div class="collection-bottom">
                <h3><?php echo htmlspecialchars($row['MenuName']); ?></h3>
                <ul>
                  <li><span><?php echo number_format($row['Price'], 2); ?> LKR</span></li>
       
                </ul>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No menu items found.</p>
      <?php endif; ?>
    </div>
    <div class="more-collection">
      <a href="menu.php">Explore our menu</a>
    </div>
  </div>
</section>

<section class="reservation-area">
  <div class="reservation-shape">
    <img src="assets/img/home/reservation-shape.png" alt="Shape" />
  </div>
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-6">
        <div class="reservation-item">
          <div class="section-title">
            <h2>Reservation A Table</h2>
            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse. </p>
          </div>
          <a href="reservation.php"><span class="btn cmn-btn"> Reserve Now </span></a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="reservation-img">
          <img src="assets/img/home/reservation.png" alt="Reservation" />
        </div>
      </div>
    </div>
  </div>
</section>

<section class="blog-area ptb-100">
  <div class="container">
    <div class="section-title">
      <h2>Our Special Events</h2>
      <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do tempor incididunt ut labore et dolore magna aliqua. </p>
    </div>
    <div class="row justify-content-center">

    <?php
      $sql = "SELECT EventName, Description, EventDate, ImageURL FROM SpecialEvents ORDER BY RAND() LIMIT 3";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<div class="col-sm-6 col-lg-4">';
          echo '  <div class="event-item">';
          echo '    <div class="event-top">';
          echo '      <img src="' . $row["ImageURL"] . '" alt="Event">';
          echo '      <span>' . date('d M Y', strtotime($row["EventDate"])) . '</span>';
          echo '    </div>';
          echo '    <div class="event-bottom">';
          echo '      <h3>' . $row["EventName"] . '</h3>';
          echo '      <p>' . $row["Description"] . '</p>';
          echo '    </div>';
          echo '  </div>';
          echo '</div>';
        }
      } else {
        echo "<p>No events found</p>";
      }
      $conn->close();
      ?>

    </div>
    <div class="text-center">
      <a class="read-blog-btn" href="events.php">View More Events</a>
    </div>
  </div>

</section> <?php include 'include/footer.php'; ?>