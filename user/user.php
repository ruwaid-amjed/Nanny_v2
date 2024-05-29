<?php
    session_start();
    include '../config/db.php';

    $informationID=$_SESSION['informationID'];
    $userID=$_SESSION["userID"];

    $sql = "SELECT f_name, l_name FROM information WHERE informationID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $informationID;
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $f_name, $l_name);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
    }
    }
    $_SESSION['fname']=$f_name;

    $sql = "SELECT COUNT(*) AS sitterCount FROM users WHERE role = 'مربية'";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $count);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }


    $sql = "SELECT 
    users.userID,info.f_name, info.l_name, info.gender, addr.city, bio.bioText, exp.paidYear,
    (price.maxPrice + price.minPrice) / 2 as averagePrice, files.path as profilePic
    FROM
        information info
    JOIN
        address addr ON info.addressID = addr.addressID
    JOIN
        bio ON info.bioID = bio.bioID
    JOIN
        experience exp ON info.expID = exp.expID
    JOIN
        price ON info.priceID = price.priceID
    JOIN
        files ON files.userID = info.informationID AND files.description = 'الصورة الشخصية'
        JOIN
        users ON users.informationID = info.informationID
    WHERE
        users.role = 'مربية'";
    $result = $conn->query($sql);

    
?>

<!DOCTYPE html>
<html lang="Arabic" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="website icon" type="png" href="imge/title-removebg-preview.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <link rel="stylesheet" href="user.css">
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

<body>

<header>
    <div class="logo">
        <a id="logo" onclick="handleSelection()">
            <img src="imge/logo (1).png">
        </a>
    </div>

    <div class="userOption">
        <button class="contact-btn" onclick="location.href='../sitterReservation/sitterReservation.php'">الحجوزات</button>
        <select id="userOptions" onchange="handleSelectionlogout(this.value)">
            <option value="name" disabled selected><?php echo $f_name ?></option>
            <option value="logout">Log Out</option>
        </select>
    </div>
</header>
    <main class="main">
        <div class="filter-buttons">
            <?php 
                $cities = array(
                    "عمان","الزرقاء","أربد","البلقاء","المفرق",
                    "العقبة","عجلون","جرش","معان","مأدبا","الكرك",
                    "الطفيلة"
                     );
             ?>
                <select id="cityFilter">
                <option value="" disabled selected>اختر المدينة</option>
            <?php 
                foreach($cities as $value){
            ?>
                <option value="<?php echo $value ?>"><?php echo $value ?></option>
            <?php
                }
            ?>
               </select>
            <button class="filter-button" data-filter="price_desc">
                <i class="fas fa-sort-amount-up"> اعلى سعر </i>
            </button>
            <button class="filter-button" data-filter="price_asc">
                <i class="fas fa-sort-amount-down"> اقل سعر </i>
            </button>
        </div>


        <div class="txt">
            <p>
                هل تبحث عن جليسة أطفال موثوقة؟ لدى Nanny الآن عدد <?php echo $count ?> من جليسات الأطفال النشطات اللواتي
                يطابقن معايير بحثك.<br><br>
                سواء كانت ليلة خاصة، أو أوقات العمل، أو ببساطة لحظات تحتاج فيها إلى استراحة، اعتمد على Nanny
                للعثور على الجليسة المثالية لأطفالك.
            </p>
        </div>
        <div class="card-container">

        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { 
                    ?>
            <div class="card">
                <div class="card-image">
                    <img src="<?php echo $row['profilePic'] ?>" alt="<?php echo $row['f_name'] ?>">
                </div>
                <div class="card-info">
                    <h2><?php echo $row['f_name'].' '.$row['l_name'] ?></h2>
                <?php if($row['gender'] == "ذكر"){ ?>
                    <p>مربي في <?php echo $row['city'] ?></p> 
                    <?php } else{ ?>
                    <p>مربيه في <?php echo $row['city'] ?></p>
                    <?php } ?>

                    <p class="ellipsis"><?php echo $row['bioText'] ?></p>

                    <div class="card-details">
                        <span>عدد سنوات الخبره : <?php echo $row['paidYear'] ?></span>
                    </div>
                    <div class="card-price">
                        <?php echo (float)$row['averagePrice'] ?> دينار للساعه
                    </div>
                </div>
                <a href="../userSitter/sitter.php?userID=<?php echo $row['userID'] ?>" class="card-arrow">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>

        <?php
            }
            } else { ?>
                <div>
                    <p>لا يوجد مربيات حاليا</p>
                </div>
            <?php }  ?>
        </div>



    </main>
    <br> <br>
    <footer class="site-footer">
        <div class="footer-container">
            <span class="footer-brand">Nanny ♥</span>
            <div class="social-icons">
                <a href="" class="social-icon" aria-label="Facebook"><img src="imge/facebook-removebg-preview.png"
                        alt=""></a>
                <a href="" class="social-icon" aria-label="Twitter"><img src="imge/twitter-removebg-preview.png"
                        alt=""></a>
                <a href="" class="social-icon" aria-label="Instagram"><img src="imge/instgram-removebg-preview.png"
                        alt=""></a>
            </div>
            <div class="copyright">
                © 2024 Nanny. جميع الحقوق محفوظة.
            </div>
        </div>
    </footer>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterButtons = document.querySelectorAll(".filter-button");
            const cityFilter = document.getElementById("cityFilter");

            cityFilter.addEventListener("change", function() {
                fetchSitters(this.value, '');
            });

            filterButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const filterType = this.getAttribute("data-filter");
                    const city = cityFilter.value;
                    fetchSitters(city, filterType);
                });
            });

            function fetchSitters(city, filterType) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'fetch_sitters.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status === 200) {
                        document.querySelector('.card-container').innerHTML = this.responseText;
                    } else {
                        console.error('Failed to retrieve data');
                    }
                };
                xhr.send('city=' + encodeURIComponent(city) + '&filter=' + encodeURIComponent(filterType));
            }
        });
    </script>

</body>

</html>

<?php 
$conn->close();
?>