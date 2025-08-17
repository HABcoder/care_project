<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    header('location: login_dt.php');
}
include "../connection.php";


$username = ucfirst($_SESSION["docname"]);
$email = $_SESSION["docemail"];

    if(isset($_GET['viewid'])){
        $upid = $_GET['viewid'];
        $query = "SELECT * FROM doctor WHERE id='$upid'";
        $result = mysqli_query($con, $query);
        $doctor = mysqli_fetch_assoc($result);
        $email = $doctor['email'];
        $name = $doctor['name'];
        $cnic = $doctor['CNIC'];
        $city = $doctor['city'];
        $experience = $doctor['experience'];
        $shift = $doctor['shift'];
        $educate = $doctor['education'];
        $address = $doctor['address'];


        $query23 = "SELECT ct_id, city_name FROM city where ct_id='$city'";
         $result12 = mysqli_query($con, $query23);
         $city_name = mysqli_fetch_assoc($result12);
         $city_name = $city_name['city_name'];

        ?>
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile details</title>
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
                        <h2><i class="fas fa-user-md me-2"></i> Doctor Profile Details</h2>
                    </div>
                    <div class="form-body">
                        <form>
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
                                    <label for="phone" class="form-label">CNIC: <?php echo $cnic; ?></label> 
                                </div>
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInRight">
                                    <label for="city" class="form-label">City: <?php echo $city_name; ?></label>                        
                                </div>
                            </div>
                            
                            <!-- Professional Information -->
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                                    <label for="experience" class="form-label">Years of Experience: <?php echo $experience?></label>
                                </div>
                                <div class="col-md-6 mb-3 animate__animated animate__fadeInRight">
                                    <label for="shift" class="form-label">Shift: <?php echo $shift; ?></label>
                                </div>
                            </div>
                            
                            <!-- Education -->
                            <div class="mb-4 animate__animated animate__fadeInUp">
                                <label for="education" class="form-label">Education: <?php echo $educate?></label>
                            </div>
                            
                            <!-- Address Checkboxes -->
                            <div class="mb-4 animate__animated animate__fadeInUp">
                                <label class="form-label">Clinic Addresses: <?php echo $address; ?> </label>
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
                            <a href="settings.php" class="btn btn-update btn-lg text-white">
                                <i class="fas fa-arrow-left me-2"></i>Back
                               </a>
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