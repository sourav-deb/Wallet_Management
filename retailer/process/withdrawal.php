
<?php
include '../../process/conn.php';
include '../../auth.php';

if (isset($_POST['received'])) {
    try {
        // Validate input
        if (!isset($_POST['update_id']) || !isset($_POST['wd_amount']) || !isset($_POST['wd_transaction_id']) || !isset($_POST['wd_utrno'])) {
            throw new Exception("Missing required fields");
        }

        $id = $_POST['update_id'];
        $wd_amount = $_POST['wd_amount'];
        $wd_transaction_id = $_POST['wd_transaction_id'];
        $wd_utrno = $_POST['wd_utrno'];

        // Debug logging
        error_log("Processing withdrawal request: " . $wd_transaction_id);

        // Validate upload directory
        $target_dir = realpath(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "new_withdrawal" . DIRECTORY_SEPARATOR . "bank_transfer" . DIRECTORY_SEPARATOR;

        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                error_log("Failed to create directory: " . $target_dir);
                throw new Exception("Failed to create upload directory");
            }
        }

        // Validate file upload
        if (!isset($_FILES['screenshot'])) {
            throw new Exception("No file uploaded");
        }

        if ($_FILES['screenshot']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Upload error code: " . $_FILES['screenshot']['error']);
        }

        // Process file
        $transaction_ss = $_FILES['screenshot'];
        $file_extension = strtolower(pathinfo($transaction_ss["name"], PATHINFO_EXTENSION));

        // Validate file type
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
        if (!in_array($file_extension, $allowed_extensions)) {
            throw new Exception("Invalid file type. Allowed: " . implode(', ', $allowed_extensions));
        }

        // Generate unique filename
        $base_filename = $wd_transaction_id;
        $counter = 0;
        $final_filename = $base_filename . '.' . $file_extension;

        while (file_exists($target_dir . $final_filename)) {
            $counter++;
            $final_filename = $base_filename . '_' . $counter . '.' . $file_extension;
            error_log("Trying filename: " . $final_filename);
        }

        $target_file = $target_dir . $final_filename;
        error_log("Final target file: " . $target_file);

        // Move file
        if (!move_uploaded_file($transaction_ss["tmp_name"], $target_file)) {
            error_log("Failed to move file from " . $transaction_ss["tmp_name"] . " to " . $target_file);
            throw new Exception("Failed to save uploaded file");
        }

        // Update database
        $stmt = $conn->prepare("UPDATE withdrawal_req SET status = 'approved', amount = ?, transaction_id = ?, utr_no = ?, transaction_ss = ?, transfered_at = NOW() WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }
        $stmt->bind_param("isssi", $wd_amount, $wd_transaction_id, $wd_utrno, $final_filename, $id);

        if (!$stmt->execute()) {
            throw new Exception("Database update failed: " . $stmt->error);
        }

        header('Location: ../new_withdrawal_requests.php?msg=success');
        exit();

    } catch (Exception $e) {
        error_log("Withdrawal Error: " . $e->getMessage());
        echo "Error processing withdrawal request: " . $e->getMessage();
        exit();
    }
}