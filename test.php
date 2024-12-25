<?php

include './process/conn.php';
    // Hash the password before storing it in the database
    $password = "AdminPassword123";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    echo $hashed_password;

    // Insert the user with the hashed password
    $stmt = $conn->prepare("UPDATE credentials SET password = ? WHERE id = 1");
    $stmt->bind_param('s',$hashed_password);
    $stmt->execute();
    $stmt->close();
    $conn->close();
?>
