<?php 
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor') {
    header('location: login_dt.php');
}
include "../connection.php";
   
$username = ucfirst($_SESSION["docname"]);
$email2 = $_SESSION["docemail"];

 if(isset($_POST['update'])){
        $id = $_POST['id'];
        $address = $_POST['address'];
        $cnic = $_POST['cnic'];
        $experience = $_POST['experience'];
        $education = $_POST['educate'];
        $shift = $_POST['shift'];
        $phone = $_POST['phone'];
        
        $add_in_array = implode(',',$address);

        if (!preg_match('/^[0-9]{13}$/', $cnic)) {
    echo "<script>alert('CNIC must be 13 digits without hyphens'); window.history.back();</script>";
    exit;
    }

    if(!preg_match('/^[0][3][0-9]{2}[-][0-9]{7}$/', $phone)){
        echo "<script>alert('Phone number must be in the format 0302-xxxxxxx'); window.history.back();</script>";
        exit;
    }
        
        $query = "UPDATE doctor SET phone='$phone', address='$add_in_array',CNIC='$cnic',experience='$experience', education='$education', shift='$shift' WHERE id='$id'";
        $result = mysqli_query($con, $query);


        $docquery = "SELECT * FROM doctor WHERE id='$id';";
        $docresult = mysqli_query($con, $docquery);
        $docrow = mysqli_fetch_assoc($docresult);
        $docemail = $docrow['email'];

        $signup = "UPDATE signup SET phone='$phone' WHERE email ='$docemail';";
        $results = mysqli_query($con, $signup);
        
        if($result && $results){
           echo "<script>alert('Data Updated');window.location.href = 'settings.php'</script>";
        } else {
            echo "Error updating profile: " . mysqli_error($con);
        }
    }
?>