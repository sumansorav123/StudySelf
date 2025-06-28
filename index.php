<?php
require 'config/Database.php';
session_start();

if(isset($_SESSION["useremail"], $_SESSION["username"])){
  header("Location: user/user_dashboard.php");
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
     <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
</head>
<style>

    .cta{
        background: linear-gradient(135deg,rgba(1, 15, 37, 0.9),rgba(0, 155, 190, 0.699));
    }
    :root {
  --primary: #046178;
  --secondary: #f5a623;
  --accent: #014a5c;
  --success: #27ae60;
  --danger: #e74c3c;
  --bg: #f9f9f9;
  --card-bg: #ffffff;
  --text-primary: #2c3e50;
  --text-secondary: #7f8c8d;
  --border: #e0e0e0;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background-color: var(--bg);
  color: var(--text-primary);
  overflow-x: hidden;
 scrollbar-width: none;
   -ms-overflow-style: none;
   scroll-behavior: smooth;
}
 
body::-webkit-scrollbar {
  display: none;
}


/* Header Styles */
header {
  /* background: linear-gradient(135deg, var(--primary), #3a7bc8); */
  color: white;
  padding: 1rem 2rem;
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 1000;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

header.scrolled {
  padding: 0.5rem 2rem;
   background: linear-gradient(135deg,rgba(1, 15, 37, 0.9),rgba(0, 155, 190, 0.699));
  /* backdrop-filter: blur(8px); */
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

.logo {
  font-size: 1.8rem;
  font-weight: 700;
  display: flex;
  align-items: center;
}

.logo i {
  margin-right: 10px;
  font-size: 2rem;
  color: var(--secondary);
}

.nav-links {
  display: flex;
  list-style: none;
}

.nav-links li {
  margin-left: 2rem;
}

.nav-links a {
  color: white;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
  position: relative;
  padding: 0.5rem 0;
}

.nav-links a::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background-color: var(--accent);
  transition: width 0.3s ease;
}

.nav-links a:hover::after {
  width: 100%;
}

.cta-button {
  background-color: white;
  color: var(--primary);
  padding: 0.5rem 1.5rem;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
  text-decoration: none;
}

.cta-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  background-color: var(--accent);
  color: white;
}

.hamburger {
  display: none;
  cursor: pointer;
  font-size: 1.5rem;
  color: white;
  transition: all 0.3s ease;
}

.hamburger:hover {
  color: var(--accent);
}

/* Hero Section */
.hero {
  height: 100svh;
  display: flex;
  align-items: center;
  padding: 0 2rem;
 background: linear-gradient(135deg,rgba(1, 15, 37, 0.9),rgba(0, 155, 190, 0.699));
   color: white;
  position: relative;
  overflow: hidden;
}

.hero::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIvPjwvc3ZnPg==");
  opacity: 0.3;
}

.hero-content {
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
  z-index: 1;
}

.hero-text {
  flex: 1;
  padding-right: 2rem;
  transform: translateX(-50px);
  opacity: 0;
  animation: slideIn 0.8s forwards 0.3s;
}

.hero-text h1 {
  font-size: 3.5rem;
  margin-bottom: 1.5rem;
  line-height: 1.2;
}

.hero-text p {
  font-size: 1.2rem;
  margin-bottom: 2rem;
  opacity: 0.9;
  max-width: 600px;
}

.hero-buttons {
  display: flex;
  gap: 1rem;
}

.secondary-button {
  background-color: transparent;
  color: white;
  border: 2px solid white;
  padding: 0.5rem 1.5rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.3s ease;
  text-decoration: none;
  text-align: center;
}

