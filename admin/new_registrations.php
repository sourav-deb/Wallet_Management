<?php
include "../process/conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Registrations</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/new_reg.css">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <!-- <div class="sidebar-toggle">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="sidebar-header">
                <i class="fas fa-wallet"></i>
                <span class="sidebar-text">Wallet</span>
            </div> -->

            <div class="sidebar-header">
                <div class="header-content">
                    <i class="fas fa-bars sidebar-toggle"></i>
                    <span class="sidebar-text">Wallet</span>
                </div>
                <!-- Mobile close button -->
                <button class="mobile-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <ul class="sidebar-menu">
                <li class="active">
                    <a href="#" class="menu-item">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="sidebar-text">New Registrations</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-sync"></i>
                        <span class="sidebar-text">Refill Orders</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="#"><span class="sidebar-text">Pending Orders</span></a></li>
                        <li><a href="#"><span class="sidebar-text">Completed Orders</span></a></li>
                        <li><a href="#"><span class="sidebar-text">Failed Orders</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-money-bill"></i>
                        <span class="sidebar-text">Payment Requests</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="#"><span class="sidebar-text">New Requests</span></a></li>
                        <li><a href="#"><span class="sidebar-text">Processed</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-credit-card"></i>
                        <span class="sidebar-text">Payout Orders</span>
                        <i class="fas fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="#"><span class="sidebar-text">Pending Payouts</span></a></li>
                        <li><a href="#"><span class="sidebar-text">Completed Payouts</span></a></li>
                        <li><a href="#"><span class="sidebar-text">Rejected Payouts</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <i class="fas fa-balance-scale"></i>
                        <span class="sidebar-text">Balance</span>
                    </a>
                </li>
            </ul>

            <!-- <div class="sidebar-toggle">
                <i class="fas fa-chevron-left"></i>
            </div> -->
        </nav>

        <div class="content-wrapper">
            <!-- New Header Section -->
            <header class="main-header">
                <div class="header-left">
                    <!-- Mobile menu trigger -->
                    <button class="mobile-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="header-text">New Registrations</div>
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
                                    <th>Retailer</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $all_reg = mysqli_query($conn, "SELECT * FROM registration");
                                while ($row = mysqli_fetch_assoc($all_reg)) {
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
                                            <td></td>
                                            <td><span class='status-badge pending'>Pending</span></td>
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

                                                    <div class='detail-item'>
                                                        <label>Assigned To:</label>
                                                        <select name='assigned_to' id='assigned_to'>
                                                            <option selected disabled>Select role</option>
                                                            <option value='retailer'>Retailer</option>
                                                            <option value='user'>User</option>
                                                        </select>
                                                    </div>


                                                    <div class='detail-item retailer-select' style='display: none;'>
                                                        <label>Retailer:</label>
                                                        <select name='retailer' id='retailer'>";

                                    // <option value='1'>Retailer 1</option>
                                    // <option value='2'>Retailer 2</option>
                                    // <option value='3'>Retailer 3</option>

                                    $query = "SELECT retailer_id, retailer_name FROM retailer";
                                    $result = mysqli_query($conn, $query);

                                    while ($row1 = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row1['retailer_id'] . "'>" . htmlspecialchars($row1['retailer_name']) . "</option>";
                                    }


                                    echo " </select>
                                                    </div>
                                               

                                                </div>
                                            </div>
                                        </td>
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

    <script src="./assets/js/new_reg.js"></script>
    <script src="../template/template.js"></script>
</body>

</html>