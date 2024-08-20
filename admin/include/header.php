<!DOCTYPE html>
<html lang="zxx">

<?php
    session_start();
    // Determine the current page
    $currentPage = basename($_SERVER['PHP_SELF'], ".php");
    $user_role = $_SESSION['UserType']; 
    // Set the title based on the user role
    $pageTitle = ($user_role == 'Admin') ? 'Admin Panel - The Gallery Cafe' : 'Staff Panel - The Gallery Cafe';
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/meanmenu.css" />
    <link rel="stylesheet" href="../assets/css/boxicons.min.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="../assets/css/slick.min.css" />
    <link rel="stylesheet" href="../assets/css/slick-theme.min.css" />
    <link rel="stylesheet" href="../assets/css/magnific-popup.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />
    <title><?php echo $pageTitle; ?></title>
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
</head>

<body>
    <div class="navbar-area fixed-top">
        <div class="mobile-nav">
            <a href="index.php" class="logo">
                <img src="../assets/img/logo.png" alt="Logo" />
            </a>
        </div>

        <div class="main-nav main-nav-three">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="index.php">
                        <img src="../assets/img/logo.png" class="logo-one" alt="Logo" />
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="index.php" class="nav-link <?php echo ($currentPage == 'index') ? 'active' : ''; ?>">Home</a>
                            </li>
                            <?php if ($user_role == 'Admin') : ?>
                            <li class="nav-item">
                                <a href="user_management.php" class="nav-link <?php echo ($currentPage == 'user_management') ? 'active' : ''; ?>">Users</a>
                            </li>
                            <li class="nav-item">
                                <a href="food_management.php" class="nav-link <?php echo ($currentPage == 'food_management') ? 'active' : ''; ?>">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a href="promotions_events_management.php" class="nav-link <?php echo ($currentPage == 'promotions_events_management') ? 'active' : ''; ?>">Promos & Events</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="reservation_management.php" class="nav-link <?php echo ($currentPage == 'reservation_management') ? 'active' : ''; ?>">Reservations</a>
                            </li>
                            <li class="nav-item">
                                <a href="preorder_management.php" class="nav-link <?php echo ($currentPage == 'preorder_management') ? 'active' : ''; ?>">Pre-orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="table_parking_management.php" class="nav-link <?php echo ($currentPage == 'table_parking_management') ? 'active' : ''; ?>">Tables & Parking</a>
                            </li>
                        </ul>
                        <div class="side-nav">
                            <a class="nav-tel" href="../"><i class="bx bxs-log-out"></i>Back to GalleryCafe</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>
