 <?php

    session_start();

  if(!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
        header('location: login_dt.php');
    }
    

    
    include "../connection.php";
    
  $username = ucfirst($_SESSION["docname"]);
    $email = $_SESSION["docemail"];

    $sql = "SELECT * from doctor where email = '$email';";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);
    $userid = $row['id'];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-X  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
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
@media (max-width: 320px) {
  .h3-dashboard {
    display: none;
  }
}

    </style>
    
    
</head>
<body>




    <div>
        <?php include 'sidebar.php';?>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                        <td width="13%" >
                    <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Settings</p>
                                           
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
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <a href='update_doc.php?upid=<?php echo $userid;?>' class="non-style-link">
                                    <div  class="dashboard-items setting-tabs"  style="padding:20px;margin:auto;width:95%;display: flex">
                                        <div class="btn-icon-back dashboard-icons-setting" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                        <div>
                                                <div class="h1-dashboard">
                                                   <h2> Account Settings  &nbsp;</h2>

                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px;">
                                                    Edit your Profile Details
                                                </div>
                                        </div>
                                                
                                    </div>
                                    </a>
                                </td>
                                
                                
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                            <td style="width: 25%;">
                                    <a href="view.php?viewid=<?php echo $userid;?>" class="non-style-link">
                                    <div  class="dashboard-items setting-tabs"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div class="btn-icon-back dashboard-icons-setting " style="background-image: url('../img/icons/view-iceblue.svg');"></div>
                                        <div>
                                                <div class="h1-dashboard" >
                                                  <h2>  View Account Details</h2>
                                                    
                                                </div><br>
                                                <div class="h3-dashboard"  style="font-size: 15px;">
                                                    View Personal information About Your Account
                                                </div>
                                        </div>
                                                
                                    </div>
                                    </a>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 5px">&nbsp;</p>
                                </td>
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>
            
            </table>
        </div>
    </div>
   



</body>
</html>