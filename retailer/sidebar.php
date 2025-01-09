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
            <span class="sidebar-text">Retailer Management</span>
        </div>
        <!-- Mobile close button -->
        <button class="mobile-close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <ul class="sidebar-menu">
        <li id="dashboard">
            <a href="./dashboard.php" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>
        <li id="user-management">
            <a href="#" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span class="sidebar-text">Request Balance</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./balance_request.php"><span class="sidebar-text">Request Form</span></a></li>
                <li><a href=""><span class="sidebar-text">All Requests List</span></a></li>
            </ul>
        </li>

        <li id="payment-requests">
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Payment Requests</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./.php"><span class="sidebar-text">New Requests</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Processed</span></a></li>
            </ul>
        </li>
        <li id="withdrawal-requests">
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Withdrawal Requests</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./.php"><span class="sidebar-text">New Requests</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Processed</span></a></li>
            </ul>
        </li>
        <li id="balance-sheet">
            <a href="./.php" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Balance Sheets</span>
                <!-- <i class="fas fa-chevron-down submenu-arrow"></i> -->
            </a>
        </li>
        <li id="payout-management">
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Payout Management</span>
                <!-- <i class="fas fa-chevron-down submenu-arrow"></i> -->
            </a>

        </li>
        <li id="settings">
            <a href="" class="menu-item">
                <i class="fas fa-credit-card"></i>
                <span class="sidebar-text">Settings</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./.php"><span class="sidebar-text">Admin Bank</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Main Settings</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Privacy Policy</span></a></li>
            </ul>
        </li>
        <li id="logout">
            <a href="./process/.php" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span class="sidebar-text">Logout</span>
            </a>
        </li>
    </ul>

    <!-- <div class="sidebar-toggle">
                <i class="fas fa-chevron-left"></i>
            </div> -->
</nav>

<?php
// include "./process/auth.php";
?>

