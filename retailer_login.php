<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retailer Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="registration-card">
            <div class="card-header" style="text-align: left;">
                <h2>Play2Gate</h2>
            </div>
            <form id="registrationForm" class="registration-form" method="POST" action="./process/retailerlogin.php">
                
                <div class="form-group">
                    <label for="username"></label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Username*" value="" required>
                    </div>
                    <span class="error-message" id="nameError"></span>
                </div>

                <div class="form-group">
                    <label for="password"></label>
                    <div class="input-group">
                        <!-- <i class="fas fa-lock"></i> -->
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                        <input type="password" id="password" name="password" placeholder="Password*" value="" required>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <!-- Log In Button -->
                <button type="submit" class="submit-btn" name="login">
                    Log In
                    
                </button>
            </form>
        </div>
    </div>

    <style>
        /* Remove scroll and ensure no overflow */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Disable scrolling */
        }

        /* 2-Color Gradient Background (top to bottom) */
        body {
            background: linear-gradient(to bottom, #cb1162, #2575fc); 
            /* Gradient from #6a11cb (purple) to #2575fc (blue) */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .registration-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .card-header h2 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px 30px;
            padding-left: 40px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .submit-btn i {
            margin-left: 10px;
        }

        /* Optional: Add responsiveness for small screens */
        @media (max-width: 480px) {
            .registration-card {
                padding: 20px;
                width: 90%;
            }

            .submit-btn {
                font-size: 16px;
            }
        }
    </style>
</body>


    <script src="./assets/js/login.js"></script>
</body>

</html>