<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['new_deposit'])) {
    $transaction_id = $_POST['transaction_id'];
    $utr_no = $_POST['utr_no'];
    $amount = $_POST['amount'];
    $mobile = $_POST['mobile'];
    // $screnshot = $_POST['screnshot'];
    $remark = $_POST['remark'];

    $user_id = $_SESSION['user_id'];
    echo $user_id;

    // Get User Data
    $sql = "SELECT cust_name, cust_email, cust_phone 
        FROM customer 
        WHERE cust_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $cust_name = $user_data['cust_name'];
        $cust_email = $user_data['cust_email'];
        $cust_mobile = $user_data['cust_phone'];
    } else {
        die("User not found");
    }


    echo $transaction_id, "<br>";
    echo $utr_no, "<br>";
    echo $amount, "<br>";
    echo $mobile, "<br>";
    echo $screnshot, "<br>";

    $target_dir = "./../../uploads/payment_req/";
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
        
        $sql = "INSERT INTO payment_req (cust_id, cust_name, req_amount, transaction_id, utr_no, screenshot, remark, status) 
                VALUES ('$user_id', '$cust_name', '$amount', '$transaction_id', '$utr_no', '$file_in_db', '$remark', 'pending')";
        
        
        if ($conn->query($sql) === TRUE) {
            echo "New request created successfully!";
            header('Location: ../balance_request.php?msg=success');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header('Location: ../balance_request.php?msg=fail');
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
        header('Location: ../balance_request.php?msg=error');
    }

}


