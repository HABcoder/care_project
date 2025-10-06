<?php 
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'A'){
    header('location: login_ad.php');
}

include("../connection.php");

// Handle edit form submission
if(isset($_POST['update_special'])){
    $ds_id = mysqli_real_escape_string($con, $_POST['ds_id']);
    $special = mysqli_real_escape_string($con, $_POST['special']);
    $desp = mysqli_real_escape_string($con, $_POST['desp']);
    
    $update_sql = "UPDATE docspecialization SET specialist='$special', description='$desp' WHERE ds_id='$ds_id'";
    if(mysqli_query($con, $update_sql)){
        echo "<script>alert('Specialization updated successfully!'); window.location.href='addcity.php';</script>";
    } else {
        echo "<script>alert('Failed to update specialization: " . mysqli_error($con) . "'); window.location.href='addcity.php';</script>";
    }
}

// Handle delete action
if(isset($_GET['spc_id'])){
    $spc_id = mysqli_real_escape_string($con, $_GET['spc_id']);
    $delete_sql = "DELETE FROM docspecialization WHERE ds_id='$spc_id'";
    if(mysqli_query($con, $delete_sql)){
        echo "<script>alert('Specialization deleted successfully!'); window.location.href='addcity.php';</script>";
    } else {
        echo "<script>alert('Failed to delete specialization: " . mysqli_error($con) . "'); window.location.href='addcity.php';</script>";
    }
}

