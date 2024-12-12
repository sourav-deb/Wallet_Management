// document.querySelector('.sidebar-toggle').addEventListener('click', function () {
//     document.querySelector('.sidebar').classList.toggle('collapsed');
//     document.querySelector('.main-content').classList.toggle('expanded');
// });

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

// assignedToSelect.addEventListener('change', function() {
//     const retailerDiv = document.querySelector('.retailer-select');
//     if (this.value == 'user') {
//         retailerDiv.style.display = 'flex';
//     } else {
//         retailerDiv.style.display = 'none';
//     }
// });

// ./process/assign_role.php


function assignRole(button) {
    alert('test');
    const form = button.closest('form');
    const errorMessage = form.querySelector('.error-message');
    const assignedTo = form.querySelector('select[name="assigned_to"]');
    const retailerSelect = form.querySelector('select[name="retailer"]');
    const userId = form.querySelector('input[name="user_id"]').value;
    
    // Reset error message
    errorMessage.textContent = '';
    
    // Validation for assigned_to
    if (!assignedTo.value || 
        assignedTo.value == '' || 
        assignedTo.value == 'Select role' || 
        assignedTo.selectedIndex == 0) {
        errorMessage.textContent = 'Please select a role';
        assignedTo.focus();
        return;
    }
    
    // Validation for retailer if retailer role is selected
    if (assignedTo.value == 'retailer') {
        if (!retailerSelect.value || 
            retailerSelect.value == '' || 
            retailerSelect.value == 'Select retailer' || 
            retailerSelect.selectedIndex == 0) {
            errorMessage.textContent = 'Please select a retailer';
            retailerSelect.focus();
            return;
        }
    }
    
    // Show loading state
    button.disabled = true;
    // button.classList.add('loading');
    // button.textContent = 'Assigning...';
    
    // Prepare data for submission
    const formData = new FormData();
    formData.append('user_id', userId);
    formData.append('assigned_to', assignedTo.value);
    if (assignedTo.value == 'retailer') {
        formData.append('retailer_id', retailerSelect.value);
    }
    console.log(formData);
    alert(formData);
    
    // Send AJAX request
    fetch('../../process/assign_role.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.success);
        if (data.success) {
            errorMessage.style.color = 'green';
            errorMessage.textContent = data.message;
            setTimeout(() => {
                // window.location.reload();
            }, 1500);
        } else {
            errorMessage.style.color = 'red';
            errorMessage.textContent = data.message || 'An error occurred';
        }
    })
    .catch(error => {
        alert(error);
        console.error('Error:', error);
        errorMessage.style.color = 'red';
        errorMessage.textContent = 'An error occurred. Please try again.';
    })
    .finally(() => {
        alert('finally');
        button.disabled = false;
        // button.classList.remove('loading');
        button.textContent = 'Assign Role';
    });
}