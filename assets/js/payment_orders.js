document.querySelector('.sidebar-toggle').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('collapsed');
    document.querySelector('.main-content').classList.toggle('expanded');
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

// Add this to your existing script section
$(document).ready(function() {
    // Optional: Initialize tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // Optional: Handle notification click
    $('.notification-item').click(function() {
        // Handle notification click (e.g., mark as read, navigate to related page)
        $(this).css('opacity', '0.7');
    });
    
    // Optional: Handle "Mark All as Read"
    $('.mark-all-read').click(function() {
        $('.notification-item').css('opacity', '0.7');
    });
});

                        
document.querySelectorAll('.expand-details').forEach(icon => {
    icon.addEventListener('click', function() {
        // Toggle the arrow icon
        this.classList.toggle('active');
        
        // Toggle the expanded row
        const expandableRow = this.closest('tr').nextElementSibling;
        expandableRow.classList.toggle('active');
    });
});

// Mobile menu toggle

