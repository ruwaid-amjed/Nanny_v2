<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract and sanitize inputs
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $mobileNumber = filter_input(INPUT_POST, 'mobileNumber', FILTER_SANITIZE_STRING);
    $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $cities=filter_input(INPUT_POST, 'cities', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $addressDirection=filter_input(INPUT_POST, 'addressDirection', FILTER_SANITIZE_STRING);

    // Validate input data
    $errors = [];

    // Validate name fields
    if (empty($firstName) || empty($lastName)) {
        $errors['name'] = 'Name fields cannot be empty.';
    }

    // Validate email
    if (!$email) {
        $errors['email'] = 'Invalid email address.';
    }

    // Validate mobile number
    if (!preg_match('/^07\d{8}$/', $mobileNumber)) {
        $errors['mobile'] = 'Mobile number must be 10 digits and start with 07.';
    }

    // Validate password
    if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }

    // Validate birthdate for age above 18
    if (!calculateAge($birthdate) >= 18) {
        $errors['birthdate'] = 'You must be 18 years or older.';
    }

    // Check if there were any errors
    if (!empty($errors)) {
        // Redirect back to the signup form with errors
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit;
    }

    // Store validated data in the session
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password; // Note: Password should be hashed in real applications
    $_SESSION['mobileNumber'] = $mobileNumber;
    $_SESSION['age'] = calculateAge($birthdate);
    $_SESSION['birthdate']=$birthdate;
    $_SESSION['gender'] = $gender;
    $_SESSION['city'] = $cities;
    $_SESSION['address'] = $address;
    $_SESSION['addressDirection'] = $addressDirection;
    
    // Redirect to a new page (e.g., welcome or dashboard page)
    header('Location: signUpyourself.php');
    exit;
}

// Helper function to calculate age
function calculateAge($birthdate) {
    $birthDate = new DateTime($birthdate);
    $today = new DateTime('today');
    return $today->diff($birthDate)->y;
}
?>
