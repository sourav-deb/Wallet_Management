<?php
include "../process/conn.php";
include "./process/auth.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Retailer</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/add_user.css">

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
                    <div class="header-text">Add Retailer</div>
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
                <form action="./process/adduser.php" method="POST" class="filter-form">
                    <div class="filter-container">

                        <div class="filter-section filter-section-1">
                            <div class="form-grid">

                                <!-- <form action="./process/adduser.php" method="POST" class="filter-form"> -->

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" name="role" id="role" value="Retailer" readonly>
                                    <!-- <select name="role" id="role" onchange="showRetailerSelect(this.value)">
                                        <option selected disabled>Select Role</option>
                                        <option value="retailer">Retailer</option>
                                        <option value="user">User</option>
                                    </select> -->
                                </div>

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" id="fullname" name="fullname" placeholder="Full Name">
                                </div>

                                <!-- Commission Type -->
                                <div class="form-group">
                                    <label for="comm_type">Commission Type</label>
                                    <select name="comm_type" id="comm_type">
                                        <option selected disabled>Select Commission Type</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>

                                <!-- Commission Value -->
                                <div class="form-group">
                                    <label for="comm_value">Commission Value</label>
                                    <input type="number" id="comm_value" name="comm_value" placeholder="Commission Value">
                                </div>

                                <!-- Gmail ID -->
                                <div class="form-group">
                                    <label for="gmailid">Gmail ID</label>
                                    <input type="email" id="gmailid" name="email" placeholder="Gmail ID">
                                </div>

                                <!-- Mobile No -->
                                <div class="form-group">
                                    <label for="mobileno">Mobile No</label>
                                    <input type="text" id="mobileno" name="mobileno" placeholder="Mobile No">
                                </div>

                                <!-- Full Address -->
                                <div class="form-group">
                                    <label for="fulladdress">Full Address</label>
                                    <input type="text" id="fulladdress" name="fulladdress" placeholder="Full Address">
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <option value="Suspended">Suspended</option>
                                    </select>
                                </div>

                            </div>



                            <!-- Apply Button -->
                            <!-- <div class="form-actions">
                                <button type="submit" class="apply-btn" name="add_user">
                                    <i class="fas fa-search"></i> Save
                                </button>
                            </div> -->
                            <!-- </form> -->
                        </div>

                        <div class="filter-section filter-section-2">
                            <div class="form-grid">

                                <!-- <form action="./process/adduser.php" method="POST" class="filter-form"> -->

                                <!-- List of all Available banks in checkbox -->
                                <div class="form-group bank-options">
                                    <label for="banks">Available Banks</label>
                                    <div class="bank-checkbox-wrapper">

                                    <?php

                                    $pay_req = mysqli_query($conn, "SELECT * FROM payment_methods ORDER BY id");
                                    while ($row = mysqli_fetch_assoc($pay_req)) {

                                        
                                        ?>
                                        <div class="bank-checkbox-item">
                                            <input type="checkbox" name="banks[]" value="<?php echo $row['methods']; ?>">
                                            <label for="hdfc"><?php echo $row['methods']; ?></label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Apply Button -->
                            <!-- <div class="form-actions">
                                <button type="submit" class="apply-btn" name="add_user">
                                    <i class="fas fa-search"></i> Save
                                </button>
                            </div> -->

                        </div>


                    </div>

                    <div class="form-actions">
                        <button type="submit" class="apply-btn" name="add_user">
                            SAVE
                        </button>
                    </div>
                </form>






            </div>
        </div>
    </div>




    <script src="./../template/template.js"></script>
    <script src="./assets/js/add_user.js"></script>
</body>

</html>