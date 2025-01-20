<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Retailers</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/pending.css">

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
                    <div class="header-text">Pending Retailers List</div>
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
                                    <th width="50"></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th style="display: none;">Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $all_reg = mysqli_query($conn, "SELECT * FROM registration ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($all_reg)) {
                                    if ($row['status'] == 'Approved' || $row['status'] == 'Declined') {
                                ?>

                                        <tr>
                                            <td>
                                                <!-- <i class='fas fa-chevron-right expand-details'></i> -->
                                            </td>
                                            <td>
                                                <div class='transaction-details'>
                                                    <p class='customer-name'><?php echo $row['full_name'] ?></p>
                                                    <p class='transaction-date'></p>
                                                </div>
                                            </td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td class='role-cell'><?php echo $row['role'] ?></td>
                                            <td><span class='status-badge <?php echo $row['status'] ?>'><?php echo $row['status'] ?></span></td>

                                        </tr>
                                    <?php
                                    } elseif ($row['status'] == 'Pending') {
                                        // echo $row['name'];
                                    ?>
                                        <tr>
                                            <td>
                                                <i class='fas fa-chevron-right expand-details'></i>
                                            </td>
                                            <td><?php echo $row['full_name'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td class='role-cell'><?php echo $row['role'] ?></td>
                                            <td><span class='status-badge <?php echo $row['status'] ?>'><?php echo $row['status'] ?></span></td>
                                            <td>
                                                <button class="btn-action edit" title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                            <td style="display: none;">
                                                <?php echo $row['id'] ?>
                                            </td>
                                        </tr>


                                        <tr class='expandable-row'>
                                            <td colspan='7'>
                                                <div class='expanded-details'>
                                                    <div class='details-grid'>
                                                        <div class='detail-item'>
                                                            <label>Name:</label>
                                                            <span><?php echo $row['full_name'] ?></span>
                                                        </div>
                                                        <div class='detail-item'>
                                                            <label>Email:</label>
                                                            <span><?php echo $row['email'] ?></span>
                                                        </div>

                                                        <div class='detail-item'>
                                                            <label>Phone:</label>
                                                            <span><?php echo $row['phone'] ?></span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>

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
                <form id="editForm" action="./process/assign_role.php" method="POST">
                    <input type="hidden" id="id" name="id">
                    <div class="modal-grid">

                        <!-- Full Name -->
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" id="full_name" required readonly>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" required readonly>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="phone" name="phone" id="phone" required readonly>
                        </div>

                        <!-- Comm Type -->
                        <div class="form-group">
                            <label>Comm Type</label>
                            <select name="commission_type" id="commission_type" required>
                                <option selected disabled>Select Comm Type</option>
                                <option value="fixed">Fixed</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>

                        <!-- Comm Value -->
                        <div class="form-group">
                            <label>Comm Type</label>
                            <input type="text" name="commission_value" id="commission_value" placeholder="Enter Comm Value" required>
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

                    <div class="payment-methods">
                        <label>Payment Methods</label>
                        <div class="checkbox-wrapper">

                        <?php
                        $pay_req = mysqli_query($conn, "SELECT * FROM payment_methods ORDER BY id");
                        while ($row = mysqli_fetch_assoc($pay_req)) {
                        ?>
                            <div class="checkbox-item">
                                <input type="checkbox" id="gpay" name="payment_methods[]" value="<?php echo $row['methods']; ?>">
                                <label for="<?php echo $row['methods']; ?>"><?php echo $row['methods']; ?></label>
                            </div>
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>

                    <div class='detail-item'>
                        <button type='submit' name='assign_role'>Assign Role</button>
                        <button type='submit' name='declined' class='declined-btn'>Declined</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./../template/template.js"></script>
    <script src="./assets/js/pending.js"></script>
</body>

</html>