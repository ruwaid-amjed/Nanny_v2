<?php
    session_start();
    include '../config/db.php';

    if(isset($_GET['id'])){
        $userID=$informationID= $_GET['id'];
    }else{

    $userID=$_SESSION["userID"];
    
    $informationID=$_SESSION["informationID"];
    }

    $sql = "SELECT f_name, l_name, age,gender, addressID ,priceID , bioID , expID, jobPrefID ,skillID ,cmWithID , aboutmeID, certificationID FROM information WHERE informationID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $informationID;
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $f_name, $l_name, $age,$gender, $addressID,$priceID ,$bioID,$expID,$jobPrefID,$skillID,$cmWithID,$aboutmeID,$certificationID);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
    }
    }
$_SESSION['fname']=$f_name;
    $descriptionMap = [
        'الصورة الشخصية' => 'profilePic',
        'ملف التعريف' => 'identityPic',
        'شهادة عدم المحكومية' => 'noCriminalPic',
        'شهادة خلو امراض' => 'noIllPic'
    ];

    $sql = "SELECT path, description FROM files WHERE userID = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $userID);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if (array_key_exists($row["description"], $descriptionMap)) {
                    ${$descriptionMap[$row["description"]]} = $row["path"];
                }
            }
        }
        mysqli_stmt_close($stmt);
    }
}

$sql = "SELECT city FROM address WHERE addressID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $addressID);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $city);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    $sql = "SELECT (maxPrice + minPrice) / 2 AS averagePrice FROM price WHERE priceID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $priceID);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $averagePrice);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    $sql = "SELECT bioText FROM bio WHERE bioID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $bioID);
            if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $bioText);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            }
        }

        $sql = "SELECT paidYear, infant, toddler, preschool, elementary, middleSchool FROM experience WHERE expID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $expID);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $paidYear, $infant, $toddler, $preschool, $elementary, $middleSchool);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    $sql = "SELECT distance, numberOfKids FROM jobpreferences WHERE jobPreferencesID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $jobPrefID);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $distance, $numberOfKids);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    $sql = "SELECT reading, games, music, draw, craft FROM skills WHERE skillID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $skillID);
            if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $reading, $games, $music, $draw, $craft);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            }
        }

        $sql = "SELECT pets, cook, clean, homework FROM comfortablewith WHERE cmWithID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $cmWithID);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $pets, $cook, $clean, $homework);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    $sql = "SELECT time_slot, saturday, sunday, monday, tuesday, wednesday, thursday, friday FROM availability WHERE idUser = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $userID);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $time_slot, $saturday, $sunday, $monday, $tuesday, $wednesday, $thursday, $friday);
            
            while (mysqli_stmt_fetch($stmt)) {
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
        }
        mysqli_stmt_close($stmt);
    }

    $sql = "SELECT driverLicense, car, kids, smoking, sittingLocation, language, education FROM aboutme WHERE aboutmeID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $aboutmeID);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $driverLicense, $car, $kids, $smoking, $sittingLocation, $language, $education);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    $sql = "SELECT firstAid, CDA, SCC FROM certifications WHERE certificationID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $certificationID);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $firstAid, $CDA, $SCC);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="stylesheet" href="sittermain.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="website icon" type="png" href="image/title-removebg-preview.png">
    <script>
        window.onscroll = function () {
            var currentScrollPos = window.pageYOffset;

            if (currentScrollPos > 50) {
                document.querySelector("nav").classList.add("hidden-header");
            } else {
                document.querySelector("nav").classList.remove("hidden-header");
            }
        }

        function handleSelectionlog(value) {
            var folderName="login";
            if (value === "logout") {
                window.location.href = '../'+encodeURIComponent(folderName)+'/login.php'; // Redirects to the main page
            }
        }

        function handleSelection() {
            var folderName="main page";
            return window.location.href = '../'+encodeURIComponent(folderName)+'/main1.php'; // Redirects to the main page
            
        }

        
    
    </script>
</head>

