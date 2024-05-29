<?php
session_start();
include '../config/db.php';

$userID=$_SESSION['userID'];

//availability table
function boolToInt($val) {
    if($val === "true")
        return 1;
    else
        return 0;
}

// Prepare an SQL statement for inserting data into the 'availability' table
$stmt = $conn->prepare("INSERT INTO availability (time_slot, saturday, sunday, monday, tuesday, wednesday, thursday, friday, idUser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Insert availability for each time slot
$time_slots = ['الصباح', 'الظهر', 'المساء', 'الليل'];
foreach ($time_slots as $index => $time_slot) {
    $saturday = boolToInt($_SESSION['availability']['السبت'][$time_slot]);
    $sunday = boolToInt($_SESSION['availability']['الاحد'][$time_slot]);
    $monday = boolToInt($_SESSION['availability']['الاثنين'][$time_slot]);
    $tuesday = boolToInt($_SESSION['availability']['الثلاثاء'][$time_slot]);
    $wednesday = boolToInt($_SESSION['availability']['الاربعاء'][$time_slot]);
    $thursday = boolToInt($_SESSION['availability']['الخميس'][$time_slot]);
    $friday = boolToInt($_SESSION['availability']['الجمعة'][$time_slot]);

    $stmt->bind_param("siiiiiiii", $time_slot, $saturday, $sunday, $monday, $tuesday, $wednesday, $thursday, $friday, $userID);
    $stmt->execute();
}

$stmt->close();

//file table
$files = [
    ['description' => "الصورة الشخصية", 'path' => $_SESSION['personal_photo']],
    ['description' => "ملف التعريف", 'path' => $_SESSION['identity']],
    ['description' => "شهادة عدم المحكومية", 'path' => $_SESSION['nocriminal']],
    ['description' => "شهادة خلو امراض", 'path' => $_SESSION['health']]
];

// Prepare an SQL statement for inserting file data
$stmt = $conn->prepare("INSERT INTO files (path, description, userID) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $path, $description, $userID);

// Execute the statement for each file
foreach ($files as $file) {
    $path = $file['path'];
    $description = $file['description'];
    $stmt->execute();
}

$stmt->close();
$conn->close();


header("Location: ../login/login.php");
?>