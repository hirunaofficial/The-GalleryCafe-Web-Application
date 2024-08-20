<?php
include 'include/header.php';

// Check if the user is logged in and has the appropriate role (Admin or Staff)
if (!in_array($_SESSION['UserType'], ['Admin', 'Staff'])) {
    header('Location: ../login.php');
    exit();
}

include '../config.php';

// Fetch all table capacities
$table_sql = "SELECT * FROM TableCapacities";
$table_result = $conn->query($table_sql);

// Fetch all parking availability
$parking_sql = "SELECT * FROM ParkingAvailability";
$parking_result = $conn->query($parking_sql);
?>

<div class="page-title-area page-title-img-one">
    <div class="container">
        <div class="page-title-item">
            <h2>Table and Parking Management</h2>
            <ul>
                <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Table and Parking Management</li>
            </ul>
        </div>
    </div>
</div>

<div class="feature-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h2>Table Capacities</h2>
        </div>
        <div class="cart-wrap">
            <table class="table user_management">
                <thead class="thead">
                    <tr>
                        <th class="table-head" scope="col">Table ID</th>
                        <th class="table-head" scope="col">Capacity</th>
                        <th class="table-head" scope="col">Availability Status</th>
                        <th class="table-head" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($table_result->num_rows > 0): ?>
                        <?php while ($row = $table_result->fetch_assoc()): ?>
                            <tr id="table-<?php echo $row['TableID']; ?>">
                                <td><?php echo htmlspecialchars($row['TableID']); ?></td>
                                <td><?php echo htmlspecialchars($row['Capacity']); ?></td>
                                <td><?php echo htmlspecialchars($row['AvailabilityStatus']); ?></td>
                                <td>
                                    <button class="cmn-btn edit-table" data-id="<?php echo $row['TableID']; ?>">Edit</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No tables found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="section-title mt-5">
            <h2>Parking Availability</h2>
        </div>
        <div class="cart-wrap">
            <table class="table user_management">
                <thead class="thead">
                    <tr>
                        <th class="table-head" scope="col">Parking ID</th>
                        <th class="table-head" scope="col">Parking Spot Number</th>
                        <th class="table-head" scope="col">Availability Status</th>
                        <th class="table-head" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($parking_result->num_rows > 0): ?>
                        <?php while ($row = $parking_result->fetch_assoc()): ?>
                            <tr id="parking-<?php echo $row['ParkingID']; ?>">
                                <td><?php echo htmlspecialchars($row['ParkingID']); ?></td>
                                <td><?php echo htmlspecialchars($row['ParkingSpotNumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['AvailabilityStatus']); ?></td>
                                <td>
                                    <button class="cmn-btn edit-parking" data-id="<?php echo $row['ParkingID']; ?>">Edit</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No parking spots found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Table Modal -->
<div class="modal fade" id="editTableModal" tabindex="-1" aria-labelledby="editTableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editTableForm" class="user_management">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTableModalLabel">Edit Table Capacity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editTableId" name="id">
                    <div class="form-group">
                        <label for="editTableCapacity">Capacity</label>
                        <input type="number" id="editTableCapacity" name="capacity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editTableStatus">Availability Status</label>
                        <select id="editTableStatus" name="status" class="form-control" required>
                            <option value="Available">Available</option>
                            <option value="Occupied">Occupied</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="cmn-btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Parking Modal -->
<div class="modal fade" id="editParkingModal" tabindex="-1" aria-labelledby="editParkingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editParkingForm" class="user_management">
                <div class="modal-header">
                    <h5 class="modal-title" id="editParkingModalLabel">Edit Parking Availability</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editParkingId" name="id">
                    <div class="form-group">
                        <label for="editParkingSpotNumber">Parking Spot Number</label>
                        <input type="text" id="editParkingSpotNumber" name="parkingspotnumber" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editParkingStatus">Availability Status</label>
                        <select id="editParkingStatus" name="status" class="form-control" required>
                            <option value="Available">Available</option>
                            <option value="Occupied">Occupied</option>
                        </select>
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
    // Open modal for editing table details
    $('.edit-table').click(function() {
        var tableId = $(this).data('id');
        $.post('table_details.php', { id: tableId }, function(response) {
            var table = JSON.parse(response);
            $('#editTableId').val(table.TableID);
            $('#editTableCapacity').val(table.Capacity);
            $('#editTableStatus').val(table.AvailabilityStatus);
            $('#editTableModal').modal('show');
        });
    });

    // Handle form submission for editing table details
    $('#editTableForm').submit(function(e) {
        e.preventDefault();
        $.post('table_update.php', $(this).serialize(), function(response) {
            alert(response);
            location.reload();
        });
    });

    // Open modal for editing parking details
    $('.edit-parking').click(function() {
        var parkingId = $(this).data('id');
        $.post('parking_details.php', { id: parkingId }, function(response) {
            var parking = JSON.parse(response);
            $('#editParkingId').val(parking.ParkingID);
            $('#editParkingSpotNumber').val(parking.ParkingSpotNumber);
            $('#editParkingStatus').val(parking.AvailabilityStatus);
            $('#editParkingModal').modal('show');
        });
    });

    // Handle form submission for editing parking details
    $('#editParkingForm').submit(function(e) {
        e.preventDefault();
        $.post('parking_update.php', $(this).serialize(), function(response) {
            alert(response);
            location.reload();
        });
    });
});
</script>