<?php 
session_start();
if(!isset($_SESSION["docid"])){
header("Location: login_dt.php");
}
include "../connection.php";


if(isset($_POST['ins'])){
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $cnic = $_POST['cnic'];
    $city = $_POST['city'];
    $educate = $_POST['education'];
    $exp = $_POST['exp'];
    $special = $_POST['special'];
    $shift = $_POST['shift'];
    $clinic = $_POST['clinic'];
   
     $clinic2 = implode(',', $clinic);

   if (!preg_match('/^[0-9]{13}$/', $cnic)) {
    echo "<script>alert('CNIC must be 13 digits without hyphens'); window.history.back();</script>";
    exit;
}


     $user_id = $_SESSION["docid"];
     $qeury1 = "SELECT * FROM signup WHERE id = $user_id";
     $queryexec = mysqli_query($con, $qeury1);
     $user_data = mysqli_fetch_assoc($queryexec);

     $name = $user_data['name'];
     $email = $user_data['email'];
     $phone = $user_data['phone'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $img_size = $_FILES['image']['size'];
    $img_error = $_FILES['image']['error'];

    $target_folder = 'doc_image/';
    $allowed_extension = ['jpeg','jpg','png','jfif'];
    $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));


    if($img_size > 2 * 1024 * 1024){
        echo "Image size is too large";
        exit;
    }
    
    if(!in_array($file_extension, $allowed_extension)){
        die ("Only JPG, JPEG, PNG, JFIF files are allowed.");
    }

    $rename_img = str_replace('','_',pathinfo($image_name, PATHINFO_FILENAME));
    $new_name = $rename_img.'_'.date("Ymd_His").'.'.$file_extension;
    
    $target = $target_folder.$new_name;

    if(move_uploaded_file($image_tmp ,$target)){   
        $query = "INSERT INTO doctor (name, email, phone, gender, DOB, city, CNIC, education, experience, speciality, shift, address, drimage) VALUES ('$name','$email','$phone','$gender','$dob','$city','$cnic','$educate', '$exp', '$special', '$shift', '$clinic2','$new_name')";
    $result = mysqli_query($con, $query);
    if($result){
        echo "<script>alert('Data Inserted'); window.location.href='login_dt.php';</script>";
    }else {
        echo "<script>alert('Data  not Inserted')</script>";
    }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare - Doctor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #198754;
            --accent-color: #6f42c1;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --card-gradient: linear-gradient(135deg, #f0f7ff, #e6f7ff);
        }
        
        body {
            background: linear-gradient(135deg, #e0f7fa, #bbdefb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark-text);
            overflow-x: hidden;
        }
        
        .registration-container {
            max-width: 1000px;
            margin: 0 auto;
            animation: fadeIn 0.8s ease-out;
        }
        
        .registration-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .registration-card:hover {
            transform: translateY(-5px);
        }
        
        .header-section {
            background: linear-gradient(120deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header-section::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            animation: pulse 8s infinite;
        }
        
        .header-section i {
            font-size: 3.5rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }
        
        .form-section {
            padding: 30px;
            background: var(--card-gradient);
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            padding: 14px 20px;
            border: 2px solid #d6d6d6ff;
            transition: all 0.3s;
            font-size: 1rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.2);
        }
        
        .input-group-text {
            background: #e9ecef;
            border: 1px solid #c9c9c9ff;
            border-radius: 12px 0 0 12px;
            transition: all 0.3s;
            padding: 0 20px;
        }
        
        .form-control:focus + .input-group-text {
            border-color: var(--primary-color);
            background: var(--primary-color);
            color: white;
        }
        
        .btn-register {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 50px;
            padding: 14px 35px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-size: 1.1rem;
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #0b5ed7, #5a3dc4);
        }
        
        .btn-register:active {
            transform: translateY(1px);
        }
        
        .btn-register::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
            transition: all 0.6s;
        }
        
        .btn-register:hover::after {
            transform: rotate(30deg) translate(20%, 20%);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .terms-text {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .terms-text:hover {
            text-decoration: underline;
        }
        
        .login-link {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .login-link:hover {
            text-decoration: none;
            color: var(--accent-color);
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s;
            padding: 0 20px;
        }
        
        .password-toggle:hover {
            color: var(--primary-color);
        }
        
        .gender-options {
            display: flex;
            gap: 20px;
            margin-top: 8px;
        }
        
        .gender-option {
            flex: 1;
            text-align: center;
            padding: 12px;
            border-radius: 12px;
            background: #f8f9fa;
            border: 2px solid #e0e0e0ff;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .gender-option:hover {
            border-color: var(--primary-color);
            background: rgba(13, 110, 253, 0.05);
        }
        
        .gender-option.active {
            background: rgba(13, 110, 253, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .gender-option i {
            font-size: 1.5rem;
            margin-bottom: 8px;
            display: block;
        }
        
        .clinic-checkbox {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }
        
        .clinic-checkbox .form-check {
            flex: 1 0 45%;
            background: white;
            padding: 15px;
            border-radius: 12px;
            border: 2px solid #d6d6d6ff;
            transition: all 0.3s;
        }
        
        .clinic-checkbox .form-check:hover {
            border-color: var(--primary-color);
            box-shadow: 0 5px 10px rgba(0,0,0,0.05);
        }
        
        .form-check-input {
            margin-top: 0.3em;
            border : 1px solid #bdbdbdff;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #495057;
        }
        
        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin: 25px 0 20px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: rotate(30deg) scale(1); }
            50% { transform: rotate(30deg) scale(1.05); }
            100% { transform: rotate(30deg) scale(1); }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-input {
            animation: inputFade 0.5s ease-out;
        }
        
        @keyframes inputFade {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .floating-icon {
            position: absolute;
            opacity: 0.1;
            font-size: 8rem;
            z-index: 0;
            animation: float 6s infinite ease-in-out;
        }
        
        .floating-icon:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }
        
        .floating-icon:nth-child(2) {
            top: 60%;
            right: 5%;
            animation-delay: 1s;
        }
        
        .floating-icon:nth-child(3) {
            bottom: 10%;
            left: 20%;
            animation-delay: 2s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-section {
                padding: 20px;
            }
            
            .header-section i {
                font-size: 2.5rem;
            }
            
            .form-section {
                padding: 20px;
            }
            
            .gender-options {
                flex-direction: column;
                gap: 10px;
            }
            
            .clinic-checkbox .form-check {
                flex: 1 0 100%;
            }
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="floating-icon"><i class="fas fa-heartbeat"></i></div>
        <div class="floating-icon"><i class="fas fa-stethoscope"></i></div>
        <div class="floating-icon"><i class="fas fa-hospital"></i></div>
        
        <div class="registration-card">
            <div class="row g-0">
                <!-- Header Section -->
                <div class="col-md-4 header-section">
                    <i class="fas fa-user-md"></i>
                    <h2>Doctor Profile</h2>
                    <p class="mt-3">Join our network of medical professionals</p>
                    <div class="mt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-3"></i>
                            <span>Access to thousands of patients</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle me-3"></i>
                            <span>Modern practice management tools</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3"></i>
                            <span>Secure patient records</span>
                        </div>
                    </div>
                </div>
                
                <!-- Form Section -->
                <div class="col-md-8 form-section">
                    <h3 class="mb-4">Enter Your Detail</h3>
                    
                    <form id="registrationForm" action="signup_dt.php" method="POST" enctype="multipart/form-data">
                     <div class="row">
                            <div class="col-md-6 mb-3 animate-input">
                                <label for="firstName" class="form-label">Name: Dr. <?php echo ucfirst($_SESSION["docname"])?></label>
                            </div>
                        
                          <div class="mb-3 animate-input">
                               <label for="email" class="form-label">Email Address: <?php echo $_SESSION["docemail"]?></label>
                          </div>
                        
                          <div class="mb-3 animate-input">
                            <label for="phone" class="form-label">Phone Number: <?php echo $_SESSION["docphone"]?></label>
                          </div>
                                              
                         <h5 class="section-title">Personal Information</h5>
                        
                          <div class="row">
                            <div class="col-md-6 mb-3 animate-input">
                                <label class="form-label">Gender</label>
                                <div class="gender-options">
                                    <div class="gender-option" data-value="male">
                                        <i class="fas fa-mars"></i>
                                        <div>Male</div>
                                        <input type="radio" name="gender" value="Male" class="d-none" required>
                                    </div>
                                    <div class="gender-option" data-value="female">
                                        <i class="fas fa-venus"></i>
                                        <div>Female</div>
                                        <input type="radio" name="gender" value="female" class="d-none">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3 animate-input">
                                <label for="birthDate" class="form-label">Date of Birth</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="birthDate" required name="dob">
                                </div>
                            </div>
                          </div>
                        
                          <div class="row">
                             <div class="col-md-6 mb-3 animate-input">
                                <label class="form-label">CNIC Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="cnic" placeholder="13 digits (no hyphens)" name="cnic" required pattern="[0-9]{13}" title="13 digit CNIC without hyphens">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3 animate-input">
                                <label for="city" class="form-label">City</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    <select class="form-select" id="city" required name="city">
                                        <option value="" disabled selected>Select your city</option>
                                        <?php
								 
								 $query23 = "select * from city";
								 $result23 = mysqli_query($con,$query23);
								 while($row12 = mysqli_fetch_assoc($result23)){
									echo "<option value = '{$row12['ct_id']}'>{$row12['city_name']}</option>";
								 }
								 ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 animate-input">
                                <label class="form-label">Education</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-graduation-cap"></i></span>
                                    <input type="text" class="form-control" name="education" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3 animate-input">
                              <div class="mb-3 animate-input">
                                <label for="phone" class="form-label">Experience</label>
                               <div class="input-group">
                                <input type="text" class="form-control" id="phone" required name="exp">
                            </div> 
                        </div>          

                     </div>

                         <div class="col-md-12 mb-3 animate-input">
                             <label for="specialty" class="form-label">Insert Your Passport Size Picture</label>
                             <div class="input-group">
                                  <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png, .jfif" required>
                              </div>
                         </div> 
                                   
                        <h5 class="section-title">Professional Information</h5>
                        
                        <div class="mb-3 animate-input">
                            <label for="specialty" class="form-label">Medical Speciality</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                                <select class="form-select" id="speciality" required name="special">
                                    <option value="" disabled selected>Select your speciality</option>
                                   <?php
								 $query2 = "select ds_id,specialist from docspecialization";
								 $result1 = mysqli_query($con,$query2);
								 while($row1 = mysqli_fetch_assoc($result1)){
									echo "<option value = '{$row1['ds_id']}'>{$row1['specialist']}</option>";
								 }
								 ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 animate-input">
                            <label for="specialty" class="form-label">Shift</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-clock-rotate-left"></i></span>
                                <select class="form-select" id="specialty" required name="shift">
                                    <option value="" disabled selected>Select your Shift</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                        </div>

                     
                        
                        <div class="mb-3 animate-input">
                            <label class="form-label">Clinic Address</label>
                            <div class="clinic-checkbox">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clinic1" name='clinic[]' value="Main Clinic">
                                    <label class="form-check-label" for="clinic1">
                                        <i class="fas fa-clinic-medical me-2"></i> Main Clinic
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clinic2" name='clinic[]' value="Downtown Branch">
                                    <label class="form-check-label" for="clinic2">
                                        <i class="fas fa-clinic-medical me-2"></i> Downtown Branch
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clinic3" name='clinic[]' value="Westside Hospital">
                                    <label class="form-check-label" for="clinic3">
                                        <i class="fas fa-clinic-medical me-2"></i> Westside Hospital
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clinic4" name='clinic[]' value="City Health Center">
                                    <label class="form-check-label" for="clinic4">
                                        <i class="fas fa-clinic-medical me-2"></i> City Health Center
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="terms-text">Terms of Service</a> and <a href="#" class="terms-text">Privacy Policy</a>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="newsletter">
                                <label class="form-check-label" for="newsletter">
                                    Subscribe to our newsletter for medical updates
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-register" name='ins'>
                                <i class="fas fa-user-plus me-2"></i> Submit
                            </button>
                        </div>   
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
       
        
        // Gender selection
        document.querySelectorAll('.gender-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove active class from all options
                document.querySelectorAll('.gender-option').forEach(opt => {
                    opt.classList.remove('active');
                });
                
                // Add active class to clicked option
                this.classList.add('active');
                
                // Check the radio input
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
            });
        });
        
       
        
        // Add animation to form inputs on focus
        const inputs = document.querySelectorAll('.form-control, .form-select, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('animate-input');
            });
        });
        
        // Floating animation for form elements
        const animateElements = document.querySelectorAll('.animate-input');
        animateElements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
        });
    </script>
</body>
</html>