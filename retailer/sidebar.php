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

    <!-- here create a triangle just below the bank transfer and above the straight line-->

        <li id="bank_transfer">
            <a href="dashboard.php" class="menu-item">
                <i class="fa-solid fa-dollar-sign"></i>
                <span class="sidebar-text">BANK TRANSFER</span>
                <i class="fas fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu" type="disc">
                <li><a href="./.php"><span class="sidebar-text">List of banks</span></a></li>
                <li><a href="./balance_request.php"><span class="sidebar-text">Request balance</span></a></li>
                <li><a href="./all_balance_req.php"><span class="sidebar-text">All requests list</span></a></li>
                <li><a href="./all_deposits.php"><span class="sidebar-text">Deposit requests</span></a></li>
                <li><a href="./new_deposits.php"><span class="sidebar-text">Pending deposit requests</span></a></li>
                <li><a href="./all_withdrawal.php"><span class="sidebar-text">Withdrawal requests</span></a></li>
                <li><a href="./new_withdrawal_requests.php"><span class="sidebar-text">Pending withdrawal requests</span></a></li>
            </ul>
        </li>


        <li id="logout">
            <a href="./process/logout.php" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span class="sidebar-text">Logout</span>
            </a>
        </li>
    </ul>


</nav>

<?php
// include "./process/auth.php";
?>