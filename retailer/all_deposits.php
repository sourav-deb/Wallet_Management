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
                    <div class="header-text">
                        <a href="#">Home Page</a> /
                        <a href="#">Bank Transfer</a> /
                        <a href="#">Deposit Requests</a>
                    </div>
                </div>


                <div class="header-right">

                    <?php
                    include '../process/conn.php';
                    include '../auth.php';
                    $user_id = $_SESSION['user_id'];
                    // echo $user_id;

                    $sql = "SELECT cust_name FROM customer WHERE cust_id = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $cust_name = $row['cust_name'];

                    ?>

                    <div class="user-menu d-flex align-items-center ml-3 position-relative">
                        <i class="fas fa-user text-dark ml-3"></i>
                        <span class="user-name text-dark ml-2"><?php echo $cust_name; ?></span>
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
                                    <th>Transaction Id</th>
                                    <th style="display: none;">Deposited By</th>
                                    <th style="display: none;">Id</th>
                                    <th style="display: none;">Phone</th>
                                    <th style="display: none;">Deposited To</th>
                                    <th>Deposited By</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Request Date</th>
                                    <th>User Info</th>
                                </tr>
                            </thead>
                            <!-- <tbody> -->
                            <tbody>
                                <?php
                                if (isset($_SESSION['search_results']) && !empty($_SESSION['search_results'])) {
                                    foreach ($_SESSION['search_results'] as $row) {
                                ?>
                                        <tr data-user-type="<?php echo $row['user_type']; ?>">
                                            
                                            <td><?php echo $row['transaction_id']; ?></td>
                                            <td style="display: none;"><?php echo $row['deposited_by']; ?></td>
                                            <td style="display: none;"><?php echo $row['id']; ?></td>
                                            <td style="display: none;"><?php echo $row['mobileno']; ?></td>
                                            <td style="display: none;"><?php echo $row['deposited_to']; ?></td>
                                            <td><?php echo $row['deposited_by']; ?></td>
                                            <td><?php echo $row['amount']; ?></td>

                                            <td><span
                                                    class="status-badge <?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></span>
                                            </td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td>
                                                <div class="user-details">
                                                    <p class="customer-name"><b>transaction_id:</b> <?php echo $row['transaction_id']; ?>
                                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('<?php echo $row['transaction_id']; ?>')" title="Copy Transaction ID"></i>
                                                    </p>
                                                    <p class="customer-name"><b>utr_no:</b> <?php echo $row['utr_no']; ?>
                                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('<?php echo $row['utr_no']; ?>')" title="Copy UTR No"></i>
                                                    </p>
                                                    <p class="customer-name"><b>mobile_no:</b> <?php echo $row['mobileno']; ?>
                                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('<?php echo $row['mobileno']; ?>')" title="Copy UTR No"></i>
                                                    </p>
                                                    <p class="customer-name"><b>screenshot:</b> 
                                                        <a href="./../uploads/new_deposits/<?php echo $row['screenshot'];?>" target="_blank">View Screenshot</a>
                                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('<?php echo $row['mobileno']; ?>')" title="Copy Mobile No"></i>
                                                    </p>
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