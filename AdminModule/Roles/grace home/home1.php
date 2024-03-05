<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roles";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  $user_id = $_SESSION['user_id'];

  $sql_student = "SELECT stu_fname, stu_lname FROM erp_student WHERE stu_id = :user_id";
  $sql_faculty = "SELECT f_role, f_fname, f_lname FROM erp_faculty WHERE f_id = :user_id";

  $stmt_student = $pdo->prepare($sql_student);
  $stmt_student->bindParam(':user_id', $user_id);
  $stmt_student->execute();

  $stmt_faculty = $pdo->prepare($sql_faculty);
  $stmt_faculty->bindParam(':user_id', $user_id);
  $stmt_faculty->execute();

  $result_student = $stmt_student->fetch();
  $result_faculty = $stmt_faculty->fetch();

  if ($result_student) {
    $first_name = $result_student['stu_fname'];
    $last_name = $result_student['stu_lname'];
    $role = 'student';
  } elseif ($result_faculty) {
    $first_name = $result_faculty['f_fname'];
    $last_name = $result_faculty['f_lname'];
    $role = $result_faculty['f_role'];
  } else {
    echo "User not found in the database.";
  }

  $authorized_menus = array();

  if ($role) {
    $stmt = $pdo->prepare("SELECT r_access FROM erp_role WHERE r_rolename = :role");
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    $result = $stmt->fetch();

    if ($result) {
      $access = $result['r_access'];
      $authorized_menus = explode(',', $access);
    }
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$pdo = null;
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>


  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">

  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <style>
    ::selection {
      background-color: rgb(128, 0, 128);
      color: #fff;
    }
  </style>

</head>


<body>


  <div class="sidebar close">
    <div class="logo-details">
      <img src="gcoe_logo.png" width="60px" height="50px">
      <span class="logo_name"> GRACE COE THOOTHUKUDI</span>
    </div>

    <ul class="nav-links">
      <?php foreach ($authorized_menus as $menu) { ?>

        <?php if ($menu === 'home') { ?>

          <li>
            <a href="" target="output_source">
              <i class='bx bxs-home'></i>
              <span class="link_name">Home</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="">Home</a></li>
            </ul>

          </li>
        <?php } ?>

        <?php if ($menu === 'dashboard') { ?>

          <li>
            <a href="" target="output_source">
              <i class='bx bxs-dashboard'></i>
              <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="">Dashboard</a></li>
            </ul>

          </li>
        <?php } ?>

        <?php if ($menu === 'admin_module') { ?>

          <li>
            <a href="../AdminMenu.php" target="output_source">
              <i class='bx bxs-user'></i>
              <span class="link_name">Admin module</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Admin module</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($menu === 'attendance_posting') { ?>

          <li>
            <a href="#" target="output_source">
              <i class='bx bx-bar-chart-alt-2'></i>
              <span class="link_name">Attendance posting</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Attendance posting</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($menu === 'result_posting') { ?>

          <li>
            <a href="#" target="output_source">
              <i class='bx bx-bar-chart-square'></i>
              <span class="link_name">Result posting</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Result posting</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($menu === 'reports') { ?>

          <li>
            <div class="iocn-link">
              <a href="#" target="output_source">
                <i class='bx bxs-report'></i>
                <span class="link_name">Reports</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Reports</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($menu === 'gallery') { ?>

          <li>
            <a href="#" target="output_source">
              <i class='bx bx-photo-album'></i>
              <span class="link_name">Gallery</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Gallery</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($menu === 'profile') { ?>

          <li>
            <a href="" target="output_source">
              <i class='bx bxs-user'></i>
              <span class="link_name"> Profile</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Profile</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($menu === 'view_calendar') { ?>

          <li>
            <a href="#" target="output_source">
              <i class='bx bxs-calendar'></i>
              <span class="link_name">View calender</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">View calender</a></li>
            </ul>
          </li>
        <?php } ?>

        <?php if ($menu === 'change_password') { ?>

          <li>
            <a href="#" target="output_source">
              <i class='bx bxs-lock-open-alt'></i>
              <span class="link_name">Change password</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Change password</a></li>
            </ul>
          </li>
      <?php }
      } ?>
      <li>
        <a href="../Logout.php">
          <i class='bx bx-log-out icon'></i>
          <span class="link_name">Logout</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../Logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <header class="header">
      <table id="ctl00_tblWelAddr" cellspacing="0" cellpadding="0" align="center" width="100%">
        <tbody>
          <tr>
            <td class="Headerheight">
              <table width="auto" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                  <tr>
                    <td width="50%" align="left">
                      <span id="ctl00_lblSiteUsersCount" class="WhiteLabel"></span>
                      <span id="ctl00_lblWelcometext" style='position: fixed;right: 0;top: 0; padding: 0px 5px; background: linear-gradient(to right, rgb(79, 4, 79), rgb(193, 91, 193)); color: #fff;'>
                        <?php echo $first_name . ' ' . $last_name . ' (' . $role . ') ' ?>!!
                      </span>
                    </td>
                    <td align="right" style="color: black;">

                    </td>
              </table>
    </header>
    <div class="home-content">

      <i class='bx bx-menu'></i>



      <img id="responsive-image" src="grace.png">


      <img id="responsive-image" src="coe.png">

    </div>

  </section>
  <br><br><br>

  <section class="content_frame" style="padding: 50px;">
    <iframe src="" name="output_source" frameborder="0" width="100%" height="927.75px"></iframe>
  </section>

  <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
      });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  </script>
  <div class="footer1" id="footerNew">

    <p class="p-class">Copyright © <?php echo date("Y"); ?>. All rights reserved by @ GRACE COLLEGE OF ENGINEERING</p>
    <p class="p-class">Copyright © <?php echo date("Y"); ?>. Developed by 3rd year cse batch 2020-2024</p>
  </div>
  </script>
  <style>
    .footer1 {
      background-image: linear-gradient(to right, rgb(79, 4, 79), rgb(193, 91, 193));
      /* padding: 5%; */
      text-align: center;
      position: fixed;
      bottom: 0;
      padding: 0.3% 0% 0.3% 0%;
      color: #fff;
      width: 100%;
    }
  </style>
</body>

</html>