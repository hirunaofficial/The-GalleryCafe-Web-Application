<?php

include 'include/header.php';

// Check if the user is logged in and has the appropriate role (admin)
if ($_SESSION['UserType'] !== 'Admin') {
   header('Location: ../login.php');
   exit();
}

include '../config.php';

// Handle form submission for adding new users
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $usertype = $_POST['usertype'];

    $sqlAdd = "INSERT INTO Users (FullName, Email, Phone, Password, UserType) VALUES ('$fullname', '$email', '$phone', '$password', '$usertype')";
    if ($conn->query($sqlAdd) === TRUE) {
        echo "New user added successfully.";
    } else {
        echo "Error: " . $sqlAdd . "<br>" . $conn->error;
    }
}

// Fetch all user accounts
$sql = "SELECT * FROM Users";
$result = $conn->query($sql);
?>

<div class="page-title-area page-title-img-one">
    <div class="container">
        <div class="page-title-item">
            <h2>User Management</h2>
            <ul>
                <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>User Management</li>
            </ul>
        </div>
    </div>
</div>

<div class="table-area ptb-100">
    <div class="container">
        <div class="table-wrap">
            <div class="section-title">
                <h2>Add Users</h2>
            </div>
            <form method="POST" action="" id="addUserForm">
                <div class="form-group">
                    <label for="fullname">Name</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="usertype">User Type</label>
                    <select name="usertype" class="form-control" required>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>
                <button type="submit" name="add_user" class="cmn-btn">Add User</button>
            </form>
        </div>
    </div>
</div>

<section class="cart-area ptb-100">
    <div class="container">
        <div class="cart-wrap">
            <div class="section-title">
                <h2>All Users</h2>
            </div>
            <!-- Add button to copy all user emails -->
            <div class="text-center mb-3">
                <button id="copy-user-emails" class="cmn-btn">Copy All User Emails</button>
                <button id="copy-subscribe-emails" class="cmn-btn">Copy All Subscribe Emails</button>
            </div>
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th class="table-head" scope="col">Name</th>
                        <th class="table-head" scope="col">Email</th>
                        <th class="table-head" scope="col">Phone</th>
                        <th class="table-head" scope="col">User Type</th>
                        <th class="table-head" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr id="user-<?php echo $row['UserID']; ?>">
                                <td><?php echo htmlspecialchars($row['FullName']); ?></td>
                                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['UserType']); ?></td>
                                <td>
                                    <button class="cmn-btn update-user" data-id="<?php echo $row['UserID']; ?>">Update User</button>
                                    <button class="cmn-btn delete-user" data-id="<?php echo $row['UserID']; ?>">Delete User</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No users found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateUserForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="updateUserId" name="id">
                    <div class="form-group">
                        <label for="updateFullName">Name</label>
                        <input type="text" id="updateFullName" name="fullname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">Email</label>
                        <input type="email" id="updateEmail" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="updatePhone">Phone</label>
                        <input type="text" id="updatePhone" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="updatePassword">Password</label>
                        <input type="password" id="updatePassword" name="password" class="form-control">
                        <small class="form-text text-muted">Leave blank to keep the current password</small>
                    </div>
                    <div class="form-group">
                        <label for="updateUserType">User Type</label>
                        <select id="updateUserType" name="usertype" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                            <option value="Customer">Customer</option>
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
    // Handle form submission for adding new users
    $('#addUserForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'user_add.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });

    // Open modal for updating user details
    $('.update-user').click(function() {
        var userId = $(this).data('id');
        $.ajax({
            url: 'user_details.php',
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                var user = JSON.parse(response);
                $('#updateUserId').val(user.UserID);
                $('#updateFullName').val(user.FullName);
                $('#updateEmail').val(user.Email);
                $('#updatePhone').val(user.Phone);
                $('#updateUserType').val(user.UserType);
                $('#updateUserModal').modal('show');
            }
        });
    });

    // Handle form submission for updating user details
    $('#updateUserForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'user_update.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    });

    // Handle user deletion
    $('.delete-user').click(function() {
        if (confirm('Are you sure you want to delete this user?')) {
            var userId = $(this).data('id');
            $.ajax({
                url: 'user_delete.php',
                type: 'POST',
                data: { id: userId },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        }
    });

    // Copy all user emails to clipboard
    $('#copy-user-emails').click(function() {
        $.ajax({
            url: 'user_get_emails.php',
            type: 'GET',
            success: function(response) {
                var emails = response.split('\n').map(email => email.trim()).join(', ');
                navigator.clipboard.writeText(emails).then(function() {
                    alert('User emails copied to clipboard!');
                }, function(err) {
                    console.error('Failed to copy: ', err);
                });
            }
        });
    });

    // Copy all subscribe emails to clipboard
    $('#copy-subscribe-emails').click(function() {
        $.ajax({
            url: 'user_subscribe_get_emails.php',
            type: 'GET',
            success: function(response) {
                var emails = response.split('\n').map(email => email.trim()).join(', ');
                navigator.clipboard.writeText(emails).then(function() {
                    alert('Subscribe emails copied to clipboard!');
                }, function(err) {
                    console.error('Failed to copy: ', err);
                });
            }
        });
    });
});
</script>