<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="registration-card">
            <div class="card-header">
                <h2>Log In</h2>
                <p>Please fill in your details to login</p>
            </div>
            <form id="registrationForm" class="registration-form" method="POST" action="./process/signin.php">
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Enter your username" value="admin" required>
                    </div>
                    <span class="error-message" id="nameError"></span>
                </div>


                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <!-- <i class="fas fa-lock"></i> -->
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" value="AdminPassword123" required>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>


                <button type="submit" class="submit-btn" name="login">
                    Log In
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="login-link">
                Already have an account? <a href="registration.php">Register here</a>
            </div>
        </div>
    </div>

    <script src="./assets/js/login.js"></script>
</body>

</html>