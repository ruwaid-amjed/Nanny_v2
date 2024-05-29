<?php
    session_start();
    // Handle role from either GET or POST
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['role'])) {
        $_SESSION['role'] = $_GET['role'];
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['role'])) {
        $_SESSION['role'] = $_POST['role'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanny</title>
    <link rel="website icon" type="png" href="imgs/title-removebg-preview.png">
    <link rel="stylesheet" href="sitterSignUp.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
<script>
       function handleSelectionSignup(selectedRole) {
    if (selectedRole === 'عائلة') {
        window.location.href = '../usersignup/signupuser.php?role=' + encodeURIComponent(selectedRole);
    } else if (selectedRole === 'مربية') {
        window.location.href = '#'
    }
}

        function handleSelection() {
            var folderName="main page";
            return window.location.href = '../'+encodeURIComponent(folderName)+'/main1.php'; // Redirects to the main page
            
        }
    </script>

    <style>
        #userOptions {
    font-size: 20px;
    padding: 8px 16px;
    border-radius: 2px;
    border: 1px solid #ccc;
    cursor: pointer;
    background-color: #163a5f; /* Light grey background for the dropdown */
    color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    margin-top:15px;
}

#userOptions option {
    background: #fff;
    font-weight: bold;
    color:black;
}

.userOption {
    margin-left: 20px; /* Ensure spacing between button and select */
}

#userOptions:hover {
    border-color: #888;
}

#userOptions:focus {
    outline: none;
    border-color: #555;
}

 #userOptions {
    height: 40px; /* Ensuring same height for both */
    align-items: center;
}

    </style>
</head>

<body>
    <header>        
        <div class="logo">
            <a id="logo" onclick="handleSelection()">
                <img src="imgs/logo (1).png">
            </a>
        </div>
        
        <div class="btns" style="display: flex; align-items: center;">
    <a href="../login/login.php" id="aLogin" >
        <button id="login">دخول</button>
    </a>
    <div class="userOption" style="margin-bottom: 45px;">
        <select id="userOptions" name="role" onchange="handleSelectionSignup(this.value)">
            <option value="" disabled selected>أشتراك</option>
            <option value="عائلة">والد</option>
            <option value="مربية">جليسة</option>
        </select>
    </div>
