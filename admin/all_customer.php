<?php
include "../process/conn.php";


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
                <div class="filter-section">
                    <div class="form-grid">

                        <!-- Gmail Search -->
                        <div class="form-group">
                            <label for="gmailSearch">Gmail ID</label>
                            <input type="email" id="gmailid" placeholder="Search by Gmail">
                        </div>

                        <!-- Number Search -->
                        <div class="form-group">
                            <label for="numberSearch">Mobile No</label>
                            <input type="text" id="mobileno" placeholder="Search by Number">
                        </div>

                        <!-- Roll Wise -->
                        <div class="form-group">
                            <label for="rollwise">Roll Wise</label>
                            <select id="rollwise" placeholder="Search by ID">
                                <option selected disabled>Select Roll</option>
                                <option value="Retailer">Retailer</option>
                                <option value="User">User</option>
                            </select>
                        </div>

                        <!-- Users Role -->
                        <div class="form-group">
                            <label for="userrole">Users Role</label>
                            <select id="userrole" placeholder="Search by ID">
                                <option selected disabled>Select Roll</option>
                                <option value="Retailer">Retailer</option>
                                <option value="User">User</option>
                            </select>
                        </div>

                        <!-- Retailer No -->
                        <div class="form-group">
                            <label for="retailerno">Retailer No</label>
                            <input type="number" id="retailerno" placeholder="Retailer No">
                        </div>

                        <!-- Min Wallet -->
                        <div class="form-group">
                            <label for="minwallet">Min Wallet</label>
                            <input type="number" id="minwallet" placeholder="Min Wallet">
                        </div>

                        <!-- Max Wallet -->
                        <div class="form-group">
                            <label for="maxwallet">Max Wallet</label>
                            <input type="number" id="maxwallet" placeholder="Max Wallet">
                        </div>

                    </div>

                    <!-- Apply Button -->
                    <div class="form-actions">
                        <button type="button" class="apply-btn">
                            <i class="fas fa-search"></i> Apply Filter
                        </button>
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <i class="fas fa-chevron-right expand-details"></i>
                                    </td>
                                    <td>
                                        <div class="user-details">
                                            <p class="customer-name">John Doe</p>
                                            <p class="user-id">ID: USR123456</p>
                                        </div>
                                    </td>
                                    <td>john.doe@example.com</td>
                                    <td>+1234567890</td>
                                    <td>$500.00</td>
                                    <td><span class="status-badge approved">Active</span></td>
                                    <td>
                                        <button class="btn-action login" title="Login as User">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </button>
                                        <button class="btn-action edit" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-action delete" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="expandable-row">
                                    <td colspan="7">
                                        <div class="expanded-details">
                                            <div class="details-grid">
                                                <div class="detail-item">
                                                    <label>Registration Date:</label>
                                                    <span>2024-02-20</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Last Login:</label>
                                                    <span>2024-02-25 14:30</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Retailer ID:</label>
                                                    <span>RTL789012</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Account Type:</label>
                                                    <span>Premium</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Total Transactions:</label>
                                                    <span>156</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>KYC Status:</label>
                                                    <span>Verified</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Add more user rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="./../template/template.js"></script>
    <script src="./assets/js/all_customer.js"></script>
</body>

</html>