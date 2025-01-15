<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['apply_filter'])) {
    $account_no = $_POST['account_no'];
    $transaction_id = $_POST['transaction-id'];
    $utr_no = $_POST['utr-no'];
    $deposit_by = $_POST['deposit_by'];
    $mobile = $_POST['mobile'];
    $request_date = $_POST['request_date'];
    $transfer_date = $_POST['transfer_date'];

    $user_id = $_SESSION['user_id'];
    echo $user_id;


    // Customer Query 
    $new_deposit = "SELECT * FROM withdrawal_req WHERE status IN ('approved', 'commissioned') AND transfer_by = '$user_id'" ;

    // Add conditions

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
    header('Location: ../all_withdrawal.php');
    exit();
}

