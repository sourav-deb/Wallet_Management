<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Deposits</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/all_withdrawal.css">

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
                    <div class="header-text">All Withdrawal List</div>
                </div>


                <div class="header-right">

                    <div class="user-menu d-flex align-items-center ml-3 position-relative">
                        
                        <i class="fas fa-user text-dark ml-3"></i>
                        <span class="user-name text-dark ml-2">John Doe</span>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <div class="main-content">
                <div class="filter-container">
                    <div class="filter-section">
                        <div class="form-grid">

                            <form action="./process/all_withdrawals.php" method="POST" class="filter-form">
                                

                                <!-- Account No -->
                                <div class="form-group">
                                    <label for="account_no">Account No</label>
                                    <input type="text" id="account_no" name="account_no"
                                        placeholder="Search by Account No">
                                </div>

                                <!-- Transaction Id -->
                                <div class="form-group">
                                    <label for="transaction-id">Transaction Id</label>
                                    <input type="text" id="transaction-id" name="transaction-id"
                                        placeholder="Search by Transaction Id">
                                </div>

                                <!-- UTR No -->
                                <div class="form-group">
                                    <label for="utr-no">UTR No</label>
                                    <input type="text" id="utr-no" name="utr-no" placeholder="Search by UTR No">
                                </div>


                                <!-- Deposited By -->
                                <div class="form-group">
                                    <label for="deposit_by">Deposited By</label>
                                    <input type="number" id="deposit_by" name="deposit_by" placeholder="Deposited By">
                                </div>

                                <!-- Mobile -->
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="number" id="mobile" name="mobile" placeholder="Mobile No.">
                                </div>

                                <!-- Request Date -->
                                <div class="form-group">
                                    <label for="request_date">Request Date</label>
                                    <input type="date" id="request_date" name="request_date">
                                </div>
                                <!-- Transfer Date -->
                                <div class="form-group">
                                    <label for="transfer_date">Transfer Date</label>
                                    <input type="date" id="transfer_date" name="transfer_date">
                                </div>

                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="apply_filter" id="apply-filter">
                                <i class="fas fa-search"></i> Apply Filter
                            </button>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Results section -->
                <div class="results-section">
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th style="display: none;">Id</th>
                                    <th width="50"></th>
                                    <th>Transfered By</th>
                                    <th style="display: none;">Account</th>
                                    <th>To Account</th>
                                    <th>Amount</th>
                                    <th>Transaction Id</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <!-- <tbody> -->
                            <tbody>
                                <?php
                                if (isset($_SESSION['search_results']) && !empty($_SESSION['search_results'])) {
                                    foreach ($_SESSION['search_results'] as $row) {
                                        ?>
                                        <tr data-user-type="<?php echo $row['user_type']; ?>">
                                            <td style="display: none;"><?php echo $row['id']; ?> </td>
                                            <td>
                                                <i class="fas fa-chevron-right expand-details"></i>
                                            </td>
                                            <td><?php echo $row['transfer_by']; ?></td>
                                            <td style="display: none;"><?php echo $row['account_no']; ?></td>
                                            <td>
                                                <div class="user-details">
                                                    <p class="customer-name"><?php echo $row['account_no']; ?></p>
                                                    <p class="user-id">Acc Holder: <?php echo $row['user_name']; ?></p>
                                                </div>
                                            </td>
                                            <td><?php echo $row['amount']; ?></td>
                                            <td><?php echo $row['transaction_id']; ?></td>
                                            <td><span
                                                    class="status-badge <?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></span>
                                            </td>
                                            
                                        </tr>
                                        <tr class="expandable-row">
                                            <td colspan="10">
                                                <div class="expanded-details">
                                                    <div class="details-grid">
                                                        <div class="detail-item">
                                                            <label>Mobile:</label>
                                                            <span><?php echo $row['mobileno']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Requested At:</label>
                                                            <span><?php echo $row['created_at']; ?></span>
                                                        </div>

                                                        <!-- Show screenshot -->
                                                        <div class="detail-item">
                                                            <label>Bank Details:</label>

                                                            <button
                                                                onclick="openModal('./../uploads/new_withdrawal/user_bank/<?php echo $row['screenshot']; ?>');"
                                                                class="view-btn"> View Screenshot<?php echo $row['screenshot']; ?>
                                                            </button>
                                                            <!-- <img src="./../uploads/new_deposits/<?php echo $row['screenshot']; ?>" alt='Screenshot'> -->

                                                        </div>

                                                        <div class="detail-item">
                                                            <label>Transfered At:</label>
                                                            <span><?php echo $row['transfered_at']; ?></span>
                                                        </div>

                                                        <div class="detail-item">
                                                            <label>Transfered Details:</label>

                                                            <button
                                                                onclick="openModal('./../uploads/new_withdrawal/bank_transfer/<?php echo $row['transaction_ss']; ?>');"
                                                                class="view-btn"> View Screenshot
                                                            </button>
                                                            <!-- <img src="./../uploads/new_deposits/<?php echo $row['screenshot']; ?>" alt='Screenshot'> -->

                                                        </div>
                                                        


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    unset($_SESSION['search_results']);
                                }
                                ?>
                            </tbody>

                            <!-- </tbody> -->
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Add modal structure at the bottom of the page, before </body> -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close-2">&times;</span>
            <img id="modalImage" src="" alt="Screenshot" width="450px" height="auto">
        </div>
    </div>




    <script src="./../template/template.js"></script>
    <script src="./assets/js/all_withdrawal.js"></script>
</body>

<script>



</script>

</html>