<body>


    <header class="header">
        <nav class="nav0">
            <div class="logo">
                <a id="logo" onclick="handleSelection()">
                    <img src="image/logo (1).png">
                </a>
            </div>
            <div class="userOption">
                <button class="contact-btn1" onclick="location.href='sitterReservation2.php'">الحجوزات</button>
                 <select id="userOptions" onchange="handleSelectionlog(this.value)">
                <option value="name" disabled selected><?php echo $f_name ?></option>
                <option value="logout">Log Out</option>
                </select>
            </div>

        </nav>
        <div class="profile-container">
            <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Rennymar" class="profile-img">
            <div class="profile-info">
                <h1><?php echo $f_name ." ". $l_name ?></h1>

                <?php
                if($gender == "ذكر"){?>
                <p>مربي في <?php echo $city ?></p>
                <?php } else{ ?>
                <p>مربيه في <?php echo $city ?></p> <?php } ?>

                <div class="details">
                    <span>العمر :<?php echo $age ?></span>
                    <span>السعر بالساعة : <?php echo (float)$averagePrice ?> دينار </span>
                </div>
            </div>
        </div>
    </header>
    <div class="profile-bottom">
        <div class="left-section">
            <h1> السيره الذاتيه</h1>
            <p class="bio"><?php echo htmlspecialchars($bioText) ?></p>
            <hr>
            <div class="pic">
                <img src="image/bag.png">
                <div class="text-content">
                    <p>سنين الخبره المدفوعه </p>
                    <?php if($paidYear == 0){ ?>
                    <span> لا يمتلك خبرة</span><?php } ?>

                    <?php if($paidYear == 1){ ?>
                    <span>سنة</span><?php } ?>

                    <?php if($paidYear == 2){ ?>
                    <span>سنتين</span><?php } ?>

                     <?php if($paidYear > 2 && $paidYear < 11){ ?> 
                    <span><?php echo $paidYear . " "; ?>سنين</span><?php } ?>

                    <?php if($paidYear > 10){ ?>
                    <span><?php echo $paidYear . " "; ?>سنة</span><?php } ?>
                </div>
            </div>

            <div class="pic">
                <img src="image/care.png">
                <div class="text-content">
                    <p>الأعمار التي لديك خبرة بها</p>
                    <span>
                        <?php
                            if($infant)
                                echo "الرضيع (0 الى 11 شهرا) .";
                            if($toddler)
                                echo " طفل صغير ( 1-3)  .";
                            if($preschool)
                                echo " مرحلة ما قبل المدرسة (العمر 4-5)  .";
                            if($elementary)
                                echo " المرحلة الابتدائية ( 6-10 سنوات)  .";
                            if($middleSchool)
                                echo " المدرسة المتوسطة (الأعمار 11+) ";  ?>
                    </span>
                </div>
            </div>
            <div class="pic">
                <img src="image/children.png">
                <div class="text-content">
                    <p>الحد الأقصى للأطفال الذي ستهتم به في وقت واحد</p>
                    <span><?php echo $numberOfKids ?></span>
                </div>
            </div>
            <div class="pic">
                <img src="image/location.png">
                <div class="text-content">
                    <p>أقصى مسافة ستسافرها للحصول على وظيفة</p>
                    <span> <?php echo $distance ?></span>
                </div>
            </div>

            <br>
            <hr>
            <div class="pic">
                <img src="image/check2.png">
                <div class="text-content">
                    <p> الهويه الوطنيه</p>
                    <span> تم اضافتها </span>
                </div>
            </div>
            <div class="pic">
                <img src="image/sick.png">
                <div class="text-content">
                    <p>شهادة خلو أمراض</p>
                    <span> تم اضافاتها  </span>
                </div>
            </div>
            <div class="pic">
                <img src="image/noCriminal.png">
                <div class="text-content">
                    <p>شهادة عدم محكومية</p>
                    <span> تم اضافاتها  </span>
                </div>
            </div>
            <br>
            <hr>
            <div class="skill">
                <div class="containar">
                    <h2 class="text"> المهارات </h2>

                    <div class="myForm4">
                    <?php if($craft){ ?>
                        <div class="aboutme-radio">
                            <img src="image/crafting.png">
                            <p> الحرف اليدويه</p>
                        </div>
                    <?php }
                        if($reading){ ?>
                        <div class="aboutme-radio">
                            <img src="image/reading.png">
                            <p> القراءه</p>
                        </div>
                        <?php } if($music){ ?>
                        <div class="aboutme-radio">
                            <img src="image/music.png">
                            <p> الموسيقى</p>
                        </div>
                        <?php } if($draw){ ?>
                        <div class="aboutme-radio">
                            <img src="image/drawing.png">
                            <p> الرسم</p>
                        </div>
                        <?php } if($games){ ?>
                        <div class="aboutme-radio">
                            <img src="image/games.png">
                            <p> الالعاب </p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="containar">
                    <h2 class="text"> اتعامل مع </h2>

                    <div class="myForm4">
                    <?php if($pets){ ?>
                        <div class="aboutme-radio">
                            <img src="image/pets.png">
                            <p> الحيوانات الاليفه</p>
                        </div>
                    <?php } if($cook){ ?>
                        <div class="aboutme-radio">
                            <img src="image/cooking.png">
                            <p> الطبخ </p>
                        </div>
                    <?php } if($homework){ ?>
                        <div class="aboutme-radio">
                            <img src="image/homework assistance.png">
                            <p> المساعدة في الواجبات المنزلية</p>
                        </div>
                    <?php } if($clean) { ?>
                        <div class="aboutme-radio">
                            <img src="image/clean.png">
                            <p>واجبات منزلية</p>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="right-section">
            <button class="contact-btn" onclick="location.href='../sitterEdit/sitterForm1.php'">تعديل المعلومات </button>
            <div class="availability">
        <h3>:جدول الايام المتاحه</h3>
        <table class="availability-table">
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
                    <td><input type="checkbox" name="availability[<?php echo $time_slot; ?>][<?php echo $day; ?>]" <?php echo (isset($availability[$time_slot][$day]) && $availability[$time_slot][$day] == 1) ? 'checked' : ''; ?> disabled></td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

            <div class="text">
                <h2> المعلومات </h2>
            </div>
            <div class="myForm3">
            
                <div class="aboutme-radio">
                    <img src="image/driver.png">
                    <p> رخصه القياده </p>
                <?php if($driverLicense){ ?>
                    <span> نعم</span>
                <?php } else { ?>
                    <span> لا</span>
                <?php } ?>
                </div>
                <div class="aboutme-radio">
                    <img src="image/car.png">
                    <p> تملك سياره</p>
                    <?php if($car){ ?>
                    <span> نعم</span>
                <?php } else { ?>
                    <span> لا</span>
                <?php } ?>
                </div>

                <div class="aboutme-radio">
                    <img src="image/child.png">
                    <p> لديك اطفال</p>
                    <?php if($kids){ ?>
                    <span> نعم</span>
                <?php } else { ?>
                    <span> لا</span>
                <?php } ?>
                </div>
                <div class="aboutme-radio">
                    <img src="image/smoker.png">
                    <p> تقوم بالتدخين</p>
                    <?php if($smoking){ ?>
                    <span> نعم</span>
                <?php } else { ?>
                    <span> لا</span>
                <?php } ?>
                </div>
                <div class="aboutme-radio">
                    <img src="image/home.png">
                    <p> الموقع المفضل لمجالسة الأطفال</p>
                <?php if($sittingLocation== " موقع خاص بك"){ ?>
                    <span> موقع خاص بالجليس</span>
                    <?php } else{ ?>
                       <span><?php echo $sittingLocation; ?></span>  <?php } ?>
                </div>
                <div class="aboutme-radio">
                    <img src="image/languge.png">
                    <p> اللغات التي أتحدث بها</p>
                <?php if($language == "اللغتين"){ ?>
                    <span> العربية، الأنجليزية</span>
                <?php } else{ ?>
                    <span><?php echo $language; } ?></span>
                
                </div>
                <div class="aboutme-radio">
                    <img src="image/education.png">
                    <p> التعليم</p>
                    <span> <?php echo $education; ?></span>
                </div>
            </div>

            <hr>
            <div class="myForm3">
                <div class="aboutme-radio">
                    <img src="image/medical.png">
                    <p> دوره اسعافات أوليه</p>
                    <?php if($firstAid){ ?>
                    <span> نعم</span>
                <?php } else { ?>
                    <span> لا</span>
                <?php } ?>
                </div>
                <div class="aboutme-radio">
                    <img src="image/SCC.png">
                    <p> مساعد تنمية الطفل (CDA)</p>
                    <?php if($CDA){ ?>
                    <span> نعم</span>
                <?php } else { ?>
                    <span> لا</span>
                <?php } ?>
                </div>
                
                <div class="aboutme-radio">
                    <img src="image/ch.png">
                    <p> أخصائي رعاية الطفل</p>
                    <?php if($SCC){ ?>
                    <span> نعم</span>
                <?php } else { ?>
                    <span> لا</span>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <h1 id="h01"> التقييمات </h1>
    <div class="review-container">
        <div class="review-content">
            <p class="reviewer-name">Alyssa</p>
            <div class="rating">
                <!-- استخدام النجوم للتقييم -->
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
            <p class="review-text">My experience with Rachel has been awesome! Her little boy robin is so sweet and so
                full of life! I loved babysitting him and I can't wait </p>
            <p class="review-date">April 2024 تم التعديل </p>
        </div>
    </div>
    <br>
    <br>

    <div id="profileEdit" style="display: none;">
        <?php include 'sitterForm1.php'; ?>
        <?php include 'sitterForm2.php'; ?>
    </div>

    <footer class="site-footer">
        <div class="footer-container">
            <span class="footer-brand"> ♥ Nanny</span>
            <div class="social-icons">
                <a href="" class="social-icon" aria-label="Facebook"><img src="image/facebook-removebg-preview.png"
                        alt=""></a>
                <a href="" class="social-icon" aria-label="Twitter"><img src="image/twitter-removebg-preview.png"
                        alt=""></a>
                <a href="" class="social-icon" aria-label="Instagram"><img src="image/instgram-removebg-preview.png"
                        alt=""></a>
            </div>
            <div class="copyright">
                © 2024 Nanny. جميع الحقوق محفوظة.
            </div>
        </div>
    </footer>

    <script>
        function toggleEdit() {
            document.getElementById('profileDisplay').style.display = 'none';
            document.getElementById('profileEdit').style.display = 'block';
        }
    </script>

</body>


</html>