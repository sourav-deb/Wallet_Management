<?php
include "../process/conn.php";
include "./process/auth.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Settings</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/main_settings.css">

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
                    <div class="header-text">Main Settings</div>
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

                <!-- Bulk Commission Settings -->
                <div class="filter-container">
                    <div class="title">Bulk Commission Settings</div>
                    <div class="filter-section">
                        <div class="form-grid">

                            <form action="./process/settings_process.php" method="POST" class="filter-form">
                                <!-- Users Role -->
                                <div class="form-group">
                                    <label for="userrole">Users Role</label>
                                    <select id="userrole" name="userrole">
                                        <option selected disabled>Select Role</option>
                                        <option value="retailer">Retailer</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <!-- Commission Type -->
                                <div class="form-group">
                                    <label for="comm-type">Commission Type</label>
                                    <select id="comm-type" name="comm-type">
                                        <option selected disabled>Select Commission Type</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>

                                <!-- Commission Value -->
                                <div class="form-group">
                                    <label for="comm-value">Commission Value</label>
                                    <input type="text" id="comm-value" name="comm-value"
                                        placeholder="Enter Commission Value">
                                </div>



                        </div>

                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="bulk_apply">
                                Bulk Apply
                            </button>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Toggle Button : New Registration Settings -->
                <div class="filter-container">
                    <div class="title">New Registration Settings</div>
                    <div class="filter-section">

                        <!-- Create On Off toggle button -->
                        <div class="toggle-container">
                            <label class="toggle-switch">
                                <?php
                                $query = "SELECT value FROM settings WHERE setting_name='registration_enabled'";
                                $result = mysqli_query($conn, $query);
                                $enabled = mysqli_fetch_assoc($result)['value'] ?? '0';
                                ?>
                                <input type="checkbox" name="registration_status" id="registration_status" <?php echo $enabled == '1' ? 'checked' : ''; ?>>
                                <span class="slider round"></span>
                            </label>
                            <span class="toggle-label">Enable New Registrations</span>
                        </div>

                    </div>
                </div>

                <!-- SMTP Settings -->
                <div class="filter-container">
                    <div class="title">SMTP Settings</div>
                    <div class="filter-section">
                        <div class="form-grid">
                            <?php
                            $smtp_query = "SELECT * FROM smtp_settings LIMIT 1";
                            $smtp_result = mysqli_query($conn, $smtp_query);
                            $smtp_data = mysqli_fetch_assoc($smtp_result);
                            ?>
                            <form action="./process/settings_process.php" method="POST" class="filter-form">

                                <!-- Admin Email -->
                                <div class="form-group">
                                    <label for="adminemail">SMTP Email</label>
                                    <input type="email" id="adminemail" name="adminemail"
                                        value="<?php echo htmlspecialchars($smtp_data['email'] ?? ''); ?>"
                                        placeholder="Enter Admin Email">
                                </div>

                                <!-- Admin Email Password -->
                                <div class="form-group">
                                    <label for="adminemail-pass">SMTP Password</label>
                                    <input type="password" id="adminemail-pass" name="adminemail-pass"
                                        value="<?php echo htmlspecialchars($smtp_data['password'] ?? ''); ?>"
                                        placeholder="Enter Admin Email Password">
                                </div>

                                <!-- Email Subject -->
                                <div class="form-group">
                                    <label for="adminemail-sub">SMTP Email Subject</label>
                                    <input type="text" id="adminemail-sub" name="adminemail-sub"
                                        value="<?php echo htmlspecialchars($smtp_data['subject'] ?? ''); ?>"
                                        placeholder="Enter Email Subject">
                                </div>

                                <!-- Email Body -->
                                <div class="form-group">
                                    <label for="adminemail-body">SMTP Email Body</label>
                                    <textarea id="adminemail-body" name="adminemail-body" placeholder="Enter Email Body"
                                        rows="4"
                                        cols="50"><?php echo htmlspecialchars($smtp_data['body'] ?? ''); ?></textarea>
                                </div>

                        </div>
                        <!-- Apply Button -->
                        <div class="form-actions">
                            <button type="submit" class="apply-btn" name="smtp_apply">
                                Save SMTP
                            </button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="./../template/template.js"></script>
    <script src="./assets/js/main_settings.js"></script>

</body>

</html>