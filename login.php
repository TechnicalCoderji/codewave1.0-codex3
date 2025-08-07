<?php

session_start(); // Start session

// Auto-login using cookies
if (!empty($_COOKIE['email'])) {
    $_SESSION['email'] = $_COOKIE['email'];
    $_SESSION['fullname'] = $_COOKIE['fullname'];
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_id'] = $_COOKIE['user_id'];

    header("Location: dashboard.php"); // Redirect if cookie is set
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CallSense</title>
    <link rel="icon" href="images/callsense.png">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- css for the aos animation js library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>

    <div class="loading-wrapper">
        <div class="loading"></div>
    </div>

    <div class="login-container" data-aos="fade-up" data-aos-delay="600">

        <div class="welcome-container">
            <h1 class="welcome-heading" data-aos="fade-up">Welcome Back</h1>
            <p class="welcome-subtext" data-aos="fade-up" data-aos-delay="400">Let's continue our journey.</p>
        </div>

        <div class="login-box">
            <div class="logo">
                <img src="images/callsense-logo.png" alt="OneDiplomas Logo">
            </div>
            <h2>Login</h2>
            <form method="POST" autocomplete="off" id='login-form'>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" required />
                        <span id="togglePassword" class="eye-icon"><i class="fas fa-eye"></i></span>
                    </div>
                </div>

                <div class="captcha-container">
                    <label>Captcha</label>
                    <img src="authentication/captcha.php" id="captcha-img" class="captcha-image" alt="CAPTCHA">
                    <button type="button" class="captcha-refresh-btn" onclick="refreshCaptcha()"><i id="refresh-icon"
                            class="fa-solid fa-rotate"></i></button>
                </div>
                <input type="text" name="captcha" required placeholder="Enter CAPTCHA">

                <div class="forgot-password">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>

                <div class="input-group">
                    <input type="submit" value="Login" class="btn">
                </div>
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</body>

<!-- JS for aos animation library, put it first before all js otherwise it will 
         not load and the whole page will not load-->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="authentication/authenticate.js"></script>
<script src="authentication/aos-animation.js"></script>

</html>