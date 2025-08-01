<?php
function sendPasswordResetEmail($email, $reset_link) {
    $to = $email;
    $subject = "Password Reset Request";
    $message = "Click the link below to reset your password:\n\n" . $reset_link;
    $headers = "From: no-reply@thetinyurls.com";

    // Send email (you can replace this with more robust email handling)
    mail($to, $subject, $message, $headers);
}
?>
