<?php
require "../../config/Database.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../user_assets/css/login.css">
</head>
<body>
    <!-- Floating notebook icons for decoration -->
    <i class="fas fa-book-open floating-notebook notebook-1"></i>
    <i class="fas fa-book floating-notebook notebook-2"></i>
    <i class="fas fa-book-reader floating-notebook notebook-3"></i>
    <i class="fas fa-pen-fancy floating-notebook notebook-4"></i>
    
    <main>
        <div class="nacbar">
            <a href="../../index.php"><span>Home</span></a>
            <a href="../../pages/help.php"><span>Help</span></a>
        </div>
        
        <section id="login" class="login active">
            <div class="login-container">
                <div class="flex">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                        <div class="form-group">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email" placeholder="Enter e-mail">
                        </div>
                        <div class="form-group">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" name="password" placeholder="Enter password" class="password-input">
                            <i class="fa-solid fa-eye-slash toggle-password"></i>
                        </div>
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            if(isset($_POST["login"])){
                                $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_SPECIAL_CHARS);
                                $password = $_POST["password"];
                                if(empty($email)){
                                    echo "<u style='color:red;'>e-mail is required</u><br>";
                                } else if(empty($password)){
                                    echo "<u style='color:red;'>password is required</u><br>";
                                } else {
                                    try {   
                                        $check = $connection->prepare("SELECT * FROM userdetails WHERE email = ?");
                                        $check->bind_param("s", $email);
                                        $check->execute();
                                        $result = $check->get_result();

                                        if($result->num_rows === 1){
                                            $row = $result->fetch_assoc();
                                            $hashed_password = $row['password'];
                                            if(password_verify($password, $hashed_password)){
                                                // Password is correct, set session variables and redirect to dashboard
                                                $_SESSION['username'] = $row['name'];
                                                $_SESSION['useremail'] = $row['email'];
                                                header("Location: ../user_dashboard.php");
                                                exit();
                                            } else {
                                                echo "<u style='color:red;'>Invalid password</u><br>";
                                            }
                                        } else {
                                            echo "<u style='color:red;'>Email not found</u><br>";
                                        }            
                                    } catch(Exception $e) {
                                        echo "Error: " . $e->getMessage() . "<br>";
                                    } finally {
                                        // Close the connection
                                        mysqli_close($connection);
                                        $check->close();
                                    }
                                }
                            }
                        }
                        ?>
                        <input type="submit" name="login" value="LogIn">
                        <div class="div">
                            <p>Don't have an account? <a href="#" class="switch-to-register">Create new account</a></p>
                        </div>
                    </form>
                    
                    <div class="content">
                        <div class="logo">
                            <i class="fas fa-book-open-reader"></i>
                            <span>StudySelf</span>
                        </div>
                        <a href="#" class="switch-to-register">Create new account</a>
                    </div>
                </div>
            </div>
        </section>     
    </main>
    
    <script>

        document.querySelectorAll(".toggle-password").forEach((icon) => {
  icon.addEventListener("click", function () {
    const passwordInput =
      this.closest(".form-group").querySelector(".password-input");
    const isVisible = passwordInput.type === "text";

    passwordInput.type = isVisible ? "password" : "text";
    this.classList.toggle("password-visible");
    this.closest(".form-group")
      .querySelectorAll(".toggle-password")
      .forEach((i) => {
        i.classList.toggle("password-visible");
      });
  });
});
    </script>
</body>
</html>