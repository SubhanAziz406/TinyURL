<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php'; // Include your database connection

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before saving it to the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $stmt->execute();
        // Redirect to dashboard.php
                header('Location: dashboard.php');
                exit(); // Ens
    } else {
        echo "Error: " . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignUp Form | TheTinyURLs</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
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
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="ml-auto">
                <a href="./index " class="nav-icon">
                    <i class="fas fa-home"></i>
                </a>
            </div>
        </div>
    </nav>
    <!-- Centered SignUp Form -->
    <section class="d-flex justify-content-center align-items-center vh-100" style="background-color: #f4f4f4;">
        <div class="container">
            <div class="form-container">
                <form action="signup.php" method="POST" id="signupForm" class="p-4 rounded shadow-lg mx-auto" style="background-color: #fff; max-width: 500px;" >
                    <h2 class="text-center mb-4" style="color: #ee4619;">SignUp Form</h2>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="username" class="form-label">User Name</label>
                            <input ype="text" name="username" id="username" class="form-control" placeholder="Enter Unique Name" required>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope" style="color: #ee4619;"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock" style="color: #ee4619;"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password" required>
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="fas fa-eye" style="color: #ee4619;"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div id="error-message" class="mb-3 text-danger" style="display: none;"></div>
                    <button type="submit" class="btn btn-primary w-100" style="background-color: #ee4619; border-color: #ee4619;">Submit</button>
                    <p class="text-center mt-3">Already have an account? <a href="./login " style="color: #ee4619;">Login</a></p>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap & JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script for toggle password visibility -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');
            const errorMessage = document.getElementById('error-message');

            togglePassword.addEventListener('click', function () {
                const isPasswordVisible = password.type === 'password';
                password.type = isPasswordVisible ? 'text' : 'password';
                confirmPassword.type = isPasswordVisible ? 'text' : 'password';
                this.querySelector('i').classList.toggle('fa-eye-slash', !isPasswordVisible);
            });

            document.getElementById('signupForm').addEventListener('submit', function (e) {
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    errorMessage.textContent = 'Passwords do not match';
                    errorMessage.style.display = 'block';
                } else {
                    errorMessage.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
