<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingID = $_POST['bookingID'];
    $status = $_POST['status'];

    $sql = "UPDATE bookings SET status = ? WHERE bookingID = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $status, $bookingID);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            
            header("Location: sitterReservation2.php"); 
            exit();
        } else {
            echo "Error: Could not execute the query: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare the query: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
