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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudySelf</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <li><a href="#home">Home</a></li>
                <li><a href="./view/enroll.php">enroll</a></li>
                <li><a href="#notes">Notes</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
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

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <div class="hero-text">
                <h1 style="padding:2px 0px ">Premium Study Notes for Academic <span style="color: #27AE60;"> Success </span> </h1>
                <p>Access high-quality, curated notes from top students and educators. Boost your grades and save time
                    with our comprehensive study materials.</p>
                <div class="hero-buttons">
                    <a href="#" class="cta-button"
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
                <!-- Note 1 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="JavaScript Notes">
                        <span class="note-category">Python</span>
                    </div>
                    <div class="note-content">
                        <h3>Python </h3>
                        <p>
                            Comprehensive guide to JavaScript fundamentals including variables, functions, and DOM
                            manipulation.
                        </p>
                        <div class="note-stats">
                            
                            <span class="note-price">price: ₹ 39 </span>
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
                        </div>
                    </div>
                </div>
        

        
                <!-- Note 2 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="JavaScript Notes">
                        <span class="note-category note-title">JavaScript</span>
                    </div>
                    <div class="note-content">
                        <h3>JavaScript Basics</h3>
                        <p>
                            Comprehensive guide to JavaScript fundamentals including variables, functions, and DOM
                            manipulation.
                        </p>
                        <div class="note-stats">
                            
                            <span class="note-price">price: ₹ 12 </span>
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Note 3 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Java Notes">
                        <span class="note-category note-title">Java</span>
                    </div>
                    <div class="note-content">
                        <h3>Java Programming Essentials</h3>
                        <p>Learn the core concepts of Java programming including OOP principles, exception handling,
                            and collections.</p>
                        <div class="note-stats">
                            
                            <span class="note-price">price: ₹ 14 </span>
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Note 4 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="React Notes">
                        <span class="note-category note-title">React</span>
                    </div>
                    <div class="note-content">
                        <h3>React.js Fundamentals</h3>
                        <p>Master the basics of React.js including components, state management, and hooks for building
                            interactive UIs.</p>
                        <div class="note-stats">
                            
                            <span class="note-price">price: ₹ 18 </span>
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Note 5 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image ">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="SQL Notes">
                        <span class="note-category note-title">SQL</span>
                    </div>
                    <div class="note-content">
                        <h3>SQL programming Management</h3>
                        <p>Learn SQL basics, programming design, and advanced queries for effective data management and
                            analysis.</p>
                        <div class="note-stats">
                            
                            <span class="note-price">price: ₹ 15 </span>
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Note 6 -->
                <div class="note-card" data-category="10thbiharBoad">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="10th Bihar Boad Notes">
                        <span class="note-category note-title">Physics</span>
                    </div>
                    <div class="note-content">
                        <h3>10th Bihar Boad Physics Notes</h3>
                        <p>testimonial-detailed notes covering key concepts in physics for 10th-grade students,  and thermodynamics.</p>
                        <div class="note-stats">
                            
                            <span class="note-price">price: ₹ 10 </span>
                              <a href="#" class="btn-download">Download<i class="fa-solid fa-download" style="color: #eaeef5;"></i></a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="section-title">
            <h2>Testimonials</h2>
            <p>Read what other students have to say about their experience with Studyself</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Sarah L.</p>
                    <p class="testimonial-role">Biology Major</p>
                </div>
                <blockquote class="testimonial-quote">
                    Studyself's biology notes were a lifesaver! They were so well-organized and easy to understand,
                    which made studying for my exams much less stressful.
                </blockquote>
         
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">John D.</p>
                    <p class="testimonial-role">College Student</p>
                </div>
                <blockquote class="testimonial-quote">
                    The calculus notes were incredibly helpful for my advanced math course. The step-by-step solutions
                    made even the most challenging problems seem manageable.
                </blockquote>

            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Emily R.</p>
                    <p class="testimonial-role">High School Student</p>
                    </div>
                <blockquote class="testimonial-quote">
                    I used the world history notes to prepare for my final exam and scored the highest in my class! The
                    timelines and summaries were fantastic.
                </blockquote>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">David K.</p>
                    <p class="testimonial-role">Computer Science Student</p>
                </div>
                <blockquote class="testimonial-quote">
                    The organic chemistry notes broke down complex reactions into easy-to-follow mechanisms. Definitely
                    improved my understanding of the subject.
                </blockquote>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Laura W.</p>
                    <p class="testimonial-role">Economics Major</p>
                </div>
                <blockquote class="testimonial-quote">
                    The microeconomics notes provided a clear and concise overview of key concepts. Helped me grasp the
                    fundamentals quickly.
                </blockquote>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Michael R.</p>
                    <p class="testimonial-role">Data Science Student</p>
                </div>
                <blockquote class="testimonial-quote">
                    The statistics notes were excellent for brushing up on concepts before my data analysis project.
                    Well-explained and easy to reference.
                </blockquote>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Sophia T.</p>
                    <p class="testimonial-role">High School Student</p>
                </div>
                <blockquote class="testimonial-quote">
                    I found the software engineering notes incredibly helpful for understanding system design
                    principles. Highly recommended for CS students.
                </blockquote>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                <p class="testimonial-author">Daniel S.</p>
                <p class="testimonial-role">Marketing Intern</p>
                </div>
                <blockquote class="testimonial-quote">
                    The marketing strategy notes gave me practical insights that I could immediately apply to my
                    internship. Very valuable resource!
                </blockquote>
            
            </div>
             <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Michael R.</p>
                    <p class="testimonial-role">Data Science Student</p>
                </div>
                <blockquote class="testimonial-quote">
                    The statistics notes were excellent for brushing up on concepts before my data analysis project.
                    Well-explained and easy to reference.
                </blockquote>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Sophia T.</p>
                    <p class="testimonial-role">High School Student</p>
                </div>
                <blockquote class="testimonial-quote">
                    I found the software engineering notes incredibly helpful for understanding system design
                    principles. Highly recommended for CS students.
                </blockquote>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-detail">
                <p class="testimonial-author">Daniel S.</p>
                <p class="testimonial-role">Marketing Intern</p>
                </div>
                <blockquote class="testimonial-quote">
                    The marketing strategy notes gave me practical insights that I could immediately apply to my
                    internship. Very valuable resource!
                </blockquote>
            
            </div>
        </div>
      <div class="testimonial-pagination" id="testimonial-pagination">
            
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
            <p>&copy; 2025 StudySelf. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of
                    Service</a></p>
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
const testimonialSlides = document.querySelectorAll(".testimonial-slide");
const sliderDots = document.querySelectorAll(".slider-dot");
let currentSlide = 0;

