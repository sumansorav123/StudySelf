<?php
require "../../config/Database.php";
session_start();
// if set session then enter userdashboard

if(!isset($_SESSION['username'])) {
  //  header("Location: ../../index.php");
      echo '<script>window.location.href = " ../../index.php";</script>';
    exit();
}
?>
<!-- logout and session destroy -->
<?php
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo '<script>window.location.href = " ../../index.php";</script>';
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
    <link rel="stylesheet" href="../user_assets/css/style.css">
   
 
</head>
<style>
    header{
          background: linear-gradient(135deg,rgba(1, 15, 37, 0.9),rgba(0, 155, 190, 0.699));
    }
    
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


</style>
<body>
        <header id="header">
        <div class="navbar">
            <div class="logo" href="../user_dashboad.php">
                <i class="fas fa-book-open-reader"></i>
                <span>StudySelf</span>
            </div>
         
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
    <br>
    <br>
    <section class="heading">

            <div class="top-header">
            <a href="../user_dashboard.php" class="cta-button">Home</a>> <a href="#" class="cta-button">Enroll</a>
            </div>
    </section>
    <br>
    <br>


      <section class="notes" id="notes">
        <div class="notes-container">

            <div class="section-title">
                <h2>Enrolled Study Notes</h2>
            </div>
           
            <div class="notes-filter">
                 <form action="" style="width:-webkit-fill-available;">
                    <div class="search-data">
                        <input type="search" name="search-data" id="search-data" class="search-input" placeholder="Search Course here ....">
                    </div>
                 </form>
            </div>
            <div class="notes-grid ">
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="JavaScript Notes">
                        <span class="note-category">Python</span>
                    </div>
                    <div class="note-content">
                        <h3>Python </h3>
                        <p>
                            Comprehensive guide to  including variables, functions, and DOM
                            manipulation.
                        </p>
                        <div class="note-stats">
                            
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
                        </div>
                    </div>
                </div>

                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="JavaScript Notes">
                        <span class="note-category">java</span>
                    </div>
                    <div class="note-content">
                        <h3>java </h3>
                        <p>
                            Comprehensive guide to Java fundamentals including variables, functions,
                            manipulation.
                        </p>
                        <div class="note-stats">
                            
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
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
                <p><i class="fas fa-envelope"></i> info@noteshere.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 StudySelf. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>




</body>
<script>
    // Mobile Menu Toggle
const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

function toggleMobileMenu() {
  navLinks.classList.toggle("active");
  hamburger.innerHTML = navLinks.classList.contains("active")
    ? '<i class="fas fa-times"></i>'
    : '<i class="fas fa-bars"></i>';
}

hamburger.addEventListener("click", toggleMobileMenu);

// Close mobile menu when clicking a link
document.querySelectorAll(".nav-links a").forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.classList.remove("active");
    hamburger.innerHTML = '<i class="fas fa-bars"></i>';
  });
});

// Sticky Header
const header = document.getElementById("header");

function handleScroll() {
  if (window.scrollY > 100) {
    header.classList.add("scrolled");
    navLinks.classList.remove("active");
    hamburger.innerHTML = '<i class="fas fa-bars"></i>';
  } else {
    header.classList.remove("scrolled");
  }
}

window.addEventListener("scroll", handleScroll);

// Testimonial Slider
class TestimonialSlider {
  constructor() {
    this.slides = document.querySelectorAll(".testimonial-card");
    this.dots = document.querySelectorAll(".slider-dot");
    this.currentIndex = 0;
    this.interval = null;
    this.slideDuration = 5000;
    
    this.init();
  }
  
  init() {
    if (this.slides.length > 0) {
      this.showSlide(this.currentIndex);
      this.startAutoSlide();
      this.addEventListeners();
    }
  }
  
  showSlide(index) {
    // Handle index wrapping
    if (index >= this.slides.length) this.currentIndex = 0;
    else if (index < 0) this.currentIndex = this.slides.length - 1;
    else this.currentIndex = index;
    
    // Update slides and dots
    this.slides.forEach(slide => {
      slide.classList.remove("active");
      slide.style.opacity = 0;
    });
    
    this.dots.forEach(dot => dot.classList.remove("active"));
    
    setTimeout(() => {
      this.slides[this.currentIndex].classList.add("active");
      this.slides[this.currentIndex].style.opacity = 1;
    }, 10);
    
    if (this.dots.length > 0) {
      this.dots[this.currentIndex].classList.add("active");
    }
  }
  
  nextSlide() {
    this.showSlide(this.currentIndex + 1);
  }
  
  prevSlide() {
    this.showSlide(this.currentIndex - 1);
  }
  
  startAutoSlide() {
    this.interval = setInterval(() => this.nextSlide(), this.slideDuration);
  }
  
  pauseAutoSlide() {
    clearInterval(this.interval);
  }
  
  addEventListeners() {
    // Dot navigation
    this.dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        this.pauseAutoSlide();
        this.showSlide(index);
        this.startAutoSlide();
      });
    });
    
    // Optional keyboard navigation
    document.addEventListener("keydown", (e) => {
      if (e.key === "ArrowRight") this.nextSlide();
      if (e.key === "ArrowLeft") this.prevSlide();
    });
  }
}

