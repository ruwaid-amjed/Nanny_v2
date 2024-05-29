<?php
session_start();
include '../config/db.php';

// Fetch sitter ID and information ID from session
$sitterID = $_SESSION['userID'];
$sitterInfoID = $_SESSION['informationID'];
$fname=$_SESSION['fname'];

// Fetch reservations for this sitter
$sql = "SELECT bookings.*, 
               parentInfo.f_name AS parentFirstName, parentInfo.l_name AS parentLastName, parentInfo.m_number AS parentMobile, 
               info.f_name, info.l_name, address.city,
               (price.maxPrice + price.minPrice) / 2 AS averagePrice 
        FROM bookings 
        JOIN users parentUser ON bookings.userID = parentUser.userID 
        JOIN information parentInfo ON parentUser.informationID = parentInfo.informationID 
        JOIN address ON parentInfo.addressID = address.addressID
        JOIN users sitterUser ON bookings.sitterID = sitterUser.userID 
        JOIN information info ON sitterUser.informationID = info.informationID 
        JOIN price ON info.priceID = price.priceID 
        WHERE bookings.sitterID = ?
        ORDER BY bookings.startDate DESC";
        
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $sitterID);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../user/user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Cairo:wght@200..1000&family=Lalezar&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Kufi+Arabic:wght@100..900&family=Noto+Naskh+Arabic:wght@400..700&family=Poppins:ital,wght@0,100;0,400;1,100&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
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
            display: flex;
            flex-direction: row-reverse; /* Changed to row-reverse to align items correctly */
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 70%;
            text-align: right;
            margin-bottom: 20px;
            padding: 20px;
        }

        .card-info {
            flex-grow: 2; /* Adjusted to make space for other elements */
            padding: 20px;
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            flex-grow: 1; /* Added to take up remaining space */
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

        .action-buttons {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-grow: 1; /* Added to take up remaining space */
        }

        .contact-btn {
            font-weight: bold;
            word-spacing: 10px;
            letter-spacing: 1px;
            background-color: #163a5f;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            width: 100%;
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
                    <img src="image/logo (1).png">
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
            <h1>صفحة الحجوزات</h1>
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
                    
                    <?php elseif ($booking['status'] == 'canceled'): ?>
                        <div class="icon-container">
                            <i class="fas fa-ban icon" style="color: red;"></i>
                            <span class="icon-text">تم الإلغاء</span>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($booking['status'] == 'pending'): ?>
                <div class="action-buttons">
                    <form action="updateBookingStatus.php" method="post">
                        <input type="hidden" name="bookingID" value="<?php echo $booking['bookingID']; ?>">
                        <button class="contact-btn" style="background-color:#4b8a30;" type="submit" name="status" value="booked">قبول</button>
                        <button class="contact-btn" style="background-color:#d02424;" type="submit" name="status" value="not booked">رفض</button>
                    </form>
                </div>
                <?php endif; ?>
                <div class="card-info">
                    <h2><?php echo htmlspecialchars($booking['parentFirstName'] . ' ' . $booking['parentLastName']); ?></h2>
                    <p>تاريخ البدء: <span><?php echo htmlspecialchars($booking['startDate']); ?></span></p>
                    <p>تاريخ الانتهاء: <span><?php echo htmlspecialchars($booking['endDate']); ?></span></p>
                    <p>موقع المجالسة: <?php echo htmlspecialchars($booking['location']); ?></p>
                    <p>رقم هاتف الوالد: <?php echo htmlspecialchars($booking['parentMobile']); ?></p>
                    <p>اجمالي السعر: <?php echo htmlspecialchars($booking['totalPrice']); ?> دينار</p>
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
