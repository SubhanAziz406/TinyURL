<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="email"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="email"] {
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Forgot Password</h2>
    <form action="forgot_password_backend.php" method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="submit" value="Submit">
    </form>
    <div class="message">
        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'email_sent') {
            echo '<p>An email has been sent to reset your password.</p>';
        } elseif (isset($_GET['status']) && $_GET['status'] == 'error') {
            echo '<p>Error: Could not send reset email.</p>';
        }
        ?>
    </div>
</div>

</body>
</html>
