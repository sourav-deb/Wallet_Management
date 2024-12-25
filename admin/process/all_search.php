<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['apply_filter'])) {
    $gmailid = $_POST['gmailid'];
    $mobileno = $_POST['mobileno'];
    // $rolewise = $_POST['rolewise'];
    $userrole = $_POST['userrole'];
    $retailerno = $_POST['retailerno'];
    $minwallet = $_POST['minwallet'];
    $maxwallet = $_POST['maxwallet'];


    // Customer Query 
    $customer = 'SELECT * FROM customer WHERE 1=1';

    // Add conditions
    if (!empty($gmailid)) {
        $customer .= " AND cust_email LIKE '%$gmailid%'";
    }
    if (!empty($mobileno)) {
        $customer .= " AND cust_phone LIKE '%$mobileno%'";
    }
    if (!empty($minwallet)) {
        $customer .= " AND wallet_balance >= '$minwallet'";
    }
    if (!empty($maxwallet)) {
        $customer .= " AND wallet_balance <= '$maxwallet'";
    }
    if (!empty($userrole)) {
        $customer .= " AND cust_role LIKE '$userrole'";
    }
    // if (!empty($rolewise)) {
    //     $customer .= " AND cust_role LIKE '%rolewise%'";
    // }

    $result = mysqli_query($conn, $customer);
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // echo json_encode($data);

    // After fetching results
    $_SESSION['search_results'] = $data;
    header('Location: ../all_customer.php');
    exit();
}
