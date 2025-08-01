<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $token = $_POST['token'];

    if ($new_password === $confirm_password) {
        // Validate token and check expiration
        $stmt = $db->prepare("SELECT * FROM users WHERE reset_token = :token AND token_expiration > NOW()");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $stmt = $db->prepare("UPDATE users SET password = :new_password, reset_token = NULL, token_expiration = NULL WHERE reset_token = :token");
            $stmt->bindParam(':new_password', $hashed_password);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            echo "Password successfully reset!";
        } else {
            echo "Invalid or expired token!";
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>
