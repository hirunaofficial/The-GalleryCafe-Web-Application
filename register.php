<?php
session_start();
include 'config.php';

// Initialize variables
$error = '';
$success = '';

// Process the registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($phone)) {
        $error = "Please fill in all fields.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if email or phone already exists
        $sql = "SELECT * FROM Users WHERE Email = ? OR Phone = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email or phone number already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $sql = "INSERT INTO Users (Email, Phone, Password, UserType, FullName) VALUES (?, ?, ?, 'Customer', ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $email, $phone, $hashed_password, $name);

            if ($stmt->execute()) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<?php $title = 'Register'; include 'include/header.php'; ?> 

<div class="page-title-area page-title-img-one">
  <div class="container">
    <div class="page-title-item">
      <h2>Register</h2>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <i class="bx bx-chevron-right"></i>
        </li>
        <li>Register</li>
      </ul>
    </div>
  </div>
</div>
<div class="table-area ptb-100">
  <div class="container">
    <div class="table-wrap">
      <div class="section-title">
        <h2>Register</h2>
      </div>
      <?php
      if (!empty($error)) {
          echo "<div class='alert alert-danger'>$error</div>";
      }
      if (!empty($success)) {
          echo "<div class='alert alert-success'>$success</div>";
      }
      ?>
      <form action="register.php" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-sm-6 col-lg-12">
            <div class="form-group">
              <input type="text" class="form-control" name="name" placeholder="Name" required data-error="Please enter your name" autocomplete="off">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-12">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email" required data-error="Please enter your email" autocomplete="off">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-12">
            <div class="form-group">
              <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required data-error="Please enter your phone number" autocomplete="off">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-12">
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required data-error="Please enter your password" autocomplete="new-password">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-12">
            <div class="form-group">
              <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required data-error="Please confirm your password" autocomplete="new-password">
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn cmn-btn">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>