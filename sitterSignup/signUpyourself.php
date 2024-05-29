<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['paidExp'] = $_POST['paidExp'];
        
        if (isset($_POST['checkboxexperience'])) {
            $_SESSION['checkboxexperience'] = $_POST['checkboxexperience'];
        } else {
            $_SESSION['checkboxexperience'] = array();
        }

        if (isset($_POST['checkboxcertification'])) {
            $_SESSION['checkboxcertification'] = $_POST['checkboxcertification'];
        } else {
            $_SESSION['checkboxcertification'] = array();
        }

        $_SESSION['distance'] = $_POST['distance'];
        $_SESSION['numOfKids'] = $_POST['numOfKids'];
        $_SESSION['pets'] = $_POST['pets'];
        $_SESSION['max-price'] = $_POST['max-price'];
        $_SESSION['min-price'] = $_POST['min-price'];
        $_SESSION['bio'] = $_POST['bio'];

        // Redirect to the next form page
        header("Location: sittersignUpaboutyou.php");
        exit();

    }
?>


<!DOCTYPE html>
<html lang="Arabic" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="website icon" type="png" href="imgs/title-removebg-preview.png">
    <link rel="stylesheet" href="sitterSignup.css">

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
            <img src="imgs/logo (1).png">
        </a>
    </div>

    <div class="userOption">
        <select id="userOptions" onchange="handleSelectionlogout(this.value)">
            <option value="name" disabled selected><?php echo $_SESSION['firstName'] ?></option>
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
                    <input type="text" id="experience" name="paidExp" placeholder=" " >
                    <label for="experience"> سنوات الخبرة</label>
                    <span class="error-message" style="color: red;"></span>
                </div>
                <hr>
                <div class="check">
                    <p> ما هي الأعمار التي لديك خبرة بها؟</p>

                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance1" name="checkboxexperience[]" value="infant" >
                        <span for="checkboxexperiance1" onclick="document.getElementById('checkboxexperiance1').click()"> الرضيع (العمر 0-11
                            شهرًا)
                        </span>
                        <br>
                    </div>

                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance2" name="checkboxexperience[]" value="toddler">
                        <span for="checkboxexperiance2" onclick="document.getElementById('checkboxexperiance2').click()">
                            طفل صغير (سن 1-3) </span>

                        <br>
                    </div>


                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance3" name="checkboxexperience[]" value="preschool">
                        <span for="checkboxexperiance3" onclick="document.getElementById('checkboxexperiance3').click()">
                            مرحلة ما قبل المدرسة (العمر 4-5) </span>

                        <br>
                    </div>

                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance4" name="checkboxexperience[]" value="elementary">
                        <span for="checkboxexperiance4" onclick="document.getElementById('checkboxexperiance4').click()">
                            المرحلة الابتدائية (العمر 6-10 سنوات) </span>

                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxexperiance5" name="checkboxexperience[]" value="middleSchool">
                        <span for="checkboxexperiance5" onclick="document.getElementById('checkboxexperiance5').click()">
                            المدرسة المتوسطة (الأعمار 11+) </span>

                        <br>
                    </div>
                   <hr>
                   <p> هل لديك أي شهادات ؟</p>
                   <div class="div-check-group">
                        <input type="checkbox" id="checkboxcertification1" name="checkboxcertification[]" value="firstAid">
                        <span for="checkboxcertification1" onclick="document.getElementById('checkboxcertification1').click()">
                        دوره اسعافات أوليه
                            </span>
                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxcertification2" name="checkboxcertification[]" value="CDA">
                        <span for="checkboxcertification2" onclick="document.getElementById('checkboxcertification2').click()">
                        مساعد تنمية الطفل (CDA)
                            </span>
                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxcertification3" name="checkboxcertification[]" value="SCC">
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
                    <?php 
                         $distance = array( "1km","2km","5km","10km","15km","25km","40km","50km");
                        ?>
                    <select name="distance" id="distance" required>
                        <option value="" disabled selected>متوسط المسافه </option>
                        <?php 
                                foreach($distance as $value){
                             ?>
                        <option value="<?php echo $value ?>">
                        <?php echo $value ?>
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
                        <option value="" disabled selected>عدد الاطفال  </option>
                        <?php 
                                foreach($kids as $value){
                             ?>
                        <option value="<?php echo $value ?>">
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
                    <input type="radio" name="pets" value="true" id="pets1" required>
                        <span onclick="document.getElementById('pets1').click()">نعم، أنا أحب الحيوانات الأليفة</span>
                        </div>
                        <div class="div-input-group2">
                            <input type="radio" name="pets" value="false" id="pets2" required>
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
                    <input type="text" id="max-price" name="max-price" placeholder=" اعلى سعر" required>
            
                </div>
                <div> <p> الى</p></div>
                <div class=" inputgroup">
                    <input type="text" id="min-price" name="min-price" placeholder=" اقل سعر" required>
                    
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
                 <textarea name="bio" rows="6" placeholder="اخبر العائلات عن نفسك" required></textarea>
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
                        src="imgs/facebook-removebg-preview.png" alt=""></a>
                <a href="" class="social-icon" aria-label="Twitter"><img
                        src="imgs/twitter-removebg-preview.png" alt=""></a>
                <a href="" class="social-icon" aria-label="Instagram"><img
                        src="imgs/instgram-removebg-preview.png" alt=""></a>
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