.secondary-button:hover {
  background-color: white;
  color: var(--primary);
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.hero-image {
  flex: 1;
  position: relative;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  transform: translateX(50px);
  opacity: 0;
  animation: slideIn 0.8s forwards 0.5s;
}

.floating-notes {
  position: relative;
  width: 500px;
  height: 500px;
}

.note {
  position: absolute;
  background-color: var(--card-bg);
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
  color: var(--text-primary);
  transition: all 0.5s ease;
  transform-origin: center;
  border: 1px solid var(--border);
}

.note-1 {
  width: 250px;
  height: 300px;
  top: 50px;
  left: 0;
  transform: rotate(-5deg);
  background-color: #f8f3e6;
  z-index: 3;
}

.note-2 {
  width: 280px;
  height: 320px;
  top: 100px;
  left: 150px;
  transform: rotate(3deg);
  background-color: #e6f3f8;
  z-index: 2;
}

.note-3 {
  width: 240px;
  height: 280px;
  top: 180px;
  left: 50px;
  transform: rotate(-8deg);
  background-color: #f8e6e6;
  z-index: 1;
}

.note h3 {
  margin-bottom: 1rem;
  color: var(--primary);
}

.note p {
  font-size: 0.9rem;
  line-height: 1.5;
  color: var(--text-secondary);
}

/* Features Section */
.features {
  padding: 5rem 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

.section-title {
  text-align: center;
  margin-bottom: 3rem;
  transform: translateY(30px);
  opacity: 0;
  animation: fadeInUp 0.8s forwards;
}

.section-title h2 {
  font-size: 2.5rem;
  color: var(--primary);
  margin-bottom: 1rem;
}

.section-title p {
  font-size: 1.1rem;
  color: var(--text-secondary);
  max-width: 700px;
  margin: 0 auto;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.feature-card {
  background-color: var(--card-bg);
  border-radius: 10px;
  padding: 2rem;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  text-align: center;
  border: 1px solid var(--border);
  transform: scale(0.95);
  opacity: 0;
  animation: fadeInScale 0.6s forwards;
}

.feature-card:nth-child(1) {
  animation-delay: 0.2s;
}

.feature-card:nth-child(2) {
  animation-delay: 0.3s;
}

.feature-card:nth-child(3) {
  animation-delay: 0.4s;
}

.feature-card:nth-child(4) {
  animation-delay: 0.5s;
}

.feature-card:nth-child(5) {
  animation-delay: 0.6s;
}

.feature-card:nth-child(6) {
  animation-delay: 0.7s;
}

.feature-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
  border-color: var(--primary);
}

.feature-icon {
  font-size: 3rem;
  color: var(--primary);
  margin-bottom: 1.5rem;
  transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
  color: var(--secondary);
  transform: rotate(15deg) scale(1.1);
}

.feature-card h3 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
  color: var(--text-primary);
}

.feature-card p {
  color: var(--text-secondary);
  line-height: 1.6;
}

/* Notes Section */
.notes {
  padding: 5rem 2rem;
  background-color: var(--bg);
}

.notes-container {
  max-width: 1200px;
  margin: 0 auto;
}

.notes-filter {
  display: flex;
  justify-content: center;
  margin-bottom: 2rem;
  flex-wrap: wrap;
  gap: 1rem;
  transform: translateY(30px);
  opacity: 0;
  animation: fadeInUp 0.8s forwards 0.3s;
}

.filter-btn {
  padding: 0.5rem 1.5rem;
  border-radius: 50px;
  background-color: var(--card-bg);
  border: 1px solid var(--border);
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 500;
  color: var(--text-secondary);
}

.filter-btn:hover,
.filter-btn.active {
  background-color: var(--primary);
  color: white;
  border-color: var(--primary);
  transform: translateY(-3px);
}

.notes-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
}

.note-card {
  background-color: var(--card-bg);
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  border: 1px solid var(--border);
  transform: translateY(30px);
  opacity: 0;
  height: fit-content;
}

.note-card:nth-child(1) {
  animation: fadeInUp 0.6s forwards 0.2s;
}

.note-card:nth-child(2) {
  animation: fadeInUp 0.6s forwards 0.3s;
}

.note-card:nth-child(3) {
  animation: fadeInUp 0.6s forwards 0.4s;
}

.note-card:nth-child(4) {
  animation: fadeInUp 0.6s forwards 0.5s;
}

