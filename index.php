<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudySelf</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
     <!-- Header -->
    <header id="header">
        <div class="navbar">
            <div class="logo">
                <i class="fas fa-book-open"></i>
                <span>StudySelf</span>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#notes">Notes</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="btn">
                <i class="fa-solid fa-user"  style="display: none;"></i>
                <ul>
                    <a href="#" class="cta-button">Sign Up</a>
                    <a href="#" class="cta-button">Sign In</a>
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
                <h1>Premium Study Notes for Academic <span style="color: #27AE60;"> Success </span> </h1>
                <p>Access high-quality, curated notes from top students and educators. Boost your grades and save time
                    with our comprehensive study materials.</p>
                <div class="hero-buttons">
                    <a href="#" class="cta-button"
                        style="background-color: transparent; color: white; border: 2px solid white;">Explore More
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
            <h2>Why Choose NoteSphere?</h2>
            <p>We provide the best study resources to help you excel in your academic journey</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Premium Quality</h3>
                <p>All notes are carefully curated and verified by top students and educators to ensure accuracy and
                    completeness.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Easy to Understand</h3>
                <p>Complex concepts broken down into simple, digestible formats with visuals and examples for better
                    retention.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Save Time</h3>
                <p>Spend less time organizing your study materials and more time actually learning and mastering the
                    content.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Access Anywhere</h3>
                <p>Available on all devices - study on your laptop, tablet, or phone whenever and wherever you want.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>Exam Focused</h3>
                <p>Notes are tailored to help you ace your exams with key points, common questions, and study
                    strategies.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Community Driven</h3>
                <p>Contribute your own notes and earn rewards while helping other students succeed in their studies.</p>
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
                <button class="filter-btn active" data-filter="all">All Subjects</button>
                <button class="filter-btn" data-filter="programming">programming</button>
                <button class="filter-btn" data-filter="10thbiharBoad">10th Bihar Boad</button>
                <button class="filter-btn" data-filter="12thbiharBoad">12th Bihar Boad</button>
            </div>
            <div class="notes-grid">
                <!-- Note 1 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Chemistry Notes">
                        <span class="note-category">Pyhton</span>
                    </div>
                    <div class="note-content">
                        <h3>Python Notes For Beginner</h3>
                        <p>Introduction to Python programming with syntax, data types, control structures, and libraries
                            for data analysis.</p>
                        <div class="note-stats">
                            <span><i class="fas fa-eye"></i>2345</span>
                            <span class="note-price"> ₹ 16 </span>
                        </div>
                    </div>
                </div>

                <!-- Note 2 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="JavaScript Notes">
                        <span class="note-category">JavaScript</span>
                    </div>
                    <div class="note-content">
                        <h3>JavaScript Basics</h3>
                        <p>
                            Comprehensive guide to JavaScript fundamentals including variables, functions, and DOM
                            manipulation.
                        </p>
                        <div class="note-stats">
                            <span><i class="fas fa-eye"></i> 1,234</span>
                            <span class="note-price"> ₹ 12 </span>
                        </div>
                    </div>
                </div>
                <!-- Note 3 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="Java Notes">
                        <span class="note-category">Java</span>
                    </div>
                    <div class="note-content">
                        <h3>Java Programming Essentials</h3>
                        <p>Learn the core concepts of Java programming including OOP principles, exception handling,
                            and collections.</p>
                        <div class="note-stats">
                            <span><i class="fas fa-eye"></i> 1,567</span>
                            <span class="note-price"> ₹ 14 </span>
                        </div>
                    </div>
                </div>

                <!-- Note 4 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="React Notes">
                        <span class="note-category">React</span>
                    </div>
                    <div class="note-content">
                        <h3>React.js Fundamentals</h3>
                        <p>Master the basics of React.js including components, state management, and hooks for building
                            interactive UIs.</p>
                        <div class="note-stats">
                            <span><i class="fas fa-eye"></i> 2,345</span>
                            <span class="note-price"> ₹ 18 </span>
                        </div>
                    </div>
                </div>
                <!-- Note 5 -->
                <div class="note-card" data-category="programming">
                    <div class="note-image ">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="SQL Notes">
                        <span class="note-category">SQL</span>
                    </div>
                    <div class="note-content">
                        <h3>SQL programming Management</h3>
                        <p>Learn SQL basics, programming design, and advanced queries for effective data management and
                            analysis.</p>
                        <div class="note-stats">
                            <span><i class="fas fa-eye"></i> 1,890</span>
                            <span class="note-price"> ₹ 15 </span>
                        </div>
                    </div>
                </div>

                <!-- Note 6 -->
                <div class="note-card" data-category="10thbiharBoad">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="10th Bihar Boad Notes">
                        <span class="note-category">Physics</span>
                    </div>
                    <div class="note-content">
                        <h3>10th Bihar Boad Physics Notes</h3>
                        <p>Detailed notes covering key concepts in physics for 10th-grade students, including mechanics,
                            optics, and thermodynamics.</p>
                        <div class="note-stats">
                            <span><i class="fas fa-eye"></i> 1,234</span>
                            <span class="note-price"> ₹ 10 </span>
                        </div>
                    </div>
                </div>
                <!-- Note 7 -->
                <div class="note-card" data-category="12thbiharBoad">
                    <div class="note-image">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            alt="12th Bihar Boad Notes">
                        <span class="note-category">Chemistry</span>
                    </div>
                    <div class="note-content">
                        <h3>12th Bihar Boad Chemistry Notes</h3>
                        <p>Comprehensive notes for 12th-grade chemistry covering organic, inorganic, and physical
                            chemistry with solved examples.</p>
                        <div class="note-stats">
                            <span><i class="fas fa-eye"></i> 1,567</span>
                            <span class="note-price"> ₹ 12 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="section-title">
            <h2>What Students Say</h2>
            <p>Read what other students have to say about their experience with NoteSphere</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Sarah">
                </div>
                <blockquote class="testimonial-quote">
                    NoteSphere's biology notes were a lifesaver! They were so well-organized and easy to understand,
                    which made studying for my exams much less stressful.
                </blockquote>
                <p class="testimonial-author">Sarah M.</p>
                <p class="testimonial-role">University Student</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="John">
                </div>
                <blockquote class="testimonial-quote">
                    The calculus notes were incredibly helpful for my advanced math course. The step-by-step solutions
                    made even the most challenging problems seem manageable.
                </blockquote>
                <p class="testimonial-author">John B.</p>
                <p class="testimonial-role">Engineering Major</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/women/3.jpg" alt="Emily">
                </div>
                <blockquote class="testimonial-quote">
                    I used the world history notes to prepare for my final exam and scored the highest in my class! The
                    timelines and summaries were fantastic.
                </blockquote>
                <p class="testimonial-author">Emily L.</p>
                <p class="testimonial-role">History Enthusiast</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/men/4.jpg" alt="David">
                </div>
                <blockquote class="testimonial-quote">
                    The organic chemistry notes broke down complex reactions into easy-to-follow mechanisms. Definitely
                    improved my understanding of the subject.
                </blockquote>
                <p class="testimonial-author">David K.</p>
                <p class="testimonial-role">Pre-Med Student</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/women/5.jpg" alt="Jessica">
                </div>
                <blockquote class="testimonial-quote">
                    The microeconomics notes provided a clear and concise overview of key concepts. Helped me grasp the
                    fundamentals quickly.
                </blockquote>
                <p class="testimonial-author">Jessica P.</p>
                <p class="testimonial-role">Business Student</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/men/6.jpg" alt="Michael">
                </div>
                <blockquote class="testimonial-quote">
                    The statistics notes were excellent for brushing up on concepts before my data analysis project.
                    Well-explained and easy to reference.
                </blockquote>
                <p class="testimonial-author">Michael R.</p>
                <p class="testimonial-role">Data Science Aspirant</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/women/7.jpg" alt="Olivia">
                </div>
                <blockquote class="testimonial-quote">
                    I found the software engineering notes incredibly helpful for understanding system design
                    principles. Highly recommended for CS students.
                </blockquote>
                <p class="testimonial-author">Olivia G.</p>
                <p class="testimonial-role">Computer Science Student</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-avatar">
                    <img src="https://randomuser.me/api/portraits/men/8.jpg" alt="Daniel">
                </div>
                <blockquote class="testimonial-quote">
                    The marketing strategy notes gave me practical insights that I could immediately apply to my
                    internship. Very valuable resource!
                </blockquote>
                <p class="testimonial-author">Daniel S.</p>
                <p class="testimonial-role">Marketing Intern</p>
            </div>
        </div>
        <div class="testimonial-pagination" id="testimonial-pagination">
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Boost Your Grades?</h2>
            <p>Join thousands of students who are achieving academic success with NoteSphere. Sign up today and get
                access to premium study materials.</p>
            <a href="#" class="cta-button"
                style="background-color: white; color: var(--primary); margin: 0 auto; display: inline-block;">Sing
                Up</a>
            <a href="#" class="cta-button"
                style="background-color: white; color: var(--primary); margin: 0 auto; display: inline-block;">Sign
                In</a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="footer-container">
            <div class="footer-col">
                <h3>About NoteSphere</h3>
                <p>NoteSphere is a platform dedicated to helping students succeed by providing high-quality, curated
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
<script src="./assets/js/script.js"></script>
</html>