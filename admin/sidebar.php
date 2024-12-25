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
                <span class="sidebar-text">User Management</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./add_user.php"><span class="sidebar-text">Add Users</span></a></li>
                <li><a href="./pending.php"><span class="sidebar-text">Pending Users List</span></a></li>
                <li><a href="./all_customer.php"><span class="sidebar-text">All Customers List</span></a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item">
                <i class="fas fa-sync"></i>
                <span class="sidebar-text">Refill Orders</span>
                <!-- <i class="fas fa-chevron-down submenu-arrow"></i> -->
            </a>
        </li>
        <li>
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Payment Requests</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./new_payment_request.php"><span class="sidebar-text">New Requests</span></a></li>
                <li><a href="#"><span class="sidebar-text">Processed</span></a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Withdrawal Requests</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="#"><span class="sidebar-text">New Requests</span></a></li>
                <li><a href="#"><span class="sidebar-text">Processed</span></a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Balance Sheets</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="#"><span class="sidebar-text">New Requests</span></a></li>
                <li><a href="#"><span class="sidebar-text">Processed</span></a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Payout Management</span>
                <!-- <i class="fas fa-chevron-down submenu-arrow"></i> -->
            </a>

        </li>
        <li>
            <a href="#" class="menu-item">
                <i class="fas fa-credit-card"></i>
                <span class="sidebar-text">Settings</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="#"><span class="sidebar-text">Admin Bank</span></a></li>
                <li><a href="./main_settings.php"><span class="sidebar-text">Main Settings</span></a></li>
                <li><a href="./privacy_policy.php"><span class="sidebar-text">Privacy Policy</span></a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-item">
                <i class="fas fa-balance-scale"></i>
                <span class="sidebar-text">Balance</span>
            </a>
        </li>
        <li>
            <a href="./process/logout.php" class="menu-item">
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
include "./process/auth.php";
?>