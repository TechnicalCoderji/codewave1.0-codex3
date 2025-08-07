<?php

session_start();

include '../db_con.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $em = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $pw = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    
    $userCaptcha = trim($_POST['captcha']);
    $correctCaptcha = $_SESSION['captcha_code'];

    if ($userCaptcha !== $correctCaptcha) {
        echo json_encode(array("status" => "error", "title" => "Error!", "message" => "Incorrect CAPTCHA. Try again."));
        return;
    }

    // Check if the email exists
    $sql = "SELECT * FROM userdata WHERE `email` = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $em);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) 
    {
        if (password_verify($pw, $row['password'])) // Verify hashed password
        { 
            
                $_SESSION['fullname'] = $row['name'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];

                // Set a cookie for auto-login (valid for 30 days)
                setcookie("email", $em, time() + (30 * 24 * 60 * 60), "/");
                setcookie("user_id", $row['id'], time() + (30 * 24 * 60 * 60), "/");
                setcookie("fullname", $row['name'], time() + (30 * 24 * 60 * 60), "/");
                setcookie("username", $row['username'], time() + (30 * 24 * 60 * 60), "/");
                
                echo json_encode(array("status" => "success", "title" => "Success!", "message" => "Login successful! Redirecting..."));
                
        } 
        else 
        {
            echo json_encode(["status" => "info", "title" => "Invalid Password!", "message" => "The password you entered is incorrect. Please try again."]);
        }
    } 
    else 
    {

        echo json_encode(array("status" => "warning", "title" => "Invalid Email!", "message" => "Email not found! Please sign up."));

    }
}

?>