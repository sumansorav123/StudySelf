<?php
require "../../config/Database.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="stylesheet" href="../assets/style.css">
</head>
<style>
    body {
  margin: 0;
  padding: 0;
  height: 80svh;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
.container {
  width: 100%;
  border-radius: 1px;
  padding: 50px 40px 20px 40px;
  box-sizing: border-box;
  font-family: sans-serif;
  color: #737373;
  border: 1px solid rgb(219, 219, 219);
  text-align: center;
  background: white;
}

.container svg {
  width: 16px;
  height: auto;
}

.content__form {
  display: flex;
  flex-direction: column;
  row-gap: 14px;
}

.content__inputs {
  display: flex;
  flex-direction: column;
  row-gap: 8px;
}

.content__form label {
  border: 1px solid rgb(219, 219, 219);
  display: flex;
  align-items: center;
  position: relative;
  min-width: 268px;
  height: 38px;
  background: rgb(250, 250, 250);
  border-radius: 3px;
}

.content__form span {
  position: absolute;
  text-overflow: ellipsis;
  transform-origin: left;
  font-size: 12px;
  left: 8px;
  pointer-events: none;
  transition: transform ease-out 0.1s;
}

.content__form input {
  width: 100%;
  background: inherit;
  border: 0;
  outline: none;
  padding: 9px 8px 7px 8px;
  text-overflow: ellipsis;
  font-size: 16px;
  vertical-align: middle;
}

.content__form input:valid + span {
  transform: scale(calc(10 / 12)) translateY(-10px);
}

.content__form input:valid {
  padding: 14px 0 2px 8px;
  font-size: 12px;
}

.content__or-text {
  display: flex;
  justify-content: space-between;
  align-items: center;
  text-transform: uppercase;
  font-size: 13px;
  column-gap: 18px;
  margin-top: 18px;
}

.content__or-text span:nth-child(3),
.content__or-text span:nth-child(1) {
  display: block;
  width: 100%;
  height: 1px;
  background-color: rgb(219, 219, 219);
}

.content__forgot-buttons {
  display: flex;
  flex-direction: column;
  margin-top: 28px;
  row-gap: 21px;
}

.content__forgot-buttons button {
  display: flex;
  justify-content: center;
  align-items: center;
  column-gap: 8px;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 12px;
  color: #00376b;
}

.content__forgot-buttons button:first-child {
  color: #385185;
  font-size: 14px;
  font-weight: 600;
}

.content__form #button {
  background: rgb(0, 149, 246);
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 700;
  font-size: 14px;
  padding: 7px 16px;
  cursor: pointer;
}

.content__form button:hover {
  background: rgb(24, 119, 242);
}

.content__form button:active:not(:hover) {
  background: rgb(0, 149, 246);
  opacity: 0.7;
}

/* text eff------------------------------ */
.btn-shine {
  font-size: 3rem;
  background: linear-gradient(to right, #0037ff 0, #79c1ff 10%, #0037ff 20%);
  background-position: 0;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: shine 3s infinite linear;
  animation-fill-mode: forwards;
  -webkit-text-size-adjust: none;
  font-weight: 600;
  text-decoration: none;
  white-space: nowrap;
  font-family: "Poppins", sans-serif;
}
@-moz-keyframes shine {
  0% {
    background-position: 0;
  }
  60% {
    background-position: 180px;
  }
  100% {
    background-position: 180px;
  }
}
@-webkit-keyframes shine {
  0% {
    background-position: 0;
  }
  60% {
    background-position: 180px;
  }
  100% {
    background-position: 180px;
  }
}
@-o-keyframes shine {
  0% {
    background-position: 0;
  }
  60% {
    background-position: 180px;
  }
  100% {
    background-position: 180px;
  }
}
@keyframes shine {
  0% {
    background-position: 0;
  }
  60% {
    background-position: 180px;
  }
  100% {
    background-position: 180px;
  }
}

</style>
<body>
    <p href="#" class="btn-shine">AdminLogin</p>
    <br><br>
   <div class="container">
    <div class="content">
      <form class="content__form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="content__inputs">
          <label>
            <input required="" type="text" name="username">
            <span>Phone number, username, or username$username</span>
          </label>
          <label>
            <input required="" type="password" name="password">
            <span>Password</span>
          </label>
        </div>
         <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            if(isset($_POST["login"])){
                                $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
                                $password = $_POST["password"];
                                if(empty($username)){
                                    echo "<u style='color:red;'>e-mail is required</u><br>";
                                } else if(empty($password)){
                                    echo "<u style='color:red;'>password is required</u><br>";
                                } else {
                                    try {   
                                        $check = $connection->prepare("SELECT * FROM admindb WHERE username = ?");
                                        $check->bind_param("s", $username);
                                        $check->execute();
                                        $result = $check->get_result();

                                        if($result->num_rows === 1){
                                            $row = $result->fetch_assoc();
                                            $hashed_password = $row['password'];
                                            if(password_verify($password, $hashed_password)){
                                                // Password is correct, set session variables and redirect to dashboard
                                                     $_SESSION['adminusername'] = $row['username'];
                                                    echo '<script>window.location.href = "../admin.php";</script>';

                                                     
                                                        exit();
                                            } else {
                                                echo "<u style='color:red;'>Invalid password</u><br>";
                                            }
                                        } else {
                                            echo "<u style='color:red;'>userName not found</u><br>";
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

        <input type="submit" id="button" name="login" value="LogIn"></input>
      </form>
      <div class="content__or-text">
        <span></span>
        <span>OR</span>
        <span></span>
      </div>
      <div class="content__forgot-buttons">
        <button>Forgot password?</button>
      </div>
    </div>
  </div>
</body>
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