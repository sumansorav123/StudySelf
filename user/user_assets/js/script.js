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
<<<<<<< HEAD
       
=======
        
>>>>>>> 8b2060bfa3f59d01d304550e0681c53bc52f5603
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



// pagination 

   // Testimonial Slider
        const testimonialSlides = document.querySelectorAll('.testimonial-slide');
        const sliderDots = document.querySelectorAll('.slider-dot');
        let currentSlide = 0;

        function showSlide(index) {
            testimonialSlides.forEach(slide => slide.classList.remove('active'));
            sliderDots.forEach(dot => dot.classList.remove('active'));

            testimonialSlides[index].classList.add('active');
            sliderDots[index].classList.add('active');
            currentSlide = index;
        }

        sliderDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Auto slide change
        setInterval(() => {
            currentSlide = (currentSlide + 1) % testimonialSlides.length;
            showSlide(currentSlide);
        }, 5000);

        

        // Testimonial Pagination Logic
        const testimonialGrid = document.querySelector('.testimonials-grid');
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        const paginationContainer = document.getElementById('testimonial-pagination');
        const testimonialsPerPage = 3;
        let currentPage = 1;

        function displayTestimonials(page) {
            const startIndex = (page - 1) * testimonialsPerPage;
            const endIndex = startIndex + testimonialsPerPage;

            testimonialCards.forEach((card, index) => {
                if (index >= startIndex && index < endIndex) {
                    card.style.display = 'grid';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function generatePaginationButtons() {
            const totalPages = Math.ceil(testimonialCards.length / testimonialsPerPage);
            paginationContainer.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement('button');
                button.textContent = i;
                if (i === currentPage) {
                    button.classList.add('active');
                }
                button.addEventListener('click', () => {
                    currentPage = i;
                    displayTestimonials(currentPage);
                    updateActiveButton();
                });
                paginationContainer.appendChild(button);
            }

            // Add "Next" button if there are more pages
            if (totalPages > 1) {
                const nextButton = document.createElement('button');
                nextButton.textContent = 'Next';
                nextButton.addEventListener('click', () => {
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
            const buttons = paginationContainer.querySelectorAll('button');
            buttons.forEach(button => button.classList.remove('active'));
            buttons[currentPage - 1]?.classList.add('active'); // Select the correct numbered button
        }

        // Initial setup
        displayTestimonials(currentPage);
        generatePaginationButtons();
