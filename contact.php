<?php
$title = 'Contact';
include 'include/header.php'; 
include 'config.php';

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $phone_number = test_input($_POST["phone_number"]);
    $subject = test_input($_POST["msg_subject"]);
    $message = test_input($_POST["message"]);
    $agree = isset($_POST["gridCheck"]);

    $error = "";
    if (empty($name)) {
        $error .= "<p>Name is required.</p>";
    }
    if (empty($email)) {
        $error .= "<p>Email is required.</p>";
    }
    if (empty($phone_number)) {
        $error .= "<p>Phone number is required.</p>";
    }
    if (empty($subject)) {
        $error .= "<p>Subject is required.</p>";
    }
    if (empty($message)) {
        $error .= "<p>Message is required.</p>";
    }
    if (!$agree) {
        $error .= "<p>You must agree to the terms and privacy policy.</p>";
    }

    if (empty($error)) {
        $sql = "INSERT INTO contactresponses (name, email, phone_number, subject, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $phone_number, $subject, $message);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Your message has been sent successfully!";
        } else {
            $error = "<p>There was an error sending your message. Please try again later.</p>";
        }

        $stmt->close();
        $conn->close();
    }

    if (!empty($error)) {
        $response = "<div class='alert alert-danger'>$error</div>";
    }

    if (isset($_SESSION['success'])) {
        $response = "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
    }

    echo $response;
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>

<div class="page-title-area page-title-img-one">
    <div class="container">
        <div class="page-title-item">
            <h2>Contact Us</h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
</div>

<div class="contact-location-area pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <div class="location-item active">
                    <i class="bx bxs-time-five"></i>
                    <ul>
                        <li>9:00 AM to 10:00 PM</li>
                        <li>(Monday to Sunday)</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="location-item active">
                    <i class="bx bxs-location-plus"></i>
                    <ul>
                        <li>No 112/51, Bambalapitiya,<br>Colombo, Sri Lanka</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="location-item active">
                    <i class="bx bxs-contact"></i>
                    <ul>
                        <li>+94 72 921 5220<br>info@thegallerycafe.lk</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-form-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="contact-item">
                    <div id="form-response"></div>
                    <form id="contactForm" method="POST">
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-12">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12">
                                <div class="form-group">
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12">
                                <div class="form-group">
                                    <input type="text" name="msg_subject" id="msg_subject" class="form-control" placeholder="Subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="6" placeholder="Message"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <div class="form-check agree-label">
                                        <input name="gridCheck" class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck"> Accept Terms & Conditions And Privacy Policy.</label>
                                        <div class="help-block with-errors gridCheck-error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <button type="submit" class="cmn-btn btn">Send Message</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                    <div class="contact-social">
                        <span>Follow Us on</span>
                        <ul>
                            <li><a href="https://www.facebook.com/TheGalleryCafe/"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="https://twitter.com/TheGalleryCafe"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="https://twitter.com/TheGalleryCafe"><i class="bx bxl-instagram"></i></a></li>
                            <li><a href="https://www.youtube.com/TheGalleryCafe" target="_blank"><i class="bx bxl-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-img">
                    <img src="assets/img/contact-man.png" alt="Contact">
                </div>
            </div>
        </div>
    </div>
</div>

<section class="chef-area chef-area-two pb-70">
    <div class="container">
        <div class="section-title">
            <h2>Our Special Chefs</h2>
            <p>Meet the talented chefs behind our culinary creations. Our team is dedicated to bringing you the best dining experience possible.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-3">
                <div class="chef-item">
                    <div class="chef-top">
                        <img src="assets/img/chef/1.jpg" alt="Chef">
                        <div class="chef-inner">
                            <h3>Nuwan Perera</h3>
                            <span>Head Chef</span>
                        </div>
                    </div>
                    <div class="chef-bottom">
                        <ul>
                            <li><a href="https://www.facebook.com/nuwanperera"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="https://twitter.com/nuwanperera"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/nuwanperera"><i class="bx bxl-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="chef-item">
                    <div class="chef-top">
                        <img src="assets/img/chef/2.jpg" alt="Chef">
                        <div class="chef-inner">
                            <h3>Chandana Silva</h3>
                            <span>Sous Chef</span>
                        </div>
                    </div>
                    <div class="chef-bottom">
                        <ul>
                            <li><a href="https://www.facebook.com/chandana.silva"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="https://twitter.com/chandana.silva"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/chandana.silva"><i class="bx bxl-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="chef-item">
                    <div class="chef-top">
                        <img src="assets/img/chef/3.jpg" alt="Chef">
                        <div class="chef-inner">
                            <h3>Tharindu Silva</h3>
                            <span>Pastry Chef</span>
                        </div>
                    </div>
                    <div class="chef-bottom">
                        <ul>
                            <li><a href="https://www.facebook.com/tharindu.silva"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="https://twitter.com/tharindu.silva"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/tharindu.silva"><i class="bx bxl-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="chef-item">
                    <div class="chef-top">
                        <img src="assets/img/chef/4.jpg" alt="Chef">
                        <div class="chef-inner">
                            <h3>Shanaka Fernando</h3>
                            <span>Saucier</span>
                        </div>
                    </div>
                    <div class="chef-bottom">
                        <ul>
                            <li><a href="https://www.facebook.com/shanaka.fernando"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="https://twitter.com/shanaka.fernando"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/shanaka.fernando"><i class="bx bxl-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'include/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#contactForm').on('submit', function(event) {
        event.preventDefault();
        var form = $(this)[0];
        var formData = new FormData(form);
        var valid = true;
        var errorMessage = '';

        if (!form.name.value.trim()) {
            valid = false;
            errorMessage += '<p>Name is required.</p>';
        }
        if (!form.email.value.trim()) {
            valid = false;
            errorMessage += '<p>Email is required.</p>';
        }
        if (!form.phone_number.value.trim()) {
            valid = false;
            errorMessage += '<p>Phone number is required.</p>';
        }
        if (!form.msg_subject.value.trim()) {
            valid = false;
            errorMessage += '<p>Subject is required.</p>';
        }
        if (!form.message.value.trim()) {
            valid = false;
            errorMessage += '<p>Message is required.</p>';
        }
        if (!form.gridCheck.checked) {
            valid = false;
            errorMessage += '<p>You must agree to the terms and privacy policy.</p>';
        }

        if (valid) {
            $.ajax({
                url: 'contact.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#form-response').html(response);
                    form.reset();
                }
            });
        } else {
            $('#form-response').html("<div class='alert alert-danger'>" + errorMessage + "</div>");
        }
    });
});
</script>
</body>
</html>
