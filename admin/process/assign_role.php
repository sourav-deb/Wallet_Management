<?php

include '../../process/conn.php';

// Set header to return JSON response
// header('Content-Type: application/json');



if (isset($_POST['assign_role'])) {
    $id = $_POST['id'];
    $role = $_POST['assigned_to'] ?? '';
    $retailer = $_POST['retailer'] ?? '';

    echo $id . " " . $role . " " . $retailer;

    if(empty($id) || empty($role)){
        echo "Please fill all the fields";
        echo "<script>window.location.href = '../new_registrations.php?error=missing_fields';</script>";
        exit;
    }

    if ($role == 'user') {
        if (empty($retailer)) {
            echo "Please select a retailer";
            echo "<script>window.location.href = '../new_registrations.php?error=missing_retailer';</script>";
            exit;
        } else {
            echo "Retailer selected";
        }
    }

    // $query = "UPDATE registration SET role = '$role', retailer_id = '$retailer' WHERE id = '$id'";
    // mysqli_query($conn, $query);
}

