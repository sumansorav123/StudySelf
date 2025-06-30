<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Java Notes - Product View</title>
    <link rel="stylesheet" href="../user_assets/css/view_book.css">
</head>
<body>
    <main>
        <div class="container">
            <div class="left-side">
               <div class="image-container">
                   <div class="image-box">
                    <img id="main-image" src="https://tse3.mm.bing.net/th?id=OIP.Pr2XQtZvNipC9RPYc9hZ_gHaIs&pid=Api&P=0&h=180" alt="Java Notes Cover Image">
                   </div>
                   <div class="image-list">
                    <div class="image img-1" onclick="changeImage('https://via.placeholder.com/600x400?text=Java+Notes+Cover')">
                         <img src="https://tse3.mm.bing.net/th?id=OIP.gKJUO0lYveRZQ9vwAkiJTAHaJ4&pid=Api&P=0&h=180" alt="Thumbnail 1">
                    </div>
                      <div class="image img-2" onclick="changeImage('https://via.placeholder.com/600x400?text=Java+Content+Page+1')">
                         <img src="https://tse1.mm.bing.net/th?id=OIP.CPm-nkkfXYAamyHRr6gwjwHaKe&pid=Api&P=0&h=180" alt="Thumbnail 2">
                    </div>
                      <div class="image img-3" onclick="changeImage('https://via.placeholder.com/600x400?text=Java+Content+Page+2')">
                         <img src="https://tse1.mm.bing.net/th?id=OIP.FrA1t3OZFrXudqIIiFvGVQHaKc&pid=Api&P=0&h=180" alt="Thumbnail 3">
                    </div>
                   </div>
               </div>
            </div>
            <div class="right-side">
                  <div class="title">
                     <h2>Java Notes</h2>
                     <h4>Programming Category</h4>
                     <p><strong>Price: ₹99</strong></p>
                  </div>
                  <div class="description">
                    Comprehensive Java programming notes covering all fundamental concepts including OOP principles, data structures, exception handling, and multithreading. Perfect for beginners and intermediate learners looking to strengthen their Java skills. These notes include practical examples, code snippets, and best practices to help you master Java programming.
                  </div>
                  <div class="actions">
                      <button class="btn btn-secondary" onclick="buyNow()">Download</button>
                  </div>
            </div>
        </div>
   </main>
   
   <script>
     
       
       // Highlight the first thumbnail by default
       window.onload = function() {
           const firstThumbnail = document.querySelector('.image-list .image:first-child');
           firstThumbnail.style.borderColor = '#4CAF50';
           firstThumbnail.style.boxShadow = '0 0 0 2px rgba(76, 175, 80, 0.3)';
       }
        
    
let thumbnails = document.querySelectorAll('.image-list .image img');
let mainImg = document.querySelector("#main-image");


thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', () => {
    
        mainImg.src = thumbnail.src;
        
        // Optional: Add visual feedback for active thumbnail
        document.querySelectorAll('.image').forEach(img => {
            img.style.borderColor = '#ddd'; // Reset all borders
        });
        thumbnail.parentElement.style.borderColor = '#4CAF50'; // Highlight active
    });
});
   </script>
</body>
</html>