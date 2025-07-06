<?php
require "../config/Database.php";
session_start();
// if set session then enter userdashboard

if(!isset($_SESSION['username'])) {
      header("Location: ../index.php");
      exit();
}
?>
<!-- logout and session destroy -->
<?php
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
      echo '<script>window.location.href = " ../index.php";</script>';
    exit();
}
?>

<!-- notes open -->
 <?php
// open notes view page
if(isset($_POST['notes_btn'])) {
    $note_id = $_POST['note_id'];
    header("Location: ./view/notes_view.php?note_id=" . urlencode($note_id));
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
    <link rel="stylesheet" href="./user_assets/css/style.css">
    <style>
        .logout {
            width: 100px;
            height: 35px;
            border-radius: 8px;
            outline: none;
            border: 2px solid #fff;
            font-weight: 600;
            background: transparent;
            color: #fff;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.4s linear;
        }

        .logout:hover {
            background-color: #eee;
            color: var(--text-primary);
            font-weight: 700;
        }

        /* Dark mode toggle styles */
        .dark-mode-toggle {
            background: transparent;
            border: 1px solid;
            color: #f9f9f9;
            cursor: pointer;
            font-size: 1.6rem;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 50px;
            position: fixed;
            bottom: 5%;
            left: 20px;
            background: #292828;
            z-index: 999;
        }

        /* Hide the sun icon by default */
        .dark-mode-toggle .fa-sun {
            display: none;
        }

        /* In dark mode, hide moon and show sun */
        [data-theme="dark"] .dark-mode-toggle .fa-moon {
            display: none;
        }

        [data-theme="dark"] .dark-mode-toggle .fa-sun {
            display: block;
        }

        /* Floating animation for hero notes */
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(-5deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes float2 {
            0%, 100% {
                transform: translateY(0) rotate(3deg);
            }
            50% {
                transform: translateY(-15px) rotate(-3deg);
            }
        }

        @keyframes float3 {
            0%, 100% {
                transform: translateY(0) rotate(-8deg);
            }
            50% {
                transform: translateY(-10px) rotate(8deg);
            }
        }

        .note-1 {
            animation: float 6s ease-in-out infinite;
        }

        .note-2 {
            animation: float2 5s ease-in-out infinite;
        }

        .note-3 {
            animation: float3 7s ease-in-out infinite;
        }

        /* Testimonial animations */
        @keyframes swingIn {
            0% {
                transform: translateY(-50px) rotate(-5deg);
                opacity: 0;
            }
            100% {
                transform: translateY(0) rotate(0);
                opacity: 1;
            }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Contact button animation */
        .whatsapp-text {
            transition: all 0.3s ease-in-out;
            width: 28px;
            color: transparent;
        }

        .contact:hover .whatsapp-text {
            width: 125px;
            color: black;
        }
      @media (max-width: 768px) {
    .testimonial-card {
        width: 100%;
    }
}
  @media (max-width: 568px) {
.testimonial-alert {
 
    z-index: 1;
}
.fa-circle-check {
    font-size: 45px;
    color: #06ea06;
}
.alert-card h2 {
    font-size: 17px;
}
  }

  .testimonial-alert{
    display: none;
  }
.right-link{
        position: fixed;
    right: 0;
    background: orange;
    padding: 5px;
    border-radius: 5px;
    writing-mode: sideways-lr;
}
  .right-link a{
    color: #ff;
    color: #fff;
    text-decoration: none;
    padding: 10px;
    cursor: pointer;
  }
    </style>
</head>
<body>
     <!-- Header -->
    <header id="header">
        <div class="navbar">
            <div class="logo">
                <i class="fas fa-book-open-reader"></i>
                <span>StudySelf</span>
            </div>
            <ul class="nav-links">
                <a href="#home"><i class="fa-solid fa-house-user"></i><span >Home</span></a>
                <a href="./view/enroll.php"><i class="fa-solid fa-bookmark"></i><span>enroll</span></a>
                <a href="#notes"><i class="fa-solid fa-book"></i><span>Notes</span></a>
                <a href="#testimonials"><i class="fa-solid fa-users"></i><span >Testimonials</span></a>
                
            </ul>
              <button id="dark-mode-toggle" class="dark-mode-toggle">
                <i class="fas fa-moon"></i> <!-- Moon icon for light mode -->
                <i class="fas fa-sun"></i> <!-- Sun icon for dark mode -->
                </button>
            <div class="btn">
                <i class="fa-solid fa-user"  style="display: none;"></i>
                <ul>
                    <a href="#" class="user-name" style="color:rgb(238, 208, 38);" ><?PHP echo $_SESSION['username']; ?></a>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="submit" name="logout" value="Logout" class="logout">
                    </form>
                </ul>
              
                <div class="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </div>

        </div>
    </header>

     <div class="contact">
            <a href=" https://wa.me/8294800888?text=hii..." target="_blank" class="whatsapp-link">
                <span class="whatsapp-text">Contact Us</span>
              <img src="../uploads/images/icons8-whatsapp-50.png" alt="contact">
            </a>
    </div>


    <!-- Hero Section -->
    <section class="hero" id="home">
        
    <div class="right-link">
        <a href="../store/store.php">StudySelf Store</a>
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

    <!-- Notes Section -->
    <section class="notes" id="notes">
        <div class="notes-container">
            <div class="section-title">
                <h2>Popular Study Notes</h2>
                <p>Browse our most popular notes across various subjects and levels</p>
            </div>
           
            <div class="notes-filter">
                 <form action="" style="width:-webkit-fill-available;">
                    <div class="search-data">
                        <input type="search" name="search-data" id="search-data" class="search-input" placeholder="Search Course here ....">
                    </div>
                 </form>
            </div>
            <div class="notes-grid ">
              <?php
    $notes_result = $connection->query("SELECT * FROM notes ORDER BY uploaded_at DESC");
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
                <img src="<?php echo '../admin/' . $thumbnail; ?>" alt="<?php echo $title; ?>" width="100px" height="200px">
                <span class="note-category"><?php echo $category_name; ?></span>
            </div>
            <div class="note-content">
                <h3><?php echo $title; ?></h3>
                <p>
                    A detailed note on <?php echo $category_name; ?> concepts.
                </p>
                <div class="note-stats">
                    <span class="note-price">Price: ₹<?php echo $price; ?></span>
                    <a href="./view/notes_view.php?id=<?php echo $note_id; ?>" class="btn-download">
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
    <section class="testimonials" id="testimonials">
        <div class="section-title">
            <h2>Testimonials</h2>
            <p>Read what other students have to say about their experience with Studyself</p>
        </div>

        <div class="testimonial-alert">
            <div class="alert-card">
                <i class="fa-solid fa-circle-check"></i>
                <h2>Submited Sucessfully</h2>
                <p>
                    Thanks for giving feedback ..
                </p>
            </div>

        </div>

        <div class="testimonial-container">
            <div class="testimonial-form">
                <div class="testimonial-info">
                    <div class="testimonial-content">
                        <h1>Share Your <span style="color:orange;"> Experience </span> !</h1>
                        <p>We'd love to hear about your journey with Studyself. Your feedback helps us improve and helps other students make informed decisions.</p>
                        <ul class="benefits-list">
                            <li> Your opinion matters to us</li>
                            <li> Help build our community</li>
                            <li> Anonymous options available</li>
                        </ul>
                    </div>
                </div>
                <div class="testimonial-card">
                    <form action=" " method="POST" id="testimonialForm">
                        <div class="form-group">
                            <label for="name" class="lbl">Name:</label>
                            <input type="text" name="name" id="name" class="ipt" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <label for="education" class="lbl">Education Level:</label>
                            <select name="education" id="education" class="ipt" required>
                                <option value="">Select your level</option>
                                <option value="High School">High School</option>
                                <option value="Undergraduate">Undergraduate</option>
                                <option value="Graduate">Graduate</option>
                                <option value="Professional">Professional</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email" class="lbl">Email:</label>
                            <input type="email" name="email" id="email" class="ipt" placeholder="your@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="msg" class="lbl">Your Experience:</label>
                            <textarea name="msg" id="msg" class="ipt" placeholder="Share your story..." required></textarea>
                        </div>
                        <button type="submit" class="submit-btn" id="submit-btn">Submit Testimonial</button>
                    </form>
                </div>
            </div>
            
            <div class="testimonial-msg">
                <h2>What Our Students Say</h2>
               <div class="testimonial-list">
                 <div class="testimonial-hanging active" style="--delay: 0">
                    
                    <div class="hanging-card">
                        <div class="user-info">
                            <div class="user-avatar">JS</div>
                            <h4>John Smith</h4>
                            <span>Computer Science</span>
                        </div>
                        <div class="testimonial-text">
                            <p>"Studyself transformed my learning approach completely. The personalized plans helped me improve my grades significantly!"</p>
                        </div>
                     
                    </div>
                </div>

                <div class="testimonial-hanging" style="--delay: 0.2">
                  
                    <div class="hanging-card">
                        <div class="user-info">
                            <div class="user-avatar">MA</div>
                            <h4>Maria Alvarez</h4>
                            <span>High School</span>
                        </div>
                        <div class="testimonial-text">
                            <p>"The scheduling tools were a game-changer. I went from barely passing to honor roll in just one semester!"</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-hanging" style="--delay: 0.4">
                 
                    <div class="hanging-card">
                        <div class="user-info">
                            <div class="user-avatar">TD</div>
                            <h4>Thomas Doe</h4>
                            <span>MBA Student</span>
                        </div>
                        <div class="testimonial-text">
                            <p>"As a working professional, the flexibility and mobile access made all the difference in my graduate studies."</p>
                        </div>
                    </div>
                </div>

                 <div class="testimonial-hanging" style="--delay: 0.4">
                 
                    <div class="hanging-card">
                        <div class="user-info">
                            <div class="user-avatar">TD</div>
                            <h4>Thomas Doe</h4>
                            <span>MBA Student</span>
                        </div>
                        <div class="testimonial-text">
                            <p>"As a working professional, the flexibility and mobile access made all the difference in my graduate studies."</p>
                        </div>
        
                    </div>
                </div>
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
                    <li><a href="./view/enroll.php">Enroll</a></li>
                    <li><a href="#notes">Notes</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Subjects</h3>
                <ul class="footer-links">
                    <li><a data-filter="Science">Science</a></li>
                    <li><a data-filter="Mathematics">Mathematics</a></li>
                    <li><a data-filter="programing">Programing</a></li>
                    <li><a data-filter="Business">Business</a></li>
                    <li><a data-filter="Engineering">Engineering</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Education St, Boston, MA</p>
                <p><i class="fas fa-phone"></i> (555) 123-4567</p>
                <p><i class="fas fa-envelope"></i> studyself@zohomail.in</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 StudySelf. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of
                    Service</a></p>
        </div>
    </footer>

    <script src="./user_assets/js/user_dashboad.js"></script>
    <script>
        // Dark mode functionality
        function toggleDarkMode() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            
            if (currentTheme === 'dark') {
                html.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Check for saved user preference or system preference
        function loadTheme() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', loadTheme);

        // Add event listener to dark mode toggle button
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', toggleDarkMode);
        }

        // Mobile menu toggle
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });

     

        // Search functionality
        const searchInput = document.getElementById('search-data');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const noteCards = document.querySelectorAll('.note-card');
            
            noteCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const category = card.querySelector('.note-category').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || category.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Filter functionality
        document.querySelectorAll('[data-filter]').forEach(filter => {
            filter.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter').toLowerCase();
                const noteCards = document.querySelectorAll('.note-card');
                
                noteCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    
                    if (filterValue === 'all' || cardCategory.includes(filterValue)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });


        const submit = document.querySelector("#submit-btn");
const alert = document.querySelector(".testimonial-alert");

submit.addEventListener("click", () => {
    alert.style.display = "block";
    setTimeout(() => {
        alert.style.display = "none";
    }, 3000);
});

    </script>

</body>
</html>