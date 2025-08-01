<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Similar styling as forgot password page */
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
        input[type="password"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="password"] {
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
    </style>
</head>
<body>

<div class="container">
    <h2>Reset Your Password</h2>
    <form action="reset_password_backend.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
        <input type="submit" value="Reset Password">
    </form>
</div>

</body>
</html>
