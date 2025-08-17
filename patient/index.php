 <?php

    session_start();

  if(!isset($_SESSION['role']) || $_SESSION['role'] != 'patient') {
        header('location: login_pt.php');
    }
    
    include "../connection.php";

    $username = ucfirst($_SESSION["user_name"]);
    $email = $_SESSION["user_email"];
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
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,.anime{
            animation: transitionIn-Y-bottom 0.5s;
        }
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
.pt-head{
  width:95%;
  padding: 20px;
}

.dash-body {
  padding: 20px;
  margin-left: 260px;
  transition: margin-left 0.3s ease;
}
.pt-date {
    font-size: 80%;
  }
@media (max-width: 753px) {
  .pt-date {
    font-size: 90%;
  }
  .heading-sub12{
    font-size: 100%;
  }

}
@media (max-width: 992px) {
  .dash-body {
    margin-left: 0;
    padding-bottom: 100px; /* for mobile bottom nav */
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

    </style>
    
    
</head>
<body>
   
    <div >
        <?php include 'sidebar.php';?>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >                    
                        <tr>                          
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Home</p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%" class="pt-date">
                                <p style="color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Kolkata');
        
                                $today = date('Y-m-d');
                                echo $today;
                                ?>
                                </p>
                            </td>
                            <td width="10%" class="pt-img">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4" >                     
                    <center>
                    <table class="filter-container doctor-header patient-header" style="border: none;" border="0" >
                    <tr>
                        <td class="pt-head">
                            <h3>Welcome!</h3>
                            <h1><?php echo $username ?>.</h1>
                            <p>Want to View your appointmemt , just click
                                <a href="appointment.php" class="non-style-link"><b>"My Appointment"</b></a> section <br>or 
                                 Edit your Personal Details. No problem, just click
                                <a href="settings.php" class="non-style-link"><b>"Setting"</b> </a><br>
                               
                            </p>
                            <br>                          
                        </td>
                    </tr>
                    </table>
                    </center>               
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%">
                            <tr>
                                <td width="50%">
                                    <center>
                                        <table class="filter-container" style="border: none;" border="0">
                                            <div class="mins">
                                                <div class="min">
                                                      <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                                </td>
                                             </tr>
                                                  <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                      <?PHP 
                                                    $quer = "SELECT COUNT(*) as appointment_total FROM appointment WHERE pt_email = '$email'";
                                                    $res = mysqli_query($con, $quer);
                                                    $row = mysqli_fetch_assoc($res);
                                                    echo $row['appointment_total'];                                                 
                                                    ?>
                                                                    
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    My Appointment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                  <a href="settings.php" style="text-decoration:none; color:#393D40;">Settings &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>  
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                                    </div>
                                                </td>
                                              </tr>
                                                </div>
                                      <div class="min">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                             <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Your Upcoming Appointment</p>
                                        <thead>
                                                  <tr>
                                                     <th class="table-headin">
                                                        Patient Name
   
                                                      </th>
                                                        <th class="table-headin">
                                                      Gender                                              
                                                      </th>                                                
                                                       <th class="table-headin">
                                                       Doctor
                                                       </th>
                                                       <th class="table-headin">                                                    
                                                       Appointment Date                                                    
                                                      </th>                                                  
                                                  </tr>
                                        </thead>
                                         <tbody>
                                              <?php 
                                    
                                        $query = "SELECT a.appdate, a.pt_name, a.pt_gender, d.name as doctor  FROM appointment as a join doctor as d on a.docid = d.id where pt_email = '$email'
                                         ORDER BY a.appdate DESC LIMIT 3";
                                        $queryExec = mysqli_query($con, $query);
                                        $count = mysqli_num_rows($queryExec);
                                        
                                         
                                        if ($count > 0) {
                                            while ($row = mysqli_fetch_assoc($queryExec)) {
                                                echo "<tr>"; ?>
                                                <td class='table-data'><?php echo $row['pt_name']?></td>
                                               <td class='table-data'><?php echo $row['pt_gender']?></td>
                                                
                                                <td class='table-data'>Dr. <?php echo $row['doctor']?></td>
                                                <td class='table-data'><?php echo $row['appdate']?></td>
                                            </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>No Data Found</td></tr>";
                                        }
                                        ?>                                           
                                        </tbody>
                                    </table>  
                               </div>
                           </div>
                                         
 </table>
                          

                                </td>
                                <td>
 
                                    
                                        </center>

                                </td>
                            </tr>
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>


</body>
</html>