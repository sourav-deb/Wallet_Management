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


// Open Modal
document.querySelectorAll('.btn-action.edit').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const data = {
            id: row.querySelector('.user-id').textContent.split(': ')[1],
            name: row.querySelector('.customer-name').textContent,
            email: row.querySelector('td:nth-child(3)').textContent,
            phone: row.querySelector('td:nth-child(4)').textContent,
            parent: row.querySelector('td:nth-child(5)').textContent,
            cust_role: row.querySelector('td:nth-child(6)').textContent,
            comm_type: row.querySelector('td:nth-child(7)').textContent,
            comm_value: row.querySelector('td:nth-child(8)').textContent,
            wallet_balance: row.querySelector('td:nth-child(9)').textContent.replace('INR ', ''),
            created_at: row.querySelector('td:nth-child(10)').textContent,
            status: row.querySelector('.status-badge').textContent,
            user_type: row.dataset.userType
        };

        console.table(data);
        
        // Prefill modal fields with complete data
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_user_type').value = data.user_type;
        document.getElementById('edit_name').value = data.name;
        document.getElementById('edit_email').value = data.email;
        document.getElementById('edit_phone').value = data.phone;
        document.getElementById('edit_parent').value = data.parent;
        document.getElementById('edit_role').value = data.cust_role;
        document.getElementById('edit_comm_type').value = data.comm_type;
        document.getElementById('edit_comm_value').value = data.comm_value;
        document.getElementById('edit_wallet').value = data.wallet_balance;
        document.getElementById('edit_status').value = data.status;

        // Show modal
        document.getElementById('editModal').style.display = 'block';
    });
});

// Close modal functionality
// document.querySelector('.close').addEventListener('click', () => {
//     document.getElementById('editModal').style.display = 'none';
// });

// Update registration status
document.getElementById('registration_status').addEventListener('change', function() {
    fetch('./process/settings_process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'setting=registration_status&value=' + (this.checked ? '1' : '0')
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            console.log('Registration status updated');
            alert('Registration status updated');
        }
    })
    .catch(error => console.error('Error:', error));
});


document.addEventListener('DOMContentLoaded', function () {
    const currentPath = window.location.pathname.split('/').pop();
    console.log('Current Path:', currentPath);
    document.querySelectorAll('.sidebar-menu a').forEach(link => {
        const linkPath = link.getAttribute('href').split('/').pop();
        console.log('Link Path:', linkPath);
        if (linkPath === currentPath) {
            link.parentElement.classList.add('active');
        } else {
            link.parentElement.classList.remove('active');
        }
    });
});

// Add class Active to sidebar menu item
document.addEventListener('DOMContentLoaded', function (e) {
    e.preventDefault();
    const menu_item = document.querySelector('.sidebar-menu #settings');
    menu_item.classList.add('active');
});