</div>      
    </header>

    <main class="main">
        <div class="container">
            <div class="page">
                <p> تبحث عن رعايه ؟ <a href="../usersignup/signupuser.php?role=عائلة"> اشترك هنا</a> </p>
                <h2>Nanny انشاء حساب في </h2>
                <span>هل لديك حساب بالفعل؟ <a href="../login/login.php">تسجيل دخول </a></span>
            </div>
        <div class="myForm">
            <form  action="sitterSignUpGenral2.php" method="post" auto_complete="off" id="signupForm">
                <div class=" inputgroup">
                    <input type="text" id="firstName" name="firstName" placeholder=" " >
                    <label for="firstName">الاسم الاول</label> 
                    <span class="error-message" style="color: red;"></span>
                </div>

                <div class=" inputgroup">       
                    <input type="text" id="lastName" name="lastName" placeholder=" " >
                    <label for="lastName">الاسم الاخير </label>
                    <span class="error-message" style="color: red;"></span>
                </div>


                <div class=" inputgroup">       
                    <input type="text" id="email" name="email" placeholder=" " >
                    <label for="email"> البريد الالكتروني  </label>
                    <span class="error-message" style="color: red;"></span> 
                </div>

                <div class=" inputgroup">       
                    <input type="password" id="password" name="password" placeholder=" " autocomplete=off >
                    <label for="password"> كلمه السر </label>
                    <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility()"></i>
                </div>
                    <ul class="password-criteria">
                        <li id="min-char">يجب أن تكون على الأقل ٨ أحرف</li>
                        <li id="uppercase">يجب أن تحتوي على أحرف كبيرة </li>
                        <li id="lowercase">يجب أن تحتوي على أحرف صغيرة </li>
                        <li id="number">يجب أن تحتوي على رقم واحد على الأقل</li>
                        <li id="special-char">يجب أن تحتوي على حرف خاص واحد على الأقل (مثل !، @، #، $)</li>
                    </ul><br>

                <div class=" inputgroup">       
                    <input type="tel" id="mobileNumber" name="mobileNumber"  placeholder=" " >
                    <label for="mobileNumber"> رقم الهاتف</label>
                    <span class="error-message" style="color: red;"></span> 
                </div>
                <ul>
                    <li>لن نعرض رقم هاتفك للأعضاء الآخرين</li>
                </ul>
                <br>
                <!-- added by ruwaid -->
                <div class="inputgroup">
                    <input type="date" id="birthdate" name="birthdate" placeholder="تاريخ الميلاد" >
                    <label for="birthdate">تاريخ الميلاد</label>
                    <span class="error-message" style="color: red;"></span>
                </div>
                <br>

                <div class="gender-selection">
                    <p>أضف علامة الجنس الموجودة على بطاقة هويتك الحكومية</p>
                    <div class="radio-group">
                    <div class="div-input-group">    
                        <input type="radio" name="gender" value="ذكر" id="male" >
                        <span onclick="document.getElementById('male').click()">ذكر</span>
                        </div>
                        <div class="div-input-group">
                            <input type="radio" name="gender" value="أنثى" id="female" >
                            <span onclick="document.getElementById('female').click()">أنثى</span>
                        </div> 
                    </div>
                    <span class="error-message" style="color: red;"></span>
                </div>

                <div class="inputgroup">
                        <?php 
                            $cities = array(
                                "عمان","الزرقاء","أربد","البلقاء","المفرق",
                                "العقبة","عجلون","جرش","معان","مأدبا","الكرك",
                                "الطفيلة"
                            );
                        ?>
                        <select name="cities" id="cities"  >
                            <option value="" disabled selected>اختر مدينتك</option>
                            <?php 
                                foreach($cities as $value){
                             ?>
                            <option value="<?php echo $value ?>"><?php echo $value ?></option>
                             <?php
                                }
                            ?>

                        </select>
                        <span class="error-message" style="color: red;"></span>
                </div>

                <div class=" inputgroup">
                    <input type="text" id="address" name="address" placeholder=" " >
                    <label for="address">العنوان</label>
                    <span class="error-message" style="color: red;"></span>
                </div>

                <div class=" inputgroup">
                    <input type="text" id="addressDirection" name="addressDirection" placeholder=" " >
                    <label for="addressDirection">(أختياري) توجيهات أضافية</label> 
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
    async function checkEmailAndPhone() {
            const email = document.getElementById('email').value.trim();
            const mobileNumber = document.getElementById('mobileNumber').value.trim();
            const response = await fetch('../usersignup/emailPhoneCheck.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `email=${encodeURIComponent(email)}&mobileNumber=${encodeURIComponent(mobileNumber)}`
            });

            if (!response.ok) {
                console.error("Failed to fetch:", response.statusText);
                return { emailExists: false, phoneExists: false };
            }

            const result = await response.json();
            return result;
        }

        async function validateForm(event) {
            event.preventDefault();
            let valid = true;
            const firstName = document.getElementById('firstName');
            const lastName = document.getElementById('lastName');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const mobileNumber = document.getElementById('mobileNumber');
            const birthdate = document.getElementById('birthdate');
            const genderMale = document.getElementById('male');
            const genderFemale = document.getElementById('female');
            const cities = document.getElementById('cities');
            const address = document.getElementById('address');

            clearErrors();

            if (firstName.value.trim() === "") {
                showError(firstName, 'أدخل الاسم الأول');
                valid = false;
            }

            if (lastName.value.trim() === "") {
                showError(lastName, 'أدخل الأسم الأخير');
                valid = false;
            }

            if (email.value.trim() === "") {
                showError(email, 'أدخل  البريد الالكتروني');
                valid = false;
            } else if (!validateEmail(email.value)) {
                showError(email, 'أدخل البريد الألكتروني بالشكل الصحيح');
                valid = false;
            }

            if (mobileNumber.value.trim() === "") {
                showError(mobileNumber, 'أدخل رقم الهاتف');
                valid = false;
            } else if (!validateMobileNumber(mobileNumber.value)) {
                showError(mobileNumber, 'رقم الهاتف يجب أن يتكون من عشر أرقام و يبدأ ب(07)');
                valid = false;
            }

            if (birthdate.value.trim() === "") {
                showError(birthdate, 'أدخل تاريخ الميلاد');
                valid = false;
            }

            const age = calculateAge(birthdate);
            if (age < 18) {
                showError(birthdate, 'يجب أن يكون عمرك 18 عامًا أو أكثر');
                valid = false;
            }

            if (!genderMale.checked && !genderFemale.checked) {
                showError(genderMale, 'Please select a gender.');
                valid = false;
            }

            if (cities.value.trim() === "") {
                showError(cities, 'أدخل المدينة');
                valid = false;
            }

            if (address.value.trim() === "") {
                showError(address, 'أدخل العنوان');
                valid = false;
            }

            const checkResult = await checkEmailAndPhone();
            if (checkResult.emailExists) {
                showError(email, 'البريد الإلكتروني موجود بالفعل');
                valid = false;
            }
            if (checkResult.phoneExists) {
                showError(mobileNumber, 'رقم الهاتف موجود بالفعل');
                valid = false;
            }

            if (valid) {
                document.getElementById('signupForm').submit();
            }
        }

        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function validateMobileNumber(mobileNumber) {
            const regex = /^07\d{8}$/;
            return regex.test(mobileNumber);
        }

        function calculateAge(birthdate) {
            const birthDate = new Date(birthdate.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        function showError(inputElement, message) {
            const parent = inputElement.parentElement;
            const errorSpan = parent.querySelector('.error-message');
            errorSpan.textContent = message;
        }

        function clearErrors() {
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach((span) => {
                span.textContent = '';
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('signupForm').addEventListener('submit', validateForm);
        });
    </script>







<script>
const inputs = document.querySelectorAll('.form-container input');
inputs.forEach(input => {
  input.addEventListener('input', () => {
    const label = input.nextElementSibling;
    if (input.value !== '') {
      label.classList.add('active');
    } else {
      label.classList.remove('active');
    }
  });
});


function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var passwordIcon = document.querySelector('.toggle-password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}


document.addEventListener('DOMContentLoaded', function() {

    let password = document.getElementById('password');
    let email = document.getElementById('email');

    setTimeout(function() {
        password.value='';
        email.value='';
}, 550);    

})


document.querySelector('#password').addEventListener('input',function(){
    var password = this.value;
    var minChar = document.getElementById('min-char');
    var uppercase = document.getElementById('uppercase');
    var lowercase = document.getElementById('lowercase');
    var number = document.getElementById('number');
    var specialChar = document.getElementById('special-char');

    minChar.classList.toggle('valid', password.length >= 8);
    uppercase.classList.toggle('valid', /[A-Z]/.test(password));
    lowercase.classList.toggle('valid', /[a-z]/.test(password));
    number.classList.toggle('valid', /[0-9]/.test(password));
    specialChar.classList.toggle('valid', /[!$%@#&*]/.test(password));
});

       
 </script>

</body>
</html>
