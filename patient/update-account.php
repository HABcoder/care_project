 <?php

    session_start();

  if(!isset($_SESSION['role']) || $_SESSION['role'] != 'patient') {
        header('location: login_pt.php');
    }
    
    include "../connection.php";

    $email = $_SESSION['user_email'] ?? '';
if (empty($email)) {
    echo "<script>alert('Email not found. Please login again.'); window.location.href='login_pt.php';</script>";
    exit;
}
    $query = "SELECT * FROM appointment WHERE pt_email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 0) {
    echo " No user found with this email in appointment table";
    exit;
}
 

    if(isset($_POST['submit'])){
      $name = $_POST["name"];
      $gender = $_POST["gender"];
      $phone = $_POST["phone"];
      $dob = $_POST["dob"];
      $address = $_POST["address"];
      $country = $_POST["country"];

     $query1 = "UPDATE appointment SET pt_name = '$name', pt_gender = '$gender', phone = '$phone', dob = '$dob', pt_address = '$address', country = '$country' WHERE pt_email = '$email'"; 
      $queryExec = mysqli_query($con, $query1);
      $affectedRows = mysqli_affected_rows($con);
      if($queryExec){
        
        echo "<script>alert('Data Updated Successfully');window.location.href ='index.php';</script>";
   
      }else{
        echo "<script>alert('Data Updation Failed')</script>";
      }
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --hospital-blue: #0077b6;
            --light-blue: #caf0f8;
            --doctor-blue: #48cae4;
            --nurse-pink: #ffafcc;
        }
        
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hospital-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .hospital-icon {
            position: absolute;
            opacity: 0.1;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }
        
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            margin-top: 50px;
            margin-bottom: 50px;
            border-top: 5px solid var(--hospital-blue);
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--hospital-blue), #0096c7);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .form-body {
            padding: 30px;
        }
        
        .gender-container {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }
        
        .gender-option {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 8px;
        }
        
        .gender-option:hover {
            background-color: #e9ecef;
        }
        
        .gender-option input {
            display: none;
        }
        
        .gender-option .checkbtn {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #adb5bd;
            margin-right: 15px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .gender-option input:checked + .checkbtn {
            border-color: var(--hospital-blue);
            background-color: var(--hospital-blue);
        }
        
        .gender-option input:checked + .checkbtn::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .gender-option.male input:checked + .checkbtn {
            background-color: var(--doctor-blue);
            border-color: var(--doctor-blue);
        }
        
        .gender-option.female input:checked + .checkbtn {
            background-color: var(--nurse-pink);
            border-color: var(--nurse-pink);
        }
        
        .gender-option.other input:checked + .checkbtn {
            background-color: #94d2bd;
            border-color: #94d2bd;
        }
        
        .gender-icon {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .btn-hospital {
            background-color: var(--hospital-blue);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-hospital:hover {
            background-color: #025f92;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <!-- Animated Hospital Background Elements -->
    <div class="hospital-bg">
        <i class="fas fa-hospital hospital-icon animate__animated animate__fadeIn" style="top: 10%; left: 5%; font-size: 40px;"></i>
        <i class="fas fa-heartbeat hospital-icon animate__animated animate__fadeIn animate__delay-1s" style="top: 30%; left: 80%; font-size: 50px;"></i>
        <i class="fas fa-procedures hospital-icon animate__animated animate__fadeIn animate__delay-2s" style="top: 70%; left: 15%; font-size: 45px;"></i>
        <i class="fas fa-ambulance hospital-icon animate__animated animate__fadeIn animate__delay-3s" style="top: 20%; left: 60%; font-size: 60px;"></i>
        <i class="fas fa-stethoscope hospital-icon animate__animated animate__fadeIn animate__delay-4s" style="top: 80%; left: 70%; font-size: 35px;"></i>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="form-container animate__animated animate__fadeInUp">
                    <div class="form-header animate__animated animate__fadeIn">
                        <h2><i class="fas fa-hospital me-2"></i> Patient Profile</h2>
                        <p class="mb-0">You can Update your personal details</p>
                    </div>
                    
                    <div class="form-body">
                        <form  action='update-account.php' method='POST'>
                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label"><i class="fas fa-user me-2"></i></label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your full name" name="name" value= "<?= $row['pt_name']?>" >
                            </div>
                            
                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                <div class="form-control" id="email"><?php echo $_SESSION['user_email'];?></div>
                            </div>
                            
                            <!-- Gender Field with Custom Checkbuttons -->
                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                                <div class="gender-container animate__animated animate__fadeIn">
                                    <label class="gender-option male">
                                        <input type="radio" name="gender" value="male"  <?php if ($row['pt_gender'] && strtolower(trim($row['pt_gender'])) == 'male') {
                                                                                    echo 'checked';
                                                                                       } ?>>
                                        <span class="checkbtn"></span>
                                        <i class="fas fa-mars gender-icon" style="color: var(--doctor-blue);"></i>
                                        <span>Male</span>
                                    </label>
                                    
                                    <label class="gender-option female">
                                        <input type="radio" name="gender" value="female"  <?php if ($row['pt_gender'] && strtolower(trim($row['pt_gender'])) == 'female') {
                                                                                        echo 'checked';
                                                                                         } ?>>
                                        <span class="checkbtn"></span>
                                        <i class="fas fa-venus gender-icon" style="color: var(--nurse-pink);"></i>
                                        <span>Female</span>
                                    </label>
                                    
                                </div>
                            </div>
                            
                            <!-- Phone Field -->
                            <div class="mb-4">
                                <label for="phone" class="form-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" name="phone"  value= "<?= $row['phone']?>">
                            </div>
                            
                            <!-- Date of Birth Field -->
                            <div class="mb-4">
                                <label for="dob" class="form-label"><i class="fas fa-calendar-day me-2"></i>Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value= "<?= $row['dob']?>">
                            </div>
                            
                            <!-- Address Field -->
                            <div class="mb-4">
                                <label for="address" class="form-label"><i class="fas fa-map-marker-alt me-2"></i>Address</label>
                                <input type="text" class="form-control" id="address" rows="2" placeholder="Enter your address" name="address"  value= "<?= $row['pt_address']?>">
                            </div>
                            
                            <!-- City and Country Fields -->
                            <div class="row">
                 
                       <div class=" col-md-6 mb-4">
                                <label for="country" class="form-label"><i class="fas fa-globe me-2"></i>Country</label>
                                <input type="text" class="form-control" id="country" rows="2" placeholder="Enter your country" name="country"  value= "<?= $row['country']?>">
                            </div>
                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" name="submit" class="btn btn-hospital text-white rounded-pill pulse animate__animated animate__fadeInUp">
                                    <i class="fas fa-paper-plane me-2"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add animation to form elements on scroll
        document.addEventListener('DOMContentLoaded', function() {
            // Animate hospital icons
            const icons = document.querySelectorAll('.hospital-icon');
            icons.forEach((icon, index) => {
                setTimeout(() => {
                    icon.style.animation = `float ${5 + index}s infinite ease-in-out`;
                }, index * 300);
            });
            
            // Add ripple effect to gender options
            const genderOptions = document.querySelectorAll('.gender-option');
            genderOptions.forEach(option => {
                option.addEventListener('click', function() {
                    this.classList.add('animate__animated', 'animate__pulse');
                    setTimeout(() => {
                        this.classList.remove('animate__animated', 'animate__pulse');
                    }, 1000);
                });
            });
            
            // Submit button animation
           const submitBtn = document.getElementById('submitBtn');

              submitBtn.addEventListener('click', function(e) {
               e.preventDefault(); // ✅ Still prevent initially
              submitBtn.classList.add('clicked');

              // Animation ends in 2.5 seconds, then submit the form
              setTimeout(function() {
                submitBtn.classList.remove('clicked');
                submitBtn.innerHTML = '✔️';

                // ✅ Submit the form manually
              submitBtn.closest('form').submit();
              }, 2500);
            }); })

    </script>
</body>
</html>