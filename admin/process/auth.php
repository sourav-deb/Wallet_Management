<?php
    // Start the session at the top of the script
    session_start();
    
    // Check if user is NOT logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page
        header("Location: ./../login.php");
        exit();
    }

    // Optional: Prevent back button from accessing previous pages after logout
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
