<?php 
session_start();

echo $_SESSION["role"] == 'patient';
session_unset();
session_destroy();
header('location: ../index.php');
?>
<?php include '../connection.php' ?>