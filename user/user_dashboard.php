<?php
require "../config/Database.php";
session_start();
// if set session then enter userdashboard

if(!isset($_SESSION['username'])) {
      echo '<script>window.location.href = "../index.php";</script>';
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
   <!-- <link rel="stylesheet" href="./user_assets/css/style.css"> -->
    <link rel="stylesheet" href="./user_assets/css/style.css">

</head>
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
@media (max-width: 992px) {
    .testimonial-list {
        margin-bottom: 2rem;
       
    }
}

@media (max-width: 568px) {
    .testimonial-list {
        margin-bottom: 2rem;
        width: 280px;
    }
     .testimonial-review {
   margin-left: -20px;
}


}
.testimonial-review {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}
/* scroll bar */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: #555;
}
/* end scroll bar */
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

        <div class="testimonial-container">
            <div class="testimonial-review">
                                   <i class="fa-solid fa-arrow-up scrl"></i>
                <div class="testimonial-list">
                    <div class="testimonial-card">
                        <div class="testimonail-name">
                            <p><b>Name</b></p>
                            <p><span>school name</span></p>
                        </div>
                        <div class="testimonial-message">
                            <p>" Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero inventore consequatur nostrum sunt modi nobis laudantium corporis animi alias. Vitae cupiditate dolorum fuga quo ullam ducimus magni perspiciatis, delectus consectetur? "</p>
                        </div>
                    </div>

                     <div class="testimonial-card">
                        <div class="testimonail-name">
                            <p><b>Name</b></p>
                            <p><span>school name</span></p>
                        </div>
                        <div class="testimonial-message">
                            <p>" Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero inventore consequatur nostrum sunt modi nobis laudantium corporis animi alias. Vitae cupiditate dolorum fuga quo ullam ducimus magni perspiciatis, delectus consectetur? "</p>
                        </div>
                     </div>    


                     
                     <div class="testimonial-card">
                        <div class="testimonail-name">
                            <p><b>Name</b></p>
                            <p><span>school name</span></p>
                        </div>
                        <div class="testimonial-message">
                            <p>" Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero inventore consequatur nostrum sunt modi nobis laudantium corporis animi alias. Vitae cupiditate dolorum fuga quo ullam ducimus magni perspiciatis, delectus consectetur? "</p>
                        </div>
                     </div> 

                     
                     <div class="testimonial-card">
                        <div class="testimonail-name">
                            <p><b>Name</b></p>
                            <p><span>school name</span></p>
                        </div>
                        <div class="testimonial-message">
                            <p>" Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero inventore consequatur nostrum sunt modi nobis laudantium corporis animi alias. Vitae cupiditate dolorum fuga quo ullam ducimus magni perspiciatis, delectus consectetur? "</p>
                        </div>
                     </div> 

                     
                     <div class="testimonial-card">
                        <div class="testimonail-name">
                            <p><b>Name</b></p>
                            <p><span>school name</span></p>
                        </div>
                        <div class="testimonial-message">
                            <p>" Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero inventore consequatur nostrum sunt modi nobis laudantium corporis animi alias. Vitae cupiditate dolorum fuga quo ullam ducimus magni perspiciatis, delectus consectetur? "</p>
                        </div>
                     </div> 

                     
                     <div class="testimonial-card">
                        <div class="testimonail-name">
                            <p><b>Name</b></p>
                            <p><span>school name</span></p>
                        </div>
                        <div class="testimonial-message">
                            <p>" Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero inventore consequatur nostrum sunt modi nobis laudantium corporis animi alias. Vitae cupiditate dolorum fuga quo ullam ducimus magni perspiciatis, delectus consectetur? "</p>
                        </div>
                     </div> 
                </div>
               

                  <i class="fa-solid fa-arrow-down scrl"></i>
   
                 
            </div>

            <div class="testimonial-form">
                <div class="form-container">
                    <h2>Feedback</h2>
                    <form action="">
                          <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" placeholder="enter your name" name="name">
                     </div>
                      <div class="form-group">
                        <label for="education">Education:</label>
                        <input type="text" placeholder="enter your name" name="education">
                     </div>
                       <div class="form-group">
                        <label for="education">Message:</label>
                        <textarea name="msg" id="msg" rows="3"></textarea>
                     </div>
                     <input type="submit" name="submit" class="rev-btn">
                    </form>
                     
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

</body>
<script src="./user_assets/js/user_dashboad.js"></script>
<script>
//   let notesOpen = document.querySelector('.note-card');
//   notesOpen.addEventListener('click',() =>{
//     window.location.href = "./view/notes_view.php" 
//   });


// Function to toggle dark mode
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

// Add event listener to your dark mode toggle button
const darkModeToggle = document.getElementById('dark-mode-toggle');
if (darkModeToggle) {
  darkModeToggle.addEventListener('click', toggleDarkMode);
}
</script>


<script>
    let up = document.querySelector('.fa-arrow-up');
    let down = document.querySelector('.fa-arrow-down');
    let testimonial = document.querySelector('.testimonial-list');

    up.addEventListener('click', () => {
        testimonial.scrollTop += 100;
    });

    down.addEventListener('click', () => {
        testimonial.scrollTop -= 100; 
    });
</script>


</html>