function showSlide(index) {
  testimonialSlides.forEach((slide) => slide.classList.remove("active"));
  sliderDots.forEach((dot) => dot.classList.remove("active"));

  testimonialSlides[index].classList.add("active");
  sliderDots[index].classList.add("active");
  currentSlide = index;
}

sliderDots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    showSlide(index);
  });
});

// Auto slide change
setInterval(() => {
  currentSlide = (currentSlide + 1) % testimonialSlides.length;
  showSlide(currentSlide);
}, 5000);

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();

    const targetId = this.getAttribute("href");
    if (targetId === "#") return;

    const targetElement = document.querySelector(targetId);
    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop - 80,
        behavior: "smooth",
      });
    }
  });
});

// Animation on scroll
function animateOnScroll() {
  const elements = document.querySelectorAll(
    ".feature-card, .note-card, .testimonial-slide"
  );

  elements.forEach((element) => {
    const elementPosition = element.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.2;

    if (elementPosition < screenPosition) {
      element.style.opacity = "1";
      element.style.transform = "translateY(0)";
    }
  });
}

// Set initial state for animated elements
document.querySelectorAll(".feature-card, .note-card").forEach((element) => {
  element.style.opacity = "0";
  element.style.transform = "translateY(20px)";
  element.style.transition = "all 0.5s ease";
});

window.addEventListener("scroll", animateOnScroll);
window.addEventListener("load", animateOnScroll);

// Testimonial Pagination Logic
const testimonialGrid = document.querySelector(".testimonials-grid");
const testimonialCards = document.querySelectorAll(".testimonial-card");
const paginationContainer = document.getElementById("testimonial-pagination");
const testimonialsPerPage = 3;
let currentPage = 1;

function displayTestimonials(page) {
  const startIndex = (page - 1) * testimonialsPerPage;
  const endIndex = startIndex + testimonialsPerPage;

  testimonialCards.forEach((card, index) => {
    if (index >= startIndex && index < endIndex) {
      card.style.display = "grid";
    } else {
      card.style.display = "none";
    }
  });
}

function generatePaginationButtons() {
  const totalPages = Math.ceil(testimonialCards.length / testimonialsPerPage);
  paginationContainer.innerHTML = "";

  for (let i = 1; i <= totalPages; i++) {
    const button = document.createElement("button");
    button.textContent = i;
    if (i === currentPage) {
      button.classList.add("active");
    }
    button.addEventListener("click", () => {
      currentPage = i;
      displayTestimonials(currentPage);
      updateActiveButton();
    });
    paginationContainer.appendChild(button);
  }

  // Add "Next" button if there are more pages
  if (totalPages > 1) {
    const nextButton = document.createElement("button");
    nextButton.textContent = "Next";
    nextButton.addEventListener("click", () => {
      if (currentPage < totalPages) {
        currentPage++;
        displayTestimonials(currentPage);
        updateActiveButton();
      }
    });
    paginationContainer.appendChild(nextButton);
  }
}

function updateActiveButton() {
  const buttons = paginationContainer.querySelectorAll("button");
  buttons.forEach((button) => button.classList.remove("active"));
  buttons[currentPage - 1]?.classList.add("active"); // Select the correct numbered button
}

// Initial setup
displayTestimonials(currentPage);
generatePaginationButtons();



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

