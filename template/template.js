// Desktop sidebar toggle
document.querySelector('.sidebar-toggle').addEventListener('click', function(e) {
    e.stopPropagation();
    if (window.innerWidth > 768) { // Only for desktop
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
        
        // Toggle icon rotation
        this.style.transform = sidebar.classList.contains('collapsed') ? 'rotate(180deg)' : 'rotate(0)';
        
        // Toggle main content margin
        const mainContent = document.querySelector('.content-wrapper');
        mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '0px' : '0px';
    }
});

// // Handle submenu visibility when sidebar is collapsed (desktop only)
// document.querySelectorAll('.sidebar-menu > li').forEach(item => {
//     item.addEventListener('mouseenter', function() {
//         if (window.innerWidth > 768 && document.querySelector('.sidebar').classList.contains('collapsed')) {
//             const submenu = this.querySelector('.submenu');
//             if (submenu) {
//                 submenu.style.display = 'block';
//                 submenu.style.position = 'absolute';
//                 submenu.style.left = '70px';
//                 submenu.style.top = this.offsetTop + 'px';
//                 submenu.style.minWidth = '200px';
//             }
//         }
//     });
    
//     item.addEventListener('mouseleave', function() {
//         if (window.innerWidth > 768) {
//             const submenu = this.querySelector('.submenu');
//             if (submenu) {
//                 submenu.style.display = '';
//                 submenu.style.position = '';
//                 submenu.style.left = '';
//                 submenu.style.top = '';
//             }
//         }
//     });
// });

// // Mobile submenu handling
// document.querySelectorAll('.menu-item').forEach(item => {
//     item.addEventListener('click', (e) => {
//         if (e.currentTarget.nextElementSibling && e.currentTarget.nextElementSibling.classList.contains('submenu')) {
//             e.preventDefault();
//             const parent = e.currentTarget.parentElement;

//             // Close other open submenus
//             document.querySelectorAll('.sidebar-menu > li').forEach(li => {
//                 if (li !== parent && li.classList.contains('active')) {
//                     li.classList.remove('active');
//                 }
//             });

//             // Toggle current submenu
//             parent.classList.toggle('active');
//         }
//     });
// });


// Handle submenu visibility for both desktop and mobile
document.querySelectorAll('.sidebar-menu > li').forEach(item => {
    // Desktop hover handling
    item.addEventListener('mouseenter', function() {
        if (window.innerWidth > 768 && document.querySelector('.sidebar').classList.contains('collapsed')) {
            const submenu = this.querySelector('.submenu');
            if (submenu) {
                submenu.style.display = 'block';
                submenu.style.position = 'absolute';
                submenu.style.left = '70px';
                submenu.style.top = this.offsetTop + 'px';
                submenu.style.minWidth = '200px';
            }
        }
    });
    
    item.addEventListener('mouseleave', function() {
        if (window.innerWidth > 768) {
            const submenu = this.querySelector('.submenu');
            if (submenu) {
                submenu.style.display = '';
                submenu.style.position = '';
                submenu.style.left = '';
                submenu.style.top = '';
            }
        }
    });

    // Mobile click handling
    const menuItem = item.querySelector('.menu-item');
    if (menuItem) {
        menuItem.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (menuItem.nextElementSibling && menuItem.nextElementSibling.classList.contains('submenu')) {
                    e.preventDefault();
                    item.classList.toggle('active');
                }
            }
        });
    }
});



// Keep your existing mobile menu code below this

// Mobile nav toggle - open
document.querySelector('.mobile-toggle').addEventListener('click', function(e) {
    e.stopPropagation(); // Prevent event bubbling
    const sidebar = document.querySelector('.sidebar');
    
    // Create and add overlay if it doesn't exist
    if (!document.querySelector('.sidebar-overlay')) {
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
    }
    
    // Show sidebar and overlay
    sidebar.classList.add('mobile-active');
    document.querySelector('.sidebar-overlay').classList.add('active');
    document.body.classList.add('nav-open');
});

// Mobile nav toggle - close
function closeNav() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    
    if (sidebar.classList.contains('mobile-active')) {
        sidebar.classList.remove('mobile-active');
        if (overlay) {
            overlay.classList.remove('active');
        }
        document.body.classList.remove('nav-open');
    }
}

// Close button click handler
document.querySelector('.mobile-close').addEventListener('click', function(e) {
    e.stopPropagation();
    closeNav();
});

// Overlay click handler
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('sidebar-overlay')) {
        closeNav();
    }
});

// Mobile submenu handling
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            const submenu = this.nextElementSibling;
            if (submenu && submenu.classList.contains('submenu')) {
                e.preventDefault();
                e.stopPropagation();
                const parent = this.parentElement;
                parent.classList.toggle('active');
            }
        }
    });
});