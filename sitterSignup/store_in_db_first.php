
<?php
session_start(); // Start the session
include '../config/db.php';

//address table
$city = $_SESSION['city'];
$addressLine= $_SESSION['address'];
$additionalDirection= $_SESSION['addressDirection'];

//experience table
$paidYear = $_SESSION['paidExp'];
$infant=$toddler=$preschool=$elementary=$middleSchool=0;

foreach($_SESSION['checkboxexperience'] as $value){
    switch ($value) {
        case "infant":
            $infant = 1;
            break;
        case "toddler":
            $toddler = 1;
            break;
        case "preschool":
            $preschool = 1;
            break;
        case "elementary":
            $elementary = 1;
            break;
        case "middleSchool":
            $middleSchool = 1;
            break;
        default:
            break;
    }
}

//jobpreferences table
$distance= $_SESSION['distance'];
$numberOfKids= $_SESSION['numOfKids'];
$pet=!empty($_SESSION['pets']) && $_SESSION['pets'] == 'true' ? 1 : 0;


//price table
$maxPrice= $_SESSION['max-price'];
$minPrice= $_SESSION['min-price'];

//bio table
$bioText= $_SESSION['bio'];

//certifications
$firstAid=$CDA=$SCC=0;
foreach ($_SESSION['checkboxcertification'] as $value) {
    switch ($value) {
        case "firstAid":
            $firstAid = 1;
            break;
        case "CDA":
            $CDA = 1;
            break;
        case "SCC":
            $SCC = 1;
            break;
        default:
            break;
    }
}

//aboutme table
$driverLicense = !empty($_SESSION['driver']) && $_SESSION['driver'] == 'true' ? 1 : 0;
$car = !empty($_SESSION['car']) && $_SESSION['car'] == 'true' ? 1 : 0;
$kids = !empty($_SESSION['child']) && $_SESSION['child'] == 'true' ? 1 : 0;
$smoking = !empty($_SESSION['smoker']) && $_SESSION['smoker'] == 'true' ? 1 : 0;
$sittingLocation= $_SESSION['home'];
$language= $_SESSION['language'];
$education= $_SESSION['education'];

//skills table
$reading=$games=$music=$draw=$craft=0;
foreach ($_SESSION['skills'] as $value) {
    switch ($value) {
        case "reading":
            $reading = 1;
            break;
        case "game":
            $games = 1;
            break;
        case "music":
            $music = 1;
            break;
        case "draw":
            $draw = 1;
            break;
        case "craft":
            $craft = 1;
            break;
        default:
            break;
    }
}

//comfortablewith table
$pets=$cook=$clean=$homework=0;
foreach ($_SESSION['dealWith'] as $value) {
    switch ($value) {
        case "pet":
            $pets = 1;
            break;
        case "cook":
            $cook = 1;
            break;
        case "clean":
            $clean = 1;
            break;
        case "homework assistance":
            $homework = 1;
            break;
        default:
            break;
    }
}


//store on db
// Prepare an SQL statement for inserting data into the 'skills' table
$stmt = $conn->prepare("INSERT INTO skills (reading, games, music, draw, craft) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiiii", $reading, $games, $music, $draw, $craft);
// Execute the statement
$stmt->execute();
$_SESSION['skillsID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'comfortablewith' table
$stmt = $conn->prepare("INSERT INTO comfortablewith (pets, cook, clean, homework) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiii", $pets, $cook, $clean, $homework);
// Execute the statement
$stmt->execute();
$_SESSION['cmWithID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'aboutme' table
$stmt = $conn->prepare("INSERT INTO aboutme (driverLicense, car, kids, smoking, sittingLocation, language, education) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiisss", $driverLicense, $car, $kids, $smoking, $sittingLocation, $language, $education);
// Execute the statement
$stmt->execute();
$_SESSION['aboutmeID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'certifications' table
$stmt = $conn->prepare("INSERT INTO certifications (firstAid, CDA, SCC) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $firstAid, $CDA, $SCC);
// Execute the statement
$stmt->execute();
$_SESSION['certificationID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'bio' table
$stmt = $conn->prepare("INSERT INTO bio (bioText) VALUES (?)");
$stmt->bind_param("s", $bioText);
// Execute the statement
$stmt->execute();
$_SESSION['bioID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'price' table
$stmt = $conn->prepare("INSERT INTO price (maxPrice, minPrice) VALUES (?, ?)");
$stmt->bind_param("ii", $maxPrice, $minPrice);
// Execute the statement
$stmt->execute();
$_SESSION['priceID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'jobpreferences' table
$stmt = $conn->prepare("INSERT INTO jobpreferences (distance, numberOfKids, pet) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $distance, $numberOfKids, $pet);
// Execute the statement
$stmt->execute();
$_SESSION['jobPrefID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'experience' table
$stmt = $conn->prepare("INSERT INTO experience (paidYear, infant, toddler, preschool, elementary, middleSchool) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiiii", $paidYear, $infant, $toddler, $preschool, $elementary, $middleSchool);
// Execute the statement
$stmt->execute();
$_SESSION['expID']=$conn->insert_id;
// Close statement
$stmt->close();

// Prepare an SQL statement for inserting data into the 'address' table
$stmt = $conn->prepare("INSERT INTO address (city, addressLine, additionalDirection) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $city, $addressLine, $additionalDirection);
// Execute the statement
$stmt->execute();
$_SESSION['addressID']=$conn->insert_id;
// Close statement
$stmt->close();
$conn->close();


header("Location: store_in_db_information.php");

?>
