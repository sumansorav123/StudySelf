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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification | StudySelf</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0037ff;
            --error: #e74c3c;
            --success: #27ae60;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .otp-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 450px;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .alert {
            padding: 12px;
            margin: 1rem 0;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .alert.success {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .alert.error {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }
        
        .otp-input {
            width: 100%;
            padding: 12px 15px;
            margin: 1rem 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            letter-spacing: 5px;
        }
        
        .verify-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .verify-btn:hover {
            background: #0028c2;
        }
        
        .timer {
            margin: 1rem 0;
            color: #555;
            font-weight: 500;
        }
        
        .timer.expired {
            color: var(--error);
        }
        
        .resend-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .floating-icon {
            position: absolute;
            color: rgba(0, 55, 255, 0.1);
            z-index: -1;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        .icon-1 { top: 20%; left: 10%; font-size: 5rem; }
        .icon-2 { top: 60%; left: 80%; font-size: 4rem; animation-delay: 1s; }
        .icon-3 { top: 80%; left: 15%; font-size: 6rem; animation-delay: 2s; }
        .icon-4 { top: 30%; left: 75%; font-size: 3.5rem; animation-delay: 3s; }
    </style>
</head>
<body>
    <i class="fas fa-book-open floating-icon icon-1"></i>
    <i class="fas fa-book floating-icon icon-2"></i>
    <i class="fas fa-book-reader floating-icon icon-3"></i>
    <i class="fas fa-pen-fancy floating-icon icon-4"></i>

    <div class="otp-container">
        <h2>Verify Your Email</h2>
        <p>Enter the 4-digit code sent to <?= htmlspecialchars($email) ?></p>
        
        <?php if (!empty($message)) echo $message; ?>
        
        <form method="POST" autocomplete="off">
            <input type="text" 
                   name="otp" 
                   class="otp-input" 
                   placeholder="Enter OTP" 
                   required
                   pattern="\d{4}"
                   title="4-digit OTP"
                   maxlength="4"
                   inputmode="numeric">
            
            <div id="otp-timer" class="timer"></div>
            
            <button type="submit" name="verify" class="verify-btn">Verify</button>
        </form>
        
        <p>Didn't receive code? <a href="?resend=true" class="resend-link">Resend OTP</a></p>
    </div>

    <script>
        // OTP Timer Countdown
        const expiryTime = <?= ($_SESSION["otp_created_at"] ?? 0) + OTP_EXPIRY ?>;
        
        function updateTimer() {
            const now = Math.floor(Date.now() / 1000);
            const remaining = expiryTime - now;
            
            if (remaining <= 0) {
                document.getElementById('otp-timer').textContent = 'OTP expired';
                document.getElementById('otp-timer').classList.add('expired');
                return;
            }
            
            const mins = Math.floor(remaining / 60);
            const secs = remaining % 60;
            document.getElementById('otp-timer').textContent = 
                `Valid for: ${mins}:${secs.toString().padStart(2, '0')}`;
            
            setTimeout(updateTimer, 1000);
        }
        
        if (expiryTime > 0) {
            updateTimer();
        }
    </script>
</body>
</html>