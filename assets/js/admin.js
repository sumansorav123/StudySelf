
     // Toggle sidebar on mobile
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.menu-slide').classList.toggle('active');
            document.querySelector('main').classList.toggle('expanded');
        });

        // Navigation between sections
        document.querySelectorAll('.menu-list li').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all menu items
                document.querySelectorAll('.menu-list li').forEach(li => {
                    li.classList.remove('active');
                });
                
                // Add active class to clicked menu item
                this.classList.add('active');
                
                const targetId = this.getAttribute('data-section');
                
                // Hide all sections
                document.querySelectorAll('.section').forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show target section with animation
                const targetSection = document.getElementById(targetId);
                targetSection.classList.add('active');
                targetSection.style.animation = 'fadeIn 0.5s ease';
                
                // Close sidebar on mobile
                if (window.innerWidth < 992) {
                    document.querySelector('.menu-slide').classList.remove('active');
                    document.querySelector('main').classList.remove('expanded');
                }
            });
        });

        // Show dashboard by default
        document.getElementById('dashboard').classList.add('active');

        // Form submission handlers
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
            submitBtn.disabled = true;
            
            // Simulate upload delay
            setTimeout(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                
                // Show success notification
                showNotification('Notes uploaded successfully!', 'success');
                
                // Reset form
                this.reset();
            }, 2000);
        });

        // Action buttons with confirmation
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this item?')) {
                    const row = this.closest('tr');
                    row.style.animation = 'fadeOut 0.3s ease';
                    setTimeout(() => {
                        row.remove();
                        showNotification('Item deleted successfully!', 'success');
                    }, 300);
                }
            });
        });

        // Search functionality
        document.getElementById('search-notes').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#manage-notes tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('search-users').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#users tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Filter functionality
        document.getElementById('download-filter').addEventListener('change', function() {
            const filterValue = this.value;
            // In a real app, you would fetch filtered data from the server
            showNotification(`Filter changed to: ${filterValue}`, 'info');
        });

        // Dark mode toggle
        document.querySelector('.dark-mode-toggle').addEventListener('click', function() {
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

        // Notification system
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification-${type}`;
            notification.textContent = message;
            notification.style.position = 'fixed';
            notification.style.bottom = '20px';
            notification.style.right = '20px';
            notification.style.padding = '15px 20px';
            notification.style.backgroundColor = type === 'success' ? 'var(--success)' : 
                                              type === 'error' ? 'var(--danger)' : 'var(--primary)';
            notification.style.color = 'white';
            notification.style.borderRadius = '5px';
            notification.style.boxShadow = 'var(--shadow-lg)';
            notification.style.zIndex = '1000';
            notification.style.animation = 'fadeIn 0.3s ease';
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'fadeOut 0.3s ease';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

      