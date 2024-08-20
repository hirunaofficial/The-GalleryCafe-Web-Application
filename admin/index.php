<?php
include 'include/header.php';

// Check if the user is logged in and has the appropriate role (admin or operational staff)
if ($_SESSION['UserType'] !== 'Admin' && $_SESSION['UserType'] !== 'Staff') {
    header('Location: ../login.php');
    exit();
}

// Define the user role for demonstration purposes
$user_role = $_SESSION['UserType'];
?>

<div class="page-title-area page-title-img-one">
   <div class="container">
      <div class="page-title-item">
         <h2>Admin Dashboard</h2>
         <ul>
            <li>
               <a href="index.php">Home</a>
            </li>
            <li>
               <i class="bx bx-chevron-right"></i>
            </li>
            <li>Admin</li>
         </ul>
      </div>
   </div>
</div>

<div class="feature-area pt-100 pb-70">
   <div class="container">
      <div class="row justify-content-center">
         <?php if ($user_role == 'Admin') : ?>
         <div class="col-sm-6 col-lg-4">
            <div class="feature-item">
            <a href="user_management.php">
               <img src="../assets/img/admin/feature1.png" alt="Feature">
               <div class="feature-inner">
                  <ul>
                     <li><img src="../assets/img/admin/feature1-icon.png" alt="Feature"></li>
                     <li><span>User Management</span></li>
                  </ul>
               </div>
            </a>
            </div>
         </div>
         <div class="col-sm-6 col-lg-4">
            <div class="feature-item">
            <a href="food_management.php">
               <img src="../assets/img/admin/feature2.png" alt="Feature">
               <div class="feature-inner">
                  <ul>
                     <li><img src="../assets/img/admin/feature2-icon.png" alt="Feature"></li>
                     <li><span>Food & Beverages</span></li>
                  </ul>
               </div>
            </a>
            </div>
         </div>
         <div class="col-sm-6 col-lg-4">
            <div class="feature-item">
            <a href="promotions_events_management.php">
               <img src="../assets/img/admin/feature5.png" alt="Feature">
               <div class="feature-inner">
                  <ul>
                     <li><img src="../assets/img/admin/feature5-icon.png" alt="Feature"></li>
                     <li><span>Promotions & Events</span></li>
                  </ul>
               </div>
            </a>
            </div>
         </div>
         <?php endif; ?>
         <div class="col-sm-6 col-lg-4">
            <div class="feature-item">
            <a href="reservation_management.php">
               <img src="../assets/img/admin/feature3.png" alt="Feature">
               <div class="feature-inner">
                  <ul>
                     <li><img src="../assets/img/admin/feature3-icon.png" alt="Feature"></li>
                     <li><span>Reservations</span></li>
                  </ul>
               </div>
            </a>
            </div>
         </div>
         <div class="col-sm-6 col-lg-4">
            <div class="feature-item">
            <a href="preorder_management.php">
               <img src="../assets/img/admin/feature4.png" alt="Feature">
               <div class="feature-inner">
                  <ul>
                     <li><img src="../assets/img/admin/feature4-icon.png" alt="Feature"></li>
                     <li><span>Pre-orders</span></li>
                  </ul>
               </div>
            </a>
            </div>
         </div>
         <div class="col-sm-6 col-lg-4">
            <div class="feature-item">
            <a href="table_parking_management.php">
               <img src="../assets/img/admin/feature6.png" alt="Feature">
               <div class="feature-inner">
                  <ul>
                     <li><img src="../assets/img/admin/feature6-icon.png" alt="Feature"></li>
                     <li><span>Table & Parking</span></li>
                  </ul>
               </div>
            </a>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include 'include/footer.php'; ?>
