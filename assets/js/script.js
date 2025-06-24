const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", () => {
  navLinks.classList.toggle("active");
  hamburger.innerHTML = navLinks.classList.contains("active")
    ? '<i class="fas fa-times"></i>'
    : '<i class="fas fa-times"></i>';
});

// Close mobile menu when clicking a link
document.querySelectorAll(".nav-links a").forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.classList.remove("active");
    hamburger.innerHTML = '<i class="fas fa-bars"></i>';
  });
});

// Sticky Header
const header = document.getElementById("header");

window.addEventListener("scroll", () => {
  const navLinks = document.querySelectorAll(".nav-links");

  if (window.scrollY > 100) {
    header.classList.add("scrolled");
    navLinks.forEach((link) => link.classList.remove("active"));
    hamburger.innerHTML = '<i class="fas fa-bars"></i>';
  } else {
    header.classList.remove("scrolled");
  }
});

// Notes Filter
const filterButtons = document.querySelectorAll(".filter-btn");
const noteCards = document.querySelectorAll(".note-card");

filterButtons.forEach((button) => {
  button.addEventListener("click", () => {
    // Remove active class from all buttons
    filterButtons.forEach((btn) => btn.classList.remove("active"));
    // Add active class to clicked button
    button.classList.add("active");

    const filterValue = button.getAttribute("data-filter");

    noteCards.forEach((card) => {
      if (
        filterValue === "all" ||
        card.getAttribute("data-category") === filterValue
      ) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});

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

const mediaQuery = window.matchMedia("(max-width: 968px)");
const userIcon = document.querySelector(".fa-user");
if (mediaQuery.matches) {
  userIcon.style.display = "block";
} else {
  userIcon.style.display = "none";
}

userIcon.addEventListener("click", () => {
  const menu = document.querySelector(".btn ul");
  if (menu.style.visibility === "hidden" || menu.style.visibility === "") {
    menu.style.visibility = "visible";
  } else {
    menu.style.visibility = "hidden";
  }
});


