   
   <?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    header('location: login_dt.php');
}

include "../connection.php";
    
$username = ucfirst($_SESSION["docname"]);
$email = $_SESSION["docemail"];
?>
<?php 




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">   -->
    <!-- <link rel="stylesheet" href="../css/admin.css"> -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        
    <title>Appointments</title>
    <style>
           :root {
            --primary-blue: #0d6efd;
            --blue-hover: #0b5ed7;
            --light-blue: #e7f1ff;
            --primary-red: #dc3545;
            --red-hover: #bb2d3b;
            --sidebar-width: 250px;
        }
        
        /* Main content area */
        /* .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        } */
        
        /* Dashboard cards */
        /* .dashboard-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        } */
        
        /* .dashboard-card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            font-size: 2rem;
            opacity: 0.7;
        } */
        
        /* Tables */
        /* .data-table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .data-table thead {
            background-color: var(--primary-blue);
            color: white;
        } */


            /* td{
                font-size: 100%;
            } */
        
        /* Responsive adjustments */
        /* @media (max-width: 1185px) {
             td{
                font-size: 80%;
            }
        }
        @media (max-width: 1065px) {
             td{
                font-size: 70%;
            }
        }
         @media (max-width: 1021px) {
             td{
                font-size: 65%;
            }
        } */
  
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom soft primary button */
.btn-primary-soft {
  background-color: var(--light-blue);
  border: 1px solid var(--primary-blue);
  color: var(--primary-blue);
  transition: all 0.3s ease;
}

.btn-primary-soft:hover {
  background-color: var(--primary-blue);
  color: #fff;
}

.dash-body {
  padding: 20px;
  margin-left: var(--sidebar-width);
  transition: margin-left 0.3s ease;
}
@media (max-width: 992px) {
  .dash-body {
    margin-left: 0;
    padding-bottom: 100px; /* for mobile bottom nav */
  }

}
  

@media (max-width: 768px) {
  .dash-body {
    margin-left: 0;
    padding-bottom: 100px; /* for mobile bottom nav */
  }
}

 @media (max-width: 447px) {
             .ap{
                font-size: 100%;
                padding-left: 8px;
            }
           .dash-body .dt {
              display: none;
            }
        }

        
</style>
</head>
<body>


   <?php include 'sidebar.php'; ?>

<!-- Main Content -->
<div class="dash-body">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-around align-items-center">
        <button onclick="window.history.back()" class="btn btn-primary">Back</button>
        <h2 class="ap">Appointment Manager</h2>
        <div class="dt">
          <p class="mb-0 small dt">Today's Date</p>
          <h6 class='dt'><?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d'); ?></h6>
        </div>
      </div>

      <!-- Filter Section -->
      <form method="post" class="row g-3 align-items-end mt-4">
        <div class="col-auto">
          <label for="date" class="form-label">Date</label>
          <input type="date" name="sheduledate" id="date" value="<?php echo htmlspecialchars($filter_date); ?>" class="form-control">
        </div>
        <div class="col-auto">
          <button type="submit" name="filter" class="btn btn-outline-primary">Filter</button>
        </div>
      </form>

      <!-- Appointment Table -->
      <div class="table-responsive">
        <form method="post" action="update_status.php">
          <table class="table table-bordered mt-4">
            <thead>
              <tr>
                <th>Patient Name</th>
                <th>Gender</th>
                <th>Doctor</th>
                <th>City</th>
                <th>Date</th>
                <th>Time</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
             $filter_date = isset($_POST['sheduledate']) ? $_POST['sheduledate'] : '';
             $where_clause = "";
             
             if (!empty($filter_date)) {
                 $where_clause .= " AND a.appdate = '$filter_date'";
             }
             
             $query = "SELECT a.*, d.name as doctor_name, c.city_name 
                       FROM appointment a 
                       JOIN doctor d ON a.docid = d.id 
                       JOIN city c ON d.city = c.ct_id 
                       WHERE email = '$email' 
                       $where_clause
                       ORDER BY a.appdate DESC, a.apptime DESC";
             
             $queryExec = mysqli_query($con, $query);
              $queryExec = mysqli_query($con, $query);
              if (mysqli_num_rows($queryExec) > 0) {
                while ($row = mysqli_fetch_assoc($queryExec)) {
              ?>
              <tr>
                <td><?php echo ucfirst($row['pt_name']); ?></td>
                <td><?php echo $row['pt_gender']; ?></td>
                <td><?php echo $row['doctor_name']; ?></td>
                <td><?php echo $row['city_name']; ?></td>
                <td><?php echo $row['appdate']; ?></td>
                <td><?php echo $row['apptime']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td>
                  <select name="status[<?php echo $row['id']; ?>]" class="form-select">
                    <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                    <option value="approved" <?php if ($row['status'] == 'approved') echo 'selected'; ?>>Approved</option>
                    <option value="rejected" <?php if ($row['status'] == 'rejected') echo 'selected'; ?>>Rejected</option>
                  </select>
                </td>
                <td>
                  <button type="submit" name="submit" class="btn btn-primary btn-sm">Update</button>
                </td>
              </tr>
              <?php }} else { ?>
              <tr>
                <td colspan="9" class="text-center py-5">
                  <img src="../img/notfound.svg" width="150"><br>
                  <span class="text-muted">No appointments on this date!</span>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>