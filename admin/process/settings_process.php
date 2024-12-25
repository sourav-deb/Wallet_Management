<?php

include '../../process/conn.php';
include '../../auth.php';

// Handle registration status toggle
header('Content-Type: application/json');

if(isset($_POST['setting']) && $_POST['setting'] === 'registration_status') {
    $value = $_POST['value'];
    
    $sql = "UPDATE settings SET value = ? WHERE setting_name = 'registration_enabled'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $value);
    
    if($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    
    $stmt->close();
    exit();
}

if (isset($_POST['bulk_apply'])) {
    $role = $_POST['userrole'];
    $comm_type = $_POST['comm-type'];
    $comm_value = $_POST['comm-value'];

    try {
        $sql = "UPDATE customer SET commission_value = ? WHERE cust_role = ? AND commission_type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $comm_value, $role, $comm_type);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Commission value updated successfully";
        } else {
            $_SESSION['error'] = "Failed to update commission value";
        }

        $stmt->close();
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    header('location: ../main_settings.php');
    exit();
}
