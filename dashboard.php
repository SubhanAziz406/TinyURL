<?php


// Include database connection
include 'db.php';

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ensure session variables are set
if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = ""; // Set it to an empty string or handle this in the login script.
}

// Get user data from session
$user_id = $_SESSION['user_id'];
$name = $_SESSION['username'] ?? 'Guest';  // In case username is missing
$email = $_SESSION['email'];

// Set a timeout period (in seconds)
$timeout_duration = 1800; // 30 minutes

// Check if the session has timed out
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();

// Function to generate random short code
function generateShortCode($length = 6) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

// Initialize variables
$short_url = '';
$error = '';




// Check if the form is submitted for URL shortening
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['long_url'])) {
    $long_url = filter_var($_POST['long_url'], FILTER_VALIDATE_URL);
    
    if ($long_url) {
        $short_code = generateShortCode();

        $sql = "INSERT INTO urls (user_id, original_url, short_url) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Error preparing the SQL statement: ' . $conn->error);
        }
        $stmt->bind_param("iss", $user_id, $long_url, $short_code);

        if ($stmt->execute()) {
            $short_url = "http://thetinyurls.com/redirect.php?c=" . $short_code;
        } else {
            $error = "Error saving the short URL: " . $stmt->error;
        }
    } else {
        $error = "Please enter a valid URL.";
    }
}



// Fetch the user's shortened URLs from the database
$sql = "SELECT url_id, original_url, short_url, created_at FROM urls WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Fetch data with bind_result (to avoid get_result issues)
$stmt->bind_result($url_id, $original_url, $short_url, $created_at);

// Store the results in an array
$urls = [];
while ($stmt->fetch()) {
    $urls[] = [
        'url_id' => $url_id,
        'original_url' => $original_url,
        'short_url' => $short_url,
        'created_at' => $created_at,
    ];
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - TheTinyURLs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="assests/fav icon.png">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        /* Custom Styles for Enhancements */
        .navbar {
            background-color: #ee4619;
            color: white;
        }
        .navbar .nav-link {
            color: white;
        }
        .navbar-brand i {
            color: white;
        }
        .card {
            border-radius: 15px;
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-title {
            font-size: 1.5rem;
        }
        .table {
            margin-top: 20px;
        }
        .table-hover tbody tr:hover {
            background-color: #f0f0f0;
        }
        .analytics-section {
            padding: 50px 0;
            background-color: #f9f9f9;
        }
        .footer {
            background-color: #ee4619;
            color: white;
        }
        .footer p {
            margin: 0;
        }
        /* Button Customization */
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-info:hover, .btn-danger:hover {
            opacity: 0.8;
        }
        /* Smooth Scrolling for Navbar Links */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <a class="navbar-brand" href="index"><i class="fas fa-link"></i> The Tiny URLs Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="index "><i class="fas fa-home"></i> Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="logout"><i class="fas fa-user"></i> Logout </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-8">
                
                    <h1 class="display-4 mb-4">Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
                    <p class="lead mb-5">Quickly turn long URLs into tiny, shareable links with just one click.</p>
                    <form action="dashboard.php" method="POST" class="url-form mx-auto">
                        <div class="input-group input-group-lg mb-3">
                            <input type="url" name="long_url" id="long_url" class="form-control" placeholder="Enter your long URL here" required>
                            
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-cut"></i> Shorten URL</button>
                            </div>
                            
                        </div>
                    </form>
                    
                    
                    
                    <div id="result" class="mt-4">
                     <!-- Display short URL if generated -->
    <?php if ($short_url): ?>
        <p>Shortened URL: <a href="https://thetinyurls.com/redirect.php?c=<?php echo htmlspecialchars($short_url); ?>" target="_blank"><?php echo htmlspecialchars($short_url); ?></a></p>

    <?php endif; ?>

    <!-- Display error messages -->
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Dashboard Overview Section -->



<!-- List all previously generated URLs for this user -->





    <!-- Shortened URLs Section -->
    <section class="my-urls-section py-5">
        <div class="container">
            <h2 class="text-center mb-4"><i class="fas fa-link"></i> Your Generated URLs</h2>
            <?php if (!empty($urls)): ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Original URL</th>
                        <th>Shortened URL</th>
                        <th>Date Created</th>
                        
                    </tr>
                </thead>
                <tbody id="urlTable">
                    <!-- Sample Row -->
                    <?php foreach ($urls as $url): ?>
            <tr>
            <td><?php echo $url['original_url']; ?></td>
                        <td><a href="https://thetinyurls.com/redirect.php?c=<?php echo $url['short_url']; ?>" target="_blank"><?php echo $url['short_url']; ?></a></td>
                        <td><?php echo $url['created_at']; ?></td>
               
            </tr>
        <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>You haven't generated any URLs yet.</p>
                <?php endif; ?>
        </div>
    </section>



    <!-- Footer -->
    <footer class="footer bg-dark text-light text-center py-3">
        <p><i class="fas fa-copyright"></i> 2024 The Tiny URLs. All rights reserved.</p>
    </footer>

    <!-- JS and Chart.js for Analytics -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Animate Counters
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.count');
            counters.forEach(counter => {
                counter.innerText = '0';
                const updateCounter = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const increment = target / 200;
                    if (count < target) {
                        counter.innerText = `${Math.ceil(count + increment)}`;
                        setTimeout(updateCounter, 1);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCounter();
            });
        });

        // Analytics Chart
        const ctx = document.getElementById('clicksChart').getContext('2d');
        const clicksChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: '# of Clicks',
                    data: [120, 190, 300, 500, 200, 300, 400],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
