<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<div class="container">
    <div class="registration-card">
        <div class="card-header" style="text-align: left;">
    <h2>Play2Gate</h2>
</div>

        <form id="registrationForm" class="registration-form" method="POST" action="./process/signin.php">
            
            <div class="form-group">
                <label for="username"></label>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Username*" value="admin" required>
                </div>
                <span class="error-message" id="nameError"></span>
            </div>

            <div class="form-group">
                <label for="password"></label>
                <div class="input-group">
                    <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    <input type="password" id="password" name="password" placeholder="Password*" value="AdminPassword123" required>
                </div>
                <span class="error-message" id="passwordError"></span>
            </div>

            <button type="submit" class="submit-btn" name="login">
                Log In
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

       
    </div>
</div>

<style>
/* Global reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Font and colors */
body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(145deg, #00bcd4, #008c8c);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
}

.registration-card {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.card-header h2 {
    font-size: 24px;
    color: #333;
    font-weight: bold;
}

.card-header p {
    color: #777;
    font-size: 14px;
    margin-top: 10px;
}

/* Input styles */
input {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 12px 15px;
    font-size: 16px;
    width: 100%;
    background-color: #f9f9f9;
}

input:focus {
    border-color: #007bff;
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
    background-color: #fff;
    outline: none;
}

.form-group {
    margin-bottom: 25px;
}

.error-message {
    color: red;
    font-size: 12px;
    display: none;
}

/* 3D Button styles */
.submit-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.submit-btn:hover {
    background: #0056b3;
    box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
    transform: translateY(-3px);
}

.submit-btn:active {
    transform: translateY(2px);
}

.login-link {
    margin-top: 20px;
    color: #555;
}

.login-link a {
    color: #007bff;
    text-decoration: none;
}

.login-link a:hover {
    text-decoration: underline;
}
</style>


    <script src="./assets/js/login.js"></script>
</body>

</html>