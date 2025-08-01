<?php
// Include database connection
include 'db.php';

// Check if short code is provided in the query string
if (isset($_GET['c'])) {
    $short_code = $_GET['c'];

    // Prepare SQL to find the original URL based on the short code
    $sql = "SELECT original_url FROM urls WHERE short_url = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparing the SQL statement: ' . $conn->error);
    }
    $stmt->bind_param("s", $short_code);
    $stmt->execute();
    $stmt->bind_result($original_url);
    $stmt->fetch();

    // If the original URL is found, redirect to it
    if ($original_url) {
        header("Location: " . $original_url);
        exit();
    } else {
        // Short URL not found in the database
        echo "Error: Short URL not found!";
    }
} else {
    // No short URL code provided
    echo "Error: No short URL provided.";
}
?>
