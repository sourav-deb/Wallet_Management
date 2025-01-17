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
    <link rel="stylesheet" href="./assets/css/all_balance.css">

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
                        <a href="#">Balance Request</a>
                    </div>
                </div>


                <div class="header-right">

                    <div class="user-menu d-flex align-items-center ml-3 position-relative">
                        <!-- Wallet Balance -->
                        <!-- <div class="wallet-balance-container"> 
                            <div class="wallet-balance-box">
                                <div class="wallet-icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="wallet-info">
                                    <span class="wallet-amount">₹ 50,000.00</span>
                                </div>
                            </div>
                        </div> -->
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
                                    <th width="50">More</th>
                                    <th>Transaction Id</th>
                                    <th>UTR No</th>
                                    <th>Requested Amount</th>
                                    <th>Screenshot</th>
                                    <th>Requested At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $pay_req = mysqli_query($conn, "SELECT * FROM payment_req ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($pay_req)) {

                                    // echo $row['name'];
                                    echo "
                                        <tr>
                                            <td>
                                                <i class='fas fa-chevron-right expand-details'></i>
                                            </td>
                                            <td>
                                                <div class='transaction-details'>
                                                    <p class='customer-name'>{$row['transaction_id']}</p>
                                                    <p class='transaction-date'></p>
                                                </div>
                                            </td>
                                            <td>{$row['utr_no']}</td>
                                            <td>{$row['req_amount']}</td>
                                            <td><div class='detail-item'>
                                                <button
                                                    onclick=openModal('./../uploads/payment_req/{$row['screenshot']}');
                                                    class='view-btn'> View Screenshot
                                                </button>
                                                <!-- <img src='./../uploads/new_deposits/ {$row['screenshot']}' alt='Screenshot'> -->

                                                        </div></td>
                                            <td>{$row['created_at']}</td>
                                            <td><span class='status-badge {$row['status']}'>{$row['status']}</span></td>
                                        </tr>";

                                    echo " <tr class='expandable-row'>
                                    <td colspan='7'>
                                        <div class='expanded-details'>
                                            <div class='details-grid'>
                                                <div class='detail-item'>
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class='detail-item'>
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class='detail-item'>
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class='detail-item'>
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class='detail-item'>
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class='detail-item'>
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                
                                                <div class='detail-item full-width'>
                                                    <label>Payload:</label>
                                                    <span></span>
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

    <!-- Add modal structure at the bottom of the page, before </body> -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close-2">&times;</span>
            <img id="modalImage" src="" alt="Screenshot" width="450px" height="auto">
        </div>
    </div>

    <script src="./../template/template.js"></script>
    <script src="./assets/js/all_balance.js"></script>
</body>

</html>