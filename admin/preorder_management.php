<?php
include 'include/header.php';

// Check if the user is logged in and has the appropriate role (Admin or Staff)
if (!in_array($_SESSION['UserType'], ['Admin', 'Staff'])) {
    header('Location: ../login.php');
    exit();
}

include '../config.php';

// Fetch all pre-orders
$sql = "SELECT PreOrders.*, Users.FullName, Users.Email, Users.Phone, Menu.MenuName, Menu.Price FROM PreOrders 
        JOIN Users ON PreOrders.UserID = Users.UserID 
        JOIN Menu ON PreOrders.MenuID = Menu.MenuID";
$result = $conn->query($sql);
?>

<div class="page-title-area page-title-img-one">
    <div class="container">
        <div class="page-title-item">
            <h2>Pre-Orders Management</h2>
            <ul>
                <li><a href="index.php">Admin Dashboard</a></li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Pre-Orders</li>
            </ul>
        </div>
    </div>
</div>

<div class="feature-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h2>All Pre-Orders</h2>
        </div>
        <div class="cart-wrap">
            <table class="table user_management">
                <thead class="thead">
                    <tr>
                        <th class="table-head" scope="col">PreOrder ID</th>
                        <th class="table-head" scope="col">Customer Name</th>
                        <th class="table-head" scope="col">Menu Item</th>
                        <th class="table-head" scope="col">Quantity</th>
                        <th class="table-head" scope="col">Price</th>
                        <th class="table-head" scope="col">Order Date</th>
                        <th class="table-head" scope="col">Status</th>
                        <th class="table-head" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr id="preorder-<?php echo $row['PreOrderID']; ?>">
                                <td><?php echo htmlspecialchars($row['PreOrderID']); ?></td>
                                <td>
                                    <a href="#" class="customer-info" data-id="<?php echo $row['PreOrderID']; ?>" data-fullname="<?php echo htmlspecialchars($row['FullName']); ?>" data-email="<?php echo htmlspecialchars($row['Email']); ?>" data-phone="<?php echo htmlspecialchars($row['Phone']); ?>">
                                        <?php echo htmlspecialchars($row['FullName']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($row['MenuName']); ?></td>
                                <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                                <td><?php echo htmlspecialchars($row['Price']); ?></td>
                                <td><?php echo htmlspecialchars($row['OrderDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['Status']); ?></td>
                                <td>
                                    <button class="cmn-btn edit-preorder" data-id="<?php echo $row['PreOrderID']; ?>">Edit</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No pre-orders found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit PreOrder Modal -->
<div class="modal fade" id="editPreOrderModal" tabindex="-1" aria-labelledby="editPreOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPreOrderForm" class="user_management">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPreOrderModalLabel">Edit Pre-Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editPreOrderId" name="id">
                    <div class="form-group">
                        <label for="editCustomerName">Customer Name</label>
                        <input type="text" id="editCustomerName" name="customername" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editMenuItem">Menu Item</label>
                        <input type="text" id="editMenuItem" name="menuitem" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editQuantity">Quantity</label>
                        <input type="number" id="editQuantity" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="text" id="editPrice" name="price" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editOrderDate">Order Date</label>
                        <input type="datetime-local" id="editOrderDate" name="orderdate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select id="editStatus" name="status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Preparing">Preparing</option>
                            <option value="Ready">Ready</option>
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

    // Open modal for editing pre-order details
    $('.edit-preorder').click(function() {
        var preorderId = $(this).data('id');
        $.post('preorder_details.php', { id: preorderId }, function(response) {
            var preorder = JSON.parse(response);
            $('#editPreOrderId').val(preorder.PreOrderID);
            $('#editCustomerName').val(preorder.FullName);
            $('#editMenuItem').val(preorder.MenuName);
            $('#editQuantity').val(preorder.Quantity);
            $('#editPrice').val(preorder.Price);
            $('#editOrderDate').val(new Date(preorder.OrderDate).toISOString().slice(0, 16));
            $('#editStatus').val(preorder.Status);
            $('#editPreOrderModal').modal('show');
        });
    });

    // Handle form submission for editing pre-order details
    $('#editPreOrderForm').submit(function(e) {
        e.preventDefault();
        $.post('preorder_update.php', $(this).serialize(), function(response) {
            alert(response);
            location.reload();
        });
    });
});

</script>
