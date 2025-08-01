<?php
session_start();
include 'db.php'; // Include your database connection

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE email = ?");
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Use bind_result() instead of get_result()
        $stmt->bind_result($user_id, $username, $hashed_password);

        if ($stmt->fetch()) {
            // Now we have $user_id, $username, and $hashed_password

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Correct password, set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                
                // Redirect to the dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                // Incorrect password
                $error = "Incorrect password!";
            }
        } else {
            // Email not found in the database
            $error = "Email not found!";
        }

        $stmt->close();
    } else {
        // Error in preparing the statement
        $error = "Error preparing the SQL statement.";
    }
}
?>

<!-- Display error message if any -->
<?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - TheTinyURLs</title>
<link rel="shortcut icon" type="image/png" href="assests/fav icon.png">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        body {
            background-color: #f0f0f0;
        }
        .ali {
            color: #ee4619;
        }

        .navbar {
            background-color: #f9f9f9;
        }
        .nav-icon {
            font-size: 36px; /* Large icon size */
            color: #ee4619; /* Icon color */
        }
        .nav-icon:hover {
            color: #ee4619; /* Hover color */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="ml-auto">
                <a href="./index.php " class="nav-icon">
                    <i class="fas fa-home"></i>
                </a>
            </div>
        </div>
    </nav>

<section class="ali d-flex justify-content-center align-items-center vh-100">
    <form action="./login" method="POST" class="p-4 rounded shadow-lg" style="background-color: #f9f9f9; max-width: 400px;">
        <h2 class="text-center mb-4" style="color: #ee4619;">Login Form</h2>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" height="20">
                        <g data-name="Layer 3" id="Layer_3">
                            <path d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z" fill="#ee4619"></path>
                        </g>
                    </svg>
                </span>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="-64 0 512 512" height="20">
                        <path d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0" fill="#ee4619"></path>
                        <path d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0" fill="#ee4619"></path>
                    </svg>
                </span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path id="eyeIcon" d="M12 4.5C7.305 4.5 2.957 7.61 1 12c1.957 4.39 6.305 7.5 11 7.5 4.695 0 9.043-3.11 11-7.5-1.957-4.39-6.305-7.5-11-7.5zm0 12.5c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zm0-8c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3z" fill="#ee4619"></path>
                    </svg>
                </span>
            </div>
        </div>

        
        <div class="d-flex justify-content-between mb-3">
            <a href="forgot_password.php" style="color: #ee4619;">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center w-100 mb-3 shadow-lg" style="background-color: #ee4619; border-color: #ee4619;">Sign In</button>

        <p class="text-center">Don't have an account? <a href="./signup " style="color: #ee4619;">Sign Up</a></p>
        

    </form>
</section>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        // Toggle password visibility
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.setAttribute('d', 'M12 4.5C7.305 4.5 2.957 7.61 1 12c1.957 4.39 6.305 7.5 11 7.5 4.695 0 9.043-3.11 11-7.5-1.957-4.39-6.305-7.5-11-7.5zm0 12.5c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zm0-8c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3z');
        } else {
            passwordField.type = 'password';
            eyeIcon.setAttribute('d', 'M12 4.5C7.305 4.5 2.957 7.61 1 12c1.957 4.39 6.305 7.5 11 7.5 4.695 0 9.043-3.11 11-7.5-1.957-4.39-6.305-7.5-11-7.5zm0 12.5c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zm0-8c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3z');
        }
    });
</script>
</body>
</html>
