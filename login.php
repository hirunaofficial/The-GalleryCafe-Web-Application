<?php
include 'config.php';

// Initialize variables
$error = '';

// Process the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrPhone = $_POST['email_or_phone'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($emailOrPhone) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
        // Prepare and execute the query
        $sql = "SELECT * FROM Users WHERE Email = ? OR Phone = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $emailOrPhone, $emailOrPhone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['Password'])) {
                // Store user information in session
                session_start();
                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['Username'] = $user['Username'];
                $_SESSION['UserType'] = $user['UserType'];

                // Redirect based on user type
                if ($user['UserType'] === 'Admin' || $user['UserType'] === 'Staff') {
                    header("Location: admin");
                } else {
                    header("Location: menu.php");
                }
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "No user found with that email or phone number";
        }
        
        $stmt->close();
    }

    $conn->close();
}
?>

<?php $title = 'Login'; include 'include/header.php'; ?> 

<div class="page-title-area page-title-img-one">
  <div class="container">
    <div class="page-title-item">
      <h2>Login</h2>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <i class="bx bx-chevron-right"></i>
        </li>
        <li>Login</li>
      </ul>
    </div>
  </div>
</div>
<div class="table-area ptb-100">
  <div class="container">
    <div class="table-wrap">
      <div class="section-title">
        <h2>Login</h2>
      </div>
      <?php
          if (!empty($error)) {
              echo "<div class='alert alert-danger'>$error</div>";
          }
      ?>
      <form action="login.php" method="post">
        <div class="row justify-content-center">
          <div class="col-sm-6 col-lg-12">
            <div class="form-group">
              <input type="text" class="form-control" name="email_or_phone" placeholder="Email or Phone" required data-error="Please enter your email or phone number">
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-12">
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required data-error="Please enter your password">
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn cmn-btn">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'include/footer.php'; ?>
