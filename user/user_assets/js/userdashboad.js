document.addEventListener('DOMContentLoaded', function() {
    // ===== Navigation and Mobile Menu =====
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

    // ===== Sticky Header =====
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

    // ===== Dark Mode Toggle =====
    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    const html = document.documentElement;
    
    if (darkModeToggle) {
        // Check for saved theme preference
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            html.setAttribute('data-theme', 'dark');
        }

        // Toggle function
        darkModeToggle.addEventListener('click', function() {
            if (html.getAttribute('data-theme') === 'dark') {
                html.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    }

    // ===== Search Functionality =====
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

    // ===== Filter Functionality =====
    document.querySelectorAll('[data-filter]').forEach(filter => {
        filter.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter').toLowerCase();
            const noteCards = document.querySelectorAll('.note-card');
            
            noteCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                card.style.display = (filterValue === 'all' || cardCategory.includes(filterValue))
                    ? 'block'
                    : 'none';
            });
        });
    });

    // ===== Testimonial Alert =====
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

    // ===== User Menu Toggle for Mobile =====
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

    // ===== Scroll Animations =====
    function initScrollAnimations() {
        const elements = document.querySelectorAll(".feature-card, .note-card");
        const windowHeight = window.innerHeight;
        
        // Set initial state
        elements.forEach(el => {
            el.style.opacity = "0";
            el.style.transform = "translateY(20px)";
            el.style.transition = "all 0.5s ease";
        });
        
        function animateOnScroll() {
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