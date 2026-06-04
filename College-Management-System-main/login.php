<?php
session_start();
include 'db.php';

// Redirect if already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    // Basic input validation
    if (empty($user) || empty($pass)) {
        $error = "Please enter both username and password.";
    } else {
        // In a real application, you would:
        // 1. Use prepared statements
        // 2. Hash passwords (password_hash())
        // 3. Implement rate limiting
        if ($user === 'admin' && $pass === 'admin') {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user;
            $_SESSION['last_activity'] = time();
            
            // Regenerate session ID to prevent fixation
            session_regenerate_id(true);
            
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password.";
            // Log failed attempts in production
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Your Company Name</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --error-color: #e74c3c;
            --light-gray: #f5f5f5;
            --dark-gray: #333;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo img {
            max-width: 150px;
        }
        
        h2 {
            color: var(--dark-gray);
            text-align: center;
            margin-bottom: 24px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark-gray);
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 40px;
            color: #aaa;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: var(--secondary-color);
        }
        
        .error-message {
            color: var(--error-color);
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .footer-links {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
        
        .footer-links a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        .divider {
            margin: 20px 0;
            text-align: center;
            position: relative;
            color: #aaa;
        }
        
        .divider::before, .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: #ddd;
        }
        
        .divider::before {
            left: 0;
        }
        
        .divider::after {
            right: 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
      
        
        <h2>Sign In to Your Account</h2>
        
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                <i class="fas fa-user input-icon"></i>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                <i class="fas fa-lock input-icon"></i>
            </div>
            
            <button type="submit" class="btn">Sign In</button>
        </form>
        
        
    </div>
</body>
</html>