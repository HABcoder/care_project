<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    header('location: login_dt.php');
}

include "../connection.php";
    
$username = ucfirst($_SESSION["docname"]);
$email = $_SESSION["docemail"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .dashbord-tables,.doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,#anim{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .doctor-heade{
            animation: transitionIn-Y-over 0.5s;
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
            background-color: #f8f9fa;
        }

        .sub-table tbody tr:hover {
            background-color: #e9f7fe;
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
        
        @media (max-width: 992px) {
            .dash-body {
                margin-left: 0;
                padding-bottom: 100px;
            }
        }
        
        .scroll {
            overflow-y: auto;
            max-height: 250px;
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
}

@media (max-width: 753px) {
  .pt-date {
    font-size: 90%;
  }
  .heading-sub12{
    font-size: 100%;
  }

}

      @media (max-width: 430px) {
  .des {
   font-size: 80%;
  }

}
        
    </style>
</head>
<body>
    <div>
        <?php include 'sidebar.php';?>
        
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;">
                <tr>
                    <td colspan="1" class="nav-bar">
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Dashboard</p>
                    </td>
                    <td width="25%"></td>
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
                
                <tr>
                    <td colspan="4">
                        <center>
                            <table class="filter-container doctor-header" style="border: none;width:95%" border="0">
                                <tr>
                                    <td>
                                        <h3>Welcome!</h3>
                                        <h1>Dr. <?php echo $username; ?></h1>
                                        <p class="des">Thanks for joining with us. We are always trying to get you a complete service<br>
                                        You can view your daily schedule, Reach Patients Appointment at home!<br><br>
                                        </p>
                                        <a href="appointment.php" class="non-style-link">
                                            <button class="btn-primary btn" style="width:30%">View Appointments</button>
                                        </a>
                                        <br><br>
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
                                            <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                <?php
                                                                $sql = "SELECT COUNT(a.pt_name) as total 
                                                                FROM appointment a JOIN doctor d ON a.docid = d.id WHERE d.email = '$email'";
                                                                $result = mysqli_query($con, $sql);
                                                                $row = mysqli_fetch_assoc($result);
                                                                echo $row['total'];
                                                                ?>
                                                            </div><br>
                                                            <div class="h3-dashboard">
                                                                All Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                        </div>
                                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                            <div class="h1-dashboard">
                                                                <?php
                                                                $sqles = "SELECT COUNT(a.pt_name) as tot FROM appointment a JOIN doctor d ON a.docid = d.id WHERE d.email = '$email' AND status = 'pending'";
                                                                $resultes = mysqli_query($con, $sqles);
                                                                $rowes = mysqli_fetch_assoc($resultes);
                                                                echo $rowes['tot'];
                                                                ?>
                                                            </div><br>
                                                            <div class="h3-dashboard">
                                                                New Appointments &nbsp;&nbsp;
                                                            </div>
                                                        </div>
                                                        <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="4">
                                                    <p id="anim" style="font-size: 20px;font-weight:600;padding: 20px; text-align: center;">Your Pending Appointments</p>
                                                    <div class="scroll" style="height: 250px;">
                                                        <table width="85%" class="sub-table" border="0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="table-headin">Name</th>
                                                                    <th class="table-headin">Gender</th>
                                                                    <th class="table-headin">Date</th>                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $sqli = "SELECT * FROM appointment a JOIN doctor d ON a.docid = d.id WHERE d.email = '$email' AND status = 'pending' LIMIT 3"; 
                                                                $ri = mysqli_query($con, $sqli);
                                                                
                                                                if(mysqli_num_rows($ri) > 0) {
                                                                    while ($rowi = mysqli_fetch_assoc($ri)) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $rowi['pt_name']; ?></td>
                                                                            <td class='table-data'><?php echo $rowi['pt_gender']; ?></td>
                                                                            <td class='table-data'><?php echo $rowi['appdate']; ?></td>                    
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    echo "<tr><td colspan='3'>No appointments found</td></tr>";
                                                                }
                                                                ?>
                                                            </tbody>                
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>