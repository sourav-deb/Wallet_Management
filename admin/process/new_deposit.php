<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['new_deposit'])) {
    $retailer_id = $_POST['retailer_id'];
    $transaction_id = $_POST['transaction-id'];
    $utr_no = $_POST['utr-no'];
    $amount = $_POST['amount'];
    $deposited_by = $_POST['deposited_by'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $remark = $_POST['remark'];

    
    $target_dir = "./../../uploads/new_deposits/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
        echo "Directory created!";
    }
   
    $screenshot = $_FILES['screnshot'];
    $file_extension = pathinfo($screenshot["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $transaction_id . '.' . $file_extension;
    $file_in_db = $transaction_id . '.' . $file_extension;
    
    if (move_uploaded_file($screenshot["tmp_name"], $target_file)) {
        // Save the file path to the database
        $sql = "INSERT INTO new_deposit (transaction_id, utr_no, amount, deposited_by, email, mobileno, remark, screenshot, status, deposited_to) 
                VALUES ('$transaction_id', '$utr_no', '$amount', '$deposited_by', '$email', '$mobileno', '$remark', '$file_in_db', 'pending', '$retailer_id')";
        if ($conn->query($sql) === TRUE) {
            echo "New deposit created successfully!";
            header('Location: ../deposit_request.php?msg=success');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header('Location: ../deposit_request.php?msg=fail');
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
        header('Location: ../deposit_request.php?msg=error');
    }
    

}