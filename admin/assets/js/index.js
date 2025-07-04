document.addEventListener('DOMContentLoaded', function() {
    // Menu toggle functionality
    const menuToggle = document.querySelector('.menu-toggle');
    const menuSlide = document.querySelector('.menu-slide');
    
    menuToggle.addEventListener('click', function() {
        menuSlide.classList.toggle('active');
    });
    
    // Section switching
    const menuItems = document.querySelectorAll('.menu-list li[data-section]');
    
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all sections and menu items
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            
            document.querySelectorAll('.menu-list li').forEach(li => {
                li.classList.remove('active');
            });
            
            // Add active class to clicked item and corresponding section
            const sectionId = this.getAttribute('data-section');
            this.classList.add('active');
            document.getElementById(sectionId).classList.add('active');
            
            // Close menu on mobile
            if (window.innerWidth < 992) {
                menuSlide.classList.remove('active');
            }
        });
    });
    
    // Search functionality
    const searchNotes = document.getElementById('search-notes');
    if (searchNotes) {
        searchNotes.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#manage-notes tbody tr');
            
            rows.forEach(row => {
                const title = row.querySelector('.title').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Search users functionality
    const searchUsers = document.getElementById('search-users');
    if (searchUsers) {
        searchUsers.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#users tbody tr');
            
            rows.forEach(row => {
                const username = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();
                if (username.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Search downloads functionality
    const searchDownloads = document.getElementById('search-downloads');
    if (searchDownloads) {
        searchDownloads.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#download-detail tbody tr');
            
            rows.forEach(row => {
                const username = row.cells[1].textContent.toLowerCase();
                const subject = row.cells[3].textContent.toLowerCase();
                if (username.includes(searchTerm) || subject.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Form submission handling
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // You can add form validation here if needed
        });
    });
    
    // Dark mode toggle (placeholder - you can implement actual dark mode)
    const darkModeToggle = document.createElement('button');
    darkModeToggle.className = 'dark-mode-toggle';
    darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
    document.body.appendChild(darkModeToggle);
    
    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        const icon = this.querySelector('i');
        if (document.body.classList.contains('dark-mode')) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    });
    
    // Add dark mode styles
    const style = document.createElement('style');
    style.textContent = `
        body.dark-mode {
            --primary: #046178;
            --secondary: #f5a623;
            --accent: #014a5c;
            --success: #27ae60;
            --danger: #e74c3c;
            --bg: #1a1a1a;
            --card-bg: #2d2d2d;
            --text-primary: #f5f5f5;
            --text-secondary: #b0b0b0;
            --border: #444;
        }
        
        body.dark-mode header {
            background-color: var(--accent);
        }
        
        body.dark-mode .stat-card {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        body.dark-mode .table-container {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
    `;
    document.head.appendChild(style);
});
