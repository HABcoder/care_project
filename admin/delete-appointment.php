<?php 
 session_start();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != 'A'){
        header('location: login_ad.php');
    }
    
    
    include("../connection.php");
 
    if(isset($_GET['delid'])){
        $delid = $_GET['delid'];
        $base = "SELECT * FROM appointment WHERE id='$delid'";
        $result = mysqli_query($con, $base);
        $row = mysqli_fetch_assoc($result);
        $email = $row['pt_email'];

        $sign = "DELETE FROM signup WHERE email='$email'";
        $sign_result = mysqli_query($con, $sign);

        $query = "DELETE FROM appointment WHERE id='$delid'";
        $query_result = mysqli_query($con, $query);
        if($sign_result && $query_result){
            echo "<script>alert('Appointment deleted successfully!');</script>";
            header('location: patient.php');
        } else {
            echo "Error deleting appointment: " . mysqli_error($conn);
        }
    }

?>