 <?php

    session_start();

  if(!isset($_SESSION['role']) || $_SESSION['role'] != 'patient') {
        header('location: login_pt.php');
    }
    

    
    include "../connection.php";
    
  $username = ucfirst($_SESSION["user_name"]);
    $email = $_SESSION["user_email"];

    // $query = "SELECT a.*, d.name as doctor_name, ds.ds_name AS speciality, c.city_name 
    // FROM appointment a 
    // JOIN doctor d ON a.docid = d.id 
    // JOIN docspecialization ds ON d.speciality = ds.ds_id
    // JOIN city c ON d.city = c.ct_id 
    // WHERE pt_email = '$email'";
    
  
$query = "SELECT a.*, d.name as doctor_name, c.city_name ,ds.specialist
  FROM appointment a 
   JOIN doctor d ON a.docid = d.id 
  JOIN docspecialization ds ON d.speciality = ds.ds_id
  JOIN city c ON d.city = c.ct_id WHERE pt_email = '$email'";

if (isset($_POST['filter']) && !empty($_POST['sheduledate'])) {
    $shedule = $_POST['sheduledate'];
    // Protect from SQL Injection
    $shedule = mysqli_real_escape_string($con, $shedule);

    $query .= " AND appdate = '$shedule'";
}

$queryExec = mysqli_query($con, $query);
$count = mysqli_num_rows($queryExec);
?>


  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Appointments</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }

              .sub-table tbody tr {
     transition: all 0.3s ease;
      border-bottom: 1px solid #f0f0f0;
}

     .sub-table tbody tr:nth-child(even) {
    background-color: #f8f9fa; /* Light gray for even rows */
}

    .sub-table tbody tr:hover {
    background-color: #e9f7fe; /* Light blue on hover */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

     .table-data {
    padding: 12px 16px;
    color: #495057;
    font-size: 14px;
    vertical-align: middle;
}

    .table-data:first-child {
    padding-left: 20px;
}

     .table-data select {
  padding: 8px 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  background-color: #fff;
   color: #333;
  font-weight: 500;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: border 0.3s ease, box-shadow 0.3s ease;
}
 
     .table-data select:focus {
  border-color: #2563eb;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
  outline: none;
}
.dash-body {
  padding: 20px;
  margin-left: 260px;
  transition: margin-left 0.3s ease;
}
.pt-head{
  font-size: 120%;
}
@media (max-width: 992px) {
  .dash-body {
    margin-left: 0;
    padding-bottom: 100px; /* for mobile bottom nav */
  }

}
@media (max-width: 753px) {
  .pt-date {
    font-size: 90%;
  }
  .heading-sub12{
    font-size: 100%;
  }

}
@media (max-width: 596px) {
  .pt-date {
    display: none;
  }
  .pt-img {
    display: none;
  }
  .heading-sub12{
    display: none;
  }
   .pt-head{
    font-size: 100%;
  }

}

.dt-ap{
    border: 1px solid #333333d5;
}

</style>
</head>
<body>


    <div>
         <?php include 'sidebar.php';?>

        <!-- Main Content -->
        <div class="dash-body">
            <!-- Top bar -->
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;margin-top:25px;">
                <tr>
                    <td width="13%">
                        <a href="index.php">
                            <button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button>
                        </a>
                    </td>
                    <td >
                        <p style="padding-left:12px;font-weight: 600;" class="pt-head">Appointment Manager</p>
                    </td>
                    <td width="15%" class="pt-date">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php
                            date_default_timezone_set('Asia/Karachi');
                            echo date('Y-m-d');
                            ?>
                        </p>
                    </td>
                    <td width="10%" class="pt-img">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;">
                            <img src="../img/calendar.svg" width="100%">
                        </button>
                    </td>
                </tr>
            </table>

            <!-- Filter -->
            <table class="filter-container" border="0">
                <tr>
                    <td width="50%"></td>
                    <td width="5%" style="text-align: center;">Date:</td>
                    <td width="30%">
                        <form action="" method="post">
                            <input type="date" name="sheduledate" id="date" class="input-text filter-container-items dt-ap" style="margin: 0;width: 100%;">
                    </td>
                    <td width="20%">
                        <input type="submit" name="filter" value=" Filter" class="btn-primary-soft btn button-icon btn-filter dt-f" style="padding: 15px; margin:0;width:100%">
                        </form>
                    </td>
                </tr>
            </table>

            <!-- Appointments -->
            <table border="0" width="100%" style="margin-top: 25px;">
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Appointments</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <div class="abc scroll">
                                <form method="post" action="appointment.php">
                                <table width="93%" class="sub-table scrolldown" border="0">
                                    <thead>
                                        <tr>
                                            <th class="table-headin">Patient name</th>
                                            <th class="table-headin">Gender</th>
                                            <th class="table-headin">Email</th>
                                            <th class="table-headin">City</th>
                                            <th class="table-headin">Doctor</th>
                                            <th class="table-headin">Consultation With</th>
                                            <th class="table-headin">Appointment Date</th>
                                            <th class="table-headin">Appointment Time</th>
                                            <th class="table-headin">Message</th>
                                            <th class="table-headin" >Status</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($count > 0) {
                                            while ($row = mysqli_fetch_assoc($queryExec)) {
                                                echo "<tr>";?>
                                                <td class='table-data'><?php echo ucfirst($row['pt_name'])?></td>
                                               <td class='table-data'><?php echo $row['pt_gender']?></td>
                                                <td class='table-data'><?php echo $row['pt_email']?></td>
                                                <td class='table-data'><?php echo $row['city_name']?></td>
                                                <td class='table-data'>Dr.<?php echo $row['doctor_name']?></td>
                                                <td class='table-data'>Dr.<?php echo $row['specialist']?></td>
                                                <td class='table-data'><?php echo $row['appdate']?></td>
                                                <td class='table-data'><?php echo $row['apptime']?></td>
                                                <td class='table-data'><?php echo $row['message']?></td>
                                               <td class="table-data"><?php echo $row['status']?></td>

                                        <!-- <td class="table-data">
                                    <button type="submit" name="submit" class="btn btn-primary shadow-sm px-4 py-2 rounded">
                                  Update
                                        </button>
                                        </td> -->

                                               </tr>
                                               <?php
                                            }
                                        } else {
                                            echo '<tr>
                                            <td colspan="6">
                                                <br><br><br><br>
                                                <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find anything!</p>
                                                    <a class="non-style-link" href="appointment.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Appointment &nbsp;</button></a>
                                                </center>
                                                <br><br><br><br>
                                            </td>
                                        </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                    </form>
                            </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    
    </div>

</body>
</html>
