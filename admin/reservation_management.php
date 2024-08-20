<?php
include 'include/header.php';
include '../config.php';

// Check if the user is logged in and has the appropriate role (Admin or Staff)
if (!in_array($_SESSION['UserType'], ['Admin', 'Staff'])) {
    header('Location: ../login.php');
    exit();
}

// Fetch all reservations
$sql = "SELECT Reservations.*, Users.FullName, Users.Email, Users.Phone FROM Reservations 
        JOIN Users ON Reservations.UserID = Users.UserID";
$result = $conn->query($sql);
?>

<div class="page-title-area page-title-img-one">
    <div class="container">
        <div class="page-title-item">
            <h2>Reservations Management</h2>
            <ul>
                <li><a href="index.php">Admin Dashboard</a></li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Reservations</li>
            </ul>
        </div>
    </div>
</div>

<div class="feature-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h2>All Reservations</h2>
        </div>
        <div class="cart-wrap">
            <table class="table user_management">
                <thead class="thead">
                    <tr>
                        <th class="table-head" scope="col">Reservation ID</th>
                        <th class="table-head" scope="col">Customer Name</th>
                        <th class="table-head" scope="col">Date</th>
                        <th class="table-head" scope="col">Time</th>
                        <th class="table-head" scope="col">Table Capacity</th>
                        <th class="table-head" scope="col">Parking Required</th>
                        <th class="table-head" scope="col">Message</th>
                        <th class="table-head" scope="col">Status</th>
                        <th class="table-head" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr id="reservation-<?php echo $row['ReservationID']; ?>">
                                <td><?php echo htmlspecialchars($row['ReservationID']); ?></td>
                                <td>
                                    <a href="#" class="customer-info" data-id="<?php echo $row['ReservationID']; ?>" data-fullname="<?php echo htmlspecialchars($row['FullName']); ?>" data-email="<?php echo htmlspecialchars($row['Email']); ?>" data-phone="<?php echo htmlspecialchars($row['Phone']); ?>">
                                        <?php echo htmlspecialchars($row['FullName']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($row['ReservationDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['ReservationTime']); ?></td>
                                <td><?php echo htmlspecialchars($row['TableCapacity']); ?></td>
                                <td><?php echo htmlspecialchars($row['ParkingRequired']); ?></td>
                                <td><?php echo htmlspecialchars($row['Message']); ?></td>
                                <td><?php echo htmlspecialchars($row['Status']); ?></td>
                                <td>
                                    <button class="cmn-btn edit-reservation" data-id="<?php echo $row['ReservationID']; ?>">Edit</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No reservations found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editReservationForm" class="user_management">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReservationModalLabel">Edit Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editReservationId" name="id">
                    <div class="form-group">
                        <label for="editCustomerName">Customer Name</label>
                        <input type="text" id="editCustomerName" name="customername" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editReservationDate">Date</label>
                        <input type="date" id="editReservationDate" name="reservationdate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editReservationTime">Time</label>
                        <input type="time" id="editReservationTime" name="reservationtime" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editTableCapacity">Table Capacity</label>
                        <input type="number" id="editTableCapacity" name="tablecapacity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editParkingRequired">Parking Required</label>
                        <select id="editParkingRequired" name="parkingrequired" class="form-control" required>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editMessage">Message</label>
                        <textarea id="editMessage" name="message" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select id="editStatus" name="status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
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

<!-- Customer Info Modal -->
<div class="modal fade" id="customerInfoModal" tabindex="-1" aria-labelledby="customerInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerInfoModalLabel">Customer Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="customerFullName"></span></p>
                <p><strong>Email:</strong> <span id="customerEmail"></span></p>
                <p><strong>Phone:</strong> <span id="customerPhone"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="cmn-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    // Open modal for customer information
    $('.customer-info').click(function() {
        var fullname = $(this).data('fullname');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        $('#customerFullName').text(fullname);
        $('#customerEmail').text(email);
        $('#customerPhone').text(phone);
        $('#customerInfoModal').modal('show');
    });

    // Open modal for editing reservation details
    $('.edit-reservation').click(function() {
        var reservationId = $(this).data('id');
        $.post('reservation_details.php', { id: reservationId }, function(response) {
            var reservation = JSON.parse(response);
            $('#editReservationId').val(reservation.ReservationID);
            $('#editCustomerName').val(reservation.FullName);
            $('#editReservationDate').val(reservation.ReservationDate);
            $('#editReservationTime').val(reservation.ReservationTime);
            $('#editTableCapacity').val(reservation.TableCapacity);
            $('#editParkingRequired').val(reservation.ParkingRequired);
            $('#editMessage').val(reservation.Message);
            $('#editStatus').val(reservation.Status);
            $('#editReservationModal').modal('show');
        });
    });

    // Handle form submission for editing reservation details
    $('#editReservationForm').submit(function(e) {
        e.preventDefault();
        $.post('reservation_update.php', $(this).serialize(), function(response) {
            alert(response);
            location.reload();
        });
    });
});
</script>