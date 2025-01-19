<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processed Payments</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/payment_processed.css">

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
                    <div class="header-text">Processed Payments</div>
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
                                    <th>Requested At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $pay_req = mysqli_query($conn, "SELECT * FROM payment_processed ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($pay_req)) {
                                    
                                    // echo $row['name'];
                                    echo "
                                        <tr>
                                            <td>
                                                <!-- <i class='fas fa-chevron-right expand-details'></i> -->
                                            </td>
                                            <td>{$row['cust_id']}</td>
                                            <td>{$row['cust_name']}</td>
                                            <td>{$row['amount']}</td>
                                            <td class='role-cell' >{$row['created_at']}</td>
                                            <td><span class='status-badge {$row['status']}'>{$row['status']}</span></td>
                                        </tr>";
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
    <script src="./assets/js/payment_processed.js"></script>
</body>

</html>