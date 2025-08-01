<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!$email) {
        echo "Invalid email format.";
        exit();
    }

    // Check if name and message are empty
    if (empty($name)) {
        echo "Name cannot be empty.";
        exit();
    }
    
    if (empty($message)) {
        echo "Message cannot be empty.";
        exit();
    }

    // Email details
    $to = "support@thetinyurls.com";  // Replace with your email
    $subject = "Contact Form Submission";
    $headers = "From: " . $email . "\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Email body
    $email_body = "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Message: \n" . $message . "\n";

    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        // Redirect back to the form page with success
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?status=success');
        exit();
    } else {
        echo "Failed to send message.";
    }
} else {
    
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./css/style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="assests/fav icon.png">
</head>

<body>

  <!-- Navbar -->
     <!-- =========================
        Header
    =========================== -->


    <?php include("header.php") ?>



    <!-- /.Header -->


         

  <!-- Hero Section -->
<section id="contact-hero" class="hero-container text-center" style="background-image: url(./assests/contact-bg.jpg); background-repeat: no-repeat; background-size: cover;
background-position: center;">
    <div class="container">
        <h1 class="hero-header">Contact Us</h1>
        <p class="hero-subtext">We're here to help you with any questions or concerns you may have.</p>
    </div>
</section>



<div class="container py-5">
    <div class="row">
        <!-- Additional Content Section with Image -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="additional-content text-center">
                <img src="./assests/contact.jpg" alt="Contact Us" class="img-fluid mb-3" style="border-radius: 10px; max-width: 90%; height: auto;">
                
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="col-md-6">
            <div class="contact-form-wrapper">
                <div class="form-card bg-light rounded-lg shadow-lg px-4 py-5">
                    <h2 class="form-title mb-4 text-center" style="color: #FF5F1F;"><b>Contact Us</b></h2>
                    <form id="contactForm">
                        <div class="form-group mb-4">
                            <label for="userName" class="form-label"><b>Your Name</b></label>
                            <input
                                type="text"
                                class="form-control custom-input"
                                id="userName"
                                placeholder="Enter your name"
                            />
                        </div>
                        <div class="form-group mb-4">
                            <label for="userEmail" class="form-label"><b>Your Email</b></label>
                            <input
                                type="email"
                                class="form-control custom-input"
                                id="userEmail"
                                placeholder="Enter your email"
                            />
                        </div>
                        <div class="form-group mb-4">
                            <label for="userMessage" class="form-label"><b>Your Message</b></label>
                            <textarea
                                id="userMessage"
                                rows="4"
                                class="form-control custom-textarea"
                                placeholder="Enter your message"
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="btn custom-btn w-100"
                        >
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer -->
    <?php include("footer.php") ?>




    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
