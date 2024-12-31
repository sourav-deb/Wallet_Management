<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Withdrawal Request</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/new_withdrawal.css">

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
                    <div class="header-text">New Withdrawal Requestt</div>
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
                                    <th>Customer Id</th>
                                    <th>Name</th>
                                    <th>Requested Amount</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $pay_req = mysqli_query($conn, "SELECT * FROM withdrawal_req WHERE status = 'pending' ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($pay_req)) {
                                    
                                    // echo $row['name'];
                                    echo "
                                        <tr>
                                            <td>
                                                <i class='fas fa-chevron-right expand-details'></i>
                                            </td>
                                            <td>
                                                <div class='transaction-details'>
                                                    <p class='customer-name'>{$row['cust_id']}</p>
                                                    <p class='transaction-date'></p>
                                                </div>
                                            </td>
                                            <td>{$row['cust_name']}</td>
                                            <td>{$row['req_amount']}</td>
                                            <td class='role-cell' >{$row['req_amount']}</td>
                                            <td><span class='status-badge {$row['status']}'>{$row['status']}</span></td>
                                        </tr>";
                                        $cust_id = $row['cust_id'];
                                        $all_cust = mysqli_query($conn, "SELECT * FROM customer WHERE cust_id = '$cust_id' ");
                                        while ($row1 = mysqli_fetch_assoc($all_cust)) {

                                    echo "
                                        <tr class='expandable-row'>
                                        <td colspan='6'>
                                            <div class='expanded-details'>
                                                <div class='details-grid'>
                                                    
                                                    <div class='detail-item'>
                                                        <label>Email:</label>
                                                        <span>{$row1['cust_email']}</span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Phone:</label>
                                                        <span>{$row1['cust_phone']}</span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Parent Id:</label>
                                                        <span>{$row['parent_id']}</span>
                                                    </div>

                                                    <form action='./process/withdrawal_req.php' method='post'>

                                                    <input type='hidden' name='cust_id' value='{$row['cust_id']}'>
                                                    <input type='hidden' name='cust_name' value='{$row['cust_name']}'>
                
                                                    <input type='hidden' name='created_at' value='{$row['created_at']}'>";

                                        echo "                                                                                               
                                                    <div class='detail-item'>
                                                        <label>Requested Amount:</label> 
                                                        <input type='number' name='req_amt' id='req_amt' value = '{$row['req_amount']}' required>
                                                    </div>

                                                    <div class='detail-item'>
                                                        <button type='submit' name='approve_req'>Approve</button>
                                                        <button type='submit' name='decline_req' class='declined-btn'>Decline</button>
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
    <script src="./assets/js/new_withdrawal.js"></script>
</body>

</html>