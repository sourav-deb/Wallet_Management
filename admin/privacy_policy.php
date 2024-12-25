<?php
include "../process/conn.php";
include "./process/auth.php";

// Fetch current privacy policy
$query = "SELECT content FROM privacy_policy ORDER BY updated_at DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$policy = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/privacy_policy.css">
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <div class="content-wrapper">
            <!-- Header Section -->
            <header class="main-header">
                <div class="header-left">
                    <button class="mobile-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="header-text">Privacy Policy</div>
                </div>

                <div class="header-right">
                    <div class="user-menu">
                        <i class="fas fa-bell" id="notification-bell"></i>
                        <div class="notification-box" id="notification-box">
                            <p>No new notifications</p>
                        </div>
                        <i class="fas fa-user"></i>
                        <span class="user-name">John Doe</span>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <div class="main-content">
                <div class="filter-container">
                    <div class="title">Privacy Policy Editor</div>
                    <div class="filter-section">
                        <form action="./process/process_policy.php" method="POST">
                            <textarea id="policy-editor" name="policy_content" rows="10" cols="160">
                                <?php echo htmlspecialchars($policy['content'] ?? ''); ?>
                            </textarea>
                            <div class="form-actions">
                                <button type="submit" class="apply-btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Current Policy Display -->
                <div class="filter-container">
                    <div class="title">Current Privacy Policy</div>
                    <div class="filter-section">
                        <div class="policy-content">
                            <?php echo $policy['content'] ?? 'No privacy policy set.'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./../template/template.js"></script>
    <script src="./assets/js/privacy_policy.js"></script>
</body>
</html>