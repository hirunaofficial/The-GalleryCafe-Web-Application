<?php
session_start();
require 'config.php';

$response = ['success' => false, 'message' => ''];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (!isset($_SESSION['UserID'])) {
        $response['message'] = 'You must be logged in to make a reservation.';
        echo json_encode($response);
        exit();
    }

    $date = trim($_POST['date']);
    $time = trim($_POST['time']);
    $persons = trim($_POST['persons']);
    $parking_required = trim($_POST['parking_required']);
    $your_message = trim($_POST['your_message']);
    $user_id = $_SESSION['UserID'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert reservation into database
        $sql = "INSERT INTO Reservations (UserID, ReservationDate, ReservationTime, TableCapacity, ParkingRequired, Message, Status)
                VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception($conn->error);
        }
        $stmt->bind_param("ississ", $user_id, $date, $time, $persons, $parking_required, $your_message);
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        $response['success'] = true;
        $response['message'] = 'Your reservation has been booked successfully!';
        // Commit transaction
        $conn->commit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        $response['message'] = 'An error occurred. Please try again.';
    }

    $stmt->close();
    echo json_encode($response);
    exit();
}
?>

<?php $title = 'Reservation'; include 'include/header.php'; ?>

    <div class="page-title-area page-title-img-one">
      <div class="container">
        <div class="page-title-item">
          <h2>Book A Table</h2>
          <ul>
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <i class="bx bx-chevron-right"></i>
            </li>
            <li>Reservation</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="table-area ptb-100">
      <div class="container">
        <div class="table-wrap">
          <div class="section-title">
            <h2>Book A Table</h2>
          </div>

          <!-- Display error or success messages -->
          <div id='error' class='alert alert-danger' style="display: none;"></div>
          <div id='success' class='alert alert-success' style="display: none;"></div>

          <!-- Table Booking Form -->
          <form id="reservationForm" method="post">
            <div class="row justify-content-center">
              <div class="col-lg-6">
                <div class="form-group">
                  <input type="date" class="form-control" id="date" name="date">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input type="time" class="form-control" id="time" name="time">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <input type="number" class="form-control" placeholder="Number of persons" id="persons" name="persons">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <select id="parking-required" name="parking_required" class="form-control">
                    <option value="" selected disabled>Parking Slot Requirement (Yes/No)</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <textarea id="your_message" name="your_message" class="form-control" rows="10" placeholder="Write a message"></textarea>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn cmn-btn" id="reserveButton">Book Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
      $('#reservationForm').on('submit', function(event) {  
        event.preventDefault(); // Prevent default form submission

        let form = event.target;
        let valid = true;
        let errorMessage = '';

        if (!form.date.value.trim()) {
          valid = false;
          errorMessage += '<p>Date is required.</p>';
        }
        if (!form.time.value.trim()) {
          valid = false;
          errorMessage += '<p>Time is required.</p>';
        }
        if (!form.persons.value.trim()) {
          valid = false;
          errorMessage += '<p>Number of persons is required.</p>';
        }
        if (!form.parking_required.value.trim()) {
          valid = false;
          errorMessage += '<p>Parking slot requirement selection is required.</p>';
        }
        if (!form.your_message.value.trim()) {
          valid = false;
          errorMessage += '<p>Message is required.</p>';
        }

        if (!valid) {
          $('#error').html(errorMessage).show();
          return;
        } else {
          $('#error').hide();
        }

        // Send AJAX request
        $.ajax({
          url: 'reservation.php',
          method: 'POST',
          data: $(form).serialize(),
          success: function(response) {
            let data = JSON.parse(response);
            if (data.success) {
              form.reset();
              $('#reserveButton').prop('disabled', true).text('Book Now');
              $('#success').text(data.message).show();
              $('#error').hide();
            } else {
              $('#error').text(data.message).show();
              $('#success').hide();
            }
            $('#reserveButton').prop('disabled', true).text('Book Now');
            
            
          },
          error: function() {
            $('#error').text('An unexpected error occurred. Please try again.').show();
            $('#success').hide();
            $('#reserveButton').prop('disabled', true).text('Book Now');
          }
        });
      });
    });
    </script>
</body>
</html>