<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - TheTinyURLs</title>
<link rel="shortcut icon" type="image/png" href="assests/fav icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css"> <!-- External CSS File for the About Us page -->
</head>
<body>

        <!-- =========================
        Header
    =========================== -->


    <?php include("header.php") ?>



    <!-- /.Header -->

    <!-- Hero Section -->
    <section id="faq-hero" class="hero-container text-center">
        <div class="container">
            <h1 class="hero-header">Frequently Asked Questions</h1>
            <p class="hero-subtext">Find answers to the most common questions about TheTinyURLs</p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-container">
        <div class="container">
            <h2 class="text-center mb-5"> Your Questions Answered</h2>
            <div class="faq-wrapper">

                <!-- Question 1 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-link"></i> What is TheTinyURLs?</h5>
                    <p>TheTinyURLs is a free online service for shortening long URLs, making them easier to share and manage across various platforms.</p>
                </div>

                <!-- Question 2 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-cogs"></i> How does TheTinyURLs work?</h5>
                    <p>To shorten a URL, paste it into our input field, and we generate a custom, short link for quick and easy sharing.</p>
                </div>

                <!-- Question 3 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-chart-line"></i> Can I track clicks on my shortened URLs?</h5>
                    <p>Yes, you can track clicks with our basic analytics to monitor the number of visits your links are generating.</p>
                </div>

                <!-- Question 4 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-lock"></i> Is TheTinyURLs secure?</h5>
                    <p>Absolutely, all links generated through TheTinyURLs are encrypted to ensure the security and safety of your shared links.</p>
                </div>

                <!-- Question 5 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-user-shield"></i> Can I customize my short URLs?</h5>
                    <p>Currently, TheTinyURLs doesn't allow full customization, but we're working on offering custom short links in future updates.</p>
                </div>

                <!-- Question 6 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-globe"></i> How long are the shortened URLs valid?</h5>
                    <p>Shortened URLs created through TheTinyURLs remain active indefinitely, so you can keep using them as long as you need.</p>
                </div>

                <!-- Question 7 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-exchange-alt"></i> Are there any limits to URL shortening?</h5>
                    <p>Our service allows you to shorten as many URLs as you want. However, large-scale URL shortening may require special consideration.</p>
                </div>

                <!-- Question 8 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-user"></i> Do I need to create an account to use TheTinyURLs?</h5>
                    <p>No account is needed to shorten links. However, creating an account unlocks additional features such as click tracking and analytics.</p>
                </div>

                <!-- Question 9 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-envelope"></i> How can I contact support?</h5>
                    <p>You can reach out to us via the contact form on our website, and we'll assist you with any queries or technical issues promptly.</p>
                </div>

                <!-- Question 10 -->
                <div class="faq-item-box">
                    <h5><i class="fas fa-shield-alt"></i> Does TheTinyURLs protect against spam or malicious links?</h5>
                    <p>Yes, we have measures in place to block harmful links and prevent the use of our service for any malicious activities online.</p>
                </div>

            </div>
        </div>
    </section>

   <!-- Footer -->
    <?php include("footer.php") ?>

</body>
</html>
