<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['driver'] = $_POST['driver'];
        $_SESSION['car'] = $_POST['car'];
        $_SESSION['child'] = $_POST['child'];
        $_SESSION['smoker'] = $_POST['smoker'];

        $_SESSION['home'] = $_POST['home'];
        $_SESSION['language'] = $_POST['language'];
        $_SESSION['education'] = $_POST['education'];

        $_SESSION['skills'] = isset($_POST['checkboxskills']) ? $_POST['checkboxskills'] : [];
        $_SESSION['dealWith'] = isset($_POST['checkboxDealWith']) ? $_POST['checkboxDealWith'] : [];
        $_SESSION['availability'] = $_POST['availability'] ?? [];

        header("Location: sitterSignupCertifications.php");
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
    <div class="container" id="color-container">
        <div class="intro" >
            <h2>  معلومات شخصيه</h2>
            <p> هل تملك :</p>
        </div>
        <form  method="post" class="myForm3">
            <div class="aboutme-radio">
                <img src="imgs/driver.png">
                <p> رخصه القياده </p>
                <div  class="div-input-group3">
                <input type="radio" name="driver" value="true" required>
                <span  onclick="document.getElementById('driver').click()"> نعم</span>
                </div>
                <div  class="div-input-group3">
                <input type="radio" name="driver" value="false" required>
                <span  onclick="document.getElementById('driver').click()"> لا</span>
                </div>
            </div>
            <div class="aboutme-radio">
            <img src="imgs/car.png">
                <p> تملك سياره</p>
                <div  class="div-input-group3">
                <input type="radio" name="car" value="true" required>
                <span  onclick="document.getElementById('car').click()"> نعم</span>
                </div>
                <div  class="div-input-group3">
                <input type="radio" name="car" value="false" required>
                <span  onclick="document.getElementById('car').click()"> لا</span>
                </div>
            </div>

            <div class="aboutme-radio">
            <img src="imgs/child.png">
                <p> لديك اطفال</p>
                <div  class="div-input-group3">
                <input type="radio" name="child" value="true" required>
                <span  onclick="document.getElementById('child').click()"> نعم</span>
                </div>
                <div  class="div-input-group3">
                <input type="radio" name="child" value="false" required>
                <span  onclick="document.getElementById('child').click()"> لا</span>
                </div>
            </div>
            <div class="aboutme-radio">
            <img src="imgs/smoker.png">
                <p> تقوم بالتدخين</p>
                <div  class="div-input-group3">
                <input type="radio" name="smoker" value="true" required>
                <span  onclick="document.getElementById('smoker').click()"> نعم</span>
                </div>
                <div  class="div-input-group3">
                <input type="radio" name="smoker" value="false" required>
                <span  onclick="document.getElementById('smoker').click()"> لا</span>
                </div>
            </div>
             
            <hr>
            <div class="infojob1">
                <img src="imgs/home.png">
                <p> الموقع المفضل لمجالسة الأطفال</p>
                
                <div class="inputgroup1">
                    <?php 
                         $home = array( " منزل العائله"," موقع خاص بك");
                        ?>
                    <select name="home" id="home" required>
                        <option value="" disabled selected>الموقع </option>
                        <?php 
                                foreach($home as $value){
                             ?>
                        <option value="<?php echo $value ?>">
                        <?php echo $value ?>
                        </option>
                        <?php
                                }
                            ?>

                    </select>
                </div>
                </div>

                <div class="infojob1">
                <img src="imgs/languge.png">
                <p> اللغات التي أتحدث بها</p>
                
                <div class="inputgroup1">
                    <?php 
                         $languge = array( " العربيه","الانجليزيه","اللغتين");
                        ?>
                    <select name="language" id="languge" required>
                        <option value="" disabled selected>اللغه </option>
                        <?php 
                                foreach($languge as $value){
                             ?>
                        <option value="<?php echo $value ?>">
                        <?php echo $value ?>
                        </option>
                        <?php
                                }
                            ?>

                    </select>
                </div>
                </div>
                
                <div class="infojob1">
                <img src="imgs/education.png">
                <p> التعليم</p>
                
                <div class="inputgroup1">
                    <?php 
                         $education = array( " بكالوريس","كليات المجتمع"," ثانويه");
                        ?>
                    <select name="education" id="education" required>
                        <option value="" disabled selected>المستوى التعليمي </option>
                        <?php 
                                foreach($education as $value){
                             ?>
                        <option value="<?php echo $value ?>">
                        <?php echo $value ?>
                        </option>
                        <?php
                                }
                            ?>

                    </select>
                </div>
                </div>
                <hr>
                <div  class="form3"> 
                    <br>
                    <h2> المهارات</h2>
               
                <div class="div-check-group">
                        <input type="checkbox" id="checkboxskills1" name="checkboxskills[]" value="reading">
                        <img src="imgs/reading.png">
                        <span for="checkboxskills1" onclick="document.getElementById('checkboxskills1').click()">
                              القراءه </span>

                        <br>
                    </div>
                   
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxskills2" name="checkboxskills[]" value="game">
                        <img src="imgs/games.png">
                        <span for="checkboxskills2" onclick="document.getElementById('checkboxskills2').click()">
                        الالعاب</span>

                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxskills3" name="checkboxskills[]" value="music">
                        <img src="imgs/music.png">
                        <span for="checkboxskills3" onclick="document.getElementById('checkboxskills3').click()">
                           الموسيقى </span>

                        <br>
                    </div>
                    <div class="div-check-group">
                        <input type="checkbox" id="checkboxskills4" name="checkboxskills[]" value="draw">
                        <img src="imgs/drawing.png">
                        <span for="checkboxskills4" onclick="document.getElementById('checkboxskills4').click()">
                            الرسم </span>

                        <br>
                    </div>
                    <div class="div-check-group">
                      
                        <input type="checkbox" id="checkboxskills5" name="checkboxskills[]" value="craft">
                        <img src="imgs/crafting.png">
                        <span for="checkboxskills5" onclick="document.getElementById('checkboxskills5').click()">
                            الحرف اليدويه</span>
                         

                        <br>
                    </div>
                    </div>
                    <hr>
                    <br>
                    <div class="form3">
                        <h2> اتعامل مع </h2>
                    
                    <div class="div-check-group">
                      
                        <input type="checkbox" id="checkboxDealWith1" name="checkboxDealWith[]" value="pet">
                        <img src="imgs/pets.png">
                        <span for="checkboxDealWith1" onclick="document.getElementById('checkboxDealWith1').click()">
                        حيوانات أليفة</span>
                    </div>

                        <div class="div-check-group">
                      <input type="checkbox" id="checkboxDealWith2" name="checkboxDealWith[]" value="cook">
                      <img src="imgs/cooking.png">
                      <span for="checkboxDealWith2" onclick="document.getElementById('checkboxDealWith2').click()">
                    الطبخ </span>
                        </div>
                        
                        <div class="div-check-group">
                      <input type="checkbox" id="checkboxDealWith3" name="checkboxDealWith[]" value="clean">
                      <img src="imgs/clean.png">
                      <span for="checkboxDealWith3" onclick="document.getElementById('checkboxDealWith3').click()">
                      واجبات منزلية </span>
                        </div>
                        <div class="div-check-group" >
                      <input type="checkbox" id="checkboxDealWith4" name="checkboxDealWith[]" value="homework assistance">
                      <img src="imgs/homework assistance.png">
                      <span for="checkboxDealWith4" onclick="document.getElementById('checkboxDealWith4').click()">
                      المساعدة في الواجبات المنزلية </span>
                        </div>
                        <hr>
                        </div>
                    
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
            <tr>
                <td>الصباح</td>
                <td>
                    <input type="hidden" name="availability[السبت][الصباح] " value="false">
                    <input type="checkbox" name="availability[السبت][الصباح]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الاحد][الصباح]" value="false">
                    <input type="checkbox" name="availability[الاحد][الصباح]" value="true">
                </td>               
                <td>
                    <input type="hidden" name="availability[الاثنين][الصباح]" value="false">
                    <input type="checkbox" name="availability[الاثنين][الصباح]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الثلاثاء][الصباح]" value="false">
                    <input type="checkbox" name="availability[الثلاثاء][الصباح]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الاربعاء][الصباح]" value="false">
                    <input type="checkbox" name="availability[الاربعاء][الصباح]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الخميس][الصباح]" value="false">
                    <input type="checkbox" name="availability[الخميس][الصباح]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الجمعة][الصباح]" value="false">
                    <input type="checkbox" name="availability[الجمعة][الصباح]" value="true">
                </td>
            </tr>
            <tr>
                <td>الظهر</td>
                <td>
                    <input type="hidden" name="availability[السبت][الظهر] " value="false">
                    <input type="checkbox" name="availability[السبت][الظهر]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الاحد][الظهر]" value="false">
                    <input type="checkbox" name="availability[الاحد][الظهر]" value="true">
                </td>               
                <td>
                    <input type="hidden" name="availability[الاثنين][الظهر]" value="false">
                    <input type="checkbox" name="availability[الاثنين][الظهر]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الثلاثاء][الظهر]" value="false">
                    <input type="checkbox" name="availability[الثلاثاء][الظهر]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الاربعاء][الظهر]" value="false">
                    <input type="checkbox" name="availability[الاربعاء][الظهر]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الخميس][الظهر]" value="false">
                    <input type="checkbox" name="availability[الخميس][الظهر]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الجمعة][الظهر]" value="false">
                    <input type="checkbox" name="availability[الجمعة][الظهر]" value="true">
                </td>
            </tr>
            <tr>
                <td>المساء</td>
                <td>
                    <input type="hidden" name="availability[السبت][المساء] " value="false">
                    <input type="checkbox" name="availability[السبت][المساء]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الاحد][المساء]" value="false">
                    <input type="checkbox" name="availability[الاحد][المساء]" value="true">
                </td>               
                <td>
                    <input type="hidden" name="availability[الاثنين][المساء]" value="false">
                    <input type="checkbox" name="availability[الاثنين][المساء]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الثلاثاء][المساء]" value="false">
                    <input type="checkbox" name="availability[الثلاثاء][المساء]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الاربعاء][المساء]" value="false">
                    <input type="checkbox" name="availability[الاربعاء][المساء]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الخميس][المساء]" value="false">
                    <input type="checkbox" name="availability[الخميس][المساء]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الجمعة][المساء]" value="false">
                    <input type="checkbox" name="availability[الجمعة][المساء]" value="true">
                </td>
            </tr>
            <tr>
                <td>الليل</td>
                <td>
                    <input type="hidden" name="availability[السبت][الليل] " value="false">
                    <input type="checkbox" name="availability[السبت][الليل]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الاحد][الليل]" value="false">
                    <input type="checkbox" name="availability[الاحد][الليل]" value="true">
                </td>               
                <td>
                    <input type="hidden" name="availability[الاثنين][الليل]" value="false">
                    <input type="checkbox" name="availability[الاثنين][الليل]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الثلاثاء][الليل]" value="false">
                    <input type="checkbox" name="availability[الثلاثاء][الليل]" value="true" >
                </td>
                <td>
                    <input type="hidden" name="availability[الاربعاء][الليل]" value="false">
                    <input type="checkbox" name="availability[الاربعاء][الليل]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الخميس][الليل]" value="false">
                    <input type="checkbox" name="availability[الخميس][الليل]" value="true">
                </td>
                <td>
                    <input type="hidden" name="availability[الجمعة][الليل]" value="false">
                    <input type="checkbox" name="availability[الجمعة][الليل]" value="true">
                </td>
            </tr>
        </tbody>
    </table> <br><br>

    <div class="inputgroup submit-button">
                     <input type="submit" value="التالي" >
                </div>
        </form>
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
</body>
</html>
