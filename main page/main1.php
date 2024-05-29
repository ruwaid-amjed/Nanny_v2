<?php
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/db.php';  

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact_us (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        $_SESSION['popup_message'] = 'Message sent successfully!';
    } else {
        $_SESSION['popup_message'] = 'Failed to send message.';
    }
    $stmt->close();
    $conn->close();

    header('Location: main1.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="Arabic" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="website icon" type="png" href="image and video/title-removebg-preview.png">

    <link rel="stylesheet" href="main1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:
        wght@100..900&family=Cairo:wght@200..1000&family=Lalezar&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Kufi+Arabic:wght@100..900&family=Noto+Naskh+Arabic:wght@400..700&family=Poppins:ital,wght@0,100;0,400;1,100&family=Roboto+Condensed:
        ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
        <script>
            window.onscroll = function () {
            var currentScrollPos = window.pageYOffset;

            if (currentScrollPos > 50) { 
                document.querySelector("header").classList.add("hidden-header");
            } else {
                document.querySelector("header").classList.remove("hidden-header");
            }
        }

        
        </script>
</head>

<body>

    <header>
        <div class="logo">
            <a href="#">
                <img src="image and video/logo2.png">
            </a>
        </div>
        <nav>
            <ul>
                <li> <a href="#servic"> خدماتنا </a></li>
                <li> <a href="#about-us">من نحن</a></li>
                <li><a href="#contact-us">تواصل معنا</a></li>

                <li><a href="../login/login.php" class="login-button">تسجيل الدخول</a></li>
                <li>
                    <form id="roleForm" class="signup-form">
                        <select id="roleSelect" name="role">
                            <option value="" disabled selected>أشتراك</option>
                            <option value="عائلة">والد</option>
                            <option value="مربية">جليسة</option>
                        </select>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <section class="hero">

        <video autoplay muted loop>
            <source src="image and video/pexels-c-technical-6985708 (2160p).mp4" type="video/mp4">
        </video>
        <div class="text">
            <div class="insid">
                <h1>مرحبا بكم في ناني جسركم نحو رعاية اطفال امنه وموثوقه</h1>
                <p> نحن هنا لنسهل عليكم الوصول الى افضل جليسات الاطفال في منطقتكم  مع التزامنا بالجوده والثقه </p>
                <div class="btns">
                    <form action="../sitterSignup/sitterSignupGenral.php" method="post">
                        <input type="hidden" name="role" value="مربية">
                        <button>  انضمي الينا كجليسه اطفال</button>
                    </form>
                    <form action="../usersignup/signupuser.php" method="post">
                        <input type="hidden" name="role" value="عائلة">
                        <button> ابدأ بحثك عن جليسه اطفال</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>

    <div class="label" id="servic">خدماتنا</div>

    <section class="whyus">

        <div class="box">
            <h3> أنت تعرف ما هو الأفضل بالنسبة لك - نحن فقط نجعل الأمر أسهل</h3>
            <p>
                سواء كنت تبحث عن جليسة أطفال أو وظيفة مجالسة أطفال جديرة بالثقة، فإن NANNY تساعدك على اتخاذ قرارات رعاية
                الطفل بسهولة قدر الإمكان</p>
        </div>

        <div class="box">
            <h3> نحن نحرص على سلامتك</h3>
            <p>من خلال التحقق من الهوية، والمراجعات، والفحوصات الجنائية، والرسائل والمدفوعات الآمنة، فإن الحفاظ على
                سلامتك أنت وعائلتك هو أولويتنا القصوى</p>
        </div>

        <div class="box">
            <h3>قلق أقل - راحة بال أكثر</h3>
            <p>تساعد الملفات الشخصية الشفافة والأدوات المفيدة وفريق الدعم الموثوق لدينا على إزالة التوتر المرتبط برعاية
                الأطفال ويمنحك راحة البال!</p>
        </div>

    </section>

    <section class="servic">
        <div class="servic-card">
            <img src="image and video/pexels-sides-imagery-3697601.jpg " class="servic-img">
            <h2 class="service-title">رعاية الأطفال أثناء العطل المدرسية</h2>

        </div>

        <div class="servic-card">
            <img src="image and video/pexels-kampus-production-7078765.jpg" class="servic-img">
            <h2 class="service-title">رعاية الأطفال النهارية</h2>
        </div>

        <div class="servic-card">
            <img src="image and video/pexels-monstera-production-5996973.jpg" class="servic-img">
            <h2 class="service-title">رعاية الأطفال المسائية</h2>
        </div>

    </section>

    <div class="label" id="about-us">من نحن</div>

    <section class="about-us-section">

        <div class="about-us-content">
            <h2>دعنا نخبرك</h2>
            <p>مرحبًا بك في Nanny، شريكك الموثوق به في خدمات رعاية الأطفال ومجالسة الأطفال. مهمتنا هي ربط العائلات
                بالمربيات المؤهلات والمهتمات برفاهية أطفالك وتنميتهم.</p>
            <p>في Nanny، نحن ندرك أهمية العثور على الشريك المثالي لعائلتك. ولهذا السبب نقوم بفحص جميع مقدمي الرعاية
                لدينا بدقة، للتأكد من أن لديهم الخبرة والمراجع والفحوصات الخلفية لتوفر لك راحة البال.</p>
            <p>سواء كنت تبحث عن دعم بدوام كامل، أو مجالسة أطفال من حين لآخر، أو رعاية متخصصة، فإن Nanny هنا لمساعدتك في
                العثور على الرعاية المناسبة لأطفالك الصغار.</p>
        </div>

        <div class="about-us-image">
            <img src="image and video/aboutUs.webp" alt="about-us">
        </div>

    </section>


    <div class="label" id="contact-us">تواصل معنا</div>

    <div class="contact-text">
        <h2>نحن ندعمك</h2>
        <p>إذا كان لديك أي أسئلة أو تعليقات حول موقعنا، فنحن نحب أن نسمع منك. فريق دعم العملاء المخصص لدينا متاح
            لمساعدتك في أي استفسارات أو مخاوف قد تكون لديك.</p>
    </div>

    <section class="contact-us" id="contact">

        <div class="contact-info">
            <img src="image and video/DALL·E 2024-03-28 15.57.59 - Create an illustration of a friendly female customer service representative with a headset, sitting at a computer desk. She is surrounded by icons sym.webp"
                alt="Customer Service" class="contact-image">
        </div>

        <div class="contact-form-container">
            <form class="contact-form" action="" method="post">
                <input type="text" name="name" placeholder="اسمك" required>
                <input type="email" name="email" placeholder="بريدك الإلكتروني" required>
                <input type="number" name="phone" placeholder="رقم الهاتف" required>
                <textarea name="message" rows="6" placeholder="رسالتك" required></textarea>
                <input type="submit" value="إرسال" class="send-btn">
            </form>
        </div>

    </section>

    <footer class="site-footer">
        <div class="footer-container">
            <span class="footer-brand">Nanny ♥</span>
            <div class="social-icons">
                <a href="" class="social-icon" aria-label="Facebook"><img
                        src="image and video/facebook-removebg-preview.png" alt=""></a>
                <a href="" class="social-icon" aria-label="Twitter"><img
                        src="image and video/twitter-removebg-preview.png" alt=""></a>
                <a href="" class="social-icon" aria-label="Instagram"><img
                        src="image and video/instgram-removebg-preview.png" alt=""></a>
            </div>
            <div class="copyright">
                © 2024 Nanny. جميع الحقوق محفوظة.
            </div>
        </div>
    </footer>


    <script>
        
        window.onload = function() {
            <?php if (isset($_SESSION['popup_message'])): ?>
                alert("<?php echo addslashes($_SESSION['popup_message']); ?>");
                <?php unset($_SESSION['popup_message']);  ?>
            <?php endif; ?>
        };

        document.getElementById('roleSelect').addEventListener('change', function() {
            var path = this.value === 'عائلة' ? '../usersignup/signupuser.php?role=عائلة' : '../sitterSignup/sitterSignupGenral.php?role=مربية'; 
                window.location.href = path;
            }
        );
    </script>    
</body>
</html>