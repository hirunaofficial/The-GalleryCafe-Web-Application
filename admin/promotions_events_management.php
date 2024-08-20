<?php
include 'include/header.php';

// Check if the user is logged in and has the appropriate role (Admin or Staff)
if (!in_array($_SESSION['UserType'], ['Admin', 'Staff'])) {
   header('Location: ../login.php');
   exit();
}

include '../config.php';

// Fetch all special events
$events_sql = "SELECT * FROM SpecialEvents";
$events_result = $conn->query($events_sql);

// Fetch all promotions
$promotions_sql = "SELECT * FROM Promotions";
$promotions_result = $conn->query($promotions_sql);
?>

<div class="page-title-area page-title-img-one">
   <div class="container">
      <div class="page-title-item">
         <h2>Promotions and Events Management</h2>
         <ul>
            <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
            <li><i class="bx bx-chevron-right"></i></li>
            <li>Promotions and Events</li>
         </ul>
      </div>
   </div>
</div>

<div class="feature-area pt-100 pb-70">
   <div class="container">
      <div class="section-title">
         <h2>Special Events</h2>
         <button class="cmn-btn" data-bs-toggle="modal" data-bs-target="#addEventModal">Add Event</button>
      </div>
      <div class="cart-wrap">
         <table class="table user_management">
            <thead class="thead">
               <tr>
                  <th class="table-head" scope="col">Event ID</th>
                  <th class="table-head" scope="col">Event Name</th>
                  <th class="table-head" scope="col">Description</th>
                  <th class="table-head" scope="col">Event Date</th>
                  <th class="table-head" scope="col">Image URL</th>
                  <th class="table-head" scope="col">Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php if ($events_result->num_rows > 0): ?>
                  <?php while ($row = $events_result->fetch_assoc()): ?>
                     <tr id="event-<?php echo $row['EventID']; ?>">
                        <td><?php echo htmlspecialchars($row['EventID']); ?></td>
                        <td><?php echo htmlspecialchars($row['EventName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Description']); ?></td>
                        <td><?php echo htmlspecialchars($row['EventDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['ImageURL']); ?></td>
                        <td>
                           <button class="cmn-btn edit-event" data-id="<?php echo $row['EventID']; ?>">Edit</button>
                           <button class="cmn-btn delete-event" data-id="<?php echo $row['EventID']; ?>">Delete</button>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               <?php else: ?>
                  <tr>
                     <td colspan="6">No events found</td>
                  </tr>
               <?php endif; ?>
            </tbody>
         </table>
      </div>

      <div class="section-title mt-5">
         <h2>Promotions</h2>
         <button class="cmn-btn" data-bs-toggle="modal" data-bs-target="#addPromotionModal">Add Promotion</button>
      </div>
      <div class="cart-wrap">
         <table class="table user_management">
            <thead class="thead">
               <tr>
                  <th class="table-head" scope="col">Promotion ID</th>
                  <th class="table-head" scope="col">Promotion Name</th>
                  <th class="table-head" scope="col">Description</th>
                  <th class="table-head" scope="col">Start Date</th>
                  <th class="table-head" scope="col">End Date</th>
                  <th class="table-head" scope="col">Image URL</th>
                  <th class="table-head" scope="col">Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php if ($promotions_result->num_rows > 0): ?>
                  <?php while ($row = $promotions_result->fetch_assoc()): ?>
                     <tr id="promotion-<?php echo $row['PromotionID']; ?>">
                        <td><?php echo htmlspecialchars($row['PromotionID']); ?></td>
                        <td><?php echo htmlspecialchars($row['PromotionName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Description']); ?></td>
                        <td><?php echo htmlspecialchars($row['StartDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['EndDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['ImageURL']); ?></td>
                        <td>
                           <button class="cmn-btn edit-promotion" data-id="<?php echo $row['PromotionID']; ?>">Edit</button>
                           <button class="cmn-btn delete-promotion" data-id="<?php echo $row['PromotionID']; ?>">Delete</button>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               <?php else: ?>
                  <tr>
                     <td colspan="7">No promotions found</td>
                  </tr>
               <?php endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<!-- Add/Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="editEventForm" class="user_management">
            <div class="modal-header">
               <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" id="editEventId" name="id">
               <div class="form-group">
                  <label for="editEventName">Event Name</label>
                  <input type="text" id="editEventName" name="eventname" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="editEventDescription">Description</label>
                  <textarea id="editEventDescription" name="description" class="form-control" required></textarea>
               </div>
               <div class="form-group">
                  <label for="editEventDate">Event Date</label>
                  <input type="datetime-local" id="editEventDate" name="eventdate" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="editEventImageURL">Image URL</label>
                  <input type="text" id="editEventImageURL" name="imageurl" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="cmn-btn">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addEventForm" class="user_management">
            <div class="modal-header">
               <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="addEventName">Event Name</label>
                  <input type="text" id="addEventName" name="eventname" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="addEventDescription">Description</label>
                  <textarea id="addEventDescription" name="description" class="form-control" required></textarea>
               </div>
               <div class="form-group">
                  <label for="addEventDate">Event Date</label>
                  <input type="datetime-local" id="addEventDate" name="eventdate" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="addEventImageURL">Image URL</label>
                  <input type="text" id="addEventImageURL" name="imageurl" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="cmn-btn">Add Event</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Add/Edit Promotion Modal -->
<div class="modal fade" id="editPromotionModal" tabindex="-1" aria-labelledby="editPromotionModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="editPromotionForm" class="user_management">
            <div class="modal-header">
               <h5 class="modal-title" id="editPromotionModalLabel">Edit Promotion</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" id="editPromotionId" name="id">
               <div class="form-group">
                  <label for="editPromotionName">Promotion Name</label>
                  <input type="text" id="editPromotionName" name="promotionname" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="editPromotionDescription">Description</label>
                  <textarea id="editPromotionDescription" name="description" class="form-control" required></textarea>
               </div>
               <div class="form-group">
                  <label for="editStartDate">Start Date</label>
                  <input type="date" id="editStartDate" name="startdate" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="editEndDate">End Date</label>
                  <input type="date" id="editEndDate" name="enddate" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="editPromotionImageURL">Image URL</label>
                  <input type="text" id="editPromotionImageURL" name="imageurl" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="cmn-btn">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Add Promotion Modal -->
<div class="modal fade" id="addPromotionModal" tabindex="-1" aria-labelledby="addPromotionModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addPromotionForm" class="user_management">
            <div class="modal-header">
               <h5 class="modal-title" id="addPromotionModalLabel">Add Promotion</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="addPromotionName">Promotion Name</label>
                  <input type="text" id="addPromotionName" name="promotionname" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="addPromotionDescription">Description</label>
                  <textarea id="addPromotionDescription" name="description" class="form-control" required></textarea>
               </div>
               <div class="form-group">
                  <label for="addStartDate">Start Date</label>
                  <input type="date" id="addStartDate" name="startdate" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="addEndDate">End Date</label>
                  <input type="date" id="addEndDate" name="enddate" class="form-control" required>
               </div>
               <div class="form-group">
                  <label for="addPromotionImageURL">Image URL</label>
                  <input type="text" id="addPromotionImageURL" name="imageurl" class="form-control">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="cmn-btn">Add Promotion</button>
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
   // Handle event deletion
   $('.delete-event').click(function() {
      if (confirm('Are you sure you want to delete this event?')) {
         var eventId = $(this).data('id');
         $.post('event_delete.php', { id: eventId }, function(response) {
            alert(response);
            location.reload();
         });
      }
   });

   // Handle promotion deletion
   $('.delete-promotion').click(function() {
      if (confirm('Are you sure you want to delete this promotion?')) {
         var promotionId = $(this).data('id');
         $.post('promotion_delete.php', { id: promotionId }, function(response) {
            alert(response);
            location.reload();
         });
      }
   });

   // Open modal for editing event details
   $('.edit-event').click(function() {
      var eventId = $(this).data('id');
      $.post('event_details.php', { id: eventId }, function(response) {
         var event = JSON.parse(response);
         $('#editEventId').val(event.EventID);
         $('#editEventName').val(event.EventName);
         $('#editEventDescription').val(event.Description);
         $('#editEventDate').val(event.EventDate.replace(" ", "T"));
         $('#editEventImageURL').val(event.ImageURL);
         $('#editEventModal').modal('show');
      });
   });

   // Handle form submission for editing event details
   $('#editEventForm').submit(function(e) {
      e.preventDefault();
      $.post('event_update.php', $(this).serialize(), function(response) {
         alert(response);
         location.reload();
      });
   });

   // Handle form submission for adding new event
   $('#addEventForm').submit(function(e) {
      e.preventDefault();
      $.post('event_add.php', $(this).serialize(), function(response) {
         alert(response);
         location.reload();
      });
   });

   // Open modal for editing promotion details
   $('.edit-promotion').click(function() {
      var promotionId = $(this).data('id');
      $.post('promotion_details.php', { id: promotionId }, function(response) {
         var promotion = JSON.parse(response);
         $('#editPromotionId').val(promotion.PromotionID);
         $('#editPromotionName').val(promotion.PromotionName);
         $('#editPromotionDescription').val(promotion.Description);
         $('#editStartDate').val(promotion.StartDate);
         $('#editEndDate').val(promotion.EndDate);
         $('#editPromotionImageURL').val(promotion.ImageURL);
         $('#editPromotionModal').modal('show');
      });
   });

   // Handle form submission for editing promotion details
   $('#editPromotionForm').submit(function(e) {
      e.preventDefault();
      $.post('promotion_update.php', $(this).serialize(), function(response) {
         alert(response);
         location.reload();
      });
   });

   // Handle form submission for adding new promotion
   $('#addPromotionForm').submit(function(e) {
      e.preventDefault();
      $.post('promotion_add.php', $(this).serialize(), function(response) {
         alert(response);
         location.reload();
      });
   });
});
</script>
