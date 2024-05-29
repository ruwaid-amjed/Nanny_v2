<?php
    
    session_start();
    
    // Define a function to handle file uploads
    function handle_file_upload($file_input_name) {
        $file_store_path = "../uploads/"; // Ensure this directory exists and is writable
        
    
            $file_tmp_name = $_FILES[$file_input_name]['tmp_name'];
            $file_name = basename($_FILES[$file_input_name]['name']);
            $destination = $file_store_path . $file_name;
            if (move_uploaded_file($file_tmp_name, $destination)) {
                $uploaded_files = $destination;
            }
        
    
        return $uploaded_files;
    }
    
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION['personal_photo'] = handle_file_upload('personal_photo');
        $_SESSION['identity'] = handle_file_upload('identity');
        $_SESSION['nocriminal'] = handle_file_upload('nocriminal');
        $_SESSION['health'] = handle_file_upload('health');
    
        // Redirect or perform other actions after handling files
         header("Location: store_in_db_first.php"); // Redirect to another page
        // exit;
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
        <form method="post" enctype="multipart/form-data">
            <h1>مرفقات المستندات</h1>
            <div class="input-container">
                <label for="personal-photo">أضف صورتك الشخصية</label>
                <input type="file" id="personal-photo" name="personal_photo"  accept="image/*" required>
            </div>
            <div class="input-container">
                <label for="identity">أضف الهوية الشخصية أو جواز السفر أو رخصة القيادة</label>
                <input type="file" id="identity" name="identity"  accept="image/*,application/pdf" required>
            </div>
            <div class="input-container">
                <label for="nocriminal">أضف شهادة عدم محكومية</label>
                <input type="file" id="nocriminal" name="nocriminal"  accept="image/*,application/pdf" required>
            </div>
            <div class="input-container">
                <label for="health">أضف شهادة خلو أمراض</label>
                <input type="file" id="health" name="health"  accept="image/*,application/pdf" required>
            </div>
            <div class="input-container">
                <label for="other-certificates">شهادات أخرى (أختياري)</label>
                <input type="file" id="other-certificates" name="other_certificates[]" multiple accept="image/*,application/pdf">
            </div>
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
            <a href="" class="social-icon" aria-label="Facebook"><img src="imgs/facebook-removebg-preview.png" alt=""></a>
            <a href="" class="social-icon" aria-label="Twitter"><img src="imgs/twitter-removebg-preview.png" alt=""></a>
            <a href="" class="social-icon" aria-label="Instagram"><img src="imgs/instgram-removebg-preview.png" alt=""></a>
        </div>
        <div class="copyright">
            © 2024 Nanny. جميع الحقوق محفوظة.
        </div>
    </div>
</footer>
</body>
</html>
