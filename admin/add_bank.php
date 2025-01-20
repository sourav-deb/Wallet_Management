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
                    <div class="group-header">Admin Bank Details</div>
                    <form method="post" action="./process/add_bank_details.php" class="form-grid">
                        <div class="form-grid">
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
                                    <input type="text" id="bank-name" name="bank_name" placeholder="Enter Bank Name">
                                </div>
                                <br>
                                <!-- Account Number -->
                                <div class="form-group">
                                    <label for="account-number">Account Number:</label>
                                    <input type="text" id="account-number" name="account_number" placeholder="Enter Account Number">
                                </div>
                                <br>
                                <!-- IFSC Code -->
                                <div class="form-group">
                                    <label for="ifsc-code">IFSC Code:</label>
                                    <input type="text" id="ifsc-code" name="ifsc_code" placeholder="Enter IFSC Code">
                                </div>
                                <br>
                                <!-- Branch Name -->
                                <div class="form-group">
                                    <label for="branch-name">Branch Name:</label>
                                    <input type="text" id="branch-name" name="branch_name" placeholder="Enter Branch Name">
                                </div>
                                <br>
                            </div>

                            <!-- UPI Details -->
                            <div id="upi-details" class="payment-details" style="display:none;">
                                <div class="form-group">
                                    <label for="upi-id">UPI ID:</label>
                                    <input type="text" id="upi-id" name="upi_id" placeholder="Enter UPI ID">
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
                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="add_bank">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>


                <div class="filter-section">
                    <div class="group-header">Payment Methods for Retailers</div>
                    <form method="post" action="./process/add_bank_details.php" class="form-grid">
                        <div class="form-grid">

                            <!-- UPI Details -->
                            <div class="form-group">
                                <label for="methods">New Methods:</label>
                                <input type="text" id="payment_methods" name="payment_methods">
                            </div>
                            <br>
                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="add_methods">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>


                <!-- Admin Bank section -->
                <div class="results-section">
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th width="50"></th>
                                    <th>Admin Bank</th>
                                    <th>Details</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $pay_req = mysqli_query($conn, "SELECT * FROM admin_bank ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($pay_req)) {

                                    // echo $row['name'];
                                    ?>
                                        <tr>
                                           <td></td>
                                            <td><?php echo $row['methods']; ?></td>
                                            <td>
                                                <div class='details-box'>
                                                    <p><b>Bank_Name: </b><?php echo $row['bank_name']; ?></p>
                                                    <p><b>Account_Number: </b><?php echo $row['account_no']; ?></p>
                                                    <p><b>IFSC_Code: </b><?php echo $row['ifsc_code']; ?></p>
                                                    <p><b>Branch_Name: </b><?php echo $row['branch_name']; ?></p>
                                                    <p><b>UPI_ID: </b><?php echo $row['upi_id']; ?></p>
                                                    <p><b>QR_Code: </b><a href="<?php echo $row['qr_code']; ?>" target="_blank">View QR Code</a></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Payment Methods section -->
                <div class="results-section">
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th width="50"></th>
                                    <th>Sl No</th>
                                    <th>Payment Methods</th>

                                    <th>Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $pay_req = mysqli_query($conn, "SELECT * FROM payment_methods ORDER BY id");
                                while ($row = mysqli_fetch_assoc($pay_req)) {

                                    // echo $row['name'];
                                    ?>
                                        <tr>
                                           <td></td>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['methods']; ?></td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>




    <script src="./../template/template.js"></script>
    <script src="./assets/js/add_bank.js"></script>
</body>

</html>