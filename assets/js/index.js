document.addEventListener("DOMContentLoaded", function() {
    // Scroll reveal effect
    const revealElements = document.querySelectorAll(".reveal");
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        },
        { threshold: 0.2 }
    );
    revealElements.forEach(el => revealObserver.observe(el));

    // Navigation functionality
    const hamburger = document.querySelector(".hamburger");
    const navLinks = document.querySelector(".nav-links");
    const header = document.getElementById("header");

    function toggleMobileMenu() {
        navLinks.classList.toggle("active");
        hamburger.innerHTML = navLinks.classList.contains("active")
            ? '<i class="fa-solid fa-xmark"></i>'
            : '<i class="fa-solid fa-bars"></i>';
    }

    if (hamburger && navLinks) {
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
    }

    // Sticky header
    function handleScroll() {
        if (window.scrollY > 100) {
            header?.classList.add("scrolled");
            navLinks?.classList.remove("active");
            if (hamburger) hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
        } else {
            header?.classList.remove("scrolled");
        }
    }
    window.addEventListener("scroll", handleScroll);

    // Dark Mode Functionality
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const html = document.documentElement;
    
    function initTheme() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            html.setAttribute('data-theme', 'dark');
        }
        updateToggleIcon();
    }
    
    function toggleTheme() {
        if (html.getAttribute('data-theme') === 'dark') {
            html.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
        } else {
            html.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        }
        updateToggleIcon();
    }
    
    function updateToggleIcon() {
        const isDark = html.getAttribute('data-theme') === 'dark';
        const moonIcon = darkModeToggle?.querySelector('.fa-moon');
        const sunIcon = darkModeToggle?.querySelector('.fa-sun');
        
        if (moonIcon && sunIcon) {
            moonIcon.style.display = isDark ? 'none' : 'inline';
            sunIcon.style.display = isDark ? 'inline' : 'none';
        }
    }
    
    if (darkModeToggle) {
        initTheme();
        darkModeToggle.addEventListener('click', toggleTheme);
        
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (!localStorage.getItem('theme')) {
                if (e.matches) {
                    html.setAttribute('data-theme', 'dark');
                } else {
                    html.removeAttribute('data-theme');
                }
                updateToggleIcon();
            }
        });
    }

    // User menu toggle
    const userIcon = document.querySelector('.fa-user');
    const userMenu = document.querySelector('.nav-ul, .btn ul');
    
    if (userIcon && userMenu) {
        function checkMobileMenu() {
            if (window.matchMedia("(max-width: 968px)").matches) {
                userIcon.style.display = "block";
                userMenu.style.visibility = "hidden";
            } else {
                userIcon.style.display = "none";
                userMenu.style.visibility = "visible";
            }
        }
        
        userIcon.addEventListener('click', () => {
            userMenu.style.visibility = userMenu.style.visibility === "visible" 
                ? "hidden" 
                : "visible";
        });
        
        window.addEventListener('resize', checkMobileMenu);
        checkMobileMenu();
    }

    // Search functionality
    const searchInput = document.getElementById("search-data");
    if (searchInput) {
        searchInput.addEventListener("input", function() {
            const term = this.value.trim().toLowerCase();
            const cards = document.querySelectorAll(".note-card");
            
            cards.forEach(card => {
                const title = card.querySelector("h3")?.textContent.toLowerCase() || "";
                const category = card.querySelector(".note-category")?.textContent.toLowerCase() || "";
                
                card.style.display = (title.includes(term) || category.includes(term)) 
                    ? "block" 
                    : "none";
            });
        });
    }

    // Testimonial functionality
    function setupTestimonialSlider() {
        const testimonialSlides = document.querySelectorAll(".testimonial-slide");
        const sliderDots = document.querySelectorAll(".slider-dot");
        
        if (testimonialSlides.length > 0) {
            let currentSlide = 0;
            
            function showSlide(index) {
                testimonialSlides.forEach(slide => slide.classList.remove("active"));
                sliderDots.forEach(dot => dot.classList.remove("active"));
                
                testimonialSlides[index].classList.add("active");
                sliderDots[index].classList.add("active");
                currentSlide = index;
            }
            
            sliderDots.forEach((dot, index) => {
                dot.addEventListener("click", () => showSlide(index));
            });
            
            setInterval(() => {
                currentSlide = (currentSlide + 1) % testimonialSlides.length;
                showSlide(currentSlide);
            }, 5000);
        }
    }
    
    function setupTestimonialPagination() {
        const testimonialGrid = document.querySelector(".testimonials-grid");
        const testimonialCards = document.querySelectorAll(".testimonial-card");
        const paginationContainer = document.getElementById("testimonial-pagination");
        
        if (testimonialCards.length > 0 && paginationContainer) {
            const testimonialsPerPage = 3;
            let currentPage = 1;
            
            function displayTestimonials(page) {
                const startIndex = (page - 1) * testimonialsPerPage;
                const endIndex = startIndex + testimonialsPerPage;
                
                testimonialCards.forEach((card, index) => {
                    card.style.display = (index >= startIndex && index < endIndex) 
                        ? "grid" 
                        : "none";
                });
            }
            
            function generatePaginationButtons() {
                const totalPages = Math.ceil(testimonialCards.length / testimonialsPerPage);
                paginationContainer.innerHTML = "";
                
                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement("button");
                    button.textContent = i;
                    if (i === currentPage) button.classList.add("active");
                    button.addEventListener("click", () => {
                        currentPage = i;
                        displayTestimonials(currentPage);
                        updateActiveButton();
                    });
                    paginationContainer.appendChild(button);
                }
                
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
                buttons.forEach(button => button.classList.remove("active"));
                buttons[currentPage - 1]?.classList.add("active");
            }
            
            displayTestimonials(currentPage);
            generatePaginationButtons();
        }
    }
    
    setupTestimonialSlider();
    setupTestimonialPagination();

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function(e) {
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
    function initScrollAnimations() {
        const elements = document.querySelectorAll(".feature-card, .note-card, .testimonial-slide");
        
        elements.forEach(element => {
            element.style.opacity = "0";
            element.style.transform = "translateY(20px)";
            element.style.transition = "all 0.5s ease";
        });
        
        function animateOnScroll() {
            const windowHeight = window.innerHeight;
            const revealPoint = 150;
            
            elements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                
                if (elementTop < windowHeight - revealPoint) {
                    el.style.opacity = "1";
                    el.style.transform = "translateY(0)";
                }
            });
        }
        
        window.addEventListener("scroll", animateOnScroll);
        window.addEventListener("load", animateOnScroll);
    }
    
    initScrollAnimations();
});


function preventBack() {
    window.history.forward();
}

setTimeout(preventBack, 0);

window.onunload = function() {
   
};