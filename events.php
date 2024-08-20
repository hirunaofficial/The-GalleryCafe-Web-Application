<?php $title = 'Events'; include 'include/header.php'; ?>
<?php include 'config.php'; ?>

<div class="page-title-area page-title-img-one">
  <div class="container">
    <div class="page-title-item">
      <h2>Special Events</h2>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><i class="bx bx-chevron-right"></i></li>
        <li>Events</li>
      </ul>
    </div>
  </div>
</div>

<section class="event-area pt-100 pb-70">
  <div class="container">
    <div class="row justify-content-center">
      <?php
      $sql = "SELECT EventName, Description, EventDate, ImageURL FROM SpecialEvents ORDER BY EventDate DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<div class="col-sm-6 col-lg-4">';
          echo '  <div class="event-item">';
          echo '    <div class="event-top">';
          echo '      <img src="' . $row["ImageURL"] . '" alt="Event">';
          echo '      <span>' . date('d M Y', strtotime($row["EventDate"])) . '</span>';
          echo '    </div>';
          echo '    <div class="event-bottom">';
          echo '      <h3>' . $row["EventName"] . '</h3>';
          echo '      <p>' . $row["Description"] . '</p>';
          echo '    </div>';
          echo '  </div>';
          echo '</div>';
        }
      } else {
        echo "<p>No events found</p>";
      }
      $conn->close();
      ?>
    </div>
  </div>
</section>

<?php include 'include/footer.php'; ?>
