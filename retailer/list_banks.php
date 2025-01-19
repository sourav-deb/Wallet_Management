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
    <link rel="stylesheet" href="./assets/css/list_banks.css">

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
                        <a href="#">All Requests</a>
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
                                    <th>Sl No</th>
                                    <th>Bank Name</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- display data here -->
                                <?php
                                $pay_req = mysqli_query($conn, "SELECT banks FROM customer WHERE cust_id = '$user_id'");
                                $row = mysqli_fetch_assoc($pay_req);

                                // Decode JSON data
                                $banks = json_decode($row['banks'], true); // true for associative array

                                // Check if banks exist and is an array
                                if ($banks && is_array($banks)) {
                                    foreach ($banks as $index => $bank) {
                                ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($bank); ?></td>
                                            <td></td>
                                            <td>
                                                <button class="btn-action edit" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;">No banks available</td>
                                    </tr>
                                <?php
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
    <script src="./assets/js/list_banks.js"></script>
</body>

</html>