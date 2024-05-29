<?php
include '../config/db.php';

$response = array('emailExists' => false, 'phoneExists' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobileNumber'];

    // Check if email exists
    $emailQuery = "SELECT 1 FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $emailQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $response['emailExists'] = true;
        }
        mysqli_stmt_close($stmt);
    }

    // Check if mobile number exists
    $phoneQuery = "SELECT 1 FROM information WHERE m_number = ?";
    if ($stmt = mysqli_prepare($conn, $phoneQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $mobileNumber);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $response['phoneExists'] = true;
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}

echo json_encode($response);
?>