.note-card:nth-child(5) {
  animation: fadeInUp 0.6s forwards 0.6s;
}

.note-card:nth-child(6) {
  animation: fadeInUp 0.6s forwards 0.7s;
}

.note-card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  border-color: var(--primary);
}

.note-image {
  height: 200px;
  background-color: #eee;
  position: relative;
  overflow: hidden;
}

.note-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.note-card:hover .note-image img {
  transform: scale(1.1);
}

.note-category {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background-color: var(--primary);
  color: white;
  padding: 0.3rem 1rem;
  border-radius: 50px;
  font-size: 0.8rem;
  font-weight: 500;
}

.note-content {
  padding: 1.5rem;
}

.note-content h3 {
  font-size: 1.2rem;
  margin-bottom: 0.5rem;
  color: var(--text-primary);
}

.note-author {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
  font-size: 0.9rem;
  color: var(--text-secondary);
}

.note-author img {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 0.5rem;
  border: 2px solid var(--border);
}

.note-stats {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
  font-size: 0.9rem;
  color: var(--text-secondary);
}

.note-price {
  font-weight: 700;
  color: var(--primary);
  font-size: 1.2rem;
}

/* Testimonials */
.testimonials {
  padding: 5rem 2rem;
  max-width: 1200px;
  margin: 0 auto;
}

.testimonials .section-title {
  margin-bottom: 2rem;
}

.testimonials-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.testimonial-card {
  background-color: var(--card-bg);
  border-radius: 10px;
  padding: 2rem;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  border: 1px solid var(--border);
  text-align: center;
}

.testimonial-avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto 1rem;
  border: 3px solid var(--accent);
}

.testimonial-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.testimonial-quote {
  font-size: 1.1rem;
  line-height: 1.6;
  margin-bottom: 1.5rem;
  color: var(--text-primary);
  font-style: italic;
  position: relative;
}

.testimonial-quote::before,
.testimonial-quote::after {
  content: '"';
  font-size: 2rem;
  color: var(--accent);
  opacity: 0.3;
  position: absolute;
}

.testimonial-quote::before {
  top: -15px;
  left: -10px;
}

.testimonial-quote::after {
  bottom: -25px;
  right: -10px;
}

.testimonial-author {
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: var(--text-primary);
}

.testimonial-role {
  color: var(--text-secondary);
  font-size: 0.9rem;
}

.testimonial-pagination {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
}

.testimonial-pagination button {
  background-color: var(--card-bg);
  color: var(--primary);
  border: 1px solid var(--primary);
  padding: 0.5rem 1rem;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.testimonial-pagination button.active {
  background-color: var(--primary);
  color: white;
}

.testimonial-pagination button:hover {
  background-color: var(--primary);
  color: white;
}

.slider-nav {
  display: flex;
  justify-content: center;
  margin-top: 2rem;
  gap: 1rem;
}

.slider-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: var(--border);
  cursor: pointer;
  transition: all 0.3s ease;
}

.slider-dot.active {
  background-color: var(--primary);
  transform: scale(1.2);
}

/* CTA Section */
.cta {
  padding: 5rem 2rem;
    background: linear-gradient(135deg,rgba(1, 15, 37, 0.9),rgba(0, 155, 190, 0.699));
  color: white;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.cta::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIvPjwvc3ZnPg==");
  opacity: 0.3;
}

.cta-container {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
  transform: translateY(30px);
  opacity: 0;
  animation: fadeInUp 0.8s forwards 0.3s;
}

.cta h2 {
  font-size: 2.5rem;
  margin-bottom: 1.5rem;
}

