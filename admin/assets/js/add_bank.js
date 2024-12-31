// Expand details
document.querySelectorAll('.expand-details').forEach(icon => {
    icon.addEventListener('click', function () {
        // Toggle the arrow icon
        this.classList.toggle('active');

        // Toggle the expanded row
        const expandableRow = this.closest('tr').nextElementSibling;
        expandableRow.classList.toggle('active');
    });
});


// Add submenu toggle functionality
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', (e) => {
        if (e.currentTarget.nextElementSibling && e.currentTarget.nextElementSibling.classList.contains('submenu')) {
            e.preventDefault();
            const parent = e.currentTarget.parentElement;

            // Close other open submenus
            document.querySelectorAll('.sidebar-menu > li').forEach(li => {
                if (li !== parent && li.classList.contains('active')) {
                    li.classList.remove('active');
                }
            });

            // Toggle current submenu
            parent.classList.toggle('active');
        }
    });
});

function showRetailerSelect(role) {
    const retailerSelect = document.getElementById('retailerSelect');
    retailerSelect.style.display = role === 'user' ? 'flex' : 'none';
}

// Add class Active to sidebar menu item
document.addEventListener('DOMContentLoaded', function (e) {
    e.preventDefault();
    const menu_item = document.querySelector('.sidebar-menu #user-management');
    menu_item.classList.add('active');
});


document.getElementById('payment-method').addEventListener('change', function () {
    var bankDetails = document.getElementById('bank-details');
    var upiDetails = document.getElementById('upi-details');
    var qrDetails = document.getElementById('qr-details');

    bankDetails.style.display = 'none';
    upiDetails.style.display = 'none';
    qrDetails.style.display = 'none';

    if (this.value === 'bank') {
        bankDetails.style.display = 'block';
    } else if (this.value === 'upi') {
        upiDetails.style.display = 'block';
    } else if (this.value === 'qr') {
        qrDetails.style.display = 'block';
    }
});