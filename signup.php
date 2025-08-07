<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | CallSense</title>
    <link rel="stylesheet" href="signup.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="images/callsense.png" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>

    <!-- Dark Overlay + Loading Animation -->
    <div class="loading-wrapper">
        <div class="loading"></div>
    </div>

    <!-- Container -->
    <div class="container" data-aos="zoom-in">

        <form method="POST" class="form-card" autocomplete="off" data-aos="fade-up" id="signup-form">

            <img src="images/callsense-logo.png" alt="CallSense Logo" class="logo" data-aos="fade-down" />

            <h2 class="main-heading" data-aos="fade-up" data-aos-delay="100">Create Your CallSense Account</h2>
            <p class="subtitle" data-aos="fade-up" data-aos-delay="200">Join our platform to get AI-driven insights for your calls.</p>

            <div class="form-flex" data-aos="fade-up" data-aos-delay="300">
                <!-- User Details -->
                <div class="form-section" data-aos="fade-right" data-aos-delay="400">
                    <h3>User Details</h3>
                    <input type="text" name="fullname" placeholder="Full Name" required />
                    <input type="text" name="username" placeholder="Username" required />
                    <input type="email" name="email" placeholder="Email" required />
                    
                    <div class="password-wrapper">
                        <input type="password" name="password" placeholder="Password" id="password" required />
                        <span id="togglePassword" class="eye-icon"><i class="fas fa-eye"></i></span>
                    </div>
                    <input type="text" name="company_name" placeholder="Company Name" required />

                </div>

            <!-- CAPTCHA Section -->
            <div class="form-section" data-aos="fade-up" data-aos-delay="450">
                <h3>Human Verification</h3>
                <div class="captcha-container">
                    <label for="captcha">Captcha</label>
                    <div class="captcha-box">
                        <img src="authentication/captcha.php" id="captcha-img" class="captcha-image" alt="CAPTCHA">
                        <button type="button" class="captcha-refresh-btn" onclick="refreshCaptcha()"
                            title="Refresh Captcha">
                            <i id="refresh-icon" class="fa-solid fa-rotate"></i>
                        </button>
                    </div>
                    <input type="text" name="captcha" required placeholder="Enter CAPTCHA" autocomplete="off">
                </div>
            </div>

            <p class="subtitle" data-aos="fade-up" data-aos-delay="200">
                By signing up, you agree to our <a href="terms-and-conditions.php">Terms & Conditions</a> and <a
                    href="privacy-policy.php">Privacy Policy</a>.
            </p>

            <input type="submit" data-aos="zoom-in" data-aos-delay="0" data-aos-offset="0" value="Sign Up"
                class="submit" />

            <p class="login-link" data-aos="fade-up" data-aos-delay="0" data-aos-offset="0">
                Already have an account? <a href="login.php">Login</a>
            </p>

        </form>
    </div>

    <!-- JS for aos animation library, put it first before all js otherwise it will 
         not load and the whole page will not load-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="authentication/authenticate.js"></script>
    <script src="authentication/aos-animation.js"></script>

</body>

</html>