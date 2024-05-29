<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitterID = $_POST['sitterID'];
    $userID = $_SESSION['parentID']; 
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $location = $_POST['location'];
    $totalPrice = $_POST['totalPrice'];

    try {
        $sql = "INSERT INTO bookings (sitterID, userID, startDate, endDate, location, totalPrice, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "iisssd", $sitterID, $userID, $startDate, $endDate, $location, $totalPrice);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../sitterReservation/sitterReservation.php");          
                exit();
            } else {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
        } else {
            throw new Exception("Error preparing query: " . mysqli_error($conn));
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
