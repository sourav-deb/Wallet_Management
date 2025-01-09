<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['apply_filter'])) {
    $deposited_to = $_POST['retailer_id'];
    $transaction_id = $_POST['transaction-id'];
    $utr_no = $_POST['utr-no'];
    $deposit_by = $_POST['deposit_by'];
    $mobile = $_POST['mobile'];
    $date = $_POST['date'];


    // Customer Query 
    $new_deposit = 'SELECT * FROM new_deposit WHERE 1=1';

    // Add conditions
    if (!empty($deposited_to)) {
        $new_deposit .= " AND deposited_to LIKE '%$deposited_to%'";
    }
    if (!empty($gmailid)) {
        $new_deposit .= " AND transaction_id LIKE '%$transaction_id%'";
    }
    if (!empty($mobileno)) {
        $new_deposit .= " AND utr_no LIKE '%$utr_no%'";
    }
    if (!empty($minwallet)) {
        $new_deposit .= " AND deposited_by >= '$deposit_by'";
    }
    if (!empty($maxwallet)) {
        $new_deposit .= " AND mobileno <= '$mobile'";
    }
    if (!empty($userrole)) {
        $new_deposit .= " AND created_at LIKE '$date'";
    }
    // if (!empty($rolewise)) {
    //     $new_deposit .= " AND cust_role LIKE '%rolewise%'";
    // }

    $result = mysqli_query($conn, $new_deposit);
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // echo json_encode($data);

    // After fetching results
    $_SESSION['search_results'] = $data;
    header('Location: ../all_deposits.php');
    exit();
}

if (isset($_POST['update_deposits'])) {

    $id = $_POST['id'];
    $deposited_by = $_POST['deposited_by'];
    $deposited_to = $_POST['deposited_to'];
    $edit_phone = $_POST['edit_phone'];
    $comm_type = $_POST['add_comm_type'];
    $comm_value = $_POST['add_comm_value'];
    $amount = $_POST['amount'];
    // $status = $_POST['edit_status'];
    $status = 'commissioned';

    echo "POST Id: " . $id . "<br>";
    echo "POST Deposited By: " . $deposited_by . "<br>";
    echo "POST Deposited To: " . $deposited_to . "<br>";
    echo "POST Phone: " . $edit_phone . "<br>";
    echo "POST Comm Type: " . $comm_type . "<br>";
    echo "POST Comm Value: " . $comm_value . "<br>";
    echo "POST Amount: " . $amount . "<br>";
    echo "POST Status: " . $status . "<br>";
    echo "POST Retailer Id: " . $deposited_to . "<br>";

    echo '-------<br>';

    // First get retailer details
    $retailer_query = "SELECT cust_id, cust_name, balance FROM customer WHERE cust_id = '$deposited_to'";
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
    $retailer_balance -= $amount;

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
    $query = "UPDATE new_deposit SET comm_type = ?, comm_value = ?, status = ? WHERE id = ?";
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



            header('Location: ../all_deposits.php?msg=success');
        } else {
            echo "Error: " . $stmt->error;
            header('Location: ../all_deposits.php?msg=error');
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
        header('Location: ../all_deposits.php?msg=prep_error');
    }





    // header('Location: ../all_deposits.php');
    exit();
}