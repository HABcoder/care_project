<?php 
session_start();

$_SESSION['role'] == 'A';
session_unset();
session_destroy();
header('location: ../index.php');
?>
<?php include '../connection.php' ?>