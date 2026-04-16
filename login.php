<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - ReliefNet</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .login-header { text-align: center; margin-bottom: 30px; }
        .login-header h2 { color: #1e293b; margin-bottom: 10px; }
        .error-msg { color: #ef4444; background: #fee2e2; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #334155; }
        input { width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; }
        .btn-login { background: #2563eb; color: white; border: none; width: 100%; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .btn-login:hover { background: #1d4ed8; }
    </style>
</head>
<body style="display: block; background-color: #f1f5f9;">
    <div class="login-container">
        <div class="login-header">
            <h2>Relief<span>Net</span> Login</h2>
            <p style="color: #64748b;">Enter your credentials to access the dashboard</p>
        </div>

        <?php 
        if(isset($_GET['error'])) {
            $error = $_GET['error'];
            $msg = "Invalid email or password.";
            if ($error == "password") $msg = "Incorrect password. Please try again.";
            if ($error == "user_not_found") $msg = "No account found with this email.";
            echo "<div class='error-msg'>$msg</div>";
        }
        ?>

        <form action="process_login.php" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="name@reliefnet.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <p style="color: #64748b; margin-bottom: 15px; font-size: 14px; margin-top: 20px;">Don't have an account?</p>
            <a href="signup.php" style="text-decoration: none;">
                <button type="button" style="background: white; color: #2563eb; border: 1px solid #2563eb; width: 100%; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer;">Create New Account</button>
            </a>
        </div>
    </div>
</body>
</html>