<?php
include '../../process/conn.php';
include '../../auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['policy_content'];
    
    $sql = "UPDATE privacy_policy SET content = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $content);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Privacy Policy updated successfully";
    } else {
        $_SESSION['error'] = "Failed to update Privacy Policy";
    }
    
    $stmt->close();
    header('Location: ../privacy_policy.php');
    exit();
}