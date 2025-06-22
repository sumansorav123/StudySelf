<?php
require '../../config/Database.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $pass = $_POST['password'];
        $c_pass = $_POST['repassword'];

        // Validate inputs
        $errors = [];
        
        if (empty($name)) {
            $errors[] = "Name is required";
        } elseif (strlen($name) > 100) {
            $errors[] = "Name is too long (max 100 characters)";
        }

        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }

        if (empty($pass)) {
            $errors[] = "Password is required";
        } elseif (strlen($pass) < 8) {
            $errors[] = "Password must be at least 8 characters";
        } elseif ($pass !== $c_pass) {
            $errors[] = "Passwords do not match";
        }

        // If no validation errors
        if (empty($errors)) {
            try {
                $check = $connection->prepare('SELECT * FROM userdetails WHERE email = ?');
                $check->bind_param('s', $email);
                $check->execute();
                $res = $check->get_result();

                if ($res->num_rows > 0) {
                    echo "<p style='color:red; text-align:center;'>This email already exists. Try another.</p>";
                } else {
                    // Generate and store OTP
                    $_SESSION['otp'] = random_int(1000, 9999);
                    $_SESSION['otp_created_at'] = time();
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = password_hash($pass, PASSWORD_DEFAULT);

                    // Send OTP email
                    require '../../vendor/autoload.php'; // Ensure this path is correct
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.zoho.in';
                        $mail->SMTPAuth = true;
                        $mail->Username = "studyself@zohomail.in";
                        $mail->Password = 'mgPX Rf5W BQPM';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('studyself@zohomail.in', 'Study Self');
                        $mail->addAddress($email, $name);
                        $mail->isHTML(true);
                        $mail->Subject = 'Your OTP for Study Self';
                        $mail->Body = 'Your OTP is <b>' . $_SESSION['otp'] . '</b>. It will expire in 10 minutes. <br><br><b>Do not share your OTP.</b>';
                        $mail->send();
                        
                        header('Location: user_otp.php');
                        exit();
                    } catch (Exception $e) {
                        die("<p style='color:red;'>Mailer Error: " . $e->getMessage() . "</p>");
                    }
                }
            } catch (mysqli_sql_exception $e) {
                echo "<p style='color:red;'>Database error: " . $e->getMessage() . '</p>';
            }
        } else {
            // Display validation errors
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
    }
    ?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../user_assets/css/login.css">
</head>
<body>
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
                                <input type="text" name="name" placeholder="Full Name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="email" placeholder="Enter e-mail" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-key"></i>
                                <input type="password" name="password" placeholder="Enter password" class="password-input">
                                <i class="fa-solid fa-eye-slash toggle-password"></i>
                            </div>
                            <div class="form-group">
                                <i class="fa-solid fa-key"></i>
                                <input type="password" name="repassword" placeholder="Confirm password" class="password-input">
                                <i class="fa-solid fa-eye-slash toggle-password"></i>
                            </div>
                            
                             

                            <input type="submit" name="register" value="Register">
                            <div class="div">
                                <p>Already have an account? <a href="user_login.php" class="switch-to-login">Sign In</a></p>
                            </div>
                        </form>
                        <div class="content">
                            <div class="logo">
                                <i class="fas fa-book-open-reader"></i>
                                <span>StudySelf</span>
                            </div>
                            <a href="user_login.php" class="switch-to-login">Sign In</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </reg-section>
    <script src="../user_assets/js/script.js"></script>
</body>
</html>