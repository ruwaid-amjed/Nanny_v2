<?php
session_start();
include '../config/db.php';

$sql = "SELECT expID,jobPrefID,priceID,bioID,certificationID  FROM information WHERE informationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['informationID']);
$stmt->execute();
$stmt->bind_result($expID,$jobPrefID,$priceID,$bioID,$certificationID);
$stmt->fetch();
$stmt->close();

// Fetch existing data
$sql = "SELECT paidYear, infant, toddler, preschool, elementary, middleSchool FROM experience WHERE expID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $expID);
$stmt->execute();
$stmt->bind_result($paidExp, $infant, $toddler, $preschool, $elementary, $middleSchool);
$stmt->fetch();
$stmt->close();

$sql = "SELECT firstAid,CDA,SCC FROM certifications WHERE certificationID  = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $certificationID);
$stmt->execute();
$stmt->bind_result($firstAid,$CDA,$SCC);
$stmt->fetch();
$stmt->close();

$sql = "SELECT distance,numberOfKids,pet FROM jobpreferences WHERE jobPreferencesID   = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $jobPrefID);
$stmt->execute();
$stmt->bind_result($distance,$numberOfKids,$pets);
$stmt->fetch();
$stmt->close();

$sql = "SELECT 	maxPrice,minPrice FROM price WHERE priceID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $priceID);
$stmt->execute();
$stmt->bind_result($maxPrice,$minPrice);
$stmt->fetch();
$stmt->close();

