<?php
include "../process/conn.php";
include "./process/auth.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users</title>

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

                            <form action="./process/adduser.php" method="POST" class="filter-form">
                                <!-- Parent -->
                                <div class="form-group">
                                    <label for="parent">Parent</label>
                                    <select name="parent" id="parent">
                                        <option selected disabled>Select Parent</option>
                                        <option value="admin">Admin</option>
                                        <option value="retailer">Retailer</option>
                                    </select>
                                </div>

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" onchange="showRetailerSelect(this.value)">
                                        <option selected disabled>Select Role</option>
                                        <option value="retailer">Retailer</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <!-- Retailer Selection (Initially Hidden) -->
                                <div class="form-group" id="retailerSelect" style="display:none;">
                                    <label for="parent_retailer">Select Retailer</label>
                                    <select name="parent_retailer" id="parent_retailer">
                                        <option selected disabled>Select Retailer</option>
                                        <?php
                                        $retailerQuery = "SELECT id, cust_name FROM customer WHERE status='Active'";
                                        $retailers = mysqli_query($conn, $retailerQuery);
                                        while ($retailer = mysqli_fetch_assoc($retailers)) {
                                            echo "<option value='" . $retailer['id'] . "'>" . $retailer['cust_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Full Name">
                                </div>

                                <!-- Commission Type -->
                                <div class="form-group">
                                    <label for="comm_type">Commission Type</label>
                                    <select name="comm_type" id="comm_type">
                                        <option selected disabled>Select Commission Type</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>

                                <!-- Commission Value -->
                                <div class="form-group">
                                    <label for="comm_value">Commission Value</label>
                                    <input type="number" id="comm_value" name="comm_value" placeholder="Commission Value">
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

                                <!-- Full Address -->
                                <div class="form-group">
                                    <label for="fulladdress">Full Address</label>
                                    <input type="text" id="fulladdress" name="fulladdress" placeholder="Full Address">
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <option value="Suspended">Suspended</option>
                                    </select>
                                </div>

                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="add_user">
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
    <script src="./assets/js/add_user.js"></script>
</body>

</html>