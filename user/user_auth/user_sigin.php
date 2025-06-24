<?php
require '../../config/Database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../user_assets/css/login.css">
</head>

<body>
    <!-- Floating notebook icons for decoration -->
    <i class="fas fa-book-open floating-notebook notebook-1"></i>
    <i class="fas fa-book floating-notebook notebook-2"></i>
    <i class="fas fa-book-reader floating-notebook notebook-3"></i>
    <i class="fas fa-pen-fancy floating-notebook notebook-4"></i>
    <reg-section>
    <main>
        <div class="nacbar">
            <a href="../../index.php"><span>Home</span></a>
            <a href="../../pages/help.php"><span>Help</span></a>
        </div>
       <section id="register" class="register">
        <div class="register-container">
            <div class="flex">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <div class="form-group">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="text" name="name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-envelope"></i>
                           <input type="email" name="email" placeholder="Enter e-mail">
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-key"></i>
                           <input type="password" name="password" placeholder="Enter password" class="password-input">
                           <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-key"></i>
                           <input type="password" name="repassword" placeholder="Enter Confirm password" class="password-input">
                           <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
<?php
$name = $email = $pass = $c_pass = '';
echo '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = $_POST['password'];
    $c_pass = $_POST['repassword'];

    if (empty($name)) {
        echo "<p style='color:red;'>Name is required</p>";
    } elseif (empty($email)) {
        echo "<p style='color:red;'>Email is required</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format</p>";
    } elseif (empty($pass)) {
        echo "<p style='color:red;'>Password is required</p>";
    } elseif (strlen($pass) < 6) {
        echo "<p style='color:red;'>Password must be at least 6 characters</p>";
    } elseif ($pass !== $c_pass) {
        echo "<p style='color:red;'>Passwords must be same</p>";
    } else {
        try {
            $check = $connection->prepare('SELECT * FROM userdetails WHERE email = ?');
            $check->bind_param('s', $email);
            $check->execute();
            $res = $check->get_result();

            if ($res->num_rows > 0) {
                echo "<p style='color:red; text-align:center;'>This email already exists. Try another.</p>";
            } else {
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = password_hash($pass, PASSWORD_DEFAULT);  // store hashed, insert after OTP
                header('Location: user_otp.php');
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            echo "<p style='color:red;'>Database error: " . $e->getMessage() . '</p>';
        }
    }
}
?>
                    <!-- register button------------------------ -->
                    <input type="submit" name="register" value="Register">
                     <div class="div">
                        <p>Already have an account? <a href="./user_login.php" class="switch-to-login ">Sign In</a></p>
                     </div>
                </form>
                <div class="content">
                    <div class="logo">
                           <i class="fas fa-book-open-reader"></i>
                           <span>StudySelf</span>
                    </div>
                    <a href="./user_login.php" class="switch-to-login">Sign In</a>
                </div>
            </div>
        </div>
      </section>
   </main>   
   </reg-section>
  
   <!-- <script src="../user_assets/js/script.js"></script> -->
    <script>
document.addEventListener('mousemove', function(e) {
    const content = document.querySelector('.content');
    const x = (e.clientX / window.innerWidth) * 100;
    const y = (e.clientY / window.innerHeight) * 100;
    content.style.backgroundPosition = `${x}% ${y}%`;
});
</script>

</body>
</html>