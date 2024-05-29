<?php
session_start();
include '../config/db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$login_err = ''; // Initialize error message string

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    // Sanitize POST data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if($email=="admin.admin@gmail.com" && $password == "adminadmin"){
        header('Location: ../admin/admin.php');
        exit();
    }

    // SQL query to fetch user details
    $sql = "SELECT userID, email, password, role , informationID FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $role ,$informationID);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        // Clear old session and start a new one
                        session_regenerate_id(true);
                        
                        $_SESSION["loggedin"] = true;
                        $_SESSION["userID"] = $id;
                        $_SESSION["email"] = $email;
                        $_SESSION["role"] = $role;
                        $_SESSION["informationID"]=$informationID;
                        // Redirect user based on role
                        if ($role == 'عائلة') {
                            header("location: ../user/user.php");
                            exit;
                        } else if ($role == 'مربية') {
                            header("location: ../sittermainpage/sittermain.php");
                            exit;
                        }
                    } else {
                        $login_err = "البريد الألكتروني أو كلمة السر غير صحيحة.";
                    }
                }
            } else {
                $login_err = "البريد الألكتروني أو كلمة السر غير صحيحة.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
} 
?>



<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="website icon" type="png" href="title-removebg-preview.png">

    
</head>

<body>
    <div class="login-form-container">
        <div class="logo-container">
            <img src="logo (1).png">
        </div>

        <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
        ?>


        <form action="" method="post">
            <div class="form-group">
                <label for="email">البريد الألكتروني:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة السر:</label>
                <input type="password" id="password" name="password" required>
                <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility()"></i>
            </div>
            <div class="form-group">
                <button type="submit">تسجيل الدخول</button>
            </div>
        </form>

        <div class="signup-links">
            <p>لست عضواً؟ <a href="../usersignup/signupuser.php?role=عائلة">سجل كوالد</a> أو <a href="../sitterSignup/sitterSignUpGenral.php?role=مربية">سجل كجليسة</a></p>
        </div>
    </div>

    <script>
    function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var passwordIcon = document.querySelector('.toggle-password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}
</script>
</body>

</html>
