<?php 
session_start();

echo $_SESSION['role'] == 'doctor';
session_unset();
session_destroy();
header('location: ../index.php');
?>
<?php include '../connection.php' ?>