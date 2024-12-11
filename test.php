<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refill Orders</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./template/template.css">
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
                    <div class="header-text">Wallet Management</div>
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

            </div>
        </div>
    </div>

    <script src="./template/template.js"></script>
</body>

</html>