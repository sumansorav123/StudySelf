<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login/register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        main {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .login, .register {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login.active, .register.active {
            display: block;
        }

        .login-container, .register-container {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .flex {
            display: flex;
            flex-wrap: wrap;
        }

        form {
            flex: 1;
            min-width: 300px;
            padding: 40px;
        }

        .content {
            flex: 1;
            min-width: 300px;
            background-color: var(--primary);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .logo {
            margin-bottom: 40px;
        }

        .logo i {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .logo span {
            font-size: 2rem;
            font-weight: bold;
            display: block;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group i:first-child {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .form-group i:last-child {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            cursor: pointer;
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid var(--border);
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(4, 97, 120, 0.2);
        }

        button, input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        button:hover, input[type="submit"]:hover {
            background-color: var(--accent);
        }

        .div {
            margin-top: 20px;
            text-align: center;
            color: var(--text-secondary);
        }

        a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }

        a:hover {
            color: #e69500;
            text-decoration: underline;
        }

        .content a {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--secondary);
            color: white;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }

        .content a:hover {
            background-color: #e69500;
            text-decoration: none;
        }

        /* Toggle password visibility */
        .password-visible {
            display: none;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            form, .content {
                flex: 100%;
                padding: 30px;
            }

            .content {
                padding-bottom: 50px;
            }
        }

        @media (max-width: 480px) {
            form, .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <main>
      <section id="login" class="login active">
        <div class="login-container">
            <div class="flex">
                
                <form action="">
                     <h2>User Login</h2>
                     <br>
                    <div class="form-group">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="text" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-envelope"></i>
                           <input type="email" placeholder="Enter valid email" required>
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-key"></i>
                           <input type="password" placeholder="Enter password" required class="password-input">
                           <i class="fa-solid fa-eye-slash toggle-password"></i>
                           
                    </div>
                    <button type="submit">Sign In</button>
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

       <section id="register" class="register">
        <div class="register-container">
            <div class="flex">
                <form action="">
                     <h2>User Register</h2>
                     <br>
                    <div class="form-group">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="text" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="text" placeholder="Enter your last name" required>
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-envelope"></i>
                           <input type="email" placeholder="Enter valid email" required>
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-key"></i>
                           <input type="password" placeholder="Enter password" required class="password-input">
                           <i class="fa-solid fa-eye-slash toggle-password"></i>
                        
                    </div>
                    <input type="submit" value="Register">
                     <div class="div">
                        <p>Already have an account? <a href="#" class="switch-to-login">Sign In</a></p>
                     </div>
                </form>
                <div class="content">
                    <div class="logo">
                           <i class="fas fa-book-open-reader"></i>
                           <span>StudySelf</span>
                    </div>
                    <a href="#" class="switch-to-login">Sign In</a>
                </div>
            </div>
        </div>
      </section>
   </main>

   <script>
        // Toggle between login and register forms
        document.querySelectorAll('.switch-to-register').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                document.querySelector('.login').classList.remove('active');
                document.querySelector('.register').classList.add('active');
            });
        });

        document.querySelectorAll('.switch-to-login').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                document.querySelector('.register').classList.remove('active');
                document.querySelector('.login').classList.add('active');
            });
        });

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const passwordInput = this.closest('.form-group').querySelector('.password-input');
                const isVisible = passwordInput.type === 'text';
                
                passwordInput.type = isVisible ? 'password' : 'text';
                this.classList.toggle('password-visible');
                this.closest('.form-group').querySelectorAll('.toggle-password').forEach(i => {
                    i.classList.toggle('password-visible');
                });
            });
        });
   </script>
</body>
</html>