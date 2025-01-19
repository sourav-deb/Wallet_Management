<?php
include "../process/conn.php";
include "./process/auth.php";

$userid = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposits</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/new_deposits.css">

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
                        <a href="#">Pending Deposit</a>
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

                <!-- Results section -->
                <div class="results-section">
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th width="50">More</th>
                                    <th>Transaction Id</th>
                                    <th>UTR No</th>
                                    <th>Amount</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $all_reg = mysqli_query($conn, "SELECT * FROM new_deposit WHERE deposited_to = '$userid' ORDER BY id DESC");
                                while ($row = mysqli_fetch_assoc($all_reg)) {
                                    if ($row['status'] == 'pending') {

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
                                            <td>{$row['amount']}</td>
                                            <td class='role-cell' >{$row['mobileno']}</td>
                                            <td><span class='status-badge {$row['status']}'>{$row['status']}</span></td>
                                        </tr>";
                                    
                                        echo "
                                        <tr class='expandable-row'>
                                        <td colspan='6'>
                                            <div class='expanded-details'>
                                                <div class='details-grid'>
                                                    <div class='detail-item'>
                                                        <label>Deposited By:</label>
                                                        <span>{$row['deposited_by']}</span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Email:</label>
                                                        <span>{$row['email']}</span>
                                                    </div>
                                                    <div class='detail-item'>
                                                        <label>Screenshot:</label>
                                                        <span>{$row['screenshot']}</span>
                                                    </div>

                                                    <form action='./process/deposit.php' method='post'>

                                                    <input type='hidden' name='transaction_id' value='{$row['transaction_id']}'>
                                                    
                                                    <div class='detail-item'>
                                                        <label>Amount:</label>
                                                        <input type='number' name='amount' id='amount' required value='{$row['amount']}'>
                                                    </div>

                                                    <div class='detail-item'>
                                                        <button type='submit' name='received'>Received</button>
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
    <script src="./assets/js/new_deposits.js"></script>
</body>

</html>