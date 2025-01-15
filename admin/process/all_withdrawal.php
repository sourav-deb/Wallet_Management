<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['apply_filter'])) {
    $deposited_to = $_POST['retailer_id'];
    $account_no = $_POST['account_no'];
    $transaction_id = $_POST['transaction-id'];
    $utr_no = $_POST['utr-no'];
    $deposit_by = $_POST['deposit_by'];
    $mobile = $_POST['mobile'];
    $request_date = $_POST['request_date'];
    $transfer_date = $_POST['transfer_date'];


    // Customer Query 
    $new_deposit = 'SELECT * FROM withdrawal_req WHERE status IN ("approved", "commissioned")';

    // Add conditions
    if (!empty($deposited_to)) {
        $new_deposit .= " AND transfer_by LIKE '%$deposited_to%'";
    }
    if (!empty($transaction_id)) {
        $new_deposit .= " AND transaction_id LIKE '%$transaction_id%'";
    }
    if (!empty($utr_no)) {
        $new_deposit .= " AND utr_no LIKE '%$utr_no%'";
    }
    if (!empty($account_no)) {
        $new_deposit .= " AND account_no LIKE '%$account_no%'";
    }
    if (!empty($mobile)) {
        $new_deposit .= " AND mobile LIKE '%$mobile%'";
    }
    if (!empty($request_date)) {
        $new_deposit .= " AND created_at LIKE '$request_date'";
    }
    if (!empty($transfer_date)) {
        $new_deposit .= " AND transfer_date LIKE '$transfer_date'";
    }
    

    $result = mysqli_query($conn, $new_deposit);
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // echo json_encode($data);

    // After fetching results
    $_SESSION['search_results'] = $data;
    header('Location: ../withdrawal_processed.php');
    exit();
}

if (isset($_POST['update_withdrawal'])) {

    $id = $_POST['edit_id'];
    $deposited_by = $_POST['deposited_by'];
    $transfered_to = $_POST['transfered_to'];
    $amount = $_POST['amount'];
    $comm_type = $_POST['add_comm_type'];
    $comm_value = $_POST['add_comm_value'];
    // $status = $_POST['edit_status'];
    $status = 'commissioned';

    echo "POST Id: " . $id . "<br>";
    echo "POST Deposited By: " . $deposited_by . "<br>";
    echo "POST Deposited To: " . $transfered_to . "<br>";
    echo "POST Comm Type: " . $comm_type . "<br>";
    echo "POST Comm Value: " . $comm_value . "<br>";
    echo "POST Amount: " . $amount . "<br>";
    echo "POST Status: " . $status . "<br>";

    echo '-------<br>';

    // First get retailer details
    $retailer_query = "SELECT cust_id, cust_name, balance FROM customer WHERE cust_id = '$deposited_by'";
    $result = $conn->query($retailer_query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $retailer_id = $row['cust_id'];
            $retailer_name = $row['cust_name'];
            $retailer_balance = $row['balance'];

            echo "Reatailer: " . $retailer_id . "<br>";
            echo "Reatailer Name: " . $retailer_name . "<br>";
            echo "Reatailer Balance : " . $retailer_balance . "<br>";
        }
    } else {
        echo "<option value=''>No Retailer Found</option>";
    }
    // Update retailer balance by deducting the amount received
    $retailer_balance += $amount;

    if ($comm_type == 'fixed') {
        $new_balance = $comm_value + $retailer_balance;
    } else if ($comm_type == 'percentage') {
        $amount = floatval($amount);
        $comm_value = floatval($comm_value);
        $commission = $amount * ($comm_value / 100);
        echo "Amount : " . $amount . "<br>";
        echo "Commission Value : " . $comm_value . "<br>";
        echo "Commission : " . $commission . "<br>";
        $new_balance = $retailer_balance + $commission;
    }

    echo "<br>New Balance : " . $new_balance . "<br>";



    // Prepare statement
    $query = "UPDATE withdrawal_req SET comm_type = ?, comm_value = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sisi", $comm_type, $comm_value, $status, $id);

        // Execute statement
        if ($stmt->execute()) {
            echo "Record updated successfully";

            // Update customer balance
            $update_query = "UPDATE customer SET balance = '$new_balance' WHERE cust_id = '$retailer_id'";
            $update_result = $conn->query($update_query);
            if ($update_result) {
                echo "<br>Customer balance updated successfully";
            } else {
                echo "Error updating customer balance: " . $conn->error;
            }



            // header('Location: ../withdrawal_processed.php?msg=success');
        } else {
            echo "Error: " . $stmt->error;
            // header('Location: ../withdrawal_processed.php?msg=error');
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
        // header('Location: ../withdrawal_processed.php?msg=prep_error');
    }





    // header('Location: ../all_deposits.php');
    exit();
}