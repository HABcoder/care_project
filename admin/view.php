<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'A'){
    header('location: login_ad.php');
}

include("../connection.php");

if(isset($_GET['viewid'])){
    $upid = $_GET['viewid'];
    $query = "SELECT * FROM doctor WHERE id='$upid'";
    $result = mysqli_query($con, $query);
    $doctor = mysqli_fetch_assoc($result);
    $phone = $doctor['phone'];
    $email = $doctor['email'];
    $name = $doctor['name'];
    $cnic = $doctor['CNIC'];
    $city = $doctor['city'];
    $experience = $doctor['experience'];
    $shift = $doctor['shift'];
    $educate = $doctor['education'];
    $address = $doctor['address'];

    $query23 = "SELECT city_name FROM city WHERE ct_id='$city'";
    $result12 = mysqli_query($con, $query23);
    $city_name = mysqli_fetch_assoc($result12)['city_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Doctor Profile Card</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --grad-1: #5b6cff;
      --grad-2: #7b2fff;
      --bg-light: #f6f8ff;
      --text-dark: #1a1c2b;
      --text-muted: #6c7293;
      --shadow: rgba(50, 50, 93, 0.15) 0px 8px 20px;
    }
    body {
      background: linear-gradient(135deg, #eef1ff, #ffffff);
      font-family: 'Segoe UI', sans-serif;
      color: var(--text-dark);
    }
    .id-wrap {
      max-width: 960px;
      margin: 40px auto;
      padding: 15px;
    }
    .id-card {
      border-radius: 22px;
      background: rgba(255,255,255,0.9);
      backdrop-filter: blur(10px);
      box-shadow: rgba(10, 10, 163, 0.6) 0px 8px 20px;
      overflow: hidden;
    }
    .id-card::before {
      content: "";
      position: absolute;
      height: 160px;
      width: 100%;
      background: linear-gradient(135deg, var(--grad-1), var(--grad-2));
      border-radius: 22px 22px 0 0;
    }
    .id-inner {
      position: relative;
      display: flex;
      flex-direction: column;
    }
    @media(min-width: 992px) {
      .id-inner { flex-direction: row; }
    }
    .left-pane {
      text-align: center;
      padding: 30px 20px;
      flex: 0 0 300px;
    }
    .doctor-image-container {
      width: 160px;
      height: 160px;
      border-radius: 50%;
      margin: 0 auto;
      border: 6px solid #fff;
      box-shadow: 0 0 0 5px rgba(91,108,255,.3);
      overflow: hidden;
    }
    .doctor-image-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .no-image-placeholder {
      width: 100%; height: 100%;
      display: flex; justify-content: center; align-items: center;
      background: #dfe3ff; color: #4a55d4;
      font-size: 60px;
    }
    .name-block {
      margin-top: 20px;
      color: #fff;
    }
    .name-block h3 {
      font-weight: 700;
    }
    .role {
      display: inline-block;
      margin-top: 8px;
      background: #fff;
      color: var(--grad-1);
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
    }
    .right-pane {
      flex: 1;
      padding: 30px;
      background: #fff;
    }
    .info-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: grid;
      grid-template-columns: 1fr;
      gap: 16px;
    }
    @media(min-width: 768px) {
      .info-list { grid-template-columns: 1fr 1fr; }
    }
    .info-item {
      display: flex;
      gap: 12px;
      padding: 14px;
      border-radius: 16px;
      background: var(--bg-light);
      transition: transform .2s, box-shadow .2s;
    }
    .info-item:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow);
    }
    .info-item i {
      font-size: 18px;
      color: var(--grad-1);
    }
    .info-item .label {
      font-size: 12px;
      color: var(--text-muted);
    }
    .info-item .value {
      font-weight: 600;
      color: var(--text-dark);
    }
    .addr-card {
      margin-top: 20px;
      padding: 18px;
      border-radius: 16px;
      background: linear-gradient(145deg, #fdfdff, #f1f3ff);
      border: 1px solid #e5e8ff;
    }
    .addr-title {
      font-weight: 700;
      margin-bottom: 8px;
    }
    .btn-update {
      margin-top: 25px;
      background: linear-gradient(135deg, var(--grad-1), var(--grad-2));
      color: #fff;
      border-radius: 30px;
      padding: 12px 28px;
      font-weight: 600;
      border: none;
      box-shadow: 0 6px 20px rgba(91,108,255,0.35);
      transition: 0.3s;
    }
    .btn-update:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(91,108,255,0.45);
    }
  </style>
</head>
<body>
  <div class="id-wrap">
    <div class="id-card position-relative animate__animated animate__fadeInUp">
      <div class="id-inner">
        <!-- Left -->
        <div class="left-pane">
          <div class="doctor-image-container">
            <?php if(!empty($doctor['drimage'])): ?>
              <img src="../doctor/doc_image/<?php echo htmlspecialchars($doctor['drimage']); ?>" alt="Doctor Image">
            <?php else: ?>
              <div class="no-image-placeholder"><i class="fas fa-user-md"></i></div>
            <?php endif; ?>
          </div>
          <div class="name-block mt-4">
            <h3 style="color: black">Dr. <?php echo htmlspecialchars($name); ?></h3>
            <span class="role"><i class="fa-solid fa-stethoscope me-1"></i><?php echo $shift; ?></span>
            <p style="color: black"><?php echo htmlspecialchars($phone); ?></p>
          </div>
        </div>
        <!-- Right -->
        <div class="right-pane">
          <ul class="info-list">
            <li class="info-item"><i class="fa-regular fa-id-card"></i><div><div class="label">CNIC</div><div class="value"><?php echo $cnic; ?></div></div></li>
            <li class="info-item"><i class="fa-regular fa-envelope"></i><div><div class="label">Email</div><div class="value"><?php echo $email; ?></div></div></li>
            <li class="info-item"><i class="fa-solid fa-user-graduate"></i><div><div class="label">Education</div><div class="value"><?php echo $educate; ?></div></div></li>
            <li class="info-item"><i class="fa-solid fa-city"></i><div><div class="label">City</div><div class="value"><?php echo $city_name; ?></div></div></li>
            <li class="info-item"><i class="fa-solid fa-briefcase"></i><div><div class="label">Experience</div><div class="value"><?php echo $experience; ?></div></div></li>
            <li class="info-item"><i class="fa-solid fa-clock"></i><div><div class="label">Shift</div><div class="value"><?php echo $shift; ?></div></div></li>
          </ul>
          <div class="addr-card">
            <div class="addr-title"><i class="fa-solid fa-hospital me-1"></i>Clinic Address</div>
            <div><?php echo nl2br(htmlspecialchars($address)); ?></div>
          </div>
          <div class="text-center">
            <a href="update_doc.php?updid=<?php echo $upid; ?>" class="btn btn-update"><i class="fas fa-pen-to-square me-2"></i>Update Profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php if(!$doctor){ echo "Error fetching doctor details: " . mysqli_error($con); exit; } } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>