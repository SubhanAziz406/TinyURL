<?php
// Include database connection
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    
    if ($email) {
        // Check if the email exists in the database
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate a secure reset token
            $reset_token = bin2hex(random_bytes(16));
            $reset_link = "http://thetinyurls.com/reset_password.php?token=" . $reset_token;

            // Store the reset token and its expiration (1 hour) in the database
            $stmt = $db->prepare("UPDATE users SET reset_token = :reset_token, token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email");
            $stmt->bindParam(':reset_token', $reset_token);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Send reset email
            include 'email_logic.php';
            sendPasswordResetEmail($email, $reset_link);

            header("Location: forgot_password.php?status=email_sent");
            exit();
        } else {
            echo "No user found with this email.";
        }
    } else {
        echo "Invalid email.";
    }
}
?>
