<?php
    session_start();
    include '../config/db.php';

    $parentID = $_SESSION['parentID'];
    $fname=$_SESSION['fname'];

    $sql = "SELECT bookings.*, information.f_name, information.l_name, information.gender,information.m_number, address.city, price.maxPrice, price.minPrice, files.path as profilePic
        FROM bookings
        JOIN information ON bookings.sitterID = information.informationID
        JOIN address ON information.addressID = address.addressID
        JOIN price ON information.priceID = price.priceID
        JOIN files ON files.userID = information.informationID AND files.description = 'الصورة الشخصية'
        WHERE bookings.userID = ?
        ORDER BY bookings.startDate DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $parentID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $bookings = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="Arabic" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="website icon" type="png" href="imge/title-removebg-preview.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../user/user.css">
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
            if (value === "logout") {
                window.location.href = '../'+encodeURIComponent(folderName)+'/login.php'; // Redirects to the main page
            }
        }
        function handleSelection() {
            var folderName="main page";
            return window.location.href = '../'+encodeURIComponent(folderName)+'/main1.php'; // Redirects to the main page
            
        }
    </script>
    <style>
        .card-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px;
                width: 100%;
            }

            .card {
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                width: 70%;
                text-align: center;
                margin-bottom: 20px;
                display: flex;
                flex-direction: row-reverse; /* Adjust to place icon on the left side */
                align-items: center;
            }

            .card-image {
                display: flex;
                justify-content: center;
                padding: 20px;
            }

            .card-image img {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
            }

            .card-info {
                padding: 20px;
                flex: 1; /* Allow the card info to take remaining space */
            }

            .card-info h2 {
                margin: 10px 0;
                font-size: 24px;
            }

            .card-info p {
                margin: 5px 0;
                font-size: 18px;
                color: #555;
            }

            .card-icons {
                display: flex;
                flex-direction: column; /* Stack icons vertically */
                justify-content: center;
                align-items: center;
                padding: 10px 20px;
                margin-right: 20px; /* Adjust space between icons and card info */
            }

            .card-icons i {
                font-size: 28px;
                margin: 10px 0;
            }

            .icon-text {
                font-size: 14px;
                margin-top: 5px;
            }

            .icon-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin: 10px 0;
            }

            .nav0 {
                height: 100px;
                background-color: transparent;
                color: black;
                display: flex;
                direction: ltr;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1;
                justify-content: space-between;
                flex-direction: row;
                transition: top 0.3s ease;
                margin-left: -20px;
            }
            
            .logo{
                margin-left:20px;
            }
    </style>
</head>

<body>

    
    <header class="header">
        <nav class="nav0">
            <div class="logo">
                <a id="logo" onclick="handleSelection()">
                    <img src="imge/logo (1).png">
                </a>
            </div>
            <div class="userOption">
                <select id="userOptions" onchange="handleSelectionlogout(this.value)">
                    <option value="name" disabled selected><?php echo $fname ?></option>
                    <option value="logout">Log Out</option>
                </select>
            </div>
        </nav>
    </header>
    <main class="main">
    <div class="txt">
        <h1>صفحه الحجوزات</h1>
    </div>

    <div class="card-container">
        <?php foreach ($bookings as $booking): ?>
            <div class="card">
                <div class="card-icons">
                    <?php if ($booking['status'] == 'booked'): ?>
                        <div class="icon-container">
                            <i class="fas fa-check icon" style="color: green;"></i>
                            <span class="icon-text">تم القبول</span>
                        </div>
                    <?php elseif ($booking['status'] == 'not booked'): ?>
                        <div class="icon-container">
                            <i class="fas fa-times icon" style="color: red;"></i>
                            <span class="icon-text">لم يتم القبول</span>
                        </div>
                    <?php elseif ($booking['status'] == 'pending'): ?>
                        <div class="icon-container">
                            <i class="fas fa-spinner icon waiting" style="color: blue;"></i>
                            <span class="icon-text">جاري الانتظار</span>
                        </div>
                    <?php elseif ($booking['status'] == 'started'): ?>
                        <div class="icon-container">
                            <i class="fas fa-play icon" style="color: orange;"></i>
                            <span class="icon-text">تم البدء</span>
                        </div>
                    <?php elseif ($booking['status'] == 'ended'): ?>
                        <div class="icon-container">
                            <i class="fas fa-stop icon" style="color: purple;"></i>
                            <span class="icon-text">تم النهاية</span>
                        </div>
                    <?php elseif ($booking['status'] == 'canceled'): ?>
                        <div class="icon-container">
                            <i class="fas fa-ban icon" style="color: red;"></i>
                            <span class="icon-text">تم الإلغاء</span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="card-info">
                    <h2><?php echo htmlspecialchars($booking['f_name'] . ' ' . $booking['l_name']); ?></h2>
                    <?php if($booking['gender']=='ذكر'){ ?>
                    <p>مربي في <?php echo htmlspecialchars($booking['city']); ?></p>
                    <?php } else { ?>
                        <p>مربيه في <?php echo htmlspecialchars($booking['city']); ?></p> <?php } ?>
                    <p><?php echo round(($booking['maxPrice'] + $booking['minPrice']) / 2, 2); ?> دينار للساعه</p>
                    <p>تاريخ البدء: <span><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($booking['startDate']))); ?></span></p>
                    <p>تاريخ الانتهاء: <span><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($booking['endDate']))); ?></span></p>
                    <p> أجمالي السعر :<?php echo $booking['totalPrice'] ?> دينار</p>
                    <p> رقم الهاتف :<?php echo $booking['m_number'] ?> </p>
                    <?php if ($booking['status'] != 'canceled' && $booking['status'] != 'ended' && $booking['status'] != 'not booked'): ?>
                        <form action="cancelBooking.php" method="post">
                            <input type="hidden" name="bookingID" value="<?php echo $booking['bookingID']; ?>">
                            <button class="contact-btn" style="background-color:#d02424;" type="submit" name="status" value="canceled">إلغاء</button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="card-image">
                    <img src="<?php echo htmlspecialchars($booking['profilePic']); ?>" alt="<?php echo htmlspecialchars($booking['f_name']); ?>">
                </div>
            </div>
        <?php endforeach; ?>
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

</body>
</html>