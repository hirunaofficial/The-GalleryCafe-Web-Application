<?php
session_start();
if (!isset($_SESSION['UserID'])) {
    header('Location: login.php');
    exit();
}

require 'config.php';

$UserID = $_SESSION['UserID'];

// Cancel Reservation
if (isset($_POST['cancel_reservation'])) {
    $ReservationID = $_POST['ReservationID'];
    $sql = "UPDATE Reservations SET Status = 'Cancelled' WHERE ReservationID = ? AND UserID = ? AND Status != 'Confirmed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $ReservationID, $UserID);
    $stmt->execute();
    $stmt->close();
}

// Cancel Pre-Order
if (isset($_POST['cancel_preorder'])) {
    $PreOrderID = $_POST['PreOrderID'];
    $sql = "UPDATE PreOrders SET Status = 'Cancelled' WHERE PreOrderID = ? AND UserID = ? AND Status != 'Confirmed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $PreOrderID, $UserID);
    $stmt->execute();
    $stmt->close();
}

// Fetch Reservations
$sql = "SELECT * FROM Reservations WHERE UserID = ? AND Status != 'Cancelled'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();
$reservations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch Pre-Orders
$sql = "SELECT PreOrders.*, Menu.MenuName, Menu.Price 
        FROM PreOrders 
        JOIN Menu ON PreOrders.MenuID = Menu.MenuID 
        WHERE PreOrders.UserID = ? AND PreOrders.Status != 'Cancelled'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $UserID);
$stmt->execute();
$preorders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<?php $title = 'Manage Orders'; include 'include/header.php'; ?> 

<div class="page-title-area page-title-img-one">
  <div class="container">
    <div class="page-title-item">
      <h2>Manage Your Orders</h2>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <i class="bx bx-chevron-right"></i>
        </li>
        <li>Manage Your Orders</li>
      </ul>
    </div>
  </div>
</div>

<section class="service-area ptb-100">
  <div class="container">
    <div class="section-title">
      <h2>Your Reservations</h2>
    </div>

    <div class="table-responsive mb-5">
        <?php if (count($reservations) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Reservation Date</th>
                    <th>Table Capacity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reservation['ReservationID']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['ReservationDate']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['TableCapacity']); ?></td>
                        <td><?php echo htmlspecialchars($reservation['Status']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="ReservationID" value="<?php echo htmlspecialchars($reservation['ReservationID']); ?>">
                                <button type="submit" name="cancel_reservation" class="btn btn-danger" <?php echo in_array($reservation['Status'], ['Confirmed', 'Completed']) ? 'disabled' : ''; ?>>Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">You have no reservations.</p>
        <?php endif; ?>
    </div>

    <div class="section-title">
      <h2>Your Pre-Orders</h2>
    </div>

    <div class="table-responsive">
        <?php if (count($preorders) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pre-Order ID</th>
                    <th>Menu Item</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($preorders as $preorder): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($preorder['PreOrderID']); ?></td>
                        <td><?php echo htmlspecialchars($preorder['MenuName']); ?></td>
                        <td><?php echo htmlspecialchars($preorder['Quantity']); ?></td>
                        <td><?php echo htmlspecialchars($preorder['OrderDate']); ?></td>
                        <td><?php echo htmlspecialchars($preorder['Price']); ?> LKR</td>
                        <td><?php echo htmlspecialchars($preorder['Status']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="PreOrderID" value="<?php echo htmlspecialchars($preorder['PreOrderID']); ?>">
                                <button type="submit" name="cancel_preorder" class="btn btn-danger" <?php echo in_array($preorder['Status'], ['Confirmed', 'Preparing', 'Ready', 'Completed']) ? 'disabled' : ''; ?>>Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">You have no pre-orders.</p>
        <?php endif; ?>
    </div>
  </div>
</section>

<?php include 'include/footer.php'; ?>
