<!DOCTYPE html>
<html lang="zxx">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
      <link rel="stylesheet" href="assets/css/meanmenu.css" />
      <link rel="stylesheet" href="assets/css/boxicons.min.css" />
      <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
      <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" />
      <link rel="stylesheet" href="assets/css/slick.min.css" />
      <link rel="stylesheet" href="assets/css/slick-theme.min.css" />
      <link rel="stylesheet" href="assets/css/magnific-popup.min.css" />
      <link rel="stylesheet" href="assets/css/style.css" />
      <link rel="stylesheet" href="assets/css/responsive.css" />
      <title><?php echo isset($title) ? $title . ' - The Gallery Cafe' : 'The Gallery Cafe'; ?></title>
      <link rel="icon" type="image/png" href="assets/img/favicon.png" />
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   </head>
   <body>
      <?php
         session_start();
         
         // Determine the current page
         $currentPage = basename($_SERVER['PHP_SELF'], ".php");
         
         // Count the number of items in the cart
         $cartItemCount = 0;
         if (isset($_SESSION['cart'])) {
             foreach ($_SESSION['cart'] as $item) {
                 $cartItemCount += $item['quantity'];
             }
         }
         ?>
      <div class="navbar-area fixed-top">
         <div class="mobile-nav">
            <a href="index.php" class="logo">
            <img src="assets/img/logo.png" alt="Logo" />
            </a>
         </div>
         <div class="main-nav main-nav-three">
            <div class="container">
               <nav class="navbar navbar-expand-md navbar-light">
                  <a class="navbar-brand" href="index.php">
                  <img src="assets/img/logo.png" class="logo-one" alt="Logo" />
                  </a>
                  <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a href="index.php" class="nav-link <?php echo ($currentPage == 'index') ? 'active' : ''; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                           <a href="about.php" class="nav-link <?php echo ($currentPage == 'about') ? 'active' : ''; ?>">About</a>
                        </li>
                        <li class="nav-item">
                           <a href="menu.php" class="nav-link <?php echo ($currentPage == 'menu') ? 'active' : ''; ?>">Menu</a>
                        </li>
                        <li class="nav-item">
                           <a href="reservation.php" class="nav-link <?php echo ($currentPage == 'reservation') ? 'active' : ''; ?>">Reservation</a>
                        </li>
                        <li class="nav-item">
                           <a href="availability.php" class="nav-link <?php echo ($currentPage == 'availability') ? 'active' : ''; ?>">Availability</a>
                        </li>
                        <li class="nav-item">
                           <a href="events.php" class="nav-link <?php echo ($currentPage == 'events') ? 'active' : ''; ?>">Events</a>
                        </li>
                        <li class="nav-item">
                           <a href="contact.php" class="nav-link <?php echo ($currentPage == 'contact') ? 'active' : ''; ?>">Contact</a>
                        </li>
                     </ul>
                     <div class="side-nav">
                        <a class="nav-cart" href="cart.php"><i class="bx bxs-cart"></i><span id="cart-count"><?php echo $cartItemCount; ?></span></a>
                        <?php if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == "Admin") { ?>
                        <a class="nav-tel" href="admin"><i class="bx bxs-user-circle"></i>Admin</a>
                        <a class="nav-tel" href="manage_orders.php"><i class="bx bxs-bowl-hot"></i>Orders</a>
                        <a class="nav-tel" href="logout.php"><i class="bx bxs-log-out"></i>Logout</a>
                        <?php } elseif (isset($_SESSION['UserType']) && $_SESSION['UserType'] == "Staff") { ?>
                        <a class="nav-tel" href="admin"><i class="bx bxs-user-circle"></i>Staff</a>
                        <a class="nav-tel" href="manage_orders.php"><i class="bx bxs-bowl-hot"></i>Orders</a>
                        <a class="nav-tel" href="logout.php"><i class="bx bxs-log-out"></i>Logout</a>
                        <?php } elseif (isset($_SESSION['UserID'])) { ?>
                        <a class="nav-tel" href="manage_orders.php"><i class="bx bxs-bowl-hot"></i>Orders</a>
                        <a class="nav-tel" href="logout.php"><i class="bx bxs-log-out"></i>Logout</a>
                        <?php } else { ?>
                        <a class="nav-tel" href="login.php"><i class="bx bxs-log-in"></i>Login</a>
                        <a class="nav-tel" href="register.php"><i class="bx bxs-user-plus"></i>Register</a>
                        <?php } ?>
                     </div>
                  </div>
               </nav>
            </div>
         </div>
      </div>
      <script>
         function updateCartCount() {
             $.ajax({
                 url: 'cart_get_count.php',
                 method: 'GET',
                 success: function(data) {
                     $('#cart-count').text(data);
                 }
             });
         }
         
         // Update cart count every 3 seconds
         setInterval(updateCartCount, 3000);
      </script>