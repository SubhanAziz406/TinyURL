<?php
// Start a session if needed (optional)
session_start();

// Include your database connection
include 'db.php'; // Ensure 'db.php' contains your correct database connection setup

// Function to generate a random string for short URL
function generateShortCode($length = 6)
{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the long URL from the form and validate it
    $long_url = filter_var($_POST['long_url'], FILTER_VALIDATE_URL);

    // Validate the long URL
    if ($long_url) {
        // Generate a short code
        $short_code = generateShortCode();

        try {
            // Prepare the SQL query to insert the long URL and short code into the database
            $stmt = $db->prepare("INSERT INTO urls (user_id, original_url, short_url, created_at) VALUES (:user_id, :original_url, :short_url, NOW())");

            // Set the parameters (assuming a static user_id of 1 for now; change it if needed)
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':original_url', $long_url);
            $stmt->bindParam(':short_url', $short_code);

            // Assuming you store the user_id in the session after login
            $user_id = $_SESSION['user_id'];

            // Execute the insert query
            $stmt->execute();

            // Create the short URL (this can be your actual domain)
            $short_url = "https://thetinyurls.com/" . $short_code;

            // Display the result
            echo "<h3>Shortened URL:</h3>";
            echo "<p>Long URL: " . htmlspecialchars($long_url) . "</p>";
            echo "<p>Short URL: <a href='" . $short_url . "'>" . $short_url . "</a></p>";

        } catch (PDOException $e) {
            // Handle any errors during the insertion
            echo "Error saving to the database: " . $e->getMessage();
        }

    } else {
        echo "<p>Invalid URL. Please try again.</p>";
    }
} else {
    echo "<p>No URL submitted.</p>";
}
?>