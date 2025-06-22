<?php
require "../config/Database.php";
session_start();

// Redirect if not logged in
if(!isset($_SESSION['adminusername'])) {
     echo '<script>window.location.href = "./auth/admin_register.php";</script>';
    exit();
}

// Handle logout
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./auth/admin_register.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | StudySelf</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-book-open-reader"></i>
            <span>StudySelf</span>
        </div>
        
        <div class="right">
         
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <div class="menu-slide">
        <div class="menu-list">
            <ul>
                <li class="active" data-section="dashboard">
                    <a href="#dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                </li>
                <li data-section="upload-notes">
                    <a href="#upload-notes"><i class="fa-solid fa-upload"></i> Upload Notes</a>
                </li>
                <li data-section="manage-notes">
                    <a href="#manage-notes"><i class="fa-solid fa-list-check"></i> Manage Notes</a>
                </li>
                <li data-section="users">
                    <a href="#users"><i class="fa-solid fa-users"></i> Users</a>
                </li>
                <li data-section="download-detail">
                    <a href="#download-detail"><i class="fa-solid fa-file-download"></i> Download Details</a>
                </li>
                <li data-section="downloads">
                    <a href="#downloads"><i class="fa-solid fa-download"></i> Downloads</a>
                </li>
                <li>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <button type="submit" name="logout" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <main>
        <div class="dashboard">
            <!-- Dashboard Overview -->
            <div id="dashboard" class="section active">
                <h1>Admin Dashboard</h1>
                <p class="welcome-message">Welcome back, <strong style="color:brown"><?php echo $_SESSION['adminusername']; ?></strong>!</p>
                
                <div class="stats-container">
                    <div class="stat-card users animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                        <div class="stat-value">1,245</div>
                        <div class="stat-label">Total Users</div>
                        
                    </div>
                    <div class="stat-card notes animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <div class="stat-value">568</div>
                        <div class="stat-label">Total Notes</div>
                    
                    </div>
                    <div class="stat-card downloads animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                        <div class="stat-value">3,784</div>
                        <div class="stat-label">Total Downloads</div>
                        
                    </div>
                    <div class="stat-card revenue animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <div class="stat-value">₹24,560</div>
                        <div class="stat-label">Total Revenue</div>
                        
                    </div>
                </div>
                
                
                
            </div>

            <!-- Upload Notes Section -->
            <div id="upload-notes" class="section">
                <div class="section-title">
                    <h2>Upload New Notes</h2>
                </div>
                <div class="form-container">
                    <form id="uploadForm">
                        <div class="form-group">
                            <label for="note-title" class="form-label">Note Title</label>
                            <input type="text" id="note-title" class="form-control" placeholder="Enter note title" required>
                        </div>
                        <div class="form-group">
                            <label for="note-category" class="form-label">Category</label>
                            <select id="note-category" class="form-control" required>
                                <option value="">Select category</option>
                                <option value="programming">Programming</option>
                                <option value="mathematics">Mathematics</option>
                                <option value="science">Science</option>
                                <option value="business">Business</option>
                                <option value="engineering">Engineering</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="note-description" class="form-label">Description</label>
                            <textarea id="note-description" class="form-control" placeholder="Enter note description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="note-file" class="form-label">Upload File</label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="note-file" class="form-control" required>
                                <div class="file-upload-preview"></div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="note-file" class="form-label">Upload Thumbnail</label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="note-file" class="form-control" required>
                                <div class="file-upload-preview"></div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="note-file" class="form-label">Demo picture 1</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="note-file" class="form-control" required>
                                    <div class="file-upload-preview"></div>
                                </div>

                           </div>
                            <div class="form-group">
                                <label for="note-file" class="form-label">Demo picture 2</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="note-file" class="form-control" required>
                                    <div class="file-upload-preview"></div>
                                </div>

                           </div>
                            <div class="form-group">
                                <label for="note-file" class="form-label">Demo picture 3</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="note-file" class="form-control" required>
                                    <div class="file-upload-preview"></div>
                                </div>

                           </div>
                        <div class="form-group">
                            <label for="note-price" class="form-label">Price (₹)</label>
                            <input type="number" id="note-price" class="form-control" placeholder="Enter price" min="0" step="1">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload Notes</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Manage Notes Section -->
            <div id="manage-notes" class="section">
                <div class="section-title">
                    <h2>Manage Notes</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search-notes" class="form-control" placeholder="Search notes...">
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Upload Date</th>

                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>101</td>
                                <td>Python Basics</td>
                                <td>Programming</td>
                                <td>2023-05-15</td>
                                
                                <td>99</td>
                                <td>
                                    <button class="action-btn view-btn">View</button>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>102</td>
                                <td>Calculus II</td>
                                <td>Mathematics</td>
                                <td>2023-06-02</td>
                                
                                <td>49</td>
                                <td>
                                    <button class="action-btn view-btn">View</button>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>103</td>
                                <td>Organic Chemistry</td>
                                <td>Science</td>
                                <td>2023-06-10</td>
                                
                                <td>199</td>
                                <td>
                                    <button class="action-btn view-btn">View</button>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>104</td>
                                <td>Financial Accounting</td>
                                <td>Business</td>
                                <td>2023-06-18</td>
                                <td>918</td>
                            
                                <td>
                                    <button class="action-btn view-btn">View</button>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>105</td>
                                <td>Data Structures</td>
                                <td>Programming</td>
                                <td>2023-06-20</td>
                            
                                <td>49</td>
                                <td>
                                    <button class="action-btn view-btn">View</button>
                                    <button class="action-btn edit-btn">Edit</button>
                                    <button class="action-btn delete-btn">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users Section -->
            <div id="users" class="section">
                <div class="section-title">
                    <h2>User Management</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search-users" class="form-control" placeholder="Search users...">
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Joined</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1001</td>
                                <td>user123</td>
                                <td>user123@example.com</td>
                                <td>2023-01-15</td>
                               
                            </tr>
                            <tr>
                                <td>1002</td>
                                <td>student456</td>
                                <td>student456@example.com</td>
                                <td>2023-02-20</td>
                               
                            </tr>
                            <tr>
                                <td>1003</td>
                                <td>learner789</td>
                                <td>learner789@example.com</td>
                                <td>2023-03-05</td>
                               
                            </tr>
                            <tr>
                                <td>1004</td>
                                <td>teacher101</td>
                                <td>teacher101@example.com</td>
                                <td>2023-04-12</td>
                              
                            </tr>
                            <tr>
                                <td>1005</td>
                                <td>banned_user</td>
                                <td>banned@example.com</td>
                                <td>2023-01-10</td>
                              
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- download details -->
            <div id="download-detail" class="section">
                <div class="section-title">
                    <h2>Download Details</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search-downloads" class="form-control" placeholder="Search downloads...">
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Subject Download</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1001</td>
                                <td>user123</td>
                                <td>user123@example.com</td>
                                <td>programing</td>
                                <td>
                                    7
                                </td>
                            </tr>
                            <tr>
                                <td>1002</td>
                                <td>student456</td>
                                <td>student456@example.com</td>
                                <td>Science</td>
                                <td>
                                    5
                                </td>
                            </tr>
                            <tr>
                                <td>1003</td>
                                <td>learner789</td>
                                <td>learner789@example.com</td>
                                <td>Mathematics</td>
                                <td>
                                   2
                                </td>
                            </tr>
                            <tr>
                                <td>1004</td>
                                <td>teacher101</td>
                                <td>teacher101@example.com</td>
                                <td>Programing</td>
                                <td>
                                    5
                                </td>
                            </tr>
                            <tr>
                                <td>1005</td>
                                <td>banned_user</td>
                                <td>banned@example.com</td>
                                <td>Science</td>
                                <td>
                                   3
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Downloads Section -->
            <div id="downloads" class="section">
                <div class="section-title">
                    <h2>Download Statistics</h2>
                    <div>
                        <select id="download-filter" class="form-control" style="display: inline-block; width: auto;">
                            <option value="all">All Time</option>
                            <option value="month">This Month</option>
                            <option value="week">This Week</option>
                            <option value="today">Today</option>
                        </select>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Note ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Downloads</th>
                                <th>Revenue</th>
                                <th>Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>101</td>
                                <td>Python Basics</td>
                                <td>Programming</td>
                                <td>245</td>
                                <td>₹2,450</td>
                                <td><i class="fas fa-arrow-up" style="color: var(--success);"></i> 12%</td>
                            </tr>
                            <tr>
                                <td>102</td>
                                <td>Calculus II</td>
                                <td>Mathematics</td>
                                <td>187</td>
                                <td>₹1,870</td>
                                <td><i class="fas fa-arrow-up" style="color: var(--success);"></i> 8%</td>
                            </tr>
                            <tr>
                                <td>103</td>
                                <td>Organic Chemistry</td>
                                <td>Science</td>
                                <td>132</td>
                                <td>₹1,320</td>
                                <td><i class="fas fa-arrow-down" style="color: var(--danger);"></i> 5%</td>
                            </tr>
                            <tr>
                                <td>104</td>
                                <td>Financial Accounting</td>
                                <td>Business</td>
                                <td>98</td>
                                <td>₹980</td>
                                <td><i class="fas fa-arrow-up" style="color: var(--success);"></i> 15%</td>
                            </tr>
                            <tr>
                                <td>105</td>
                                <td>Data Structures</td>
                                <td>Programming</td>
                                <td>76</td>
                                <td>₹760</td>
                                <td><i class="fas fa-arrow-down" style="color: var(--danger);"></i> 3%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="dark-mode-toggle" title="Toggle Dark Mode">
        <i class="fas fa-moon"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
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

      
    </script>
</body>
</html>