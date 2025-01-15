<?php

include '../../process/conn.php';
include '../../auth.php';

date_default_timezone_set('Asia/Kolkata');
$created_at = date(format: 'Y-m-d H:i:s');

if(isset($_POST['approve_req'])){

    $cust_id = $_POST['cust_id'];
    $cust_name = $_POST['cust_name'];
    $req_amt = $_POST['req_amt'];
    $transaction_id = $_POST['transaction_id'];

    echo $transaction_id;


    try {
        // Add payment request to payment_processed table
        $sql = "INSERT INTO payment_processed (cust_id, cust_name, amount, status, created_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $status = 'approved'; 
        $stmt->bind_param("ssdss", $cust_id, $cust_name, $req_amt, $status, $created_at);
        
        if($stmt->execute()) {
            $_SESSION['success'] = "Payment request processed successfully";
            // echo "Payment request processed successfully";
            console_log("Payment request processed successfully", true);
        } else {
            $_SESSION['error'] = "Failed to process payment request";
            // echo "Failed to process payment request";
            console_log("Failed to process payment request", true);
        }
        $stmt->close();

        // Update balance in customer table
        $sql2 = "UPDATE customer SET balance = balance + ? WHERE cust_id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("ds", $req_amt, $cust_id);

        if($stmt2->execute()) {
            $_SESSION['success'] = "Customer balance updated successfully";
            // echo "Customer balance updated successfully";
            console_log("Customer balance updated successfully", true);
        } else {
            $_SESSION['error'] = "Failed to update customer balance";
            // echo "Failed to update customer balance";
            console_log("Failed to update customer balance", true);
        }        
        $stmt2->close();

        // Update payment request status to processed from payment_req table
        $sql3 = "UPDATE payment_req SET status = 'approved' WHERE transaction_id = ? ";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("s", $transaction_id);

        if($stmt3->execute()) {
            $_SESSION['success'] = "Payment request deleted successfully";
            // echo "Payment request deleted successfully";
            console_log("Payment request deleted successfully", true);
        } else {
            $_SESSION['error'] = "Failed to delete payment request";
            // echo "Failed to delete payment request";
            console_log("Failed to delete payment request", true);
        }
        $stmt3->close();

        header('Location: ../payment_request.php');

    } catch(Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header('Location: ../payment_request.php?msg=failed');
    }
}


function console_log($data, $timestamp = false) {
    $output = json_encode($data);
    if($timestamp) {
        $time = date('Y-m-d H:i:s');
        echo "<script>console.log('[$time]', $output);</script>";
    } else {
        echo "<script>console.log($output);</script>";
    }
}