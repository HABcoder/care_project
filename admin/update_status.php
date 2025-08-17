<?php
include "../connection.php";

if (isset($_POST['submit']) && isset($_POST['status'])) {
    foreach ($_POST['status'] as $id => $new_status) {
        $id = intval($id);
        $new_status = mysqli_real_escape_string($con, $new_status);
        $update = "UPDATE appointment SET status = '$new_status' WHERE id = $id";
        mysqli_query($con, $update);
    }

    echo "<script>alert('Data updated successfully'); window.location.href='appointment.php';</script>";
} else {
    echo "No data received.";
}
?>
