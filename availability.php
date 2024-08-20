<?php
$title = 'Availability'; 
include 'include/header.php';
include 'config.php';

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
      <h2>Availability</h2>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <i class="bx bx-chevron-right"></i>
        </li>
        <li>Availability</li>
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
                    </tr>
                </thead>
                <tbody>
                    <?php if ($table_result->num_rows > 0): ?>
                        <?php while ($row = $table_result->fetch_assoc()): ?>
                            <tr id="table-<?php echo $row['TableID']; ?>">
                                <td><?php echo htmlspecialchars($row['TableID']); ?></td>
                                <td><?php echo htmlspecialchars($row['Capacity']); ?></td>
                                <td><?php echo htmlspecialchars($row['AvailabilityStatus']); ?></td>
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
                    </tr>
                </thead>
                <tbody>
                    <?php if ($parking_result->num_rows > 0): ?>
                        <?php while ($row = $parking_result->fetch_assoc()): ?>
                            <tr id="parking-<?php echo $row['ParkingID']; ?>">
                                <td><?php echo htmlspecialchars($row['ParkingID']); ?></td>
                                <td><?php echo htmlspecialchars($row['ParkingSpotNumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['AvailabilityStatus']); ?></td>
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

<?php include 'include/footer.php'; ?>