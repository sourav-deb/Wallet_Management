<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Customers</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/all_customer.css">

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
                    <div class="header-text">All Customers List</div>
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

                            <form action="./process/all_search.php" method="POST" class="filter-form">
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

                                <!-- Roll Wise -->
                                <!-- <div class="form-group">
                                    <label for="rolewise">Role Wise</label>
                                    <select id="rolewise" name="rolewise">
                                        <option selected disabled>Select Role</option>
                                        <option value="retailer">Retailer</option>
                                        <option value="user">User</option>
                                    </select>
                                </div> -->

                                <!-- Users Role -->
                                <div class="form-group">
                                    <label for="userrole">Users Role</label>
                                    <select id="userrole" name="userrole">
                                        <option selected disabled>Select Role</option>
                                        <option value="retailer">Retailer</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <!-- Retailer No -->
                                <div class="form-group">
                                    <label for="retailerno">Retailer No</label>
                                    <input type="number" id="retailerno" name="retailerno" placeholder="Retailer No">
                                </div>

                                <!-- Min Wallet -->
                                <div class="form-group">
                                    <label for="minwallet">Min Wallet</label>
                                    <input type="number" id="minwallet" name="minwallet" placeholder="Min Wallet">
                                </div>

                                <!-- Max Wallet -->
                                <div class="form-group">
                                    <label for="maxwallet">Max Wallet</label>
                                    <input type="number" id="maxwallet" name="maxwallet" placeholder="Max Wallet">
                                </div>

                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="apply_filter">
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
                                    <th width="50"></th>
                                    <th>Details</th>
                                    <th style="display: none;">Gmail ID</th>
                                    <th style="display: none;">Mobile No</th>
                                    <th>Parent</th>
                                    <th>Role</th>
                                    <th>Comm Type</th>
                                    <th>Comm Value</th>
                                    <th>Wallet Balance</th>
                                    <th>Register Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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
                                                <i class="fas fa-chevron-right expand-details"></i>
                                            </td>
                                            <td>
                                                <div class="user-details">
                                                    <p class="customer-name"><?php echo $row['cust_name']; ?></p>
                                                    <p class="user-id">ID: <?php echo $row['cust_id']; ?></p>
                                                </div>
                                            </td>
                                            <td style="display: none;"><?php echo $row['cust_email']; ?></td>
                                            <td style="display: none;"><?php echo $row['cust_phone']; ?></td>
                                            <td><?php echo $row['parent']; ?></td>
                                            <td><?php echo $row['cust_role']; ?></td>
                                            <td><?php echo $row['commission_type']; ?></td>
                                            <td><?php echo $row['commission_value']; ?></td>
                                            <td>INR <?php echo $row['wallet_balance']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><span class="status-badge <?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></span></td>
                                            <td>
                                                <button class="btn-action edit" title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn-action login" title="Login as User">
                                                    <i class="fas fa-sign-in-alt"></i>
                                                </button>

                                                <button class="btn-action delete" title="Delete User">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="expandable-row">
                                            <td colspan="10">
                                                <div class="expanded-details">
                                                    <div class="details-grid">
                                                        <div class="detail-item">
                                                            <label>Full Name:</label>
                                                            <span><?php echo $row['cust_name']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Parent Name:</label>
                                                            <span><?php echo $row['parent']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Role:</label>
                                                            <span><?php echo $row['cust_role']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Commission Type:</label>
                                                            <span><?php echo $row['comm_type']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Commission Value:</label>
                                                            <span><?php echo $row['comm_value']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Wallet Balance:</label>
                                                            <span>INR <?php echo $row['wallet_balance']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Status:</label>
                                                            <span><?php echo $row['status']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Register Date:</label>
                                                            <span><?php echo $row['created_at']; ?></span>
                                                        </div>
                                                        <!-- <div class="detail-item full-width">
                                                            <label>Register Date:</label>
                                                            <span><?php echo $row['created_at']; ?></span>
                                                        </div> -->
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
    <script src="./assets/js/all_customer.js"></script>
</body>

</html>