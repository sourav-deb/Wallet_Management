<?php
include "../process/conn.php";
include "./process/auth.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bank</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/add_bank.css">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php
        include 'sidebar.php';
        ?>


        <div class="content-wrapper">
            <!-- New Header Section -->
            <header class="main-header">
                <div class="header-left">
                    <!-- Mobile menu trigger -->
                    <button class="mobile-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="header-text">Add Bank Details</div>
                </div>


                <div class="header-right">

                    <div class="user-menu d-flex align-items-center ml-3 position-relative">
                        <i class="fas fa-bell text-dark" id="notification-bell"></i>
                        <div class="notification-box bg-white shadow-sm p-3 position-absolute" id="notification-box">
                            <p>No new notifications</p>
                        </div>
                        <i class="fas fa-user text-dark ml-3"></i>
                        <span class="user-name text-dark ml-2">John Doe</span>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <div class="main-content">

                <div class="filter-section">
                    <div class="form-grid">
                        <form method="post" action="" class="form-grid">
                            <div class="form-group">
                                <label for="payment-method">Select Payment Method</label>
                                <select id="payment-method" name="payment_method" required>
                                    <option value="bank">Bank Account Details</option>
                                    <option value="upi">UPI Payment</option>
                                    <option value="qr">QR Code</option>
                                </select>
                            </div>

                            <!-- Bank Details -->
                            <div id="bank-details" class="payment-details">
                                <div class="form-group">
                                    <label for="bank-name">Bank Name:</label>
                                    <input type="text" id="bank-name" name="bank_name">
                                </div>
                                <br>
                                <!-- Account Number -->
                                <div class="form-group">
                                    <label for="account-number">Account Number:</label>
                                    <input type="text" id="account-number" name="account_number">
                                </div>
                                <br>
                                <!-- IFSC Code -->
                                <div class="form-group">
                                    <label for="ifsc-code">IFSC Code:</label>
                                    <input type="text" id="ifsc-code" name="ifsc_code">
                                </div>
                                <br>
                                <!-- Branch Name -->
                                <div class="form-group">
                                    <label for="branch-name">Branch Name:</label>
                                    <input type="text" id="branch-name" name="branch_name">
                                </div>
                                <br>
                            </div>

                            <!-- UPI Details -->
                            <div id="upi-details" class="payment-details" style="display:none;">
                                <div class="form-group">
                                    <label for="upi-id">UPI ID:</label>
                                    <input type="text" id="upi-id" name="upi_id">
                                </div>
                            </div>

                            <!-- QR Code Details -->
                            <div id="qr-details" class="payment-details" style="display:none;">
                                <div class="form-group">
                                    <label for="qr-code">QR Code Image:</label>
                                    <input type="file" id="qr-code" name="qr_code">
                                </div>
                            </div>
                            <br>
                            <!-- Submit Button -->
                            <div class="form-actions" style="text-align:right;">
                                <!-- <button type="submit" class="apply-btn">
                                    <i class="fas fa-search"></i> Submit
                                </button> -->
                            </div>

                    </div>

                    <!-- Apply Button -->
                    <div class="form-actions">
                        <button type="submit" class="apply-btn">
                            <!-- <i class="fas fa-search"></i>  -->
                            Submit
                        </button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>




    <script src="./../template/template.js"></script>
    <script src="./assets/js/add_bank.js"></script>
</body>

</html>