<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refill Orders</title>

    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Add JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="assets/css/refill_orders.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-wallet"></i>
                <span class="sidebar-text">Wallet</span>
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

            <div class="sidebar-toggle">
                <i class="fas fa-chevron-left"></i>
            </div>
        </nav>

        <div class="content-wrapper">
            <!-- New Header Section -->
            <header class="main-header">
                <div class="header-left">
                    <h2>Wallet Management</h2>
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
                <div class="filter-section">
                    <div class="form-grid">
                        <!-- Status Dropdown -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status">
                                <option value="">Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>

                        <!-- Payment Method -->
                        <div class="form-group">
                            <label for="paymentrequisite">Payment Requisite Id</label>
                            <input type="text" id="paymentrequisite" placeholder="Enter Payment Requisite ID">
                            <!-- <select id="paymentrequisite">
                                <option value="">Select Payment Method</option>
                                <option value="credit">Credit Card</option>
                                <option value="debit">Debit Card</option>
                                <option value="wallet">Wallet</option>
                            </select> -->
                        </div>

                        <!-- Merchant Transaction ID -->
                        <div class="form-group">
                            <label for="merchantTxnId">Merchant Transaction ID</label>
                            <input type="text" id="merchantTxnId" placeholder="Enter Transaction ID">
                        </div>

                        <!-- Currency -->
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select id="currency">
                                <option value="">Select Currency</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                            </select>
                        </div>

                        <!-- Operator Transaction ID -->
                        <div class="form-group">
                            <label for="operatorTxnId">Operator Transaction ID</label>
                            <input type="text" id="operatorTxnId" placeholder="Enter Operator ID">
                        </div>

                        <!-- Customer Wallet ID -->
                        <div class="form-group">
                            <label for="walletId">Customer Wallet ID</label>
                            <input type="text" id="walletId" placeholder="Enter Wallet ID">
                        </div>

                        <!-- Customer Name -->
                        <div class="form-group">
                            <label for="customerName">Customer Name</label>
                            <input type="text" id="customerName" placeholder="Enter Customer Name">
                        </div>

                        <!-- Operator -->
                        <div class="form-group">
                            <label for="operator">Operator</label>
                            <select id="operator">
                                <option value="">Select Operator</option>
                                <option value="op1">Operator 1</option>
                                <option value="op2">Operator 2</option>
                                <option value="op3">Operator 3</option>
                            </select>
                        </div>

                        <!-- Merchant User ID -->
                        <div class="form-group">
                            <label for="merchantUserId">Merchant User ID</label>
                            <input type="text" id="merchantUserId" placeholder="Enter Merchant User ID">
                        </div>


                        <!-- Refill Methods -->
                        <div class="form-group">
                            <label for="refillMethods">Refill Methods</label>
                            <select id="refillMethods">
                                <option value="">Select Refill Methods</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" id="startDate">
                        </div>

                        <!-- End Date -->
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" id="endDate">
                        </div>

                        <!-- Amount from -->
                        <div class="form-group">
                            <label for="amountFrom">Amount From</label>
                            <input type="text" id="amountFrom" placeholder="Enter Amount From">
                        </div>

                        <!-- Amount to -->
                        <div class="form-group">
                            <label for="amountTo">Amount To</label>
                            <input type="text" id="amountTo" placeholder="Enter Amount To">
                        </div>

                        <!-- Count -->
                        <div class="form-group">
                            <label for="count">Count</label>
                            <input type="text" id="count" placeholder="Enter Count">
                        </div>

                        <!-- Type -->
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select id="type">
                                <option value="">Select Type</option>
                                <option value="credit">Credit</option>
                                <option value="debit">Debit</option>
                            </select>
                        </div>

                        <!-- Payload -->
                        <div class="form-group">
                            <label for="payload">Payload</label>
                            <textarea id="payload" placeholder="Enter Payload"></textarea>
                        </div>
                    </div>

                    <!-- Apply Button -->
                    <div class="form-actions">
                        <button type="button" class="apply-btn">
                            <i class="fas fa-search"></i> Apply Filter
                        </button>
                    </div>
                </div>

                <!-- Results section -->
                <div class="results-section">
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th width="50"></th>
                                    <th>Details</th>
                                    <th>Customer Transaction ID</th>
                                    <th>Merchant Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <i class="fas fa-chevron-right expand-details"></i>
                                    </td>
                                    <td>
                                        <div class="transaction-details">
                                            <p class="customer-name">John Doe</p>
                                            <p class="transaction-date">2024-02-20 14:30</p>
                                        </div>
                                    </td>
                                    <td>CTX123456789</td>
                                    <td>MTX987654321</td>
                                    <td>$500.00</td>
                                    <td><span class="status-badge approved">Approved</span></td>
                                </tr>
                                <tr class="expandable-row">
                                    <td colspan="6">
                                        <div class="expanded-details">
                                            <div class="details-grid">
                                                <div class="detail-item">
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Operator:</label>
                                                    <span>Operator 1</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Currency:</label>
                                                    <span>USD</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Wallet ID:</label>
                                                    <span>WAL123456</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Merchant User ID:</label>
                                                    <span>MU789012</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Operator Transaction ID:</label>
                                                    <span>OTX456789</span>
                                                </div>
                                                <div class="detail-item full-width">
                                                    <label>Payload:</label>
                                                    <span>{"key": "value", "status": "success"}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-chevron-right expand-details"></i>
                                    </td>
                                    <td>
                                        <div class="transaction-details">
                                            <p class="customer-name">Jane Smith</p>
                                            <p class="transaction-date">2024-02-20 13:15</p>
                                        </div>
                                    </td>
                                    <td>CTX123456790</td>
                                    <td>MTX987654322</td>
                                    <td>$750.00</td>
                                    <td><span class="status-badge pending">Pending</span></td>
                                </tr>
                                <tr class="expandable-row">
                                    <td colspan="6">
                                        <div class="expanded-details">
                                            <div class="details-grid">
                                                <div class="detail-item">
                                                    <label>Payment Method:</label>
                                                    <span>Credit Card</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Operator:</label>
                                                    <span>Operator 2</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Currency:</label>
                                                    <span>EUR</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Wallet ID:</label>
                                                    <span>WAL123457</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Merchant User ID:</label>
                                                    <span>MU789013</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Operator Transaction ID:</label>
                                                    <span>OTX456790</span>
                                                </div>
                                                <div class="detail-item full-width">
                                                    <label>Payload:</label>
                                                    <span>{"key": "value", "status": "pending"}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fas fa-chevron-right expand-details"></i>
                                    </td>
                                    <td>
                                        <div class="transaction-details">
                                            <p class="customer-name">Mike Johnson</p>
                                            <p class="transaction-date">2024-02-20 12:45</p>
                                        </div>
                                    </td>
                                    <td>CTX123456791</td>
                                    <td>MTX987654323</td>
                                    <td>$250.00</td>
                                    <td><span class="status-badge declined">Declined</span></td>
                                </tr>
                                <tr class="expandable-row">
                                    <td colspan="6">
                                        <div class="expanded-details">
                                            <div class="details-grid">
                                                <div class="detail-item">
                                                    <label>Payment Method:</label>
                                                    <span>Debit Card</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Operator:</label>
                                                    <span>Operator 3</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Currency:</label>
                                                    <span>GBP</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Wallet ID:</label>
                                                    <span>WAL123458</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Merchant User ID:</label>
                                                    <span>MU789014</span>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Operator Transaction ID:</label>
                                                    <span>OTX456791</span>
                                                </div>
                                                <div class="detail-item full-width">
                                                    <label>Payload:</label>
                                                    <span>{"key": "value", "status": "failed"}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/refill_orders.js"></script>
</body>

</html>