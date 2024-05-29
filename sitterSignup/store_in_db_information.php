<?php
session_start(); // Start the session
include '../config/db.php';

//information table
$f_name = $_SESSION['firstName'];
$l_name = $_SESSION['lastName'];
$m_number = $_SESSION['mobileNumber'];
$birthdate = $_SESSION['birthdate'];
$age = $_SESSION['age'];
$gender = $_SESSION['gender'];
$addressID =$_SESSION['addressID'];
$expID =$_SESSION['expID'];
$jobPrefID =$_SESSION['jobPrefID'];
$priceID =$_SESSION['priceID'];
$bioID =$_SESSION['bioID'];
$aboutmeID =$_SESSION['aboutmeID'];
$skillID=$_SESSION['skillsID'];
$cmWithID=$_SESSION['cmWithID'];
$certificationID =$_SESSION['certificationID'];


$stmt = $conn->prepare("INSERT INTO information (f_name, l_name, m_number, birth_date, age, gender, addressID, expID, jobPrefID, priceID, bioID, aboutmeID, skillID, cmWithID, certificationID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisisiiiiiii", $f_name, $l_name, $m_number, $birthdate, $age, $gender, $addressID, $expID, $jobPrefID, $priceID, $bioID, $aboutmeID, $skillID, $cmWithID, $certificationID);

$stmt->execute();
$_SESSION['informationID']=$conn->insert_id;

$stmt->close();
$conn->close();

header("Location: store_in_db_user.php");
?>