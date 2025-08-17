   <?php 
 session_start();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor'){
        header('location: login_dt.php');
    }
    
    
    include("../connection.php");

    if(isset($_GET['upid'])){
        $upid = $_GET['upid'];
        $query = "SELECT * FROM doctor WHERE id='$upid'";
        $result = mysqli_query($con, $query);
        $doctor = mysqli_fetch_assoc($result);
        $email = $doctor['email'];
        $name = $doctor['name'];
        $cnic = $doctor['CNIC'];
        $experience = $doctor['experience'];
        $shift = $doctor['shift'];
        $educate = $doctor['education'];

        $address = $doctor['address'];
        $chk = explode(',', $address);

        $signquery = "SELECT * FROM signup WHERE email = '$email';";
        $signresult = mysqli_query($con, $signquery);
        $sign = mysqli_fetch_assoc($signresult);
        $phone = $sign['phone'];

        ?>
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile Update</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(3, 12, 131, 0.42);
            overflow: hidden;
            margin-top: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        .form-container:hover {
            box-shadow: 0 15px 35px rgba(0, 16, 158, 0.56);
        }
        .form-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .form-body {
            padding: 30px;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.25rem rgba(37, 116, 252, 0.41);
        }
        .btn-update {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-update:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(106, 17, 203, 0.3);
        }
        .address-checkbox {
            margin-bottom: 15px;
        }
        .address-checkbox input[type="checkbox"] {
            display: none;
        }
        .address-checkbox label {
            display: block;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .address-checkbox input[type="checkbox"]:checked + label {
            border-color: rgba(37, 117, 252, 1);
            background-color: rgba(37, 116, 252, 0.23);
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container animate__animated animate__fadeInUp">
                    <div class="form-header animate__animated animate__fadeIn">
                        <h2><i class="fas fa-user-md me-2"></i> Doctor Profile Update</h2>
                    </div>
                    <div class="form-body">
                        <form action="curd2.php" method="post">
                            <!-- Personal Information -->
                            <div class="row mb-4">
                                <input type="hidden" name="id" value="<?php echo $upid; ?>">
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                                    <label for="name" class="form-label">Full Name: <?php echo $name; ?></label>
                                </div>
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInRight">
                                    <label for="email" class="form-label">Email Address: <?php echo $email; ?></label>
                                </div>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                                    <label for="phone" class="form-label">CNIC</label>
                                    <input type="text" class="form-control" id="cnic" name="cnic"  value="<?php echo $cnic; ?>"> 
                                     <h6 id="lb5"></h6>
                                </div>
                                 <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"  value="<?php echo $phone; ?>"> 
                                     <h6 id="lb3"></h6>
                                </div>
                            </div>
                            
                            <!-- Professional Information -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                                    <label for="experience" class="form-label">Years of Experience</label>
                                    <input type="text" class="form-control" id="experience" placeholder="5" value="<?php echo $experience?>" name="experience">
                                </div>
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInRight">
                                    <label for="shift" class="form-label">Shift</label>
                                    <select class="form-select" id="shift" name="shift">
                                        <option value="">Select Shift</option>
                                        <option value="Morning" <?php if($shift == "Morning") echo "selected"; ?>>Morning</option>
                                        <option value="Night" <?php if($shift == "Night") echo "selected"; ?>>Night</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Education -->
                            <div class="mb-4 animate__animated animate__fadeInUp">
                                <label for="education" class="form-label">Education</label>
                                <textarea class="form-control" id="education" rows="3" placeholder="Medical degrees and qualifications" name="educate"><?php echo $educate?></textarea>
                            </div>
                            
                            <!-- Address Checkboxes -->
                            <div class="mb-4 animate__animated animate__fadeInUp">
                                <label class="form-label">Clinic Addresses </label>
                                <div class="row">
                                    <div class="col-md-6 address-checkbox animate__animated animate__fadeInRight">
                                        <input type="checkbox" id="address4" name="address[]" value="Main Clinic" <?php if(in_array("Main Clinic", $chk)) echo "checked"; ?>>
                                        <label for="address4">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            <strong>Main Clinic</strong> 
                                        </label>
                                    </div>
                                    <div class="col-md-6 address-checkbox animate__animated animate__fadeInRight">
                                        <input type="checkbox" id="address2" name="address[]" value="Downtown Branch"<?php if(in_array("Downtown Branch", $chk)) echo "checked"; ?>>
                                        <label for="address2">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            <strong>Downtown Branch</strong> 
                                        </label>
                                    </div>
                                   <div class="col-md-6 address-checkbox animate__animated animate__fadeInRight">
                                        <input type="checkbox" id="address3" name="address[]" value="Westside Hospital" <?php if(in_array("Westside Hospital", $chk)) echo "checked"; ?>>
                                        <label for="address3">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            <strong>Westside hospital</strong> 
                                        </label>
                                    </div>
                                    <div class="col-md-6 address-checkbox animate__animated animate__fadeInRight">
                                        <input type="checkbox" id="address1" name="address[]" value="City Health Center" <?php if(in_array("City Health Center", $chk)) echo "checked"; ?>>
                                        <label for="address1">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            <strong>City Health Center</strong> 
                                        </label>
                                    </div>
                                </div>
                            </div>
                                  <?php
        if(!$doctor){
            echo "Error fetching doctor details: " . mysqli_error($con);
            exit;
        }
    }

?>
                            
                            <!-- Submit Button -->
                            <div class="text-center mt-4 animate__animated animate__fadeInUp">
                                <button type="submit" class="btn btn-update btn-lg text-white" name="update">
                                    <i class="fas fa-save me-2"></i> Submit
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
        // Add animation to form elements on load
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.form-control, .form-select, .address-checkbox');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = 1;
                }, 100 * index);
            });
        });
    </script>
</body>
</html>