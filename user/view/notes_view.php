<?php
session_start();
require "../../config/Database.php"; // Adjust the path if needed

// Check if note_id and user_id are provided
if (!isset($_GET['note_id']) || !isset($_GET['user_id'])) {
    echo "No note ID or user ID specified.";
    exit();
}

$note_id = intval($_GET['note_id']);
$user_id = intval($_GET['user_id']);

// Use prepared statement to prevent SQL injection
$note_query = $connection->prepare("SELECT * FROM notes WHERE id = ?");
$note_query->bind_param("i", $note_id);
$note_query->execute();
$note_result = $note_query->get_result();

if ($note_result->num_rows === 0) {
    echo "Note not found.";
    exit();
}

$note = $note_result->fetch_assoc();

// Escape and assign note data
$title = htmlspecialchars($note['title']);
$price = htmlspecialchars($note['price']);
$description = htmlspecialchars($note['description']);
$thumbnail = htmlspecialchars($note['thumbnail_path']);
$demo1 = htmlspecialchars($note['demo1_path']);
$demo2 = htmlspecialchars($note['demo2_path']);
$demo3 = htmlspecialchars($note['demo3_path']);
$note_file = htmlspecialchars($note['file_path']);

// Get category name
$category_id = $note['category_id'];
$category_name = "Unknown";
$cat_res = $connection->prepare("SELECT name FROM categories WHERE id = ?");
$cat_res->bind_param("i", $category_id);
$cat_res->execute();
$cat_result = $cat_res->get_result();

if ($cat_result->num_rows > 0) {
    $category_name = htmlspecialchars($cat_result->fetch_assoc()['name']);
}

