<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'patient') {
        header('location: patient/login_pt.php');
    }
    if(!isset($_GET['apid']))
        header('location: index.php');

include "connection.php";
$email = $_SESSION["user_email"];

if(isset($_POST['ins'])){
    // Get form data
    $docid = isset($_POST['doctor_id']) ? (int)$_POST['doctor_id'] : 0;
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $fullName = $firstName ." ". $lastName;
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $sptid = isset($_POST['speid']) ? (int)$_POST['speid'] : 0;
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $appdate = $_POST['appdate'];
    $apptime = $_POST['apptime'];
    $message = $_POST['message'];
    
   
    // Insert appointment
    $query = "INSERT INTO appointment(specialistid, docid, pt_name, dob, pt_gender,pt_email, phone, 
    pt_address, country, appdate, apptime, message) VALUES ($sptid, $docid, '$fullName', '$dob', '$gender', '$email','$phone',
    '$address', '$country', '$appdate', '$apptime', '$message')";
    
    $queryExec = mysqli_query($con,$query);

    if($queryExec){
        echo "<script>alert('Appointment Booked Successfully');window.location.href = 'index.php'</script>";
    }
    else{
        echo "<script>alert('Error: ".mysqli_error($con)."')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
           /* --primary: #28a745;
            --primary-dark: #218838;
            --primary-light: #d4edda;
            --secondary: #6c757d;
            --light-bg: #f8f9fa;
            --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --success: #28a745;*/
            --primary: #007bff;           /* main blue */
                --primary-dark: #0056b3;      /* darker blue for hover/focus */
            --primary-light: #cce5ff;     /* light blue background */
            --secondary: #6c757d;         /* unchanged - neutral gray */
            --light-bg: #f8f9fa;          
            --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); 
            --success: #007bff;    




        }
        
        body {
            background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .form-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-header {
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 25px 30px;
            position: relative;
            overflow: hidden;
        }
        
        .form-header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 8s infinite linear;
        }
        
        @keyframes pulse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .form-title {
            font-weight: 700;
            margin-bottom: 5px;
            position: relative;
        }
        
        .form-subtitle {
            font-weight: 300;
            opacity: 0.9;
            position: relative;
        }
        
        .form-body {
            padding: 30px;
        }
        
        .form-icon {
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 3rem;
            opacity: 0.8;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .form-label {
            position: absolute;
            top: 12px;
            left: 15px;
            color: var(--secondary);
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 5px;
        }
        
        .form-control {
            height: 50px;
            padding-top: 18px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
        }
        
        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: -10px;
            font-size: 0.85rem;
            color: var(--primary);
            background: white;
        }
        
        .form-control:focus ~ .input-icon {
            color: var(--primary);
            transform: scale(1.1);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            transition: all 0.3s ease;
        }
        
        .btn-register {
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(40, 167, 69, 0.4);
        }
        
        .btn-register::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
            transition: all 0.8s ease;
        }
        
        .btn-register:hover::after {
            transform: rotate(30deg) translate(20%, 20%);
        }
        
        .terms-text {
            font-size: 0.9rem;
            color: var(--secondary);
        }
        
        .gender-options {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }
        
        .gender-option {
            flex: 1;
            text-align: center;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .gender-option:hover {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }
        
        .gender-option.active {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }
        
        .gender-option i {
            font-size: 1.5rem;
            margin-bottom: 8px;
            color: var(--primary);
        }
        
        .progress-container {
            margin-bottom: 30px;
        }
        
        .progress {
            height: 8px;
            border-radius: 4px;
        }
        
        .progress-bar {
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            transition: width 0.5s ease;
        }
        
        .step {
            display: none;
            animation: slideIn 0.5s ease-out;
        }
        
        .step.active {
            display: block;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .form-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        
        .form-note {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 15px;
            font-size: 0.9rem;
            margin-top: 20px;
        }
        
        .form-note i {
            color: var(--success);
            margin-right: 10px;
        }
        
        .city-select {
            position: relative;
        }
        
        .city-select i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            pointer-events: none;
        }
        
        .card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .review-item {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            animation: fadeInItem 0.5s ease-out;
        }
        
        .review-item:last-child {
            border-bottom: none;
        }
        
        @keyframes fadeInItem {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1 class="form-title"><i class="fas fa-heartbeat me-2"></i>Appointment</h1>
            <p class="form-subtitle">Complete your profile in just a few steps</p>
            <i class="fas fa-user-injured form-icon"></i>
        </div>
        
        <div class="progress-container p-3 bg-light">
            <div class="d-flex justify-content-between mb-2">
                <span class="step-indicator active">Personal Info</span>
                <span class="step-indicator">Appointment Details</span>
                <span class="step-indicator">Review</span>
            </div>
            <div class="progress">
                <div class="progress-bar" style="width: 33%"></div>
            </div>
        </div>
        
        <div class="form-body">
            <form id="patientForm" action="appointment_form.php" method="POST">
                <!-- Step 1: Personal Information -->
                <div class="step active" id="step1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="firstName" placeholder=" " required name="firstName">
                                <label for="firstName" class="form-label">First Name</label>
                                <span class="input-icon"><i class="fas fa-user"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="lastName" placeholder=" " required name="lastName">
                                <label for="lastName" class="form-label">Last Name</label>
                                <span class="input-icon"><i class="fas fa-user"></i></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="date" class="form-control" id="dob" placeholder=" " required name="dob">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <span class="input-icon"><i class="fas fa-birthday-cake"></i></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <!-- <label class="form-label">Gender</label> -->
                                <div class="gender-options">
                                    <div class="gender-option active">
                                        <i class="fas fa-male"></i>
                                        <div value="Male">Male</div>
                                    </div>
                                    <div class="gender-option">
                                        <i class="fas fa-female"></i>
                                        <div value="Female">Female</div>
                                        
                                    </div>
                                    <input type="hidden" name="gender" id="genderInput" value="Male">
                                </div>
                                
                            </div>
                        </div>

                </div>
                            <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <!-- <input type="text" class="form-control" id="email" required name="email"> -->
                                <input type="hidden" name = "email"  value="<?php echo $_SESSION['user_email']; ?>" >
                                <div class="form-control"><?php echo $_SESSION['user_email']?></div>
                                <label for="email" class="form-label">Email</label>
                                <span class="input-icon"><i class="fas fa-envelope"></i></span>
                               
                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" id="phone" required name="phone">
                                <label for="phone" class="form-label">Phone</label>
                                <span class="input-icon"><i class="fas fa-phone"></i></span>
                            </div>
                        </div>
                    
                   

                        
                    </div>
                     <div class="input-group mb-4">
                        <input type="text" class="form-control" id="address" placeholder=" " required name="address">
                        <label for="address" class="form-label">Street Address</label>
                        <span class="input-icon"><i class="fas fa-home"></i></span>
                    </div>

                     <div class="row">
                       
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" id="country" required name="country">
                                <label for="country" class="form-label">Country</label>
                                <span class="input-icon"><i class="fas fa-globe"></i></span>
                            </div>
                        </div>
                    </div>


            


                </div>
                
                <!-- Step 2: Contact Information -->
                 <!-- Step 2: Appointment Details-->
            <div class="step" id="step2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-4">
                            
                            <!-- <select class="form-control" name="specialist_id" id="specialist" onchange="fetchDoc(this.value)">
                                  <option>Choose Specialization</option>
                                 <?php
                if(isset($_GET['apid'])){
                    $idget = $_GET['apid'];
                    $teen = "SELECT * FROM doctor as d join docspecialization as dsp on d.speciality = dsp.ds_id where d.id=$idget";
                    $teenx = mysqli_query($con, $teen);
                    $counti = mysqli_num_rows($teenx);
                    if($counti > 0){
                        $row1 = mysqli_fetch_assoc($teenx);
                        echo "data is fetched";
                   
                    }}
								 ?>
                                 
                             
                            </select> -->
                            <input type="hidden" name="speid"  value= "<?php echo $row1['ds_id'];?>">
                            <div class="form-control" name="specialist_id" id="specialist"><?php echo $row1['specialist'];?></div>
                            <span class="input-icon"><i class="fa-solid fa-stethoscope"></i></span>
                        </div>
                    </div>
                     <div class="col-md-6">
                        
                            <div class="input-group mb-4">
                                <input type="hidden" name="doctor_id" value="<?= $idget ?>">
                                <div class="form-control" id="Doctor" name="doctor" value = "<?php echo $row1['id'];?>"><?php echo $row1['name'];?></div>
                                  <span class="input-icon" id='icon-doctor' style= 'display:none;'><i class="fa-solid fa-user-doctor"></i></span >
                            </div>
                    
                    </div>
                   
                       
                </div>
                
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" id="appdate" placeholder=" " name="appdate" required>
                                <label for="appdate" class="form-label">Appointment Date</label>
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <input type="time" class="form-control" id="apptime" placeholder=" " required name="apptime">
                                <label for="apptime" class="form-label">Appointment Time</label>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" id="message" placeholder=" " required name="message">
                        <label for="message" class="form-label">Reason of Appointment</label>
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                    </div>
    
                </div>
                
                <!-- Step 3: Review and Submit -->
                <div class="step" id="step3">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Personal Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Full Name:</div>
                                    <div class="col-8" id="reviewName"></div>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Date of Birth:</div>
                                    <div class="col-8" id="reviewDob"></div>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Gender:</div>
                                    <div class="col-8" id="reviewGender">Male</div>
                                </div>
                            </div>

                          <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Email:</div>
                                    <div class="col-8" id="reviewEmail"></div>
                                </div>
                            </div>

                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Phone:</div>
                                    <div class="col-8" id="reviewPhone"></div>
                                </div>
                            </div>

                                 <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Address:</div>
                                    <div class="col-8" id="reviewAddress"></div>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Country:</div>
                                    <div class="col-8" id="reviewCountry"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-address-book me-2"></i>Appointment Detail</h5>
                        </div>
                        <div class="card-body">
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Specialist:</div>
                                    <div class="col-8" id="reviewspecialist"></div>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Doctor:</div>
                                    <div class="col-8" id="reviewDoctor"></div>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Appointment Date:</div>
                                    <div class="col-8" id="reviewDate"></div>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Appointment Time:</div>
                                    <div class="col-8" id="reviewTime"></div>
                                </div>
                            </div>
                            <div class="review-item">
                                <div class="row">
                                    <div class="col-4 text-muted">Message:</div>
                                    <div class="col-8" id="reviewMessage"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label terms-text" for="terms">
                            I confirm that all information provided is accurate and complete to the best of my knowledge.
                        </label>
                    </div>
                </div>
                
                <div class="form-note">
                    <i class="fas fa-lock"></i> Your information is protected with 256-bit encryption and will only be accessible to authorized medical personnel.
                </div>
                
                <div class="form-footer">
                    <button type="button" class="btn btn-outline-secondary" id="prevBtn">Previous</button>
                    <button type="submit" class="btn btn-register" id="nextBtn" name="ins">Next Step</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 3;
            
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const progressBar = document.querySelector('.progress-bar');
            
            // Update progress bar
            function updateProgress() {
                const progress = (currentStep / totalSteps) * 100;
                progressBar.style.width = `${progress}%`;
                
                // Update step indicators
                document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                    if (index < currentStep) {
                        indicator.classList.add('active');
                    } else {
                        indicator.classList.remove('active');
                    }
                });
                
                // Update button text
                if (currentStep === totalSteps) {
                    nextBtn.innerHTML = 'Complete Registration <i class="fas fa-check ms-2"></i>';
                } else {
                    nextBtn.textContent = 'Next Step';
                }
                
                // Hide previous button on first step
                if (currentStep === 1) {
                    prevBtn.style.visibility = 'hidden';
                } else {
                    prevBtn.style.visibility = 'visible';
                }
                
                // Populate review fields on last step
                const patientEmail = "<?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?>";
                const specialistName = "<?php echo isset($row1['specialist']) ? $row1['specialist'] : ''; ?>";
                const doctorName = "<?php echo isset($row1['name']) ? $row1['name'] : ''; ?>";
                if (currentStep === totalSteps) {
                    document.getElementById('reviewName').textContent = 
                        document.getElementById('firstName').value + ' ' + 
                        document.getElementById('lastName').value;
                    
                    const dob = new Date(document.getElementById('dob').value);
                    document.getElementById('reviewDob').textContent = 
                        dob.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                    
                    document.getElementById('reviewEmail').textContent = patientEmail;
                    
                    document.getElementById('reviewPhone').textContent = 
                        document.getElementById('phone').value;
                    
                    // document.getElementById('reviewEmergency').textContent = 
                    //     document.getElementById('emergencyContact').value;
                    
                    document.getElementById('reviewAddress').textContent = 
                        document.getElementById('address').value;
                    
                    document.getElementById('reviewCountry').textContent = 
                        document.getElementById('country').value;

                     document.getElementById('reviewspecialist').textContent = specialistName;

                    document.getElementById('reviewDoctor').textContent = doctorName;

                    document.getElementById('reviewDate').textContent = 
                        document.getElementById('appdate').value;

                    document.getElementById('reviewTime').textContent = 
                        document.getElementById('apptime').value;

                     document.getElementById('reviewMessage').textContent = 
                        document.getElementById('message').value;
                }
            }
            
            // Navigate to step
            function goToStep(step) {
                document.querySelectorAll('.step').forEach(el => {
                    el.classList.remove('active');
                });
                document.getElementById(`step${step}`).classList.add('active');
                currentStep = step;
                updateProgress();
            }
            
            // Next button click
            nextBtn.addEventListener('click', function() {
                if (currentStep < totalSteps) {
                    goToStep(currentStep + 1);
                } else {
                    // Validate form
                    const form = document.getElementById('patientForm');
                    if (form.checkValidity()) {
                        // Submit form
                        const submitBtn = document.createElement('button');
                        submitBtn.type = 'submit';
                        form.appendChild(submitBtn);
                        submitBtn.click();
                        form.removeChild(submitBtn);
                        
                        // Show success animation
                        document.querySelector('.form-container').classList.add('animate__animated', 'animate__pulse');
                        
                        setTimeout(() => {
                            alert('Registration complete! Thank you for signing up.');
                            document.getElementById('patientForm').reset();
                            goToStep(1);
                            document.querySelector('.form-container').classList.remove('animate__animated', 'animate__pulse');
                        }, 800);
                    } else {
                        form.reportValidity();
                    }
                }
            });
            
            // Previous button click
            prevBtn.addEventListener('click', function() {
                if (currentStep > 1) {
                    goToStep(currentStep - 1);
                }
            });
            
            // Gender selection
            document.querySelectorAll('.gender-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.gender-option').forEach(el => {
                        el.classList.remove('active');
                    });
                    this.classList.add('active');
                    const selectedGender = this.querySelector('div').textContent.trim();
        document.getElementById('reviewGender').textContent = selectedGender;

        // ✅ Set value in hidden input for form submission
        document.getElementById('genderInput').value = selectedGender;
                });
            });
            
            // Initialize progress
            updateProgress();
            
            // Add animation to form elements on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            document.querySelectorAll('.input-group, .gender-options, .form-note').forEach(el => {
                observer.observe(el);
            });
        });

    </script>
</body>
</html>