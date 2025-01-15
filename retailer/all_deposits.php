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
    <link rel="stylesheet" href="./assets/css/all_deposits.css">

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
                    <div class="header-text">All Deposits List</div>
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

                            <form action="./process/all_deposits.php" method="POST" class="filter-form">
                                

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

                                <!-- Date -->
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" name="date">
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
                                    <th width="50"></th>
                                    <th>Deposited By</th>
                                    <th style="display: none;">Deposited By</th>
                                    <th style="display: none;">Id</th>
                                    <th style="display: none;">Phone</th>
                                    <th style="display: none;">Deposited To</th>
                                    <th>Transaction ID</th>
                                    <th>UTR No</th>
                                    <th>Mobile</th>
                                    <th>Amount</th>
                                    <th>Request Date</th>
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
                                                    <p class="customer-name"><?php echo $row['deposited_by']; ?></p>
                                                    <!-- <p class="user-id">Deposited By: <?php echo $row['deposited_by']; ?></p> -->
                                                </div>
                                            </td>
                                            <td style="display: none;"><?php echo $row['deposited_by']; ?></td>
                                            <td style="display: none;"><?php echo $row['id']; ?></td>
                                            <td style="display: none;"><?php echo $row['mobileno']; ?></td>
                                            <td style="display: none;"><?php echo $row['deposited_to']; ?></td>
                                            <td><?php echo $row['transaction_id']; ?></td>
                                            <td><?php echo $row['utr_no']; ?></td>
                                            <td><?php echo $row['mobileno']; ?></td>
                                            <td><?php echo $row['amount']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><span
                                                    class="status-badge <?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></span>
                                            </td>
                                            <td>
                                                <?php if($row['status'] == 'approved'): ?>
                                                    <button class="btn-action edit" title="Edit User">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                <?php endif; ?>
                 
                                            </td>
                                        </tr>
                                        <tr class="expandable-row">
                                            <td colspan="10">
                                                <div class="expanded-details">
                                                    <div class="details-grid">
                                                        <div class="detail-item">
                                                            <label>Deposited By:</label>
                                                            <span><?php echo $row['deposited_by']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Deposited To:</label>
                                                            <span><?php echo $row['deposited_to']; ?></span>
                                                        </div>

                                                        <div class="detail-item">
                                                            <label>Email:</label>
                                                            <span><?php echo $row['email']; ?></span>
                                                        </div>

                                                        <div class="detail-item">
                                                            <label>Mobile:</label>
                                                            <span><?php echo $row['mobileno']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Amount:</label>
                                                            <span>INR <?php echo $row['amount']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Status:</label>
                                                            <span><?php echo $row['status']; ?></span>
                                                        </div>
                                                        <div class="detail-item">
                                                            <label>Requested Date:</label>
                                                            <span><?php echo $row['created_at']; ?></span>
                                                        </div>

                                                        <!-- Show screenshot -->
                                                        <div class="detail-item">
                                                            <label>Screenshot:</label>

                                                            <button
                                                                onclick="openModal('./../uploads/new_deposits/<?php echo $row['screenshot']; ?>');"
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

    <!-- Edit Modal -->
    <div class=" modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit User Details</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editForm" action="./process/all_deposit_search.php" method="POST">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="modal-grid">
                        
                        <div class="form-group">
                            <label>Deposited By</label>
                            <input type="text" id="deposited_by" name="deposited_by" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Deposited To</label>
                            <input type="text" id="deposited_to" name="deposited_to" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" id="edit_phone" name="edit_phone" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Comm Type</label>
                            <select name="add_comm_type" id="add_comm_type" required>
                                <option selected disabled>Select Commission Type</option>
                                <option value="fixed">Fixed</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Comm Value</label>
                            <input type="text" id="add_comm_value" name="add_comm_value" required>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" id="amount" name="amount" required readonly>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select id="edit_status" name="edit_status" required>
                                <!-- <option value="">Update Status</option> -->
                                <option value="approved">Approved</option>
                                <option value="commissioned">Commissioned</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn-save" name="update_deposits">Save Changes</button>
                </form>
            </div>
        </div>
    </div>


    <script src="./../template/template.js"></script>
    <script src="./assets/js/all_deposits.js"></script>
</body>

<script>



</script>

</html>