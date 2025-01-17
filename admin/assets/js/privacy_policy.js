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






tinymce.init({
    selector: '#policy-editor',
    height: 500,
    width: '100%',
    plugins: 'lists link table code',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link table | code',
    setup: function (editor) {
        editor.on('init', function () {
            editor.getContainer().style.width = '100%';
        });
    }
});


// Add class Active to sidebar menu item
document.addEventListener('DOMContentLoaded', function (e) {
    e.preventDefault();
    const menu_item = document.querySelector('.sidebar-menu #settings');
    menu_item.classList.add('active');
});