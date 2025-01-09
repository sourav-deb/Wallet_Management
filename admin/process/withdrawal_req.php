<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['new_withdrawal'])) {
    $retailer_id = $_POST['retailer_id'];
    $account_no = $_POST['account_no'];
    $transfer_to = $_POST['transfer_to'];
    $amount = $_POST['amount'];
    $mobileno = $_POST['mobileno'];
    $remark = $_POST['remark'];

    
    $target_dir = "./../../uploads/new_withdrawal/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
        echo "Directory created!";
    }
    
    $screenshot = $_FILES['screnshot'];
    $file_extension = pathinfo($screenshot["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $account_no . '.' . $file_extension;
    $file_in_db = $account_no . '.' . $file_extension;
    
    if (move_uploaded_file($screenshot["tmp_name"], $target_file)) {
        // Save the file path to the database
        $sql = "INSERT INTO withdrawal_req (account_no, transfer_by, user_name, mobile, screenshot, amount, status) 
                VALUES ('$account_no', '$retailer_id', '$transfer_to', '$mobileno', '$file_in_db', '$amount', 'pending')";
        if ($conn->query($sql) === TRUE) {
            echo "New withdrawal request created successfully!";
            header('Location: ../withdrawal_request.php?msg=success');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header('Location: ../withdrawal_request.php?msg=fail');
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
        header('Location: ../withdrawal_request.php?msg=error');
    }
    

}