// Initialize slider if elements exist
if (document.querySelector(".testimonial-card")) {
  new TestimonialSlider();
}

// Testimonial Pagination
class TestimonialPagination {
  constructor() {
    this.grid = document.querySelector(".testimonials-grid");
    this.cards = document.querySelectorAll(".testimonial-card");
    this.paginationContainer = document.getElementById("testimonial-pagination");
    this.perPage = 3;
    this.currentPage = 1;
    
    if (this.cards.length > 0) {
      this.init();
    }
  }
  
  init() {
    this.displayCards();
    this.createPagination();
    this.addResponsiveHandlers();
  }
  
  displayCards() {
    const start = (this.currentPage - 1) * this.perPage;
    const end = start + this.perPage;
    
    this.cards.forEach((card, index) => {
      card.style.display = (index >= start && index < end) ? "grid" : "none";
    });
  }
  
  createPagination() {
    const pageCount = Math.ceil(this.cards.length / this.perPage);
    this.paginationContainer.innerHTML = "";
    
    // Previous button
    if (pageCount > 1) {
      const prevBtn = document.createElement("button");
      prevBtn.innerHTML = "&laquo;";
      prevBtn.addEventListener("click", () => {
        if (this.currentPage > 1) {
          this.currentPage--;
          this.updateDisplay();
        }
      });
      this.paginationContainer.appendChild(prevBtn);
    }
    
    // Page buttons
    for (let i = 1; i <= pageCount; i++) {
      const btn = document.createElement("button");
      btn.textContent = i;
      if (i === this.currentPage) btn.classList.add("active");
      
      btn.addEventListener("click", () => {
        this.currentPage = i;
        this.updateDisplay();
      });
      
      this.paginationContainer.appendChild(btn);
    }
    
    // Next button
    if (pageCount > 1) {
      const nextBtn = document.createElement("button");
      nextBtn.innerHTML = "&raquo;";
      nextBtn.addEventListener("click", () => {
        if (this.currentPage < pageCount) {
          this.currentPage++;
          this.updateDisplay();
        }
      });
      this.paginationContainer.appendChild(nextBtn);
    }
  }
  
  updateDisplay() {
    this.displayCards();
    this.updateActiveButton();
  }
  
  updateActiveButton() {
    const buttons = this.paginationContainer.querySelectorAll("button");
    buttons.forEach(btn => btn.classList.remove("active"));
    
    // The active button is at position this.currentPage (0-indexed would be +1 for prev button)
    buttons[this.currentPage]?.classList.add("active");
  }
  
  addResponsiveHandlers() {
    const mediaQuery = window.matchMedia("(max-width: 768px)");
    this.handleResponsive(mediaQuery);
    mediaQuery.addListener(this.handleResponsive);
  }
  
  handleResponsive = (mq) => {
    this.perPage = mq.matches ? 1 : 3;
    this.currentPage = 1;
    this.displayCards();
    this.createPagination();
  }
}

// Initialize pagination if elements exist
if (document.querySelector(".testimonials-grid")) {
  new TestimonialPagination();
}

// User Menu Toggle for Mobile
const userIcon = document.querySelector(".fa-user");
if (userIcon) {
  const userMenu = document.querySelector(".btn ul");
  
  function checkMobileMenu() {
    if (window.matchMedia("(max-width: 968px)").matches) {
      userIcon.style.display = "block";
      userMenu.style.visibility = "hidden";
    } else {
      userIcon.style.display = "none";
      userMenu.style.visibility = "visible";
    }
  }
  
  userIcon.addEventListener("click", () => {
    userMenu.style.visibility = userMenu.style.visibility === "visible" 
      ? "hidden" 
      : "visible";
  });
  
  window.addEventListener("resize", checkMobileMenu);
  checkMobileMenu();
}

// Search Functionality
const searchInput = document.getElementById("search-data");
if (searchInput) {
  searchInput.addEventListener("input", function() {
    const term = this.value.trim().toLowerCase();
    const cards = document.querySelectorAll(".note-card");
    
    cards.forEach(card => {
      const title = card.querySelector("h3")?.textContent.toLowerCase() || "";
      const category = card.querySelector(".note-category")?.textContent.toLowerCase() || "";
      
      if (title.includes(term) || category.includes(term)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";

      }
    });
  });
}

// Scroll Animations
function animateOnScroll() {
  const elements = document.querySelectorAll(".feature-card, .note-card");
  const windowHeight = window.innerHeight;
  
  elements.forEach(el => {
    const elementTop = el.getBoundingClientRect().top;
    const revealPoint = 150;
    
    if (elementTop < windowHeight - revealPoint) {
      el.style.opacity = "1";
      el.style.transform = "translateY(0)";
    }
  });
}

// Initialize scroll animations
document.querySelectorAll(".feature-card, .note-card").forEach(el => {
  el.style.opacity = "0";
  el.style.transform = "translateY(20px)";
  el.style.transition = "all 0.5s ease";
});

window.addEventListener("scroll", animateOnScroll);
window.addEventListener("load", animateOnScroll);
</script>

</html>