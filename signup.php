<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - ReliefNet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #f1f5f9; display: flex; justify-content: center; padding-top: 50px;">
    <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Create Account</h2>
        <form action="process_signup.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Full Name</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Email</label>
                <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Password</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold;">Phone</label>
                <input type="text" name="phone" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold;">Role</label>
                <select name="role" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="Admin">Admin</option>
                    <option value="Donor">Donor</option>
                    <option value="Volunteer">Volunteer</option>
                </select>
            </div>
            <button type="submit" style="width: 100%; background: #2563eb; color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; font-weight: bold;">Register</button>
        </form>
        
        <div style="margin-top: 20px; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <p style="color: #64748b; margin-bottom: 15px; font-size: 14px;">Already have an account?</p>
            <a href="login.php" style="text-decoration: none;">
                <button type="button" style="background: white; color: #2563eb; border: 1px solid #2563eb; width: 100%; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer;">Back to Login</button>
            </a>
        </div>
    </div>
</body>
</html>