<?php
require "../config/Database.php";
session_start();



// Redirect if not logged in
if (!isset($_SESSION['adminusername'])) {
    header("Location: ./auth/admin_register.php");
    exit();
}

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle logout
if (isset($_POST['logout'])) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['errors'] = ["Invalid CSRF token"];
        header("Location: admin.php");
        exit();
    }
    
    session_unset();
    session_destroy();
    header("Location: ./auth/admin_register.php");
    exit(); 
}

// Handle delete
if (isset($_POST['id']) && $_POST['id'] > 0) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['errors'] = ["Invalid CSRF token"];
        header("Location: admin.php");
        exit();
    }

    $id = intval($_POST['id']);
    
    // First get file paths to delete them
    $getFilesQuery = "SELECT file_path, demo_path, thumbnail_path, demo1_path, demo2_path, demo3_path FROM notes WHERE id = ?";
    $stmt = $connection->prepare($getFilesQuery);
    if (!$stmt) {
        $_SESSION['errors'] = ["Database error: " . $connection->error];
        header("Location: admin.php");
        exit();
    }
    
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        $_SESSION['errors'] = ["Error fetching files: " . $stmt->error];
        $stmt->close();
        header("Location: admin.php");
        exit();
    }
    
    $result = $stmt->get_result();
    $files = $result->fetch_assoc();
    $stmt->close();
    
    // Delete files from server
    if ($files) {
        foreach ($files as $filePath) {
            if ($filePath && file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
    
    // Delete from database
    $delquery = "DELETE FROM notes WHERE id = ?";
    $stmt = $connection->prepare($delquery);
    if (!$stmt) {
        $_SESSION['errors'] = ["Database error: " . $connection->error];
        header("Location: admin.php");
        exit();
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Record deleted successfully";
    } else {
        $_SESSION['errors'] = ["Error deleting record: " . $stmt->error];
    }
    $stmt->close();
    header("Location: admin.php");
    exit();
}

// Initialize variables
$notes_data = [];
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['logout']) && !isset($_POST['id'])) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['errors'] = ["Invalid CSRF token"];
        header("Location: admin.php");
        exit();
    }

    // Get input data with proper validation
    $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
    $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.00;
    $isUpdate = isset($_POST['note_id']) && $_POST['note_id'] > 0;

    // Validate required fields
    if (empty($title) || empty($description) || $category_id <= 0) {
        $_SESSION['errors'] = ["Please fill all required fields"];
        header("Location: admin.php");
        exit();
    }

    // Validate price
    if ($price < 0) {
        $_SESSION['errors'] = ["Price cannot be negative"];
        header("Location: admin.php");
        exit();
    }

    // File upload validation
    $allowedTypes = [
        'file_path' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'],
        'demo_path' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'],
        'thumbnail_path' => ['image/jpeg', 'image/png', 'image/gif'],
        'demo1_path' => ['image/jpeg', 'image/png', 'image/gif'],
        'demo2_path' => ['image/jpeg', 'image/png', 'image/gif'],
        'demo3_path' => ['image/jpeg', 'image/png', 'image/gif']
    ];

    $allowedExtensions = [
        'file_path' => ['pdf', 'doc', 'docx', 'ppt', 'pptx'],
        'demo_path' => ['pdf', 'doc', 'docx', 'ppt', 'pptx'],
        'thumbnail_path' => ['jpg', 'jpeg', 'png', 'gif'],
        'demo1_path' => ['jpg', 'jpeg', 'png', 'gif'],
        'demo2_path' => ['jpg', 'jpeg', 'png', 'gif'],
        'demo3_path' => ['jpg', 'jpeg', 'png', 'gif']
    ];

    $maxFileSize = 10 * 1024 * 1024; // 10MB
    $upload_errors = [];
    $filePaths = [];

    // Upload directories
    $noteDir = "uploads/notes/";
    $demoDir = "uploads/demofile/";
    $thumbDir = "uploads/thumbnails/";
    $demoImgDir = "uploads/demos/";

    // Create directories if not exist
    if (!is_dir($noteDir)) mkdir($noteDir, 0777, true);
    if (!is_dir($demoDir)) mkdir($demoDir, 0777, true);
    if (!is_dir($thumbDir)) mkdir($thumbDir, 0777, true);
    if (!is_dir($demoImgDir)) mkdir($demoImgDir, 0777, true);

    // Process file uploads
    foreach (['file_path', 'demo_path', 'thumbnail_path', 'demo1_path', 'demo2_path', 'demo3_path'] as $file) {
        if (!empty($_FILES[$file]['name'])) {
            // Validate file size
            if ($_FILES[$file]['size'] > $maxFileSize) {
                $upload_errors[] = "File $file is too large (max 10MB)";
                continue;
            }

            // Validate file type
            $fileType = mime_content_type($_FILES[$file]['tmp_name']);
            if (!in_array($fileType, $allowedTypes[$file])) {
                $upload_errors[] = "Invalid file type for $file. Allowed: " . implode(', ', $allowedTypes[$file]);
                continue;
            }

            // Validate file extension
            $extension = strtolower(pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions[$file])) {
                $upload_errors[] = "Invalid file extension for $file. Allowed: " . implode(', ', $allowedExtensions[$file]);
                continue;
            }

            // Generate unique filename
            $filename = uniqid() . '.' . $extension;
            
            // Determine target directory
            $targetDir = ($file === 'file_path') ? $noteDir : 
                        ($file === 'demo_path' ? $demoDir : 
                        ($file === 'thumbnail_path' ? $thumbDir : $demoImgDir));
            
            $targetPath = $targetDir . $filename;

            if (move_uploaded_file($_FILES[$file]['tmp_name'], $targetPath)) {
                $filePaths[$file] = $targetPath;
                
                // Delete old file if updating
                if ($isUpdate && !empty($_POST['existing_' . $file]) && file_exists($_POST['existing_' . $file])) {
                    unlink($_POST['existing_' . $file]);
                }
            } else {
                $upload_errors[] = "Failed to upload $file";
            }
        } elseif ($isUpdate) {
            // Keep existing file if not updating
            $filePaths[$file] = $_POST['existing_' . $file];
        } elseif (!$isUpdate && in_array($file, ['file_path', 'demo_path', 'thumbnail_path'])) {
            // Required files for new uploads
            $upload_errors[] = "$file is required for new uploads";
        }
    }

    if (empty($upload_errors)) {
        if ($isUpdate) {
            // Update existing note
            $stmt = $connection->prepare("UPDATE notes SET title=?, category_id=?, description=?, file_path=?, demo_path=?, thumbnail_path=?, demo1_path=?, demo2_path=?, demo3_path=?, price=? WHERE id=?");
            if (!$stmt) {
                $_SESSION['errors'] = ["Database error: " . $connection->error];
                header("Location: admin.php");
                exit();
            }
            
            $stmt->bind_param("sisssssssdi", $title, $category_id, $description, 
                $filePaths['file_path'], $filePaths['demo_path'], $filePaths['thumbnail_path'], 
                $filePaths['demo1_path'], $filePaths['demo2_path'], 
                $filePaths['demo3_path'], $price, $_POST['note_id']);
        } else {
            // Insert new note
            $stmt = $connection->prepare("INSERT INTO notes (title, category_id, description, file_path, demo_path, thumbnail_path, demo1_path, demo2_path, demo3_path, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                $_SESSION['errors'] = ["Database error: " . $connection->error];
                header("Location: admin.php");
                exit();
            }
            
            $stmt->bind_param("sisssssssd", $title, $category_id, $description, 
                $filePaths['file_path'], $filePaths['demo_path'], $filePaths['thumbnail_path'], 
                $filePaths['demo1_path'], $filePaths['demo2_path'], 
                $filePaths['demo3_path'], $price);
        }

        if ($stmt->execute()) {
            $_SESSION['message'] = $isUpdate ? "Note updated successfully!" : "Note uploaded successfully!";
        } else {
            $_SESSION['errors'] = ["Database error: " . $stmt->error];
            
            // Clean up uploaded files if database operation failed
            if (!$isUpdate) {
                foreach ($filePaths as $path) {
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
        }
        $stmt->close();
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION['errors'] = $upload_errors;
        header("Location: admin.php");
        exit();
    }
}

// Fetch note data for editing if ID is provided
if ($id > 0) {
    $sql = "SELECT * FROM notes WHERE id = ?";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        $_SESSION['errors'] = ["Database error: " . $connection->error];
        header("Location: admin.php");
        exit();
    }
    
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        $_SESSION['errors'] = ["Error fetching note: " . $stmt->error];
        $stmt->close();
        header("Location: admin.php");
        exit();
    }
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $notes_data = $result->fetch_assoc();
    } else {
        $_SESSION['errors'] = ["No notes found with this ID"];
        header("Location: admin.php");
        exit();
    }
    $stmt->close();
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
                    <a href="#upload-notes"><i class="fa-solid fa-upload"></i> <?php echo $id ? 'Edit' : 'Upload'; ?> Notes</a>
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
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
                <p class="welcome-message">Welcome back, <strong style="color:brown"><?php echo htmlspecialchars($_SESSION['adminusername']); ?></strong>!</p>
                
                <!-- Display messages/errors -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="notification-success"><?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?></div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="notification-error">
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['errors']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="stats-container">
                    <div class="stat-card users animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                        <div class="stat-value">
                            <?php
                                $sql = "SELECT COUNT(*) AS total_users FROM userdetails";
                                $userc = $connection->query($sql);
                                echo $userc ? htmlspecialchars($userc->fetch_assoc()['total_users']) : "Error";
                            ?>
                        </div>
                        <div class="stat-label">Total Users</div>
                    </div>
                    <div class="stat-card notes animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <div class="stat-value">
                            <?php
                                $sql = "SELECT COUNT(*) AS total_notes FROM notes";
                                $notesc = $connection->query($sql);
                                echo $notesc ? htmlspecialchars($notesc->fetch_assoc()['total_notes']) : "Error";
                            ?>
                        </div>
                        <div class="stat-label">Total Notes</div>
                    </div>
                    <div class="stat-card downloads animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                          <div class="stat-value">
                            <?php
                                $sql = "SELECT COUNT(*) AS total_purchase FROM enrolled";
                                $notesc = $connection->query($sql);
                                echo $notesc ? htmlspecialchars($notesc->fetch_assoc()['total_purchase']) : "Error";
                            ?>
                        </div>
                        <div class="stat-label">Total Purchase</div>
                    </div>
                    <div class="stat-card revenue animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <div class="stat-value">₹0</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>
                </div>
            </div>

            <!-- Upload/Edit Notes Section -->
            <div id="upload-notes" class="section">
                <div class="section-title">
                    <h2><?php echo $id ? 'Edit' : 'Upload'; ?> Notes</h2>
                </div>
                <div class="form-container">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <?php if ($id): ?>
                            <input type="hidden" name="note_id" value="<?php echo htmlspecialchars($id); ?>">
                        <?php endif; ?>
                        
                        <input type="text" name="title" placeholder="Enter note title" 
                               value="<?php echo $id ? htmlspecialchars($notes_data['title']) : ''; ?>" required><br>
                        
                        <label for="note-category">Category:</label>
                        <select id="note-category" name="category_id" required>
                            <option value="">Select category</option>
                            <?php
                            $categories = $connection->query("SELECT * FROM categories");
                            if ($categories) {
                                while ($cat = $categories->fetch_assoc()):
                                    $selected = ($id && $notes_data['category_id'] == $cat['id']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo htmlspecialchars($cat['id']); ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php 
                                endwhile;
                            }
                            ?>
                        </select><br>

                        <textarea name="description" placeholder="Enter note description" required><?php 
                            echo $id ? htmlspecialchars($notes_data['description']) : ''; 
                        ?></textarea><br>

                        <!-- Main File -->
                        <label>Note File (PDF/DOCX/PPTX):</label>
                        <input type="file" name="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx" <?php echo !$id ? 'required' : ''; ?>><br>
                        <?php if ($id): ?>
                            <p>Current file: <?php echo htmlspecialchars(basename($notes_data['file_path'])); ?></p>
                            <input type="hidden" name="existing_file_path" value="<?php echo htmlspecialchars($notes_data['file_path']); ?>">
                        <?php endif; ?>

                       <!-- Demo File -->
                        <label>Demo File (PDF/DOCX/PPTX):</label>
                        <input type="file" name="demo_path" accept=".pdf,.doc,.docx,.ppt,.pptx" <?php echo !$id ? 'required' : ''; ?>><br>
                        <?php if ($id): ?>
                            <p>Current file: <?php echo htmlspecialchars(basename($notes_data['demo_path'])); ?></p>
                            <input type="hidden" name="existing_demo_path" value="<?php echo htmlspecialchars($notes_data['demo_path']); ?>">
                        <?php endif; ?>

                        <!-- Thumbnail -->
                        <label>Thumbnail Image:</label>
                        <input type="file" name="thumbnail_path" accept="image/*" <?php echo !$id ? 'required' : ''; ?>><br>
                        <?php if ($id): ?>
                            <p>Current thumbnail: <?php echo htmlspecialchars(basename($notes_data['thumbnail_path'])); ?></p>
                            <input type="hidden" name="existing_thumbnail_path" value="<?php echo htmlspecialchars($notes_data['thumbnail_path']); ?>">
                        <?php endif; ?>

                        <!-- Demo Images -->
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                            <label>Demo Image <?php echo $i; ?>:</label>
                            <input type="file" name="demo<?php echo $i; ?>_path" accept="image/*"><br>
                            <?php if ($id && !empty($notes_data["demo{$i}_path"])): ?>
                                <p>Current demo <?php echo $i; ?>: <?php echo htmlspecialchars(basename($notes_data["demo{$i}_path"])); ?></p>
                                <input type="hidden" name="existing_demo<?php echo $i; ?>_path" value="<?php echo htmlspecialchars($notes_data["demo{$i}_path"]); ?>">
                            <?php endif; ?>
                        <?php endfor; ?>

                        <input type="number" name="price" step="0.01" min="0" placeholder="Enter price" 
                               value="<?php echo $id ? htmlspecialchars($notes_data['price']) : '0.00'; ?>" required><br>
                                 
                        <input type="submit" value="<?php echo $id ? 'Update' : 'Upload'; ?> Note">
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
                        $notes_result = $connection->query("SELECT notes.*, categories.name AS category_name 
                                                           FROM notes LEFT JOIN categories ON notes.category_id = categories.id 
                                                           ORDER BY uploaded_at DESC");
                        if ($notes_result && $notes_result->num_rows > 0):
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
                                <?php while ($row = $notes_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                                        <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['uploaded_at']); ?></td>
                                        <td><?php echo $row['price'] ? '₹' . number_format($row['price'], 2) : 'Free'; ?></td>
                                        <td>
                                            <a href="admin.php?id=<?php echo $row['id']; ?>#upload-notes" class="action-btn edit-btn">Edit</a>
                                            <form action="" method="POST" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this note?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>There are no notes uploaded yet.</p>
                    <?php endif; ?>
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
                    <?php
                        $user_data = $connection->query("SELECT * FROM userdetails ORDER BY id DESC");
                        if ($user_data && $user_data->num_rows > 0):
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
                                <?php while ($row = $user_data->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>There are no users registered yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Purchase Details Section -->
            <div id="download-detail" class="section">
                <div class="section-title">
                    <h2>Purchase Details</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search-downloads" class="form-control" placeholder="Search downloads...">
                    </div>
                </div>
                <div class="table-container">
                      <?php
                         $enroll_query = $connection->query("SELECT * FROM enrolled ORDER BY enroll_id DESC");
                        if ($enroll_query && $enroll_query->num_rows > 0):
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Id</th>
                                <th>Notes Id</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php while ($row = $enroll_query->fetch_assoc()): ?>
                          
                                <tr>
                                        <td><?php echo htmlspecialchars($row['enroll_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['notes_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                                        <td><?php echo htmlspecialchars($row['enroll_date']); ?></td>
                                 </tr>          
                                   <?php endwhile; ?>               
                        </tbody>
                    </table>
                      <?php else: ?>
                        <p>There are no purchase records yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script src="./assets/js/index.js"></script>
    <div class="dark-mode-toggle" title="Toggle Dark Mode">
        <i class="fas fa-moon"></i>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.menu-slide').style.transform = 
                document.querySelector('.menu-slide').style.transform === 'translateX(0%)' ? 
                'translateX(-100%)' : 'translateX(0%)';
        });

        // Navigation between sections
        document.querySelectorAll('.menu-list li').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-list li').forEach(li => li.classList.remove('active'));
                this.classList.add('active');
                
                const targetId = this.getAttribute('data-section');
                document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
                
                const targetSection = document.getElementById(targetId);
                targetSection.classList.add('active');
                targetSection.style.animation = 'fadeIn 0.5s ease';
                
                if (window.innerWidth < 992) {
                    document.querySelector('.menu-slide').style.transform = 'translateX(-100%)';
                }
            });
        });

        // Search functionality
        document.getElementById('search-notes').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('#manage-notes tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('search-users').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('#users tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('search-downloads').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('#download-detail tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        // Dark mode toggle
        document.querySelector('.dark-mode-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-moon');
            icon.classList.toggle('fa-sun');
            
            // Save preference to localStorage
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        });

        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
            const icon = document.querySelector('.dark-mode-toggle i');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
    </script>
</body>
</html>