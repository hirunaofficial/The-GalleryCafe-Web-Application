<?php
include 'include/header.php';

// Check if the user is logged in and has the appropriate role (admin)
if ($_SESSION['UserType'] !== 'Admin') {
   header('Location: ../login.php');
   exit();
}

include '../config.php';

// Fetch all food items
$sql = "SELECT * FROM Menu";
$result = $conn->query($sql);
?>

<div class="page-title-area page-title-img-one">
   <div class="container">
      <div class="page-title-item">
         <h2>Food & Beverages Management</h2>
         <ul>
            <li><a href="index.php">Admin Dashboard</a></li>
            <li><i class="bx bx-chevron-right"></i></li>
            <li>Food & Beverages</li>
         </ul>
      </div>
   </div>
</div>

<div class="table-area ptb-100">
    <div class="container">
        <div class="table-wrap">
            <div class="section-title">
         <h2>Add Food Item</h2>
      </div>
      <form method="POST" action="" id="addFoodForm" class="user_management">
         <div class="form-group">
            <label for="menuname">Name</label>
            <input type="text" name="menuname" id="menuname" class="form-control" required>
         </div>
         <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
         </div>
         <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
         </div>
         <div class="form-group">
            <label for="cuisinetype">Cuisine Type</label>
            <input type="text" name="cuisinetype" id="cuisinetype" class="form-control" required>
         </div>
         <div class="form-group">
            <label for="imageurl">Image URL</label>
            <input type="text" name="imageurl" id="imageurl" class="form-control">
         </div>
         <button type="submit" name="add_food" class="cmn-btn">Add Food Item</button>
      </form>
      </div>
    </div>
</div>

<section class="cart-area ptb-100">
   <div class="container">
      <div class="cart-wrap">
         <div class="section-title">
            <h2>All Food Items</h2>
         </div>
         <table class="table user_management">
            <thead class="thead">
               <tr>
                  <th class="table-head" scope="col">Name</th>
                  <th class="table-head" scope="col">Description</th>
                  <th class="table-head" scope="col">Price</th>
                  <th class="table-head" scope="col">Cuisine Type</th>
                  <th class="table-head" scope="col">Image</th>
                  <th class="table-head" scope="col">Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php if ($result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                     <tr id="food-<?php echo $row['MenuID']; ?>">
                        <td><?php echo htmlspecialchars($row['MenuName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Description']); ?></td>
                        <td><?php echo htmlspecialchars($row['Price']); ?></td>
                        <td><?php echo htmlspecialchars($row['CuisineType']); ?></td>
                        <td><img src="../<?php echo htmlspecialchars($row['ImageURL']); ?>" alt="<?php echo htmlspecialchars($row['MenuName']); ?>" width="50"></td>
                        <td>
                           <button class="cmn-btn update-food" data-id="<?php echo $row['MenuID']; ?>">Update</button>
                           <button class="cmn-btn delete-food" data-id="<?php echo $row['MenuID']; ?>">Delete</button>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               <?php else: ?>
                  <tr>
                     <td colspan="6">No food items found</td>
                  </tr>
               <?php endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>

<!-- Update Food Modal -->
<div class="modal fade" id="updateFoodModal" tabindex="-1" aria-labelledby="updateFoodModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="updateFoodForm" class="user_management">
            <div class="modal-header">
               <h5 class="modal-title" id="updateFoodModalLabel">Update Food Item</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" id="updateFoodId" name="id">
               <div class="form-group">
                  <label for="updateMenuName">Name</label>
                  <input type="text" id="updateMenuName" name="menuname" class="form-control">
               </div>
               <div class="form-group">
                  <label for="updateDescription">Description</label>
                  <textarea id="updateDescription" name="description" class="form-control"></textarea>
               </div>
               <div class="form-group">
                  <label for="updatePrice">Price</label>
                  <input type="number" step="0.01" id="updatePrice" name="price" class="form-control">
               </div>
               <div class="form-group">
                  <label for="updateCuisineType">Cuisine Type</label>
                  <input type="text" id="updateCuisineType" name="cuisinetype" class="form-control">
               </div>
               <div class="form-group">
                  <label for="updateImageURL">Image URL</label>
                  <input type="text" id="updateImageURL" name="imageurl" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="cmn-btn">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>

<?php include 'include/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
   // Handle form submission for adding new food items
   $('#addFoodForm').submit(function(e) {
      e.preventDefault();
      $.post('food_add.php', $(this).serialize(), function(response) {
         alert(response);
         location.reload();
      });
   });

   // Open modal for updating food item details
   $('.update-food').click(function() {
      var foodId = $(this).data('id');
      $.post('food_details.php', { id: foodId }, function(response) {
         var food = JSON.parse(response);
         $('#updateFoodId').val(food.MenuID);
         $('#updateMenuName').val(food.MenuName);
         $('#updateDescription').val(food.Description);
         $('#updatePrice').val(food.Price);
         $('#updateCuisineType').val(food.CuisineType);
         $('#updateImageURL').val(food.ImageURL);
         $('#updateFoodModal').modal('show');
      });
   });

   // Handle form submission for updating food item details
   $('#updateFoodForm').submit(function(e) {
      e.preventDefault();
      $.post('food_update.php', $(this).serialize(), function(response) {
         alert(response);
         location.reload();
      });
   });

   // Handle food item deletion
   $('.delete-food').click(function() {
      if (confirm('Are you sure you want to delete this food item?')) {
         var foodId = $(this).data('id');
         $.post('food_delete.php', { id: foodId }, function(response) {
            alert(response);
            location.reload();
         });
      }
   });
});
</script>
