<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bookingID']) && $_POST['status'] == 'canceled') {
    $bookingID = $_POST['bookingID'];

    $sql = "UPDATE bookings SET status = 'canceled' WHERE bookingID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $bookingID);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: sitterReservation.php"); // Redirect to the bookings page
            exit();
        } else {
            echo "Error: Could not execute the query: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare the query: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
