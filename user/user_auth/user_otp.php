 <?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
require "../../config/Database.php";

// Database connection
// $database = new Database();
// $connection = $database->connect();

// 1. Redirect if session data missing
if (!isset($_SESSION["email"], $_SESSION["name"], $_SESSION["password"])) {
    header("Location: signup.php");
    exit();
}

$email = $_SESSION["email"];
$name = $_SESSION["name"];
$password = $_SESSION["password"];
$message = "";

// 2. Handle resend OTP
if (isset($_GET['resend'])) {
    $_SESSION["otp"] = random_int(1000, 9999);
    $_SESSION["otp_created_at"] = time();

    // Send email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.zoho.in';
        $mail->SMTPAuth = true;
        $mail->Username = "studyself@zohomail.in"; // sender email
        $mail->Password = 'mgPX Rf5W BQPM';     // app password
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 587;

        $mail->setFrom('studyself@zohomail.in', 'Study Self');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Resent OTP for Study Self';
        $mail->Body = 'Your OTP is <b>' . $_SESSION["otp"] . '</b>. It will expire in 4 minutes. <br><br><b>Do not share your OTP.</b>';
        $mail->send();
        $message = "<p style='color:green;'>OTP has been resent to your email.</p>";
    } catch (Exception $e) {
        $message = "<p style='color:red;'>Mailer Error: " . $mail->ErrorInfo . "</p>";
    }
}

// 3. Generate OTP if not already set
if (!isset($_SESSION["otp"])) {
    $_SESSION["otp"] = random_int(1000, 9999);
    $_SESSION["otp_created_at"] = time();

    // Send email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.zoho.in';
        $mail->SMTPAuth = true;
        $mail->Username = "studyself@zohomail.in";
         $mail->Password = 'mgPX Rf5W BQPM';  
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 587;

        $mail->setFrom('studyself@zohomail.in', 'Study Self');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Study Self';
        $mail->Body = 'Your OTP is <b>' . $_SESSION["otp"] . '</b>. It will expire in 4 minutes. <br><br><b>Do not share your OTP.</b>';
        $mail->send();
        $message = "<p style='color:green;'>OTP has been sent to your email.</p>";
    } catch (Exception $e) {
        $message = "<p style='color:red;'>Mailer Error: " . $mail->ErrorInfo . "</p>";
    }
}

// 4. Handle OTP submission
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST["verify"])) {
    $userOtp = trim($_POST["otp"] ?? "");

    if ($userOtp == $_SESSION["otp"]) {
        try {
            $stmt = $connection->prepare("INSERT INTO userdetails (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                unset($_SESSION["otp"], $_SESSION["name"], $_SESSION["email"], $_SESSION["password"], $_SESSION["otp_created_at"]);
                header("Location: user_login.php");
                exit();
            } else {
                $message = "<p style='color:red;'>Database error! Please try again later.</p>";
            }
        } catch (mysqli_sql_exception $e) {
            $message = "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        $message = "<p style='color:red;'>Incorrect OTP. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>S☆undHaven | Verify OTP</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="../user_assets/css/style.css">
  <style>
    body {
      overflow: hidden;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100svh;
    }
    .card {
      width: auto;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.2);
      margin: 3px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <!-- Floating notebook icons for decoration -->
  <i class="fas fa-book-open floating-notebook notebook-1"></i>
  <i class="fas fa-book floating-notebook notebook-2"></i>
  <i class="fas fa-book-reader floating-notebook notebook-3"></i>
  <i class="fas fa-pen-fancy floating-notebook notebook-4"></i>

  <div class="form-container">
    <div class="container">
      <div class="card">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
          <input id="wid" type="text" name="otp" placeholder="Enter OTP here..." required />
          <input class="transparent-btn" type="submit" name="verify" value="Verify OTP" />
        </form>
        <br>
        <?= $message ?><br>
        <p>Didn't receive OTP? <a href="?resend=true">Resend OTP</a></p>
        <br>
        <a href="user_sigin.php">Go Back</a>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener("load", function () {
      const preloader = document.getElementById("preloader");
      const contentDiv = document.querySelector(".content");

      if (!localStorage.getItem("visited")) {
        localStorage.setItem("visited", "true");
        if (preloader) preloader.style.display = "block";

        setTimeout(function () {
          if (preloader) preloader.style.display = "none";
          if (contentDiv) contentDiv.style.display = "block";
        }, 2000);
      } else {
        if (preloader) preloader.style.display = "none";
        if (contentDiv) contentDiv.style.display = "block";
      }
    });
  </script>
</body>
</html>