$sql = "SELECT 	bioText FROM  bio WHERE bioID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bioID);
$stmt->execute();
$stmt->bind_result($bioText);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update data in the database
    $sql = "UPDATE experience SET paidYear=?, infant=?, toddler=?, preschool=?, elementary=?, middleSchool=? WHERE expID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiiiii", $_POST['paidExp'], in_array('infant', $_POST['checkboxexperience']), in_array('toddler', $_POST['checkboxexperience']), in_array('preschool', $_POST['checkboxexperience']), in_array('elementary', $_POST['checkboxexperience']), in_array('middleSchool', $_POST['checkboxexperience']), $expID);
    $stmt->execute();
    $stmt->close();

    $sql = "UPDATE jobpreferences SET distance=?, numberOfKids=?, pet=? WHERE jobPreferencesID =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $_POST['distance'], $_POST['numOfKids'], $_POST['pets'], $jobPrefID);
    $stmt->execute();
    $stmt->close();

    $sql = "UPDATE price SET maxPrice=?, minPrice=? WHERE priceID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddi", $_POST['max-price'], $_POST['min-price'], $priceID);
    $stmt->execute();
    $stmt->close();

    $sql = "UPDATE bio SET bioText=? WHERE bioID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $_POST['bio'], $bioID);
    $stmt->execute();
    $stmt->close();

    $sql = "UPDATE certifications SET firstAid=?, CDA=?, SCC=? WHERE certificationID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", in_array('firstAid', $_POST['checkboxcertification']), in_array('CDA', $_POST['checkboxcertification']), in_array('SCC', $_POST['checkboxcertification']), $certificationID);
    $stmt->execute();
    $stmt->close();

    header("Location: sitterForm2.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:
            wght@100..900&family=Cairo:wght@200..1000&family=Lalezar&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Kufi+Arabic:wght@100..900&family=Noto+Naskh+Arabic:wght@400..700&family=Poppins:ital,wght@0,100;0,400;1,100&family=Roboto+Condensed:
            ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script>
        function handleSelectionlogout(value) {
            var folderName="login";
            if (value === 'logout') {
                window.location.href = '../'+encodeURIComponent(folderName)+'/login.php'; // Redirects to the main page
            }
        }
        function handleSelection() {
            var folderName="main page";
            return window.location.href = '../'+encodeURIComponent(folderName)+'/main1.php'; // Redirects to the main page
            
        }
    </script>
</head>
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
    <div class="container">
        <div class="intro">
            <h2> عرَف بنفسك</h2>
            <p>ساعد العائلات في التعرف عليك بشكل أفضل من خلال مشاركة تجربتك في رعاية الاطفال.</p>
        </div>
        <div class="myForm2">
            <form  method="post" id="signupForm">
                <div class=" inputgroup">
                    <p> سنوات الخبرة المدفوعة</p>
                    <input type="text" id="experience" name="paidExp" value="<?php echo htmlspecialchars($paidExp); ?>" placeholder=" " >
                    <label for="experience"> سنوات الخبرة</label>
                    <span class="error-message" style="color: red;"></span>
                </div>
                <hr>
                <div class="check">
                    <p> ما هي الأعمار التي لديك خبرة بها؟</p>

                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance1" name="checkboxexperience[]" value="infant" <?php echo $infant ? 'checked' : ''; ?>>
                        <span for="checkboxexperiance1" onclick="document.getElementById('checkboxexperiance1').click()"> الرضيع (العمر 0-11
                            شهرًا)
                        </span>
                        <br>
                    </div>

                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance2" name="checkboxexperience[]" value="toddler" <?php echo $toddler ? 'checked' : ''; ?>>
                        <span for="checkboxexperiance2" onclick="document.getElementById('checkboxexperiance2').click()">
                            طفل صغير (سن 1-3) </span>

                        <br>
                    </div>


                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance3" name="checkboxexperience[]" value="preschool" <?php echo $preschool ? 'checked' : ''; ?>>
                        <span for="checkboxexperiance3" onclick="document.getElementById('checkboxexperiance3').click()">
                            مرحلة ما قبل المدرسة (العمر 4-5) </span>

                        <br>
                    </div>

                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance4" name="checkboxexperience[]" value="elementary" <?php echo $elementary ? 'checked' : ''; ?>>
                        <span for="checkboxexperiance4" onclick="document.getElementById('checkboxexperiance4').click()">
                            المرحلة الابتدائية (العمر 6-10 سنوات) </span>

                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance5" name="checkboxexperience[]" value="middleSchool" <?php echo $middleSchool ? 'checked' : ''; ?>>
                        <span for="checkboxexperiance5" onclick="document.getElementById('checkboxexperiance5').click()">
                            المدرسة المتوسطة (الأعمار 11+) </span>

                        <br>
                    </div>
                   <hr>
                   <p> هل لديك أي شهادات ؟</p>
                   <div class="div-check-group">
                        <input type="checkbox" id="checkboxcertification1" name="checkboxcertification[]" value="firstAid" <?php echo $firstAid ? 'checked' : ''; ?>>
                        <span for="checkboxcertification1" onclick="document.getElementById('checkboxcertification1').click()">
                        دوره اسعافات أوليه
                            </span>
                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxcertification2" name="checkboxcertification[]" value="CDA" <?php echo $CDA ? 'checked' : ''; ?>>
                        <span for="checkboxcertification2" onclick="document.getElementById('checkboxcertification2').click()">
                        مساعد تنمية الطفل (CDA)
                            </span>
                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxcertification3" name="checkboxcertification[]" value="SCC" <?php echo $SCC ? 'checked' : ''; ?>>
                        <span for="checkboxcertification3" onclick="document.getElementById('checkboxcertification3').click()">
                        أخصائي رعاية الطفل
                            </span>
                        <br>
                    </div>


                </div>
                <hr>
                <div class="infojob">
                    <h2> شارك تفضيلاتك الوظيفية</h2>
                    <p> أقصى مسافة ستسافرها للحصول على وظيفة</p>
                </div>
                <div class="inputgroup">
        <p> أقصى مسافة ستسافرها للحصول على وظيفة</p>
        <?php 
            $distances = array("1km", "2km", "5km", "10km", "15km", "25km", "40km", "50km");
        ?>
        <select name="distance" id="distance" required>
            <option value="" disabled <?php echo empty($distance) ? 'selected' : ''; ?>>متوسط المسافه</option>
            <?php 
                foreach($distances as $value){
            ?>
                <option value="<?php echo $value; ?>" <?php echo ($value == $distance) ? 'selected' : ''; ?>>
                    <?php echo $value; ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
                    <hr>
                <div class="infojob">
                    <p>     الحد الأقصى للأطفال الذي ستهتم به في وقت واحد </p>
                </div>
                <div class="inputgroup">
                    <?php 
                         $kids = array( "1 طفل ","2 طفل","3 طفل"," +4 طفل",);
                        ?>
                    <select name="numOfKids" id="numOfKids" required>
                        <option value="" disabled <?php echo empty($kids) ? 'selected' : ''; ?>>عدد الاطفال  </option>
                        <?php 
                                foreach($kids as $value){
                             ?>
                        <option value="<?php echo $value ?>" <?php echo ($value == $kids) ? 'selected' : ''; ?>>
                        <?php echo $value ?>
                        </option>
                        <?php
                                }
                            ?>

                    </select>
                </div>
                <hr>
                <div class="infojob">
                    <p> هل ستعمل في منزل به حيوانات أليفة؟ </p>
                </div>
                <div class="gender-selection2">
                    <div class="radio-group">
                    <div class="div-input-group2">    
                    <input type="radio" name="pets" value="true" id="pets1" <?php echo ($pets=='1') ? 'checked' : ''; ?> required>
                        <span onclick="document.getElementById('pets1').click()">نعم، أنا أحب الحيوانات الأليفة</span>
                        </div>
                        <div class="div-input-group2">
                            <input type="radio" name="pets" value="false" id="pets2" <?php echo ($pets=='0') ? 'checked' : ''; ?> required>
                            <span onclick="document.getElementById('pets2').click()">لا، أنا لست مرتاحًا مع الحيوانات الأليفة</span>
                        </div> 
                    </div>
                </div>
                <hr>
                <div class="infojob">
                    <p> قم بتعيين السعر الأساسي الخاص بك بالساعة لطفل واحد </p>
                </div>
                <div class="page">
                <p  id="price"style="font-size:15px"> متوسط ​​المدى هو 5 اردني - 10 اردني في الساعة  </p>
            </div>
            <div class="countainer-praice">
            <div class=" inputgroup">
                    <input type="text" id="max-price" name="max-price" placeholder=" اعلى سعر" required value="<?php echo htmlspecialchars($maxPrice); ?>">
            
                </div>
                <div> <p> الى</p></div>
                <div class=" inputgroup">
                    <input type="text" id="min-price" name="min-price" placeholder=" اقل سعر" required value="<?php echo htmlspecialchars($minPrice); ?>">
                    
                </div>
            </div>
            <hr>
            <div class="infojob">
                    <h2> اكتب سيرة ذاتية </h2>
                    <p> أشياء للإعتبار
لماذا تحبين العمل مع الأطفال؟
ما هي الخبرة التي لديك؟
ما الذي يميزك؟  </p>
                </div>
            <div class="bio"> 
                 <textarea name="bio" rows="6" placeholder="اخبر العائلات عن نفسك"   required ><?php echo htmlspecialchars($bioText); ?></textarea>
                </div>



        
                <div class="inputgroup submit-button">
                     <input type="submit" value="التالي" >
                </div>

            </form>
        </div>

    </div>
</main>
<footer class="site-footer">
        <div class="footer-container">
            <span class="footer-brand">Nanny ♥</span>
            <div class="social-icons">
                <a href="" class="social-icon" aria-label="Facebook"><img
                        src="image/facebook-removebg-preview.png" alt=""></a>
                <a href="" class="social-icon" aria-label="Twitter"><img
                        src="image/twitter-removebg-preview.png" alt=""></a>
                <a href="" class="social-icon" aria-label="Instagram"><img
                        src="image/instgram-removebg-preview.png" alt=""></a>
            </div>
            <div class="copyright">
                © 2024 Nanny. جميع الحقوق محفوظة.
            </div>
        </div>
    </footer>

    <script>
    function validateForm() {
        let valid = true;
        const experience = document.getElementById('experience');
        if (experience.value.trim() === "") {
            showError(experience, 'قم بتعبئة هذا الحقل');
            valid = false;
        }
        else if (!validateExperience(experience.value)) {
        showError(experience, 'هذا الحقل يحتوي على أرقام فقط');
        valid = false;
        }


        return valid;
    }

    function validateExperience(experience) {
    const regex = /\d+/;
    return regex.test(experience);
    }

    function showError(inputElement, message) {
        const parent = inputElement.parentElement;
        const errorSpan = parent.querySelector('.error-message');
        errorSpan.textContent = message;
    }

    document.getElementById('signupForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (validateForm()) {
            this.submit();
        }
    });
    </script>

<body>

</body>

</html>

