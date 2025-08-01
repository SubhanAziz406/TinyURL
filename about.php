<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us - TheTinyURLs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css"> <!-- External CSS File for the About Us page -->
    <link rel="shortcut icon" type="image/png" href="assests/fav icon.png">
</head>
<body>
  <!-- =========================
        Header
    =========================== -->


    <?php include ("header.php") ?>


    
   <!-- /.Header --> 
    

  <!-- Hero Section -->
<section id="about-hero" class="hero-container text-center" style="background-image: url(./assests/about-bg.jpg); background-repeat: no-repeat; background-size: cover;
    background-position: center;">
    <div class="container">
        <h1 class="hero-header"> About Us</h1>
        <p class="hero-subtext">Discover who we are and what drives us at TheTinyURLs.</p>
    </div>
</section>


    <!-- About Section -->
    <section id="about-section" class="about-section text-center py-5 bg-light">
        <div class="container">
            <h2 class="mb-4"> About TheTinyURLs</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="mt-3">
                        <i class="fas fa-link"></i> At <strong>TheTinyURLs</strong>, we provide a fast, efficient, and user-friendly service for shortening long URLs, making them easy to share across platforms. 
                    </p>
                    <p>
                        <i class="fas fa-chart-line"></i> With powerful features such as click tracking and detailed analytics, we empower you to keep tabs on your links' performance, helping you enhance your digital strategy.
                    </p>
                    <p>
                        <i class="fas fa-share-alt"></i> Whether you’re sharing URLs on social media, through emails, or on blogs, <strong>TheTinyURLs</strong> is here to ensure your links are both accessible and manageable.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section id="mission-section" class="mission-section text-center py-5">
        <div class="container">
            <h2 class="mb-4"> Our Mission</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="mt-3">
                        <i class="fas fa-rocket"></i> At <strong>TheTinyURLs</strong>, our mission is to revolutionize the way people share and manage URLs. We focus on simplicity, providing a seamless experience for users looking to shorten long URLs in a matter of seconds.
                    </p>
                    <p>
                        <i class="fas fa-trophy"></i> Our commitment to innovation, quality, and user satisfaction drives us to continuously improve our platform, ensuring that we meet the growing needs of our users across various industries.
                    </p>
                    <p>
                        <i class="fas fa-handshake"></i> We believe in creating a lasting impact by offering a reliable service that enables users to optimize their online presence and make sharing easier.
                    </p>
                </div>
            </div>
        </div>
    </section>

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



    <?php include ("footer.php") ?>


    
   <!-- /.Footer --> 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
