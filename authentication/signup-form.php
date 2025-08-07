<?php

session_start();

include '../db_con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // htmlspecialchars: to sanitize the input to prevent XSS(Cross Site Scripting) attacks
    
    $name = htmlspecialchars($_POST['fullname'], ENT_QUOTES, 'UTF-8'); 
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $em = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // secure hash

    $company_name = htmlspecialchars($_POST['company_name'], ENT_QUOTES, 'UTF-8');

    $token = bin2hex(random_bytes(32)); // Secure unique token
    $avatar = "avatar1.png";

    $userCaptcha = trim($_POST['captcha']);
    $correctCaptcha = $_SESSION['captcha_code'];

    if ($userCaptcha !== $correctCaptcha) {
        echo json_encode(["status" => "error", "title" => "Error!", "message" => "Incorrect CAPTCHA. Try again."]);
        return;
    }

    // Check if email already exists
    $sql = "SELECT * FROM userdata WHERE `email` = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $em);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) 
    {
        echo json_encode(['status' => 'info','title' => 'Email Exists!', 'message' => 'Email is already registered! Please use another email.']);
    } 
    else if (strlen($username) > 25) 
    {

        echo json_encode(['status' => 'info','title' => 'Username Too Long!', 'message' => 'The Username must be less than 25 characters!']);
    } 
    else 
    {

        // Insert user into database
        $sql = "INSERT INTO userdata (`name`, `email`, `username`, `password`, `company_name`, `avatar`) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $em, $username, $pass, $company_name, $avatar);

        if (mysqli_stmt_execute($stmt))
        {
            try {

                echo json_encode(['status' => 'success', 'title' => 'Registration Successful!', 'message' => 'Registration Successful! You can login now in your account.']);

            } 
            catch (Exception $e) {

                echo json_encode(['status' => 'error', 'title' => 'Email Sending Failed!', 'message' => 'Could not send verification email. Please try again!']);

            }
        } 
        else 
        {

            echo json_encode(['status' => 'error', 'title' => 'Registration Failed!', 'message' => 'Could not register user, please try again!']);

        }
    }
}

?>