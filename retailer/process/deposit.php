<?php
include '../../process/conn.php';
include '../../auth.php';



if (isset($_POST['received'])) {
    $transaction_id = $_POST['transaction_id'];
    $amount = $_POST['amount'];

    // Save the file path to the database

    $sql = "UPDATE new_deposit SET amount = '$amount', status='approved' WHERE transaction_id='$transaction_id'";
    if ($conn->query($sql) === TRUE) {
        echo "New deposit received successfully!";
        header('Location: ../new_deposits.php?msg=success');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location: ../new_deposits.php?msg=fail');
    }
    
}

if (isset($_POST['decline'])) {
    $transaction_id = $_POST['transaction-id'];
    $amount = $_POST['amount']; 
    // Save the file path to the database
    $sql = "UPDATE new_deposit SET status='declined' WHERE transaction_id='$transaction_id'";
    if ($conn->query($sql) === TRUE) {
        echo "New deposit received successfully!";
        header('Location: ../new_deposits.php?msg=success');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location: ../new_deposits.php?msg=fail');
    }
}


?>