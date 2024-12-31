<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Sheet</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/balance.css">

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
                    <div class="header-text">Balance Sheet</div>
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

                            <form action="./process/balance_search.php" method="POST" class="filter-form">
                                <!-- Customer Id -->
                                <div class="form-group">
                                    <label for="customerid">Customer ID</label>
                                    <input type="text" id="customerid" name="customerid" placeholder="Search by Customer ID">
                                </div>

                                <!-- Gmail Search -->
                                <div class="form-group">
                                    <label for="gmailSearch">Gmail ID</label>
                                    <input type="email" id="gmailid" name="gmailid" placeholder="Search by Gmail">
                                </div>

                                <!-- Number Search -->
                                <div class="form-group">
                                    <label for="numberSearch">Mobile No</label>
                                    <input type="text" id="mobileno" name="mobileno" placeholder="Search by Number">
                                </div>

                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="get_balance">
                                <i class="fas fa-search"></i> Open Balance Sheet
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
                                    <th>Cust Id</th>
                                    <th style="display: none;">Gmail ID</th>
                                    <th style="display: none;">Mobile No</th>
                                    <th>Date & Time</th>
                                    <th>Dr.</th>
                                    <th>Cr.</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <!-- <tbody> -->
                            <tbody>
                                <?php
                                if (isset($_SESSION['search_results']) && !empty($_SESSION['search_results'])) {
                                    foreach ($_SESSION['search_results'] as $row) {
                                ?>
                                        <tr data-user-type="<?php echo $row['user_type']; ?>">
                                            
                                            <td>
                                                <div class="user-details">
                                                    <p class="customer-name"><?php echo $row['cust_id']; ?></p>
                                                    <p class="user-id">ID: <?php echo $row['cust_id']; ?></p>
                                                </div>
                                            </td>
                                            <td style="display: none;"><?php echo ''; ?></td>
                                            <td style="display: none;"><?php echo ''; ?></td>
                                            <td><?php echo $row['date_time']; ?></td>
                                            <td><?php echo $row['debit']; ?></td>
                                            <td><?php echo $row['credit']; ?></td>
                                            <td><?php echo $row['balance']; ?></td>
                                            
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
    <script src="./assets/js/balance.js"></script>
</body>

</html>