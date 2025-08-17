<?php
session_start();
include '../connection.php';

if(isset($_POST['ins'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = $_POST['pass']; // no need to escape password here

    // Step 1: Get user record by email only
    $sql = "SELECT * FROM signup WHERE email = '$email'";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);

        // Step 2: Verify password with hashed password
        if(password_verify($password, $row['password'])){
              if ($row['role'] == 'doctor') {
                
            $query1 = "SELECT * FROM doctor WHERE email = '$email'";
            $queryExec = mysqli_query($con, $query1);
            if(mysqli_num_rows($queryExec) > 0 ){
                $doctor = mysqli_fetch_assoc($queryExec);
                $_SESSION['docid'] = $doctor['id'];
                 $_SESSION['docname'] = $doctor['name'];
                  $_SESSION['docemail'] = $doctor['email'];
                  $_SESSION['docphone'] = $doctor['phone'];
                   $_SESSION['role'] = 'doctor';
                      echo "<script>window.location.href = 'index.php';</script>";
                    exit();

                } else {
                    echo "<script>alert('Doctor details not found ');</script>";
                }

            } else {
                echo "<script>alert('Email Not Found. Kinldy Register Your Self'); window.location.href = '../index.php';</script>";
              
            }

        } else {
            echo "<script>alert('Invalid password');</script>";
        }

    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
            
          
                
    
            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --doctor-blue: #1977cc;
            --doctor-light: #e8f1f9;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8f1f9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .doctor-card {
            max-width: 500px;
            margin: 0 auto;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.31);
            transition: transform 0.3s;
        }
        
        .doctor-card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: var(--doctor-blue);
            color: white;
            text-align: center;
            padding: 25px;
            position: relative;
        }
        
        .card-header h3 {
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .doctor-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }
        
        .form-control:focus {
            border-color: var(--doctor-blue);
            box-shadow: 0 0 0 0.25rem rgba(25, 119, 204, 0.25);
        }
        
        .btn-doctor {
            background-color: var(--doctor-blue);
            border: none;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .btn-doctor:hover {
            background-color: #1565b7;
        }
        
        .forgot-link {
            color: var(--doctor-blue);
            text-decoration: none;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        /* Modal Styles */
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }
        
        .modal-header {
            background-color: var(--doctor-blue);
            color: white;
            border-bottom: none;
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .close {
            color: white;
            opacity: 1;
            text-shadow: none;
        }
        
        .input-group-text {
            background-color: white;
            border-right: none;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .login-with {
            display: block;
            text-align: center;
            color: #777;
            margin: 20px 0;
            position: relative;
        }
        
        .login-with::before, .login-with::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
            margin: auto;
        }
        
        .login-with::before {
            margin-right: 10px;
        }
        
        .login-with::after {
            margin-left: 10px;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            text-decoration: none;
            transition: transform 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
        }
        
        .btn-google {
            background-color: #db4437;
        }
        
        .btn-microsoft {
            background-color: #00a1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card doctor-card">
                    <div class="card-header">
                        <div class="doctor-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3>Doctor Portal </h3>
                    </div>
                    <div class="card-body text-center p-5">
                        <h4 class="mb-4">Welcome Back, Doctor</h4>
                        <p class="text-muted mb-4">Access patient records, manage appointments, and provide care</p>
                        <button class="btn btn-doctor btn-lg w-100 text-white" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt me-2"></i> Login to Your Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">
                        <i class="fas fa-user-md me-2"></i> Doctor Login 
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="doctorLoginForm" action="login_dt.php" method="POST">
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="doctorEmail" placeholder="Professional Email Address" name="email" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="doctorPassword" placeholder="Password" required name="pass">
                                <span class="input-group-text bg-white" style="cursor: pointer;" id="togglePassword" >
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                           
                        </div>
                        
                        <button type="submit" class="btn btn-doctor btn-lg w-100 text-white mb-3" name="ins">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                        
                        <span class="login-with">or login with</span>
                        
                        <div class="social-login">
                            <a href="https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Fwww.google.com%3Fhl%3Den-US&ec=GAlA8wE&hl=en&flowName=GlifWebSignIn&flowEntry=AddSession&dsh=S-1422202459%3A1754727528438339" class="social-btn btn-google">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="https://www.facebook.com/login/device-based/regular/login/?login_attempt=1" target="blank" class="social-btn btn-facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                        
                        <div class="text-center mt-3">
                            <p class="text-muted">Don't have an account? <a href="../signup_dt.php" class="forgot-link">Register Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('doctorPassword');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>


