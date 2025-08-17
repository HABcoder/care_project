<?php


$con = mysqli_connect("localhost", "root","", "care3");

if (!$con) {
    echo '<script>alert("not connect");</script>';
}
?>