// Handle download/enrollment
if (isset($_POST['download'])) {
    $note_id = intval($_POST['note_id']);
    $user_id = intval($_POST['user_id']);

    // Check if user is already enrolled
    $enroll_check = $connection->prepare("SELECT enroll_id FROM enrolled WHERE notes_id = ? AND user_id = ?");
    $enroll_check->bind_param("ii", $note_id, $user_id);
    $enroll_check->execute();
    $enroll_result = $enroll_check->get_result();

    if ($enroll_result->num_rows === 0) {
        // Insert enrollment record
        $stmt = $connection->prepare("INSERT INTO enrolled (user_id, notes_id, title, category_name, description, thumbnail_path, note_file) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssss", 
            $user_id, 
            $note_id,
            $title,
            $category_name,
            $description,
            $thumbnail,
            $note_file
        );

        if ($stmt->execute()) {
            echo '<script>alert("Course enrolled successfully"); window.location.href = "./enroll.php?user_id=' . $user_id . '";</script>';
            exit();
        } else {
            echo "Insert Error: " . $stmt->error;
        }
    } else {
        echo '<script>alert("You are already enrolled.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Note View</title>
    <link rel="stylesheet" href="../user_assets/css/view.css">
    <link rel="stylesheet" href="../user_assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="left-side">
            <div class="image-container">
                <div class="image-box">
                    <img id="main-image" src="../../admin/<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>">
                </div>
                <div class="image-list">
                    <div class="image img-1" onclick="changeImage('../../admin/<?php echo $demo1; ?>')">
                        <img src="../../admin/<?php echo $demo1; ?>" alt="Demo 1">
                    </div>
                    <div class="image img-2" onclick="changeImage('../../admin/<?php echo $demo2; ?>')">
                        <img src="../../admin/<?php echo $demo2; ?>" alt="Demo 2">
                    </div>
                    <div class="image img-3" onclick="changeImage('../../admin/<?php echo $demo3; ?>')">
                        <img src="../../admin/<?php echo $demo3; ?>" alt="Demo 3">
                    </div>
                </div>
            </div>
        </div>

        <div class="right-side">
            <div class="title">
                <h2><?php echo $title; ?></h2>
                <h4><?php echo $category_name; ?> Category</h4>
                <p><strong>Price: ₹<?php echo $price; ?></strong></p>
            </div>
            <div class="description">
                <?php echo $description; ?>
            </div>
            <form action="" method="POST">
                <input type="hidden" name="note_id" value="<?php echo $note_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <button type="submit" name="download" class="btn-secondary">Download Now</button>
                <?php if (!empty($note['demo_path'])): ?>
                    <a href="<?php echo '../../admin/' . htmlspecialchars($note['demo_path']); ?>" class="btn-secondary">Demo page</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <section class="notes" id="notes">
        <div class="notes-container">
            <div class="section-title">
                <h2>Latest Uploaded Study Notes</h2>
            </div>          
            <div class="notes-grid">
                <?php
                $notes_result = $connection->query("SELECT * FROM notes ORDER BY uploaded_at DESC LIMIT 3");
                if ($notes_result->num_rows > 0) {
                    while ($row = $notes_result->fetch_assoc()) {
                        $note_id = htmlspecialchars($row['id']);
                        $title = htmlspecialchars($row['title']);
                        $price = htmlspecialchars($row['price']);
                        $category_id = htmlspecialchars($row['category_id']);
                        $thumbnail = htmlspecialchars($row['thumbnail_path']);

                        // Fetch category name
                        $category_name = "Unknown Category";
                        $category_query = $connection->prepare("SELECT name FROM categories WHERE id = ?");
                        $category_query->bind_param("i", $category_id);
                        $category_query->execute();
                        $category_result = $category_query->get_result();
                        
                        if ($category_result->num_rows > 0) {
                            $category_row = $category_result->fetch_assoc();
                            $category_name = htmlspecialchars($category_row['name']);
                        }
                ?>
                <div class="note-card" data-category="<?php echo strtolower($category_name); ?>">
                    <div class="note-image">
                        <img src="<?php echo '../../admin/' . $thumbnail; ?>" alt="<?php echo $title; ?>" width="100px" height="200px">
                        <span class="note-category"><?php echo $category_name; ?></span>
                    </div>
                    <div class="note-content">
                        <h3><?php echo $title; ?></h3>
                        <p>A detailed note on <?php echo $category_name; ?> concepts.</p>
                        <div class="note-stats">
                            <span class="note-price">Price: ₹<?php echo $price; ?></span>
                            <a href="view.php?note_id=<?php echo $note_id; ?>&user_id=<?php echo $user_id; ?>" class="btn-download">
                                View Note <i class="fa-solid fa-download" style="color: #eaeef5;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p>There are no posts uploaded yet.</p>";
                }
                ?>  
            </div>
        </div>
    </section>
    
    <script>
        // Image Gallery Functionality
        function changeImage(src) {
            // Update main image
            document.getElementById('main-image').src = src;
            
            // Remove highlight from all thumbnails
            document.querySelectorAll('.image-list .image').forEach(img => {
                img.style.borderColor = '#ddd';
                img.style.boxShadow = 'none';
            });
            
            // Highlight clicked thumbnail
            event.currentTarget.style.borderColor = '#4CAF50';
            event.currentTarget.style.boxShadow = '0 0 0 2px rgba(76, 175, 80, 0.3)';
        }

        // Highlight the first thumbnail by default on page load
        window.addEventListener('DOMContentLoaded', function() {
            const firstThumbnail = document.querySelector('.image-list .image:first-child');
            if (firstThumbnail) {
                firstThumbnail.style.borderColor = '#4CAF50';
                firstThumbnail.style.boxShadow = '0 0 0 2px rgba(76, 175, 80, 0.3)';
            }
        });

        // Animation for note cards
        function animateOnScroll() {
            const noteCards = document.querySelectorAll('.note-card');
            const windowHeight = window.innerHeight;
            
            noteCards.forEach(card => {
                const cardPosition = card.getBoundingClientRect().top;
                const revealPoint = 150;
                
                if (cardPosition < windowHeight - revealPoint) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        }

        // Initialize animations
        document.querySelectorAll('.note-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
        });

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>
</html>