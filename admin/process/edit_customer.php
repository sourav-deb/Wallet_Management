<?php

    include '../../process/conn.php';
    include '../../auth.php';

    if(isset($_POST['edit_customer'])){
        $id = $_POST['id'];
        $name = $_POST['edit_name'];
        $email = $_POST['edit_email'];
        $phone = $_POST['edit_phone'];
        $parent = $_POST['edit_parent'];
        $role = $_POST['edit_role'];
        $comm_type = $_POST['edit_comm_type'];
        $comm_value = $_POST['edit_comm_value'];
        $wallet_balance = $_POST['edit_wallet'];
        $status = $_POST['edit_status'];

        $query = "UPDATE customer SET cust_name = '$name', cust_email = '$email', cust_phone = '$phone', parent = '$parent', cust_role = '$role', commission_type = '$comm_type', commission_value = '$comm_value', wallet_balance = '$wallet_balance', status = '$status' WHERE cust_id = '$id'";
        $result = mysqli_query($conn, $query);

        if($result){
            echo "Customer updated successfully";
            header('Location: ../all_customer.php?msg=success');
        }else{
            echo "Failed to update customer";
            header('Location: ../all_customer.php?msg=failed');
        }
    }

