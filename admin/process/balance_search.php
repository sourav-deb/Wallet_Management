<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['get_balance'])) {
    $customerid = $_POST['customerid'];
    $gmailid = $_POST['gmailid'];
    $mobileno = $_POST['mobileno'];

    // Customer Query 
    $customer = "SELECT * FROM balance_sheet WHERE cust_id = '$customerid' ORDER BY date_time DESC";

    // Add conditions
    if (!empty($gmailid)) {
        $customer .= " AND cust_email LIKE '%$gmailid%'";
    }
    if (!empty($mobileno)) {
        $customer .= " AND cust_phone LIKE '%$mobileno%'";
    }

    $result = mysqli_query($conn, $customer);
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // echo json_encode($data);

    // After fetching results
    $_SESSION['search_results'] = $data;
    header('Location: ../balance_sheet.php');
    exit();
}
