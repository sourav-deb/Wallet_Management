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
            <span class="sidebar-text">WEBMANAGEMENT</span>
        </div>
        <!-- Mobile close button -->
        <button class="mobile-close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <ul class="sidebar-menu">

        <li id="bank_transfer">
            <a href="dashboard.php" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span class="sidebar-text">BANK TRANSFER</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./.php"><span class="sidebar-text">List of banks</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Deposit requests</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Pending deposit requests</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Withdrawal requests</span></a></li>
                <li><a href="./.php"><span class="sidebar-text">Pending withdrawal requests</span></a></li>
            </ul>
        </li>

        <li id="dashboard">
            <a href="./dashboard.php" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>
        <li id="request_balance">
            <a href="#" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span class="sidebar-text">Request Balance</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./balance_request.php"><span class="sidebar-text">Request Form</span></a></li>
                <li><a href="./all_balance_req.php"><span class="sidebar-text">All Requests List</span></a></li>
            </ul>
        </li>

        <li id="deposits">
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Deposits</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./new_deposits.php"><span class="sidebar-text">New Deposits Requests</span></a></li>
                <li><a href="./all_deposits.php"><span class="sidebar-text">Processed</span></a></li>
            </ul>
        </li>
        <li id="withdrawal">
            <a href="#" class="menu-item">
                <i class="fas fa-money-bill"></i>
                <span class="sidebar-text">Withdrawal Requests</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="./new_withdrawal_requests.php"><span class="sidebar-text">New Requests</span></a></li>
                <li><a href="./all_withdrawal.php"><span class="sidebar-text">Processed</span></a></li>
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
// include "./process/auth.php";
?>