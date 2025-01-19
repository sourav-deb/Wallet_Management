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
            id: row.querySelector('td:nth-child(4)').textContent,
            depositedby: row.querySelector('td:nth-child(3)').textContent,
            phone: row.querySelector('td:nth-child(5)').textContent,
            amount: row.querySelector('td:nth-child(10)').textContent,
            deposited_to: row.querySelector('td:nth-child(6)').textContent,
            status: row.querySelector('.status-badge').textContent,
            user_type: row.dataset.userType
        };

        console.table(data);
        
        // Prefill modal fields with complete data
        document.getElementById('edit_id').value = data.id;
        document.getElementById('deposited_by').value = data.depositedby;
        document.getElementById('edit_phone').value = data.phone;
        document.getElementById('edit_status').value = data.status;
        document.getElementById('deposited_to').value = data.deposited_to;
        document.getElementById('amount').value = data.amount;

        // Show modal
        document.getElementById('editModal').style.display = 'block';
    });
});


// Close modal functionality
document.querySelector('.close').addEventListener('click', () => {
    document.getElementById('editModal').style.display = 'none';
});

// Add class Active to sidebar menu item
document.addEventListener('DOMContentLoaded', function (e) {
    e.preventDefault();
    const menu_item = document.querySelector('.sidebar-menu #bank_transfer');
    menu_item.classList.add('active');
});

// Close modal functionality
document.querySelector('.close-2').addEventListener('click', () => {
    document.getElementById('imageModal').style.display = 'none';
});

// Open View Image Modal
const modal = document.getElementById("imageModal");
const modalImg = document.getElementById("modalImage");
const span = document.getElementsByClassName("close")[0];

function openModal(imgSrc) {
    modal.style.display = "block";
    modalImg.src = imgSrc;
}

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showAlert('Copied!', 'success');
    }).catch(err => {
        showAlert('Failed to copy text', 'error');
        console.error('Failed to copy text: ', err);
    });
}

function showAlert(message, type = 'success') {
    // Create alert element
    const alert = document.createElement('div');
    alert.className = `custom-alert ${type}`;
    alert.innerHTML = `
        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    
    // Add to document
    document.body.appendChild(alert);
    
    // Trigger animation
    setTimeout(() => alert.classList.add('show'), 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        alert.classList.remove('show');
        setTimeout(() => alert.remove(), 300);
    }, 3000);
}