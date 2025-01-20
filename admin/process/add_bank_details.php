<?php



include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['add_bank'])) {

    $payment_method = $_POST['payment_method'];
    $bank_name = '';
    $account_number = '';
    $ifsc_code = '';
    $branch_name = '';
    $upi_id = '';
    $qr_code = '';

    if ($payment_method == 'bank') {
        $bank_name = $_POST['bank_name'];
        $account_number = $_POST['account_number'];
        $ifsc_code = $_POST['ifsc_code'];
        $branch_name = $_POST['branch_name'];
    }
    elseif ($payment_method == 'upi') {
        $upi_id = $_POST['upi_id'];
    }
    // elseif ($payment_method == 'qr') {
    //     $qr_code = $_FILES['qr_code'];
    // }



    $sql = "INSERT INTO admin_bank (methods, bank_name, account_no, ifsc_code, branch_name, upi_id, qr_code) 
            VALUES ('$payment_method', '$bank_name', '$account_number', '$ifsc_code', '$branch_name', '$upi_id', '$qr_code')";

    if (mysqli_query($conn, $sql)) {
        echo "Bank details added successfully";
        $_SESSION['success'] = "Bank details added successfully";
        header('Location: ../add_bank.php?success=successful');
    } else {
        echo "Error: " . mysqli_error($conn);
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header('Location: ../add_bank.php?error=Error');
    }

}

if (isset($_POST['add_methods'])) {
    $methods = $_POST['payment_methods'];
    $sql = "INSERT INTO payment_methods (methods) VALUES ('$methods')";
    if (mysqli_query($conn, $sql)) {
        echo "Methods added successfully";
        $_SESSION['success'] = "Methods added successfully";
        header('Location: ../add_bank.php?success=successful');
    } else {
        echo "Error: " . mysqli_error($conn);
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header('Location: ../add_bank.php?error=Error');
    }
}
