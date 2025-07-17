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

 <!-- testimonials database -->
 <?php
    // inset testimonials
    if (isset($_POST['testimonial_submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $education = htmlspecialchars($_POST['education']);
    $email = htmlspecialchars($_POST['email']);
    $msg = htmlspecialchars($_POST['msg']);

    // Validate inputs
    if (empty($name) || empty($education) || empty($email) || empty($msg)) {
        $_SESSION['testimonial_error'] = "All fields are required.";
    } else {
        $stmt = $connection->prepare("INSERT INTO testimonials (name, education, email, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $education, $email, $msg);

        if ($stmt->execute()) {
            $_SESSION['testimonial_success'] = true;
        } else {
            $_SESSION['testimonial_error'] = "Error submitting testimonial. Please try again.";
        }

        $stmt->close();
    }

    // Redirect to prevent duplicate submission
    header("Location: " . $_SERVER['PHP_SELF']);
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
            color:var(--heading);
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.4s linear;
        }

        .logout:hover {
            background-color: #eee;
            color: var(--text-primary);
            font-weight: 700;
        }

        .dark-mode{
                position: fixed;
    left: 20px;
    top: 90%;
    padding: 5px;
    font-size: 24px;
    z-index: 1;
    background: #303030;
    color: #fff;
    width: 42px;
    border-radius: 50px;
    border: none;
        }
          
        
[data-theme="dark"] {
  --primary: #38bdf8;       /* Brighter, more vibrant blue */
  --secondary: #f59e0b;     /* Slightly warmer orange */
  --accent: #0ea5e9;        /* Deep sky blue */
  --success: #34d399;       /* Softer green */
  --danger: #f87171;        /* Softer red */
  --bg: #0f172a;            /* Deep navy blue instead of pure black */
  /* --card-bg: #1e293b;       Slightly lighter navy for cards */
  --text-primary:rgb(90, 87, 87);   /* Very light gray (almost white) */
  --text-secondary: #94a3b8; /* Medium gray for secondary text */
  --border: #334155;         /* Dark gray-blue for borders */
  --heading:#ffff;
    color:#fff;

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
    color:var(--bg);
    text-decoration: none;
    padding: 10px;
    cursor: pointer;
  }
  .testimonials{
    background:transparent;
  }
  .testi-btn{
        padding: 11px;
    border: none;
    border-radius: 6px;
    font-weight: 500;
    color: var(--bg);
    background: var(--accent);
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

         <button id="dark-mode-toggle" class="dark-mode-toggle dark-mode">
                <i class="fas fa-moon"></i> <!-- Moon icon for light mode -->
                <i class="fas fa-sun"></i> <!-- Sun icon for dark mode -->
          </button>

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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="testimonialForm">
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
    <input type="submit" name="testimonial_submit"  value="Submit Testimonial" class="testi-btn">
</form>

                </div>
            </div>            
            <div class="testimonial-msg">
    <h2>What Our Students Say</h2>
    <div class="testimonial-list">
        <?php
        // Fetch testimonials from the database
        $testimonial_result = $connection->query("SELECT * FROM testimonials ORDER BY id DESC");
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
    // Rest of your existing JavaScript code...
    // Mobile menu toggle
    // const hamburger = document.querySelector('.hamburger');
    // const navLinks = document.querySelector('.nav-links');
    
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });

    // Close mobile menu when clicking on a link
   
     function preventBack() {
        window.history.forward();
    }

    setTimeout(preventBack, 0);

    window.onunload = function () {
        // Optional: force unload
    };


    

const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

function toggleMobileMenu() {
  navLinks.classList.toggle("active");
  hamburger.innerHTML = navLinks.classList.contains("active")
    ? '<i class="fa-solid fa-xmark"></i>'
    : '<i class="fa-solid fa-bars"></i>';
}

hamburger.addEventListener("click", toggleMobileMenu);

// Close mobile menu when clicking a link
document.querySelectorAll(".nav-links a").forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.classList.remove("active");
    hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
  });
});

document.addEventListener("click", (e) => {
  if (e.target.closest(".hamburger")) {
    toggleMobileMenu();
  }
});

// Sticky Header
const header = document.getElementById("header");

function handleScroll() {
  if (window.scrollY > 100) {
    header.classList.add("scrolled");
    navLinks.classList.remove("active");
    hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
  } else {
    header.classList.remove("scrolled");
  }
}





    // Search functionality
    const searchInput = document.getElementById('search-data');
    if (searchInput) {
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
    }

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

    const submit = document.querySelector(".testi-btn");
    const alert = document.querySelector(".testimonial-alert");
    
    if (submit && alert) {
        submit.addEventListener("click", () => {
            alert.style.display = "block";
            setTimeout(() => {
                alert.style.display = "none";
            }, 3000);
        });
    }

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
  const toggleBtn = document.querySelector('.dark-mode-toggle');
  const html = document.documentElement;

  // Check for saved theme preference
  const currentTheme = localStorage.getItem('theme') || 'light';
  if (currentTheme === 'dark') {
    html.setAttribute('data-theme', 'dark');
  }

  // Toggle function
  toggleBtn.addEventListener('click', function() {
    if (html.getAttribute('data-theme') === 'dark') {
      html.removeAttribute('data-theme');
      localStorage.setItem('theme', 'light');
    } else {
      html.setAttribute('data-theme', 'dark');
      localStorage.setItem('theme', 'dark');
    }
  });
});
    </script>

</body>
</html>