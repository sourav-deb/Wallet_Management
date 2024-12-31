<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Users</title>

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
                    <div class="header-text">Pending Users List</div>
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
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $all_reg = mysqli_query($conn, "SELECT * FROM registration ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($all_reg)) {
                                    if ($row['status'] == 'Approved' || $row['status'] == 'Declined') {

                                        echo "
                                        <tr>
                                            <td>
                                                <!-- <i class='fas fa-chevron-right expand-details'></i> -->
                                            </td>
                                            <td>
                                                <div class='transaction-details'>
                                                    <p class='customer-name'>{$row['full_name']}</p>
                                                    <p class='transaction-date'></p>
                                                </div>
                                            </td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td class='role-cell' >{$row['role']}</td>
                                            <td><span class='status-badge {$row['status']}'>{$row['status']}</span></td>
                                        </tr>";
                                    } elseif ($row['status'] == 'Pending') {
                                        // echo $row['name'];
                                        echo "
                                        <tr>
                                            <td>
                                                <i class='fas fa-chevron-right expand-details'></i>
                                            </td>
                                            <td>
                                                <div class='transaction-details'>
                                                    <p class='customer-name'>{$row['full_name']}</p>
                                                    <p class='transaction-date'></p>
                                                </div>
                                            </td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td class='role-cell' >{$row['role']}</td>
                                            <td><span class='status-badge {$row['status']}'>{$row['status']}</span></td>
                                        </tr>";

                                        echo "
                                        <tr class='expandable-row'>
                                        <td colspan='6'>
                                            <div class='expanded-details'>
                                                <div class='details-grid'>
                                                    <div class='detail-item'>
                                                        <label>Name:</label>
                                                        <span>{$row['full_name']}</span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Email:</label>
                                                        <span>{$row['email']}</span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Phone:</label>
                                                        <span>{$row['phone']}</span>
                                                    </div>

                                                    <form action='./process/assign_role.php' method='post'>

                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                    <input type='hidden' name='full_name' value='{$row['full_name']}'>
                                                    <input type='hidden' name='email' value='{$row['email']}'>
                                                    <input type='hidden' name='phone' value='{$row['phone']}'>
                                                    <input type='hidden' name='created_at' value='{$row['created_at']}'>

                                                    <div class='detail-item'>
                                                        <label>Assigned To:</label>
                                                        <select name='assigned_to' id='assigned_to' required>
                                                            <option selected disabled>Select role</option>
                                                            <option value='retailer'>Retailer</option>
                                                            <option value='user'>User</option>
                                                        </select>
                                                    </div>


                                                    <div class='detail-item retailer-select' style='display: none;'>
                                                        <label>Retailer:</label>
                                                        <select name='retailer' id='retailer' required>
                                                        <option selected disabled>Select retailer</option>";

                                        $query = "SELECT cust_id, cust_name FROM profile WHERE cust_role = 'retailer'";
                                        $result = mysqli_query($conn, $query);

                                        while ($row1 = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row1['cust_id'] . "'>" . htmlspecialchars($row1['cust_name']) . "</option>";
                                        }


                                        echo " </select>
                                                    </div>

                                                    
                                                    <div class='detail-item'>
                                                        <label>Commission Type:</label>
                                                        <select name='commission_type' id='commission_type' required>
                                                            <option selected disabled>Select commission type</option>
                                                            <option value='fixed'>Fixed</option>
                                                            <option value='percentage'>Percentage</option>
                                                        </select>
                                                    </div>

                                                    <div class='detail-item'>
                                                        <label>Commission Value:</label>
                                                        <input type='number' name='commission_value' id='commission_value'>
                                                    </div>

                                                    <div class='detail-item'>
                                                        <button type='submit' name='assign_role'>Assign Role</button>
                                                        <button type='submit' name='declined' class='declined-btn'>Declined</button>
                                                    </div>
                                               </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>";
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

    <script src="./../template/template.js"></script>
    <script src="./assets/js/pending.js"></script>
</body>

</html>