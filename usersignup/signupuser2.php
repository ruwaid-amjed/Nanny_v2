<?php

session_start();
include '../config/db.php';

$role=$_SESSION['role'];


// Continue with POST processing if it's a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extract and sanitize inputs
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $mobileNumber = filter_input(INPUT_POST, 'mobileNumber', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'cities', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $addressDirection = filter_input(INPUT_POST, 'addressDirection', FILTER_SANITIZE_STRING);

    // Validate input data
    $errors = [];

    if (empty($firstName) || empty($lastName)) {
        $errors['name'] = 'Name fields cannot be empty.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address.';
    }

    if (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }

    if (empty($city)) {
        $errors['city'] = 'City cannot be empty.';
    }

    // Check if there were any errors
    if (!empty($errors)) {
        // Redirect back to the signup form with errors
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit;
    }

    // Perform database operations
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO address (city, addressLine, additionalDirection) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $city, $address, $addressDirection);
        $stmt->execute();
        $addressID = $conn->insert_id;
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO information (f_name, l_name,m_number, addressID) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $firstName, $lastName,$mobileNumber, $addressID);
        $stmt->execute();
        $informationID = $conn->insert_id;
        $stmt->close();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password, role, informationID) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $email, $hashedPassword, $role, $informationID);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
        header("Location: ../login/login.php");
        exit;
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error: " . $exception->getMessage();
    } finally {
        $conn->close();
    }
}

?>