// Handle city deletion
if(isset($_GET['delid'])){
    $ct_id = mysqli_real_escape_string($con, $_GET['delid']);
    $delete_city_sql = "DELETE FROM city WHERE ct_id='$ct_id'";
    if(mysqli_query($con, $delete_city_sql)){
        echo "<script>alert('City deleted successfully!'); window.location.href='addcity.php';</script>";
    } else {
        echo "<script>alert('Failed to delete city: " . mysqli_error($con) . "'); window.location.href='addcity.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add City and Specialization</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #0d6efd;
            --blue-hover: #0b5ed7;
            --light-blue: #e7f1ff;
            --primary-red: #dc3545;
            --red-hover: #bb2d3b;
            --sidebar-width: 250px;
        }
        
        .dash-body {
            padding: 20px;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        @media (max-width: 992px) {
            .dash-body {
                margin-left: 0;
                padding-bottom: 80px;
            }
        }
        
        .card-custom {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 20px;
        }
        
        .card-header-custom {
            background-color: var(--primary-blue);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .table thead {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .btn-soft-primary {
            background-color: var(--light-blue);
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
        }
        
        .btn-soft-primary:hover {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .page-header {
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        @media (max-width: 576px) {
            .mobile-hidden {
                display: none;
            }
            
            .input-group-mobile {
                flex-direction: column;
            }
            
            .input-group-mobile .form-control {
                margin-bottom: 10px;
                width: 100% !important;
            }
        }
        
        .animate-fade {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-edit {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }
        
        .btn-edit:hover {
            background-color: #e0a800;
            color: #212529;
        }
        
        .btn-delete {
            background-color: var(--primary-red);
            color: white;
            border: none;
        }
        
        .btn-delete:hover {
            background-color: var(--red-hover);
            color: white;
        }
        
        .modal-header {
            background-color: var(--primary-blue);
            color: white;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="dash-body animate-fade">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <button onclick="window.history.back()" class="btn btn-soft-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </button>
                        <h2 class="mb-0 text-center">Add City and Specialization</h2>
                        <div class="mobile-hidden">
                            <p class="mb-0 small text-muted">Today's Date</p>
                            <h6><?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <!-- City Section -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-custom h-100">
                        <div class="card-header card-header-custom">
                            <h4 class="mb-0" style="color:#0d6efd;"><i class="fas fa-city me-2"></i>Add City</h4>
                        </div>
                        <div class="card-body">
                            <form action="addcity.php" method="POST" class="mb-4">
                                <div class="input-group input-group-mobile">
                                    <input type="text" name="city" class="form-control" placeholder="Enter city name" required>
                                    <button type="submit" name='ins' class="btn btn-primary ms-2">
                                        <i class="fas fa-plus me-1"></i> Add City
                                    </button>
                                </div>
                            </form>
                            <?php 
                            if(isset($_POST['ins'])){
                                // Trim and sanitize input
                                $ct = trim(mysqli_real_escape_string($con, $_POST['city']));
                                
                                // Validate input is not empty
                                if(empty($ct)) {
                                    echo "<script>alert('City name cannot be empty!'); window.location.href='addcity.php';</script>";
                                    exit();
                                }
                                
                                // Check if city already exists (case-insensitive check)
                                $check_sql = "SELECT city_name FROM city WHERE LOWER(city_name) = LOWER('$ct')";
                                $check_result = mysqli_query($con, $check_sql);
                                
                                if(mysqli_num_rows($check_result) > 0) {
                                    echo "<script>alert('City \"$ct\" already exists!'); window.location.href='addcity.php';</script>";
                                } else {
                                    // Insert new city
                                    $insert_sql = "INSERT INTO city (city_name) VALUES ('$ct')";
                                    if(mysqli_query($con, $insert_sql)) {
                                        echo "<script>alert('City \"$ct\" added successfully!'); window.location.href='addcity.php';</script>";
                                    } else {
                                        $error = mysqli_error($con);
                                        echo "<script>alert('Failed to add city. Error: $error'); window.location.href='addcity.php';</script>";
                                    }
                                }
                            }
                            ?>
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>City Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT * FROM city";
                                        $query = mysqli_query($con, $sql);
                                        $count = mysqli_num_rows($query);
                                        
                                        if($count > 0){
                                            while($row = mysqli_fetch_assoc($query)){
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['city_name']) . "</td>";
                                                echo "<td>";
                                                echo "<a  style= 'color: red;' href='deletecity.php?delid=" . $row['ct_id'] . "' class='btn btn-sm btn-delete' onclick='return confirm(\"Are you sure you want to delete this city?\");'>";
                                                echo "<i class='fas fa-trash me-1'></i>Delete";
                                                echo "</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='2' class='text-center text-muted'>No cities found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Specialization Section -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-custom h-100">
                        <div class="card-header card-header-custom">
                            <h4 class="mb-0" style="color:#0d6efd;"><i class="fas fa-stethoscope me-2"></i>Add Specialization</h4>
                        </div>
                        <div class="card-body">
                            <form action="addcity.php" method="POST" class="mb-4">
                                <div class="mb-3">
                                    <label class="form-label">Specialization</label>
                                    <input type="text" name='special' class="form-control" placeholder="Enter specialization" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" name='desp' class="form-control" placeholder="Enter description">
                                </div>
                                <button type="submit" name='des' class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Add Specialization
                                </button>
                            </form>
                            <?php 
                            if(isset($_POST['des'])){
                                $special = mysqli_real_escape_string($con, $_POST['special']);
                                $desp = mysqli_real_escape_string($con, $_POST['desp']);
                                
                                // Check if specialization already exists
                                $check_sql = "SELECT specialist FROM docspecialization WHERE LOWER(specialist) = LOWER('$special')";
                                $check_result = mysqli_query($con, $check_sql);
                                
                                if(mysqli_num_rows($check_result) > 0) {
                                    echo "<script>alert('Specialization \"$special\" already exists!'); window.location.href='addcity.php';</script>";
                                } else {
                                    $sql23 = "INSERT INTO docspecialization (specialist, description) VALUES ('$special', '$desp')";
                                    if(mysqli_query($con, $sql23)){
                                        echo "<script>alert('Specialization added successfully!'); window.location.href='addcity.php';</script>";
                                    } else {
                                        echo "<script>alert('Failed to add specialization: " . mysqli_error($con) . "'); window.location.href='addcity.php';</script>";
                                    }
                                }
                            }
                            ?>
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Specialist</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "SELECT * FROM docspecialization";
                                        $query = mysqli_query($con, $sql);
                                        $count = mysqli_num_rows($query);
                                        
                                        if($count > 0){
                                            while($row = mysqli_fetch_assoc($query)){
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['specialist']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                                echo "<td class='action-buttons'>";
                                                echo "<button class='btn btn-sm btn-edit' data-bs-toggle='modal' data-bs-target='#editSpecializationModal' 
                                                        data-id='" . $row['ds_id'] . "' 
                                                        data-special='" . htmlspecialchars($row['specialist']) . "' 
                                                        data-desp='" . htmlspecialchars($row['description']) . "'>";
                                                echo "<i class='fas fa-edit me-1'></i>Edit";
                                                echo "</button>";
                                                echo "<a href='addcity.php?spc_id=" . $row['ds_id'] . "' class='btn btn-sm btn-delete' onclick='return confirm(\"Are you sure you want to delete this specialization?\");' style= 'color: red;'>";
                                                echo "<i class='fas fa-trash me-1'></i>Delete";
                                                echo "</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='3' class='text-center text-muted'>No specializations found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Specialization Modal -->
    <div class="modal fade" id="editSpecializationModal" tabindex="-1" aria-labelledby="editSpecializationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSpecializationModalLabel">Edit Specialization</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="addcity.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="ds_id" id="edit_ds_id">
                        <div class="mb-3">
                            <label for="edit_special" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="edit_special" name="special" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_desp" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edit_desp" name="desp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_special" class="btn btn-primary">Update Specialization</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Activate Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Handle edit modal data population
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editSpecializationModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var ds_id = button.getAttribute('data-id');
                    var special = button.getAttribute('data-special');
                    var desp = button.getAttribute('data-desp');
                    
                    document.getElementById('edit_ds_id').value = ds_id;
                    document.getElementById('edit_special').value = special;
                    document.getElementById('edit_desp').value = desp;
                });
            }
        });
    </script>
</body>
</html>