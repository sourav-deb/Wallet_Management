<?php
include "../process/conn.php";
include "./process/auth.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Request</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/balance_req.css">

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
                    <div class="header-text">Deposit Request</div>
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
                <div class="filter-container">
                    <div class="filter-section">
                        <div class="form-grid">

                            <form action="./process/new_deposit.php" method="POST" class="filter-form"
                                enctype="multipart/form-data">

                                <!-- Transaction Id -->
                                <div class="form-group">
                                    <label for="transaction-id">Transaction Id</label>
                                    <input type="text" name="transaction-id" id="transaction-id"
                                        placeholder="Transaction Id">
                                </div>

                                <!-- UTR No. -->
                                <div class="form-group">
                                    <label for="utr-no">UTR No.</label>
                                    <input type="text" name="utr-no" id="utr-no" placeholder="UTR No.">
                                </div>

                                <!-- Amount -->
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" name="amount" id="amount" placeholder="Amount">
                                </div>

                                <!-- Screnshot -->
                                <div class="form-group">
                                    <label for="screnshot">Screnshot</label>
                                    <input type="file" name="screnshot" id="screnshot" multiple>
                                </div>

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="fullname">Deposited By</label>
                                    <input type="text" id="fullname" name="deposited_by" placeholder="Full Name">
                                </div>

                                <!-- Gmail ID -->
                                <div class="form-group">
                                    <label for="gmailid">Gmail ID</label>
                                    <input type="email" id="gmailid" name="email" placeholder="Gmail ID">
                                </div>

                                <!-- Mobile No -->
                                <div class="form-group">
                                    <label for="mobileno">Mobile No</label>
                                    <input type="text" id="mobileno" name="mobileno" placeholder="Mobile No">
                                </div>

                                <!-- Remark -->
                                <div class="form-group">
                                    <label for="remark">Remark</label>
                                    <input type="text" id="remark" name="remark" placeholder="Remark">
                                </div>


                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="new_deposit">
                                <i class="fas fa-search"></i> Save
                            </button>
                        </div>
                        </form>
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
                <form id="editForm" action="./process/edit_customer.php" method="POST">
                    <input type="hidden" id="edit_id" name="id">
                    <input type="hidden" id="edit_user_type" name="user_type">
                    <div class="modal-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="edit_name" name="edit_name" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="edit_email" name="edit_email" required>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" id="edit_phone" name="edit_phone" required>
                        </div>
                        <div class="form-group">
                            <label>Parent</label>
                            <select name="edit_parent" id="edit_parent">
                                <option selected disabled>Select Parent</option>
                                <option value="admin">Admin</option>
                                <option value="retailer">Retailer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="edit_role" id="edit_role">
                                <option selected disabled>Select Role</option>
                                <option value="retailer">Retailer</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Comm Type</label>
                            <select name="edit_comm_type" id="edit_comm_type">
                                <option selected disabled>Select Comm Type</option>
                                <option value="fixed">Fixed</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Comm Value</label>
                            <input type="text" id="edit_comm_value" name="edit_comm_value" required>
                        </div>

                        <div class="form-group">
                            <label>Wallet Balance</label>
                            <input type="number" id="edit_wallet" name="edit_wallet" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select id="edit_status" name="edit_status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn-save" name="edit_customer">Save Changes</button>
                </form>
            </div>
        </div>
    </div>


    <script src="./../template/template.js"></script>
    <script src="./assets/js/balance_req.js"></script>
</body>

</html>