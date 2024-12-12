<?php

include '../../process/conn.php';

// Set header to return JSON response
// header('Content-Type: application/json');



if (isset($_POST['assign_role'])) {
    $id = $_POST['id'];
    $role = $_POST['assigned_to'] ?? '';
    $retailer = $_POST['retailer'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    echo $id . " " . $role . " " . $retailer;

    date_default_timezone_set('Asia/Kolkata');
    $created_at = date('Y-m-d H:i:s');

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
            // Update
            $query = "UPDATE registration SET status = 'Approved', role = '$role' WHERE id = '$id'";
            mysqli_query($conn, $query);

            $query2 = "INSERT INTO user (user_id, user_name, email, phone, retailer, retailer_id, created_at) VALUES ('$role.$id', '$full_name', '$email', '$phone', '$retailer', '$retailer', '$created_at')";
            mysqli_query($conn, $query2);

            echo "<script>window.location.href = '../new_registrations.php?success=role_assigned';</script>";

            
        }
    } elseif($role == 'retailer'){
        echo "Retailer selected";
        // Update

        $query = "UPDATE registration SET status = 'Approved', role = '$role' WHERE id = '$id'";
        mysqli_query($conn, $query);

        $query2 = "INSERT INTO retailer (retailer_id, retailer_name, email, phone, created_at) VALUES ('$role.$id', '$full_name', '$email', '$phone', '$created_at')";
        mysqli_query($conn, $query2);

        echo "<script>window.location.href = '../new_registrations.php?success=role_assigned';</script>";
    }

    // $query = "UPDATE registration SET role = '$role', retailer_id = '$retailer' WHERE id = '$id'";
    // mysqli_query($conn, $query);
}

