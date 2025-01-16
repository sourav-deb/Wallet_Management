
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

// Add this to your existing script section
// $(document).ready(function() {
//     // Optional: Initialize tooltip
//     $('[data-toggle="tooltip"]').tooltip();

//     // Optional: Handle notification click
//     $('.notification-item').click(function() {
//         // Handle notification click (e.g., mark as read, navigate to related page)
//         $(this).css('opacity', '0.7');
//     });

//     // Optional: Handle "Mark All as Read"
//     $('.mark-all-read').click(function() {
//         $('.notification-item').css('opacity', '0.7');
//     });
// });


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


// Render retailer to select if retailer is selected
// document.addEventListener('DOMContentLoaded', function() {
//     const assignedToSelect = document.getElementById('assigned_to');
//     const retailerDiv = document.querySelector('.retailer-select');

//     assignedToSelect.addEventListener('change', function() {
//         if (this.value === 'user') {
//             retailerDiv.style.display = 'flex';
//         } else {
//             retailerDiv.style.display = 'none';
//             document.getElementById('retailer').value = ''; // Reset retailer selection
//         }
//     });
// });

// Render retailer to select if retailer is selected
const assignedToSelect = document.querySelectorAll('#assigned_to');
assignedToSelect.forEach(select => {
    select.addEventListener('change', function () {
        const parentForm = this.closest('form');
        const retailerDiv = parentForm.querySelector('.retailer-select');
        if (this.value == 'user') {
            retailerDiv.style.display = 'flex';
        } else {
            retailerDiv.style.display = 'none';
        }
    });
});


// ./process/assign_role.php

// Add class Active to sidebar menu item
document.addEventListener('DOMContentLoaded', function (e) {
    e.preventDefault();
    const menu_item = document.querySelector('.sidebar-menu #bank_transfer');
    menu_item.classList.add('active');
});

// Open Modal
document.querySelectorAll('.btn-action.edit').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const data = {
            id: row.querySelector('td:nth-child(1)').textContent,
            accountNo: row.querySelector('td:nth-child(3)').textContent,
            amount: row.querySelector('td:nth-child(5)').textContent,
            
        };

        console.table(data);
        
        // Prefill modal fields with complete data
        document.getElementById('update_id').value = data.id;
        document.getElementById('wd_amount').value = data.amount;

        // Show modal
        document.getElementById('editModal').style.display = 'block';
    });
});


// Close modal functionality
document.querySelector('.close').addEventListener('click', () => {
    document.getElementById('editModal').style.display = 'none';
});