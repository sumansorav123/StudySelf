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
 // Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file_path'])) {
    // Get input data
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $category_id = intval($_POST['category_id']);
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.00;

    // Upload directories
    $noteDir = "uploads/notes/";
    $thumbDir = "uploads/thumbnails/";
    $demoDir = "uploads/demos/";

    // Create directories if not exist
    if (!is_dir($noteDir)) mkdir($noteDir, 0777, true);
    if (!is_dir($thumbDir)) mkdir($thumbDir, 0777, true);
    if (!is_dir($demoDir)) mkdir($demoDir, 0777, true);

    // Handle uploads
    $file_path = $noteDir . basename($_FILES['file_path']['name']);
    $thumbnail_path = $thumbDir . basename($_FILES['thumbnail_path']['name']);
    $demo1_path = $demoDir . basename($_FILES['demo1_path']['name']);
    $demo2_path = $demoDir . basename($_FILES['demo2_path']['name']);
    $demo3_path = $demoDir . basename($_FILES['demo3_path']['name']);

    // Move uploaded files
    move_uploaded_file($_FILES['file_path']['tmp_name'], $file_path);
    move_uploaded_file($_FILES['thumbnail_path']['tmp_name'], $thumbnail_path);
    move_uploaded_file($_FILES['demo1_path']['tmp_name'], $demo1_path);
    move_uploaded_file($_FILES['demo2_path']['tmp_name'], $demo2_path);
    move_uploaded_file($_FILES['demo3_path']['tmp_name'], $demo3_path);

    // Insert into DB
    $stmt = $connection->prepare("INSERT INTO notes 
        (title, category_id, description, file_path, thumbnail_path, demo1_path, demo2_path, demo3_path, price) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssssd", $title, $category_id, $description, $file_path, $thumbnail_path, $demo1_path, $demo2_path, $demo3_path, $price);

   if ($stmt->execute()) {
    echo '<script>alert("Note uploaded successfully!");</script>';
    header("Location: ../admin/admin.php");
    $stmt->close();
    exit();
} else {
    echo '<script>alert("Error uploading note: ' . $stmt->error . '");</script>';
    header("Location: ../admin/admin.php");
    $stmt->close();
    exit();
}

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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<style>
 
</style>
<body>
    <header>
        <div class="logo">
            <i class="fas fa-book-open-reader" style="color:orange;"></i>
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
                    <a href="#download-detail"><i class="fa-solid fa-file-download"></i> Purchase Details</a>
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
                        <div class="stat-value">
                            <?php
                                $sql = "SELECT COUNT(*) AS total_users FROM userdetails";
                                $userc = mysqli_query($connection, $sql);

                                if ($userc && $row = mysqli_fetch_assoc($userc)) {
                                    echo $row['total_users'];
                                } else {
                                    echo "Error fetching data.";
                                }
                            ?>
                        </div>
                        <div class="stat-label">Total Users</div>
                        
                    </div>
                    <div class="stat-card notes animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <div class="stat-value">
                             <?php
                                $sql = "SELECT COUNT(*) AS total_users FROM notes";
                                $notesc = mysqli_query($connection, $sql);

                                if ($notesc && $row = mysqli_fetch_assoc($notesc)) {
                                    echo $row['total_users'];
                                } else {
                                    echo "Error fetching data.";
                                }
                            ?>
                        </div>
                        <div class="stat-label">Total Notes</div>
                    
                    </div>
                    <div class="stat-card downloads animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Total Purchase</div>
                        
                    </div>
                    <div class="stat-card revenue animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <div class="stat-value">₹0</div>
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
                    <!-- Upload Notes Form -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="text" name="title" placeholder="Enter note title" required><br>
                            <label for="note-category">Category:</label>
                            <select id="note-category" name="category_id" required>
                                <option value="">Select category</option>
                                <option value="1">Programming</option>
                                <option value="2">Mathematics</option>
                                <option value="3">Science</option>
                                <option value="4">Business</option>
                                <option value="5">Engineering</option>
                            </select><br>
<<<<<<< HEAD
                            <textarea name="description" placeholder="Enter note description" maxlength="100" required></textarea><br>
=======
                            <textarea name="description" placeholder="Enter note description" required></textarea><br>
>>>>>>> 38f4abb1611297834920d6d920bf3e3bc42f656e
                            <input type="file" name="file_path" accept=".pdf,.docx,.pptx" required><br>
                            <input type="file" name="thumbnail_path" accept="image/*" required><br>
                            <input type="file" name="demo1_path" accept="image/*" required><br>
                            <input type="file" name="demo2_path" accept="image/*" required><br>
                            <input type="file" name="demo3_path" accept="image/*" required><br>
                            <input type="number" name="price" step="0.01" placeholder="Enter price (optional)"><br>
                            <input type="submit" value="Upload Note">
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
                    <?php
                        $notes_result = $connection->query("SELECT * FROM notes ORDER BY uploaded_at DESC");
                        if ($notes_result->num_rows > 0) {
                    ?>
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
            <?php
            while ($row = $notes_result->fetch_assoc()) {
                $note_id = htmlspecialchars($row['id']);
                $title = htmlspecialchars($row['title']);
                $price = htmlspecialchars($row['price']);
                $uploaded_at = htmlspecialchars($row['uploaded_at']);
                $category_id = htmlspecialchars($row['category_id']);

                // Fetch category name
                $category_name = "Unknown Category";
                $category_query = $connection->query("SELECT name FROM categories WHERE id = $category_id");
                if ($category_query && $category_query->num_rows > 0) {
                    $category_row = $category_query->fetch_assoc();
                    $category_name = htmlspecialchars($category_row['name']);
                }
            ?>
                <tr>
                    <td><?php echo $note_id; ?></td>
                    <td><?php echo $title; ?></td>
                    <td class="title"><?php echo $category_name; ?></td>
                    <td><?php echo $uploaded_at; ?></td>
                    <td><?php echo $price ? '₹' . number_format($price, 2) : 'Free'; ?></td>
                    <td>
                        
                        <button class="action-btn edit-btn">Edit</button>
                        <button class="action-btn delete-btn">Delete</button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "<p>There are no posts uploaded yet.</p>";
}
?>
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
                    <?PHP
                        $user_data = $connection->query("SELECT * FROM userdetails ORDER BY id DESC");
                        if ($user_data->num_rows > 0) {
                       ?>
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
                            <?php
                             while ($rows = $user_data->fetch_assoc()) {
                            $user_id = htmlspecialchars($rows["id"]);
                            $user_name = htmlspecialchars($rows["name"]);
                            $user_email = htmlspecialchars($rows["email"]);
                            $created_at = htmlspecialchars($rows["created_at"]);
                        ?>
                            <tr>
                                <td>
                                    <?php echo $user_id;?>
                                </td>
                                <td>
                                    <?php echo $user_name;?>
                                </td>
                                <td>
                                    <?php echo $user_email;?>
                                </td>
                                <td>
                                    <?php echo $created_at;?>
                                </td>                               
                            </tr>
                        <?php  
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    } else {
                            echo "<p>There are no posts uploaded yet.</p>";
                        }
                    ?>
                </div>
            </div>

            <!-- download details -->
            <div id="download-detail" class="section">
                <div class="section-title">
                    <h2>Purchase Details</h2>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
<<<<<<< HEAD
    <script src="./assets/js/index.js"></script>
=======

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
        // document.getElementById('dashboard').classList.add('active');

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
>>>>>>> 38f4abb1611297834920d6d920bf3e3bc42f656e
</body>
</html>