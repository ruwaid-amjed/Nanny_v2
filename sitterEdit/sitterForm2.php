<?php
session_start();
include '../config/db.php';

$userID = $_SESSION['userID'];

$sql = "SELECT aboutmeID, skillID,cmWithID  FROM information WHERE informationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['informationID']);
$stmt->execute();
$stmt->bind_result($aboutmeID, $skillID,$cmWithID);
$stmt->fetch();
$stmt->close();

// Fetch existing data for the form
$sql = "SELECT driverLicense, car, kids, smoking, sittingLocation, language, education FROM aboutme WHERE aboutmeID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $aboutmeID);
$stmt->execute();
$stmt->bind_result($driverLicense, $car, $kids, $smoking, $sittingLocation, $language, $education);
$stmt->fetch();
$stmt->close();

// Fetch skills
$sql = "SELECT reading, games, music, draw, craft FROM skills WHERE skillID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $skillID);
$stmt->execute();
$stmt->bind_result($reading, $games, $music, $draw, $craft);
$stmt->fetch();
$stmt->close();

// Fetch comfortable with
$sql = "SELECT pets, cook, clean, homework FROM comfortablewith WHERE cmWithID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cmWithID);
$stmt->execute();
$stmt->bind_result($pets, $cook, $clean, $homework);
$stmt->fetch();
$stmt->close();