.cta p {
  font-size: 1.1rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

/* Footer */
footer {
  background-color: #05252e;
  color: white;
  padding: 3rem 2rem 1rem;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.footer-col h3 {
  font-size: 1.3rem;
  margin-bottom: 1.5rem;
  position: relative;
  padding-bottom: 0.5rem;
  color: white;
}

.footer-col h3::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 50px;
  height: 2px;
  background-color: var(--accent);
}

.footer-col p {
  margin-bottom: 1rem;
  opacity: 0.7;
  line-height: 1.6;
  color: rgba(255, 255, 255, 0.8);
}

.footer-links {
  list-style: none;
}

.footer-links li {
  margin-bottom: 0.8rem;
}

.footer-links a {
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: all 0.3s ease;
}

.footer-links a:hover {
  color: var(--secondary);
  padding-left: 5px;
}

.social-links {
  display: flex;
  gap: 1rem;
  margin-top: 1rem;
}

.social-links a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.1);
  color: white;
  transition: all 0.3s ease;
}

.social-links a:hover {
  background-color: var(--bg);
  transform: translateY(-3px);
  color: var(--text-primary);
}

.footer-bottom {
  text-align: center;
  padding-top: 2rem;
  margin-top: 2rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  opacity: 0.7;
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.6);
}

.footer-bottom a {
  color: var(--text-secondary);
  text-decoration: none;
}

.btn ul {
  display: flex;
  gap: 19px;
  padding: 10px;
}

/* Animations */
@keyframes float {
  0%,
  100% {
    transform: translateY(0) rotate(-5deg);
  }

  50% {
    transform: translateY(-20px) rotate(5deg);
  }
}

@keyframes float2 {
  0%,
  100% {
    transform: translateY(0) rotate(3deg);
  }

  50% {
    transform: translateY(-15px) rotate(-3deg);
  }
}

@keyframes float3 {
  0%,
  100% {
    transform: translateY(0) rotate(-8deg);
  }

  50% {
    transform: translateY(-10px) rotate(8deg);
  }
}

