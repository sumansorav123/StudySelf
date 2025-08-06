<?php
require 'config/Database.php';
session_start();

if(isset($_SESSION["useremail"], $_SESSION["username"])){
  header("Location: user/user_dashboard.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudySelf</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
       <link rel="stylesheet" href="./assets/css/style.css">

</head>
<style>
    @media (max-width: 992px) {
     .fa-user{
        display:block;
     }
    }
    .hanging-card{
        width: 290px;
    }
</style>
<body>
     <!-- Header -->
    <header id="header">
        <div class="navbar">
            <div class="logo">
                <i class="fas fa-book-open-reader"></i>
                <span>StudySelf</span>
            </div>
            <ul class="nav-links">
                <a href="#home"><span >Home</span></a>
                <a href="#features"><span >Features</span></a>
                <a href="#notes"><span >Notes</span></a>
                <a href="#testimonials"><span >Testimonials</span></a>
                
            </ul>
             <button id="dark-mode-toggle" class="dark-mode-toggle">
                <i class="fas fa-moon"></i> <!-- Moon icon for light mode -->
                <i class="fas fa-sun"></i> <!-- Sun icon for dark mode -->
                </button>
            <div class="btn">
              
                <i class="fa-solid fa-user" ></i>
                <ul class="nav-ul">
                    <a href="./user/user_auth/user_sigin.php" class="cta-button">Sign Up</a>
                    <a href="./user/user_auth/user_login.php" class="cta-button">Sign In</a>
                </ul>
                <div class="hamburger">
                   <i class="fa-solid fa-bars"></i>
                </div>
            </div>

        </div>
    </header>

    <div class="contact">
     
            <a href=" https://wa.me/8294800888?text=hii..." target="_blank" class="whatsapp-link">
                <span class="whatsapp-text">Contact Us</span>
              <img src="./uploads/images/icons8-whatsapp-50.png" alt="contact">
            </a>
       
    </div>

    <!-- Hero Section -->
    <section class="hero" id="home">
          <div class="right-link">
        <a href="./store/store.php">StudySelf Store</a>
    </div>
        <div class="hero-content">
            <div class="hero-text">
                <h1 style="padding:2px 0px ">Premium Study Notes for Academic <span style="color: #27AE60;"> Success </span> </h1>
                <p>Access high-quality, curated notes from top students and educators. Boost your grades and save time
                    with our comprehensive study materials.</p>
                <div class="hero-buttons">
                    <a href="#notes" class="cta-button"
                        style="background-color: transparent; color: white; border: 2px solid white;">Explore
                        Notes</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-notes">
                    <div class="note note-1">
                        <h3>Core Java</h3>

                        <p>Comprehensive guide to Java programming with examples, best practices, and common pitfalls.
                            Ideal for beginners and intermediate learners.</p>
                    </div>
                    <div class="note note-2">
                        <h3>Calculus II</h3>
                        <p>Step-by-step solutions for integration techniques, series, and sequences with practice
                            problems and exam tips.</p>
                    </div>
                    <div class="note note-3">
                        <h3>World History</h3>
                        <p>Chronological overview of major world events with timelines, key figures, and analysis of
                            historical impacts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-title">
            <h2 class="reveal">Why Choose NoteSphere?</h2>
            <p class="reveal">We provide the best study resources to help you excel in your academic journey</p>
        </div>
        <div class="features-grid reveal">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-star reveal"></i>
                </div>
                <h3 class="reveal">Premium Quality</h3>
                <p class="reveal">All notes are carefully curated and verified by top students and educators to ensure accuracy and
                    completeness.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search reveal"></i>
                </div>
                <h3 class="reveal">Easy to Understand</h3>
                <p class="reveal">Complex concepts broken down into simple, digestible formats with visuals and examples for better
                    retention.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clock reveal"></i>
                </div>
                <h3 class="reveal">Save Time</h3>
                <p class="reveal">Spend less time organizing your study materials and more time actually learning and mastering the
                    content.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt reveal"></i>
                </div>
                <h3 class="reveal">Access Anywhere</h3>
                <p class="reveal">Available on all devices - study on your laptop, tablet, or phone whenever and wherever you want.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-graduation-cap reveal"></i>
                </div>
                <h3 class="reveal">Exam Focused</h3>
                <p class="reveal">Notes are tailored to help you ace your exams with key points, common questions, and study
                    strategies.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users reveal"></i>
                </div>
                <h3 class="reveal">Community Driven</h3>
                <p class="reveal">Contribute your own notes and earn rewards while helping other students succeed in their studies.</p>
            </div>
        </div>
    </section>

     <!-- Notes Section -->
    <section class="notes" id="notes">
        <div class="notes-container">
            <div class="section-title">
                <h2 class="reveal">Popular Study Notes</h2>
                <p class="reveal">Browse our most popular notes across various subjects and levels</p>
            </div>
           
            <div class="notes-filter">
                 <form action="" style="width:-webkit-fill-available;">
                    <div class="search-data">
                        <input type="search" name="search-data" id="search-data" class="search-input reveal" placeholder="Search Course here ....">
                    </div>
                 </form>
            </div>
            <div class="notes-grid reveal">
              <?php
    $notes_result = $connection->query("SELECT * FROM notes ORDER BY uploaded_at DESC LIMIT 6");
    if ($notes_result->num_rows > 0) {
        while ($row = $notes_result->fetch_assoc()) {
            $note_id = htmlspecialchars($row['id']);
            $title = htmlspecialchars($row['title']);
            $price = htmlspecialchars($row['price']);
            $uploaded_at = htmlspecialchars($row['uploaded_at']);
            $category_id = htmlspecialchars($row['category_id']);
            $thumbnail = htmlspecialchars($row['thumbnail_path']);

            // Fetch category name
            $category_name = "Unknown Category";
            $category_query = $connection->query("SELECT name FROM categories WHERE id = $category_id");
            if ($category_query && $category_query->num_rows > 0) {
                $category_row = $category_query->fetch_assoc();
                $category_name = htmlspecialchars($category_row['name']);
            }
    ?>
        <div class="note-card" data-category="<?php echo strtolower($category_name); ?>">
            <div class="note-image">
                <img src="<?php echo 'admin/' . $thumbnail; ?>" alt="<?php echo $title; ?>" width="100px" height="200px">
                <span class="note-category"><?php echo $category_name; ?></span>
            </div>
            <div class="note-content">
                <h3><?php echo $title; ?></h3>
                <p>
                    A detailed note on <?php echo $category_name; ?> concepts.
                </p>
                <div class="note-stats">
                    <span class="note-price">Price: ₹<?php echo $price; ?></span>
                    <a href="./user/user_auth/user_login.php" class="btn-download">
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

    <!-- Testimonials Section -->
    <section class="testimonials reveal" id="testimonials">
       
    <div class="testimonial-msg" >
        <br>
    <h2>What Our Students Say</h2>
    <br>
    <div class="testimonial-list">
        <?php
        // Fetch testimonials from the database
        $testimonial_result = $connection->query("SELECT * FROM testimonials ORDER BY id DESC LIMIT 4");
        if ($testimonial_result->num_rows > 0) {
            $delay = 0;
            while ($testimonial = $testimonial_result->fetch_assoc()) {
                $name = htmlspecialchars($testimonial['name']);
                $education = htmlspecialchars($testimonial['education']);
                $message = htmlspecialchars($testimonial['message']);
                $created_at = date("d M Y", strtotime($testimonial['submitted_at'])); // format date
                $initials = strtoupper(substr($name, 0, 1)) . (strpos($name, " ") !== false ? strtoupper(substr(explode(" ", $name)[1], 0, 1)) : "");
        ?>
            <div class="testimonial-hanging active" style="--delay: <?= $delay ?>s">
                <div class="hanging-card">
                    <div class="user-info">
                        <div class="user-avatar"><?= $initials ?></div>
                        <h4><?= $name ?></h4>
                        <span><?= $education ?></span>
                    </div>
                    <div class="testimonial-text">
                        <p>"<?= $message ?>"</p>
                        <small><?= $created_at ?></small>
                    </div>
                </div>


           
            </div>
        <?php
                $delay += 0.2; // stagger animation
            }
        } else {
            echo "<p>No testimonials yet!</p>";
        }
        ?>
    </div>
</div>

        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" style=" background-color:rgb(5, 63, 79);">
        <div class="footer-container">
            <div class="footer-col">
                <h3>About StudySelf</h3>
                <p>StudySelf is a platform dedicated to helping students succeed by providing high-quality, curated
                    study notes from top students and educators.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#notes">Notes</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#">Pricing</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Subjects</h3>
                <ul class="footer-links">
                    <li><a href="#">Science</a></li>
                    <li><a href="#">Mathematics</a></li>
                    <li><a href="#">Humanities</a></li>
                    <li><a href="#">Business</a></li>
                    <li><a href="#">Engineering</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Education St, Boston, MA</p>
                <p><i class="fas fa-phone"></i> (555) 123-4567</p>
                <p><i class="fas fa-envelope"></i>studyselfzohomail.in</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 StudySelf. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of
                    Service</a></p>
        </div>
    </footer>

</body>
<script src="./assets/js/index.js"></script>

</html>