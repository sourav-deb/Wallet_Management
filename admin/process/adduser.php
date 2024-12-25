<?php

    include '../../process/conn.php';
    include '../../auth.php';

    if(isset($_POST['add_user'])){
        $parent = $_POST['parent'];
        $role = $_POST['role'];
        $fullname = $_POST['fullname'];
        $comm_type = $_POST['comm_type'];
        $comm_value = $_POST['comm_value'];
        $email = $_POST['email'];
        $phone = $_POST['mobileno'];
        $address = $_POST['fulladdress'];
        $status = $_POST['status'];

        if($role == 'user'){
            $parent_retailer = $_POST['parent_retailer'];
        }else if($role == 'retailer'){
            $parent_retailer = 'admin';
        }

        date_default_timezone_set('Asia/Kolkata');
        $created_at = date(format: 'Y-m-d H:i:s');

        // **Step 1: Prepare the SQL statement with placeholders**
        $stmt = $conn->prepare("INSERT INTO customer (parent, parent_name, cust_role, cust_name, commission_type, commission_value, cust_email, cust_phone, cust_address, status, created_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // **Step 2: Bind the parameters (s = string, i = integer, d = double, b = blob)**
        // Here, all the fields are strings, so we use 'sssssssss' to indicate 9 strings
        $stmt->bind_param('sssssisisss', $parent, $parent_retailer, $role, $fullname, $comm_type, $comm_value, $email, $phone, $address, $status, $created_at);

        // **Step 3: Execute the statement**
        if($stmt->execute()){
            echo "User added successfully!";
            header('Location: ../add_user.php?msg=success');
        } else {
            echo "Error: " . $stmt->error;
            header('Location: ../add_user.php?msg=failed');
        }

        // **Step 4: Close the statement and connection**
        $stmt->close();
    }

