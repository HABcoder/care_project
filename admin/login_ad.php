<?php
session_start();
include '../connection.php';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = $_POST['pass']; // no need to escape password here

    // Step 1: Get user record by email only
    $sql = "SELECT * FROM signup WHERE email = '$email'";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);

        // Step 2: Verify password with hashed password
        if(password_verify($password, $row['password'])){
            // Password is correct, set session variables
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $row['name']; // your signup uses 'name', not 'username'
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'A') {
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Unknown role');</script>";
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
    <title>Admin Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-purple: #1977cc;
            --admin-light: #f3effb;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #f3effb 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-card {
            max-width: 500px;
            margin: 0 auto;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.26);
            transition: transform 0.3s;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: var(--admin-purple);
            color: white;
            text-align: center;
            padding: 25px;
            position: relative;
        }
        
        .card-header h3 {
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .admin-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }
        
        .form-control:focus {
            border-color: var(--admin-purple);
            box-shadow: 0 0 0 0.25rem  rgba(25, 119, 204, 0.25);
        }
        
        .btn-admin {
            background-color: var(--admin-purple);
            border: none;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .btn-admin:hover {
            background-color: #1565b7;
        }
        
        .forgot-link {
            color: var(--admin-purple);
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
            background-color: var(--admin-purple);
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
        
        .security-features {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid var(--admin-purple);
        }
        
        .security-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .security-icon {
            width: 30px;
            color: var(--admin-purple);
            margin-right: 10px;
        }
        
        .two-factor {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        

    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card admin-card">
                    <div class="card-header">
                        <div class="admin-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Admin Portal</h3>
                    </div>
                    <div class="card-body text-center p-5">
                        <h4 class="mb-4">System Administration</h4>
                        <p class="text-muted mb-4">Manage users, settings, and system configurations</p>
                        <button class="btn btn-admin btn-lg w-100 text-white" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt me-2"></i> Secure Login
                        </button>
                        
                        <div class="security-features mt-4">
                            <h5 class="mb-3">Security Features:</h5>
                            <div class="security-item">
                                <i class="fas fa-lock security-icon"></i>
                                <span>Enterprise-grade encryption</span>
                            </div>
                            <div class="security-item">
                                <i class="fas fa-history security-icon"></i>
                                <span>Activity logging and audit trails</span>
                            </div>
                            <div class="security-item">
                                <i class="fas fa-user-shield security-icon"></i>
                                <span>Role-based access control</span>
                            </div>
                        </div>
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
                        <i class="fas fa-shield-alt me-2"></i> Admin Authentication
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="adminLoginForm" method="POST" action="login_ad.php">
                        <div class="mb-4">
                            <label for="adminUsername" class="form-label fw-bold">Admin ID</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                <input type="email" class="form-control" id="adminUsername" placeholder="Enter admin email" required name="email">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="adminPassword" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" id="adminPassword" placeholder="Enter your password" required  name="pass">
                                <span class="input-group-text bg-white" style="cursor: pointer;" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="two-factor">
                            
                            <div id="twoFactorFields" style="display: none;">
                                <div class="mb-3">
                                    <label for="authCode" class="form-label">Authentication Code</label>
                                    <input type="text" class="form-control" id="authCode" placeholder="6-digit code">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="trustDevice">
                                <label class="form-check-label" for="trustDevice">Trust this device</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-admin btn-lg w-100 text-white mb-3" name="submit">
                            <i class="fas fa-unlock-alt me-2"></i> Login
                        </button>
                        
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
            const passwordInput = document.getElementById('adminPassword');
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

