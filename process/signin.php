<?php
    // Start the session at the beginning of the script
    session_start();

    // Include the connection file
    include 'conn.php';

    if (isset($_POST['login'])) {
        $username = trim($_POST['username']); // Sanitize input
        $password = trim($_POST['password']); // Sanitize input

        // Check if username or password is empty
        if(empty($username) || empty($password)) {
            echo "Username or password cannot be empty.";
            exit();
        }

        // **Step 1: Prepare the SQL statement with placeholders**
        $stmt = $conn->prepare("SELECT id, username, password FROM credentials WHERE username = ?");
        
        // **Step 2: Bind the parameter (s = string)**
        $stmt->bind_param('s', $username);
        
        // **Step 3: Execute the statement**
        $stmt->execute();
        
        // **Step 4: Get the result**
        $result = $stmt->get_result();
        
        // **Step 5: Check if a user exists**
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // **Step 6: Verify the password**
            if (password_verify($password, $user['password'])) {
                
                // **Regenerate session ID to prevent session fixation**
                session_regenerate_id(true);
                
                // **Set session variables**
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                echo "Login successful! Welcome, " . $_SESSION['username'];
                
                // Redirect the user to a dashboard or home page
                header("Location: ./../admin/add_user.php");
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Invalid username or password.";
        }

        // **Step 7: Close the statement and connection**
        $stmt->close();
        $conn->close();
    }
?>
