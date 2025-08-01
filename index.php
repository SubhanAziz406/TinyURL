<?php
// Include your database connection
include 'db.php'; 

// Start session (if using session for login check)
session_start();

// Initialize variables
$shortUrl = '';
$error = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the long URL from the form input
    if (isset($_POST['long_url']) && !empty($_POST['long_url'])) {
        $longUrl = $_POST['long_url'];
        
        // Validate the URL
        if (filter_var($longUrl, FILTER_VALIDATE_URL)) {
            // Generate a unique short code for the URL
            $shortCode = substr(md5(uniqid(rand(), true)), 0, 6);
            
            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                // The user is logged in, store the URL in the database
                $userId = $_SESSION['user_id'];

                // Insert the long URL and short code into the database
                $sql = "INSERT INTO urls (user_id, original_url, short_url) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt === false) {
                    die('Error preparing the SQL statement: ' . $conn->error);
                }

                // Bind parameters and execute the statement
                $stmt->bind_param("iss", $userId, $longUrl, $shortCode);

                if ($stmt->execute()) {
                    // Set the short URL to be displayed
                    $shortUrl = "https://thetinyurls.com/redirect.php?c=" . $shortCode;

                    // Debug to see if the short URL is set
                    // var_dump($shortUrl); exit();  // Uncomment for debugging
                } else {
                    $error = "Error executing the SQL statement: " . $stmt->error;
                }
            } else {
                // The user is not logged in, just generate and show the short URL
                $shortUrl = "https://thetinyurls.com/redirect.php?c=" . $shortCode;
            }
        } else {
            $error = "Invalid URL format.";
        }
    } else {
        $error = "Please enter a URL to shorten.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Tiny URLs - Shorten Your URL</title>
    <meta name="author" content="Green Bill, Inc."> <!-- Replace with your name -->
    <meta name="description"
        content="TheTinyURLs provides innovative URL shortening solutions to simplify your online experience.">
    <meta name="keywords" content="URL shortening, link shortener, short links, TheTinyURLs, online tools">
    <link rel="shortcut icon" type="image/png" href="assests/fav icon.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>


<body>
    <!-- Navbar -->
    <!-- =========================
        Header
    =========================== -->


    <?php include("header.php") ?>



    <!-- /.Header -->



    <!-- Hero Section -->
    <section class="hero-section text-center" style="background-image: url(./assests/bg-1.jpg); background-repeat: no-repeat; background-size: cover;
    background-position: center;">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-6">
                    <h1 class="display-4 mb-4"><i class="fas fa-compress-arrows-alt" style="color: #ee4619;"></i>
                        Shorten Your URLs with Ease</h1>
                    <p class="lead mb-5">Quickly turn long URLs into tiny, shareable links with just one click.</p>
                    <form action="index.php" method="POST" class="url-form mx-auto">
                        <div class="input-group input-group-lg mb-3">
                            <input type="url" name="long_url" id="long_url" class="form-control"
                                placeholder="Enter your long URL here" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-cut"></i> Shorten
                                    URL</button>
                            </div>

                        </div>
                    </form>
                    <div id="result" class="mt-4">
                        <?php if (!empty($shortUrl)): ?>
    <p>Shortened URL: <a href="<?php echo htmlspecialchars($shortUrl); ?>" target="_blank"><?php echo htmlspecialchars($shortUrl); ?></a></p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                <h2 class="display-5">Why Choose <span class="highlight">TheTinyURLs</span>?</h2>
                <p class="additional-text">Experience seamless URL shortening tailored for your needs!</p>
                <div class="additional-text">
                    <i class="fas fa-check-circle"></i> <span>Boost your brand with custom links.</span><br>
                    <i class="fas fa-clock"></i> <span>Save time with fast link management.</span><br>
                    <i class="fas fa-user-friends"></i> <span>Share short links with your team easily.</span>
                </div>
                <div class="mt-4">
                    <a href="./contact.html"   class="btn btn-outline-light">Get More Info</a>
                </div>
            </div>
            </div>
            </div>
            
        </div>
    </section>


    <!-- About Section -->
    <section id="about" class="about-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4"> About <span class="highlight">TheTinyURLs</span></h2>
                    <p class="about-text">
                        TheTinyURLs offers a fast and simple way to shorten long URLs. Our service provides seamless URL
                        shortening
                        with added features such as click tracking and analytics to help you keep track of how your
                        links are performing.
                        Whether you're sharing links on social media, blogs, or marketing campaigns, <span
                            class="highlight">TheTinyURLs</span> has got you covered.
                    </p>
                </div>
            </div>
            <div class="row mt-5 text-center">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-bolt fa-3x feature-icon"></i>
                        <h5 class="mt-3">Fast and Easy</h5>
                        <p>Shorten URLs instantly with just a click and share them anywhere.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-chart-line fa-3x feature-icon"></i>
                        <h5 class="mt-3">Analytics</h5>
                        <p>Track clicks and performance of your shortened URLs in real-time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-share-alt fa-3x feature-icon"></i>
                        <h5 class="mt-3">Share Everywhere</h5>
                        <p>Generate short URLs optimized for sharing on any platform or device.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section id="faq" class="faq-section py-5">
        <div class="container">
            <h2 class="text-center mb-5">Frequently Asked Questions</h2>
            <div class="accordion" id="faqAccordion">

                <!-- Question 1 -->
                <div class="card mb-3">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                What is TheTinyURLs?
                                <span class="arrow ml-2">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#faqAccordion">
                        <div class="card-body">
                            <i class="fas fa-link"></i> TheTinyURLs is a free service that lets you shorten long URLs,
                            making them easier to share and manage.
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="card mb-3">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How do I create a shortened URL?
                                <span class="arrow ml-2">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                        <div class="card-body">
                            <i class="fas fa-link"></i> To create a shortened URL, simply paste your long URL into the
                            input field on our homepage and click "Shorten."
                        </div>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="card mb-3">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Is TheTinyURLs free to use?
                                <span class="arrow ml-2">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                        <div class="card-body">
                            <i class="fas fa-link"></i> Yes, TheTinyURLs is completely free to use with no limits on how
                            many URLs you can shorten.
                        </div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="card mb-3">
                    <div class="card-header" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Can I track the performance of my URLs?
                                <span class="arrow ml-2">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                        <div class="card-body">
                            <i class="fas fa-link"></i> Currently, we do not offer analytics or tracking, but this
                            feature will be available soon.
                        </div>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="card mb-3">
                    <div class="card-header" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                How secure are my shortened URLs?
                                <span class="arrow ml-2">
                                    <i class="fas fa-chevron-up"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
                        <div class="card-body">
                            <i class="fas fa-link"></i> We take security seriously and employ multiple measures to
                            ensure the safety of the links you create.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    
    
    <section id="features" class="features-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5"> <span class="highlight">Features of TheTinyURLs</span></h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-lock fa-3x feature-icon"></i>
                        <h5 class="mt-3">Secure Links</h5>
                        <p>Your links are safe with us. We prioritize security to keep your data protected.</p>
                        <p>With advanced encryption protocols and regular security audits, you can trust that your links remain confidential and secure.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-user-friends fa-3x feature-icon"></i>
                        <h5 class="mt-3">User-Friendly Interface</h5>
                        <p>Our platform is designed to be intuitive, ensuring a smooth experience for all users.</p>
                        <p>Whether you're a beginner or a tech-savvy user, you'll find our interface straightforward, making link management a breeze.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-globe fa-3x feature-icon"></i>
                        <h5 class="mt-3">Global Access</h5>
                        <p>Access your links from anywhere in the world, on any device.</p>
                        <p>Our platform is optimized for mobile and desktop, ensuring you can manage your links wherever you are—no matter the time zone.</p>
                    </div>
                </div>
            </div>
            <div class="row text-center mt-5">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-chart-line fa-3x feature-icon"></i>
                        <h5 class="mt-3">Analytics Dashboard</h5>
                        <p>Track the performance of your links with our detailed analytics dashboard.</p>
                        <p>Gain insights into user engagement, click rates, and geographical data, helping you refine your marketing strategies.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-share-alt fa-3x feature-icon"></i>
                        <h5 class="mt-3">Easy Sharing Options</h5>
                        <p>Share your shortened links effortlessly across various platforms.</p>
                        <p>With just one click, you can share your links via social media, email, or messaging apps, making it easy to reach your audience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fas fa-cog fa-3x feature-icon"></i>
                        <h5 class="mt-3">Customizable Links</h5>
                        <p>Create personalized links that reflect your brand or content.</p>
                        <p>Choose custom aliases for your links, making them more memorable and relevant to your audience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="pricing" class="pricing-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Choose Your Plan</h2>
            <div class="row">
                <!-- Basic Plan -->
                <div class="col-md-4">
                    <div class="card text-center shadow border-0 hover-effect">
                        <div class="card-header bg-info text-white custom-header">
                            <h5 class="mb-0">Basic Plan</h5>
                            <h2 class="my-3 text-white">$9.99/month</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ideal for individuals and small projects.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check"></i> Shorten unlimited links</li>
                                <li><i class="fas fa-check"></i> Basic analytics</li>
                                <li><i class="fas fa-check"></i> Access from any device</li>
                                <li><i class="fas fa-check"></i> 24/7 Customer Support</li>
                            </ul>
                            <a href="./contact.html"class="btn" style="background-color: #ee4619; color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: background-color 0.3s ease; border: none;">Start Now</a>
                        </div>
                    </div>
                </div>
                <!-- Pro Plan -->
                <div class="col-md-4">
                    <div class="card text-center shadow border-0 hover-effect">
                        <div class="card-header bg-warning text-dark custom-header">
                            <h5 class="mb-0 text-white">Pro Plan</h5>
                            <h2 class="my-3 text-white">$19.99/month</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Perfect for professionals and growing businesses.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check"></i> Everything in Basic</li>
                                <li><i class="fas fa-check"></i> Advanced analytics</li>
                                <li><i class="fas fa-check"></i> Custom branded links</li>
                                <li><i class="fas fa-check"></i> Priority support</li>
                            </ul>
                            <a href="./contact.html" class="btn" style="background-color: #ee4619; color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: background-color 0.3s ease; border: none;">Start Now</a>
                        </div>
                    </div>
                </div>
                <!-- Enterprise Plan -->
                <div class="col-md-4">
                    <div class="card text-center shadow border-0 hover-effect">
                        <div class="card-header bg-success text-white custom-header">
                            <h5 class="mb-0">Enterprise Plan</h5>
                            <h2 class="my-3 text-white">Contact Us</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Custom solutions for large organizations.</p>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check"></i> Everything in Pro</li>
                                <li><i class="fas fa-check"></i> Dedicated account manager</li>
                                <li><i class="fas fa-check"></i> Custom API access</li>
                                <li><i class="fas fa-check"></i> Enhanced security features</li>
                            </ul>
                            <a href="./contact.html" class="btn" style="background-color: #ee4619; color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px; transition: background-color 0.3s ease; border: none;">Start Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="lead">Not sure which plan is right for you? <a style="color: #ee4619;" href="./contact.html" ><b>Contact us</b></a> for personalized assistance!</p>
            </div>
        </div>
    </section>


    <section id="contact" class="contact-section py-5">

        <div class="container">
            <div class="row align-items-center">
                <!-- Paragraph Section -->
                <div class="col-md-6">
                    <h2 class="text-center mb-4">Get A Quote</h2>
                    <p class="text-center">
                        Looking for a customized quote for our services? Fill out the form below or reach out to us
                        directly
                        to get a personalized estimate. Our team will get back to you with the details as soon as
                        possible.
                    </p>
                </div>

                <!-- Form Section -->

                <div class="col-md-6">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="email"><b>Email</b></label>
                            <input type="email" id="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <label for="message"><b>Message</b></label>
                            <textarea id="message" class="form-control" rows="4" placeholder="Your Message"
                                required></textarea>
                        </div>
                        <a href="./contact " class="btn btn-primary btn-lg">Get a Quote</a>

                    </form>
                </div>
            </div>
        </div>
    </section>





    <!-- Testimonial Section -->
    <!-- Testimonial Section -->
    <section id="testimonials" class="testimonials-section py-5">
        <div class="container">
            <h2 class="text-center mb-5"> What Our Users Say</h2>
            <div class="row">
                <!-- Testimonial 1 -->
                <div class="col-md-4">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-img-top">
                            <img src="./assests/profile1.jpg" class="rounded-circle mx-auto d-block user-img"
                                alt="User 1">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">
                                "TheTinyURLs has saved me so much time! It's easy to use and the click tracking is
                                really helpful for my marketing campaigns."
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="col-md-4">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-img-top">
                            <img src="./assests/profile4.jpg" class="rounded-circle mx-auto d-block user-img"
                                alt="User 2">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="card-text">
                                "I love how simple it is to shorten links with TheTinyURLs. Sharing links is so much
                                easier now!"
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="col-md-4">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-img-top">
                            <img src="assests/profile3.jpg" class="rounded-circle mx-auto d-block user-img"
                                alt="User 3">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Alice Johnson</h5>
                            <p class="card-text">
                                "TheTinyURLs has been a game changer for me. The analytics feature lets me track link
                                performance effortlessly!"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <?php include("footer.php") ?>





    <!-- Font Awesome CDN (for icons) -->
    <script>
        const toggleButton = document.getElementById('toggleArrow');
        const icon = toggleButton.querySelector('i');

        toggleButton.addEventListener('click', function () {
            // Toggle between arrow down and arrow up
            if (icon.classList.contains('fa-chevron-down')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>