@keyframes slideIn {
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes fadeInUp {
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

@keyframes fadeInScale {
  to {
    transform: scale(1);
    opacity: 1;
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

/* Pulse Animation */
@keyframes pulse {
  0% {
    transform: scale(1);
  }

  50% {
    transform: scale(1.05);
  }

  100% {
    transform: scale(1);
  }
}

.pulse {
  animation: pulse 2s infinite;
}

/* Responsive Styles */
@media (max-width: 992px) {
  .hero {
    height: auto;
    padding: 4rem 2rem;
  }
  .hero-content {
    flex-direction: column-reverse;
    text-align: center;
    margin-top: 20%;
  }

  .hero-text {
    padding-right: 0;
    margin-bottom: 3rem;
    text-align: center;
    display: flex;
    justify-self: center;
    align-items: center;
    flex-direction: column;
    p {
      font-size: 1.3rem;
    }
  }

  .hero-buttons {
    justify-content: center;
  }

  .feature-card {
    padding: 1.5rem;
  }
  .fa-user {
    padding: 9px;
    border-radius: 50px;
    border: 1px solid;
    cursor: pointer;
  }

  .btn ul {
    display: flex;
    flex-direction: column;
    gap: 19px;
    position: absolute;
    top: 70px;
    /* background: #181919a8; */
    padding: 10px;
    visibility: hidden;
    right: 0;
  }

  .btn {
    display: flex;
    gap: 30px;
  }

  .fa-user i {
    display: block;
  }
  .fa-user:active .btn {
    visibility: visible;
    transition: visibility 0.3s ease-in-out;
  }
}

@media (max-width: 768px) {
  .nav-links {
    position: fixed;
    top: 52px;
    left: -100%;
    width: 100%;
    height: calc(100vh - 80px);
    background-color: var(--primary);
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.5s ease;
    padding: 2rem 0;
    /* backdrop-filter: blur(10px); */
     background: linear-gradient(135deg,rgba(1, 15, 37, 0.934),rgba(0, 155, 190, 0.89));
  }

  .nav-links.active {
    left: 0;
  }

  .nav-links li {
    margin: 1rem 0;
  }

  .hamburger {
    display: block;
  }

  .hero-text h1 {
    font-size: 2.5rem;
  }

  .section-title h2 {
    font-size: 2rem;
  }

  .testimonial-card {
    margin: 0 0.5rem;
    padding: 1.5rem;
  }

  .testimonials-grid {
    grid-template-columns: repeat(1, 1fr);
  }
  .hero {
    padding-top: 0;
  }
  .floating-notes {
    height: 500px;
  }
  .hero {
    padding:2px ;
  }
 
}

@media (max-width: 576px) {
  .hero {
    height: auto;
    padding: 0;
    margin: 0;
  }
  .hero-text h1 {
    font-size: 2rem;
  }

  .hero-buttons {
    flex-direction: column;
    gap: 1rem;
  }

  /* .note {
    width: 80% !important;
    height: auto !important;
    position: relative !important;
    margin: 1rem auto;

    animation: none !important;
  }

  .floating-notes:hover .note-1,
  .floating-notes:hover .note-2,
  .floating-notes:hover .note-3 {
    top: 0 !important;
    left: 0 !important;
    transform: rotate(0deg);
  }

  .note-1 {
    left: 0;
    transform: rotate(0deg);
    background-color: #f8f3e6;
    z-index: 3;
  }

  .note-2 {
    top: -110px;
    left: 0px;
    transform: rotate(339deg);
    background-color: #e6f3f8;
    z-index: 2;
  }

  .note-3 {
    top: -230px;
    left: 0px;
    transform: rotate(354deg);
    background-color: #f8e6e6;
    z-index: 1;
  } */
  .note-1 {
    width: 180px;
    height: 230px;
    top: 50px;
    left: 0;
    transform: rotate(-5deg);
    background-color: #f8f3e6;
    z-index: 3;
  }

  .note-2 {
    width: 210px;
    height: 250px;
    top: 100px;
    left: 150px;
    transform: rotate(3deg);
    background-color: #e6f3f8;
    z-index: 2;
  }

  .note-3 {
    width: 170px;
    height: 210px;
    top: 180px;
    left: 50px;
    transform: rotate(-8deg);
    background-color: #f8e6e6;
    z-index: 1;
  }

  .note h3 {
    margin-bottom: 1rem;
    color: var(--primary);
  }

  .note p {
    font-size: 0.8rem;
    line-height: 1.5;
    color: var(--text-secondary);
  }
  .floating-notes {
    max-width: 350px;
    height: 400px;
  }

  .section-title h2 {
    font-size: 1.8rem;
  }

  .cta h2 {
    font-size: 2rem;
  }

  .footer-container {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .logo {
    font-size: 1.2rem;
  }

  .testimonials-grid {
    display: contents;
  }
}

/* Testimonials Specific Styles */
.testimonials-grid {
  /* Initially show only the first three */
  grid-template-columns: repeat(3, 1fr);
}

.testimonial-card {
  display: none;
  /* Hide all by default */
}

.testimonial-card:nth-child(-n + 3) {
  display: block;
  /* Show the first three */
}

.testimonial-pagination button {
  margin: 0 5px;
}
.testimonial-detail{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2px;
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
                <li><a href="#features">Features</a></li>
                <li><a href="#notes">Notes</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="btn">
                <i class="fa-solid fa-user"  style="display: none;"></i>
                <ul>
                    <a href="./user/user_auth/user_sigin.php" class="cta-button">Sign Up</a>
                    <a href="./user/user_auth/user_login.php" class="cta-button">Sign In</a>
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
                        <p>testimonial-detailed notes covering key concepts in physics for 10th-grade students, including mechanics,
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
            <h2>Testimonials</h2>
            <p>Read what other students have to say about their experience with NoteSphere</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-detail">
                    <p class="testimonial-author">Sarah L.</p>
                    <p class="testimonial-role">Biology Major</p>
                </div>
                <blockquote class="testimonial-quote">
                    NoteSphere's biology notes were a lifesaver! They were so well-organized and easy to understand,
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
<script src="./assets/js/script.js"></script>
 <script>
    function preventBack() {
        window.history.forward();
    }

    setTimeout(preventBack, 0);

    window.onunload = function () {
        // Optional: force unload
    };
</script>
</html>