// Fetch availability
$sql = "SELECT time_slot, saturday, sunday, monday, tuesday, wednesday, thursday, friday FROM availability WHERE idUser = ?";
$availability = [];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$stmt->bind_result($time_slot, $saturday, $sunday, $monday, $tuesday, $wednesday, $thursday, $friday);
while ($stmt->fetch()) {
    $availability[$time_slot] = [
        'saturday' => $saturday,
        'sunday' => $sunday,
        'monday' => $monday,
        'tuesday' => $tuesday,
        'wednesday' => $wednesday,
        'thursday' => $thursday,
        'friday' => $friday
    ];
}
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update about me data
    $driverLicense = ($_POST['driver'] == 'true') ? 1 : 0;
    $car = ($_POST['car'] == 'true') ? 1 : 0;
    $kids = ($_POST['child'] == 'true') ? 1 : 0;
    $smoking = ($_POST['smoker'] == 'true') ? 1 : 0;
    $sittingLocation = $_POST['home'];
    $language = $_POST['language'];
    $education = $_POST['education'];
    
    $sql = "UPDATE aboutme SET driverLicense=?, car=?, kids=?, smoking=?, sittingLocation=?, language=?, education=? WHERE aboutmeID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiissssi", $driverLicense, $car, $kids, $smoking, $sittingLocation, $language, $education, $aboutmeID);
    $stmt->execute();
    $stmt->close();

    // Update skills
    $reading = in_array('reading', $_POST['checkboxskills']) ? 1 : 0;
    $games = in_array('games', $_POST['checkboxskills']) ? 1 : 0;
    $music = in_array('music', $_POST['checkboxskills']) ? 1 : 0;
    $draw = in_array('draw', $_POST['checkboxskills']) ? 1 : 0;
    $craft = in_array('craft', $_POST['checkboxskills']) ? 1 : 0;
    
    $sql = "UPDATE skills SET reading=?, games=?, music=?, draw=?, craft=? WHERE skillID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiiii", $reading, $games, $music, $draw, $craft, $skillID);
    $stmt->execute();
    $stmt->close();

    // Update comfortable with
    $pets = in_array('pets', $_POST['checkboxDealWith']) ? 1 : 0;
    $cook = in_array('cook', $_POST['checkboxDealWith']) ? 1 : 0;
    $clean = in_array('clean', $_POST['checkboxDealWith']) ? 1 : 0;
    $homework = in_array('homework', $_POST['checkboxDealWith']) ? 1 : 0;

    $sql = "UPDATE comfortablewith SET pets=?, cook=?, clean=?, homework=? WHERE cmWithID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiii", $pets, $cook, $clean, $homework, $cmWithID);
    $stmt->execute();
    $stmt->close();

    // Update availability
    $time_slots = ['الصباح', 'الظهر', 'المساء', 'الليل'];
    foreach ($time_slots as $time_slot) {
        foreach (['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day) {
            $value = ($_POST['availability'][$time_slot][$day]==="true") ? 1 : 0;
            $sql = "UPDATE availability SET $day=? WHERE idUser=? AND time_slot=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $value, $userID, $time_slot);
            $stmt->execute();
            $stmt->close();
        }
    }

    header("Location: ../sittermainpage/sittermain.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="Arabic" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="website icon" type="png" href="image/title-removebg-preview.png">
    <link rel="stylesheet" href="../sitterSignup/sitterSignup.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Cairo:wght@200..1000&family=Lalezar&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Kufi+Arabic:wght@100..900&family=Noto+Naskh+Arabic:wght@400..700&family=Poppins:ital,wght@0,100;0,400;1,100&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script>
        function handleSelectionlogout(value) {
            var folderName = "login";
            if (value === 'logout') {
                window.location.href = '../' + encodeURIComponent(folderName) + '/login.php';
            }
        }

        function handleSelection() {
            var folderName = "main page";
            return window.location.href = '../' + encodeURIComponent(folderName) + '/main1.php';
        }
    </script>
</head>
<body>
<header>
    <div class="logo">
        <a id="logo" onclick="handleSelection()">
            <img src="image/logo (1).png">
        </a>
    </div>

    <div class="userOption">
        <select id="userOptions" onchange="handleSelectionlogout(this.value)">
            <option value="name" disabled selected><?php echo $_SESSION['fname'] ?></option>
            <option value="logout">Log Out</option>
        </select>
    </div>
</header>

<main class="main">
    <div class="container" id="color-container">
        <div class="intro">
            <h2>معلومات شخصيه</h2>
            <p>هل تملك :</p>
        </div>
        <form method="post" class="myForm3">
            <div class="aboutme-radio">
                <img src="image/driver.png">
                <p>رخصه القياده</p>
                <div class="div-input-group3">
                    <input type="radio" name="driver" value="true" <?php echo ($driverLicense == 1) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('driver').click()">نعم</span>
                </div>
                <div class="div-input-group3">
                    <input type="radio" name="driver" value="false" <?php echo ($driverLicense == 0) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('driver').click()">لا</span>
                </div>
            </div>
            <div class="aboutme-radio">
                <img src="image/car.png">
                <p>تملك سياره</p>
                <div class="div-input-group3">
                    <input type="radio" name="car" value="true" <?php echo ($car == 1) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('car').click()">نعم</span>
                </div>
                <div class="div-input-group3">
                    <input type="radio" name="car" value="false" <?php echo ($car == 0) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('car').click()">لا</span>
                </div>
            </div>
            <div class="aboutme-radio">
                <img src="image/child.png">
                <p>لديك اطفال</p>
                <div class="div-input-group3">
                    <input type="radio" name="child" value="true" <?php echo ($kids == 1) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('child').click()">نعم</span>
                </div>
                <div class="div-input-group3">
                    <input type="radio" name="child" value="false" <?php echo ($kids == 0) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('child').click()">لا</span>
                </div>
            </div>
            <div class="aboutme-radio">
                <img src="image/smoker.png">
                <p>تقوم بالتدخين</p>
                <div class="div-input-group3">
                    <input type="radio" name="smoker" value="true" <?php echo ($smoking == 1) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('smoker').click()">نعم</span>
                </div>
                <div class="div-input-group3">
                    <input type="radio" name="smoker" value="false" <?php echo ($smoking == 0) ? 'checked' : ''; ?> required>
                    <span onclick="document.getElementById('smoker').click()">لا</span>
                </div>
            </div>
            <hr>
            <div class="infojob1">
                <img src="image/home.png">
                <p>الموقع المفضل لمجالسة الأطفال</p>
                <div class="inputgroup1">
                    <?php 
                        $home = array("منزل العائله", "موقع خاص بك");
                    ?>
                    <select name="home" id="home" required>
                        <option value="" disabled>الموقع</option>
                        <?php 
                            foreach($home as $value){
                                $selected = ($sittingLocation == $value) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$value</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="infojob1">
                <img src="image/languge.png">
                <p>اللغات التي أتحدث بها</p>
                <div class="inputgroup1">
                    <?php 
                        $languages = array("العربيه", "الانجليزيه", "اللغتين");
                    ?>
                    <select name="language" id="language" required>
                        <option value="" disabled>اللغه</option>
                        <?php 
                            foreach($languages as $value){
                                $selected = ($language == $value) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$value</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="infojob1">
                <img src="image/education.png">
                <p>التعليم</p>
                <div class="inputgroup1">
                    <?php 
                        $education_levels = array("بكالوريس", "كليات المجتمع", "ثانويه");
                    ?>
                    <select name="education" id="education" required>
                        <option value="" disabled>المستوى التعليمي</option>
                        <?php 
                            foreach($education_levels as $value){
                                $selected = ($education == $value) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$value</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form3"> 
                <br>
                <h2>المهارات</h2>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxskills1" name="checkboxskills[]" value="reading" <?php echo ($reading == 1) ? 'checked' : ''; ?>>
                    <img src="image/reading.png">
                    <span onclick="document.getElementById('checkboxskills1').click()">القراءه</span>
                </div>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxskills2" name="checkboxskills[]" value="games" <?php echo ($games == 1) ? 'checked' : ''; ?>>
                    <img src="image/games.png">
                    <span onclick="document.getElementById('checkboxskills2').click()">الالعاب</span>
                </div>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxskills3" name="checkboxskills[]" value="music" <?php echo ($music == 1) ? 'checked' : ''; ?>>
                    <img src="image/music.png">
                    <span onclick="document.getElementById('checkboxskills3').click()">الموسيقى</span>
                </div>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxskills4" name="checkboxskills[]" value="draw" <?php echo ($draw == 1) ? 'checked' : ''; ?>>
                    <img src="image/drawing.png">
                    <span onclick="document.getElementById('checkboxskills4').click()">الرسم</span>
                </div>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxskills5" name="checkboxskills[]" value="craft" <?php echo ($craft == 1) ? 'checked' : ''; ?>>
                    <img src="image/crafting.png">
                    <span onclick="document.getElementById('checkboxskills5').click()">الحرف اليدويه</span>
                </div>
            </div>
            <hr>
            <br>
            <div class="form3">
                <h2>اتعامل مع</h2>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxDealWith1" name="checkboxDealWith[]" value="pets" <?php echo ($pets == 1) ? 'checked' : ''; ?>>
                    <img src="image/pets.png">
                    <span onclick="document.getElementById('checkboxDealWith1').click()">حيوانات أليفة</span>
                </div>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxDealWith2" name="checkboxDealWith[]" value="cook" <?php echo ($cook == 1) ? 'checked' : ''; ?>>
                    <img src="image/cooking.png">
                    <span onclick="document.getElementById('checkboxDealWith2').click()">الطبخ</span>
                </div>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxDealWith3" name="checkboxDealWith[]" value="clean" <?php echo ($clean == 1) ? 'checked' : ''; ?>>
                    <img src="image/clean.png">
                    <span onclick="document.getElementById('checkboxDealWith3').click()">واجبات منزلية</span>
                </div>
                <div class="div-check-group">
                    <input type="checkbox" id="checkboxDealWith4" name="checkboxDealWith[]" value="homework" <?php echo ($homework == 1) ? 'checked' : ''; ?>>
                    <img src="image/homework assistance.png">
                    <span onclick="document.getElementById('checkboxDealWith4').click()">المساعدة في الواجبات المنزلية</span>
                </div>
            </div>
            <hr>
            <br>
            <table class="availability-table">
                <caption style="text-align:right;">جدول الأيام المتاحة:</caption>
                <thead>
                    <tr>
                        <th></th> <!-- Empty cell for the corner -->
                        <th>السبت</th>
                        <th>الأحد</th>
                        <th>الإثنين</th>
                        <th>الثلاثاء</th>
                        <th>الأربعاء</th>
                        <th>الخميس</th>
                        <th>الجمعة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (['الصباح', 'الظهر', 'المساء', 'الليل'] as $time_slot): ?>
                    <tr>
                        <td><?php echo $time_slot; ?></td>
                        <?php foreach (['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day): ?>
                        <td>
                            <input type="hidden" name="availability[<?php echo $time_slot; ?>][<?php echo $day; ?>]" value="false">
                            <input type="checkbox" name="availability[<?php echo $time_slot; ?>][<?php echo $day; ?>]" value="true" <?php echo (isset($availability[$time_slot][$day]) && $availability[$time_slot][$day] == 1) ? 'checked' : ''; ?>>
                        </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br><br>
            <div class="inputgroup submit-button">
                <input type="submit" value="حفظ">
            </div>
        </form>
    </div>
</main>

<footer class="site-footer">
    <div class="footer-container">
        <span class="footer-brand">Nanny ♥</span>
        <div class="social-icons">
            <a href="" class="social-icon" aria-label="Facebook"><img src="image/facebook-removebg-preview.png" alt=""></a>
            <a href="" class="social-icon" aria-label="Twitter"><img src="image/twitter-removebg-preview.png" alt=""></a>
            <a href="" class="social-icon" aria-label="Instagram"><img src="image/instgram-removebg-preview.png" alt=""></a>
        </div>
        <div class="copyright">
            © 2024 Nanny. جميع الحقوق محفوظة.
        </div>
    </div>
</footer>
</body>
</html>
