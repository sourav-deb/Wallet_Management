<?php
include "../process/conn.php";
include "./process/auth.php";

$userid = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdrawal</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/new_withdrawal_req.css">

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
                    <div class="header-text">New Withdrawal</div>
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

                <!-- Results section -->
                <div class="results-section">
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th style="display:none;"></th>
                                    <th width="50"></th>
                                    <th>Account No</th>
                                    <th>Account Holder</th>
                                    <th>Amount</th>
                                    <th>Requested At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $all_reg = mysqli_query($conn, "SELECT * FROM withdrawal_req WHERE transfer_by = '$userid' ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($all_reg)) {
                                    if ($row['status'] == 'pending') {

                                       ?>
                                        <tr>
                                            <td style="display:none;"><?php echo $row['id'] ?> </td>
                                            <td>
                                                <i class="fas fa-chevron-right expand-details"></i> 
                                            </td>
                                            <td>
                                                <div class="transaction-details">
                                                    <p class="customer-name"><?php echo $row['account_no'] ?></p>
                                                    <p class="transaction-date"></p>
                                                </div>
                                            </td>
                                            <td><?php echo $row['user_name'] ?></td>
                                            <td><?php echo $row['amount'] ?></td>
                                            <td class="role-cell" ><?php echo $row['created_at'] ?></td>
                                            <td><span class="status-badge <?php echo $row['amount'] ?>"><?php echo $row['status'] ?></span></td>
                                            <td>
                                                <button class='btn-action edit' title='Edit User'>
                                                    <i class='fas fa-edit'></i>
                                                </button>
           
                                            </td>
                                        </tr>

                                        
                                        <tr class="expandable-row">
                                        <td colspan='8'>
                                            <div class='expanded-details'>
                                                <div class='details-grid'>
                                                    <div class='detail-item'>
                                                        <label>Requested To:</label>
                                                        <span><?php echo $row['transfer_by'] ?></span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Mobile:</label>
                                                        <span><?php echo $row['mobile'] ?></span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Screenshot:</label>
                                                        <span><?php echo $row['screenshot'] ?></span>
                                                    </div>

                                                

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit User Details</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editForm" action="./process/withdrawal.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="update_id" name="update_id">
                    <input type="hidden" id="edit_user_type" name="user_type">
                    <div class="modal-grid">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" id="wd_amount" name="wd_amount" required>
                        </div>
                        <div class="form-group">
                            <label>Transaction Id</label>
                            <input type="text" id="wd_transaction_id" name="wd_transaction_id" required>
                        </div>

                        <div class="form-group">
                            <label>UTR No.</label>
                            <input type="text" id="wd_utrno" name="wd_utrno" required>
                        </div>

                        <div class="form-group">
                            <label>Screenshot</label>
                            <input type="file" id="screenshot" name="screenshot" required  >
                        </div>
                        
                    </div>

                    <button type="submit" class="btn-save" name="received">Transfered</button>
                </form>
            </div>
        </div>
    </div>

    <?php
        }
    }
    ?>

    <script src="./../template/template.js"></script>
    <script src="./assets/js/new_withdrawal_req.js"></script>
</body>

</html>