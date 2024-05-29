<?php
session_start();
include '../config/db.php';

//users table
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$role = $_SESSION['role'];
$informationID =$_SESSION['informationID'];

// Hash the password for secure storage
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare an SQL statement for inserting data into the 'users' table
$stmt = $conn->prepare("INSERT INTO users (email, password, role, informationID) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $email, $hashedPassword, $role, $informationID);

// Execute the statement
$stmt->execute();
$_SESSION['userID']=$conn->insert_id;

$stmt->close();
$conn->close();

header("Location: store_in_db_final.php");
?>