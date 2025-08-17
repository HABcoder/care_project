 <?php

    session_start();

  if(!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
        header('location: login_dt.php');
    }
    

    
    include "../connection.php";
    
     $username = ucfirst($_SESSION["docname"]);
      $email = $_SESSION["docemail"];

     $search_term = isset($_POST['search12']) ? $_POST['search12'] : '';

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
        
    <title>Patients</title>
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
.kk {
    width:13%;
}
.sd{
    display: none;
    width: 100%;
}
       @media (max-width: 753px) {
  .pt-date {
    font-size: 90%;
  }
  .heading-sub12{
    font-size: 90%;
  }
}
       @media (max-width: 596px) {
        .hd{
            display: none;
        }
        .sd{
    display: flex;
}
        .kk {
    width:100%;
}
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
   .dash-body {
            padding: 20px;
            margin-left: 260px;
            transition: margin-left 0.3s ease;
        }
        
        @media (max-width: 992px) {
            .dash-body {
                margin-left: 0;
                /* padding-bottom: 100px; */
            }
        }
        
        .scroll {
            overflow-y: auto;
            max-height: 250px;
        }
</style>
</head>
<body>

    <div >
      <?php include 'sidebar.php';?>
        <div class="dash-body">
            <h2 class="sd text-center">My Patient</h2>
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td class="kk">

                    <a href="index.php"><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td class="hd">
                        
                          <form action="" method="post" class="header-search">
                                    <input type="search" name="search12" class="input-text header-searchbar" 
                                          placeholder="Search Patient name or Email" list="patient" 
                                        value="<?php echo htmlspecialchars($search_term); ?>">&nbsp;&nbsp;
                                   <input type="Submit" value="Search" name="search" class="login-btn btn-primary btn" 
                                            style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            </form>
                        
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
                <tr width="100%"; >
                    <td class="sd"> 
                          <form action="" method="post" class="header-search">
                                    <input type="search" name="search12" class="input-text header-searchbar" 
                                          placeholder="Search Patient name or Email" list="patient" 
                                        value="<?php echo htmlspecialchars($search_term); ?>">&nbsp;&nbsp;
                                   <input type="Submit" value="Search" name="search" class="login-btn btn-primary btn" 
                                            style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            </form>
                        
                    </td>
                </tr>
 
                <tr>
                    <td colspan="4" style="padding-top:10px;" class="hd">
                        <p class="heading-main12" style="margin-left: 45px;font-size:30px;color:rgb(49, 49, 49)" class="hd"> My Patient </p>
                    </td>
                    
                </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                          <tr>
                                <th class="table-headin">                                                                 
                                Name                               
                               </th>
                                <th class="table-headin">                                                                  
                                    Email                                    
                                </th>
                                <th class="table-headin">          
                                        Telephone                               
                                </th>
                                <th class="table-headin">
                                    Gender
                                </th>
                                <th class="table-headin">                                   
                                    Appointment Date                                   
                                </th>
                                 <th class="table-headin">                                   
                                    Message                                  
                                </th>
                                <th class="table-headin">
                                    
                                    Action
                              </th>                                  
                          </tr>
                        </thead>
                          <tbody>
        <?php 

        // Base query
        $ptquery = "SELECT specialistid,docid,pt_name,pt_gender,pt_email,a.phone AS appoint_phone, 
                   pt_address,country,appdate,apptime,message,status, a.id AS appoint_id,d.id AS doctor_id 
                   FROM appointment a JOIN doctor d ON a.docid = d.id 
                   WHERE d.email = '$email'";
        
        // Add search condition if search term exists
        if (!empty($search_term)) {
            $ptquery .= " AND (a.pt_name LIKE '%$search_term%' OR a.pt_email LIKE '%$search_term%')";
        }
        
        $ptres = mysqli_query($con, $ptquery);
        $pt_count = mysqli_num_rows($ptres);
        
        if($pt_count > 0) {
            while($row = mysqli_fetch_assoc($ptres)) {
        ?>
        <tr>
            <td class="table-data"><?php echo htmlspecialchars(ucfirst($row['pt_name'])); ?></td>
            <td class="table-data"><?php echo htmlspecialchars($row['pt_email']); ?></td>
            <td class="table-data"><?php echo htmlspecialchars($row['appoint_phone']); ?></td>
            <td class="table-data"><?php echo htmlspecialchars($row['pt_gender']); ?></td>
            <td class="table-data"><?php echo htmlspecialchars($row['appdate']); ?></td>  
            <td class="table-data"><?php echo htmlspecialchars($row['message']); ?></td>
            <td class="table-data">
                <a href="?action=view&id=<?php echo $row['appoint_id']; ?>" class="non-style-link">
                    <button class="btn-primary-soft btn" style="padding: 5px 10px;">View</button>
                </a>
            </td>  
        </tr>
        <?php 
            }
        } else {
            echo '<tr>
                <td colspan="7">
                <br><br><br><br>
                <center>
                <img src="../img/notfound.svg" width="25%">
                <br>
                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">';
                
            if(!empty($search_term)) {
                echo 'No patients found matching your search';
            } else {
                echo 'You Have No Patients!';
            }
                
            echo '</p>
                </a>
                </center>
                <br><br><br><br>
                </td>
                </tr>';
        }
        ?>
    </tbody>
                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>

    <?php 
    if($_GET){
        
        $id= $_GET["id"];
        $action = $_GET["action"];
            $sqlmains = "select * from appointment where id= '$id'";
            $resultmains = mysqli_query($con, $sqlmains);
            $row = mysqli_fetch_assoc($resultmains);
            $name=$row["pt_name"];
            $email=$row["pt_email"];
            $gender =$row["pt_gender"];
            $dob=$row["dob"];
            $tele=$row["phone"];
            
            $status = $row["status"];

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                          
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: '.$name.'</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: '.$email.'</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Gender: '.$gender.' </label>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="label-td" colspan="2">
                                <br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: '.$tele.'</label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <br>
                                </td>
                            </tr>

                           

                            <tr>
                              <td class="label-td" colspan="2">
                                   <br><br>
                               </td>
                            </tr>

                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Date of Birth: '.$dob.'</label>
                                </td>
                            </tr>

                              <tr>
                                <td class="label-td" colspan="2">
                                    <br><br>
                                </td>    
                            </tr>
  
                            <tr>   
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Status: '.$status.'</label>
                                </td>
                            </tr>
                           <tr>
                                <td class="label-td" colspan="2">
                                    <br><br>
                                </td>    
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        
    };

?>
</div>

</body>
</html>



   