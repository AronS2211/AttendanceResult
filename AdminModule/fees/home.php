<?php

session_start();


$conn = mysqli_connect('localhost', 'root', '', 'graceerp');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>






<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>


  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">

  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>


<body>
  <!-- Content Frame -->
  <style>
    .main-container {
      margin-top: 20px;
      display: flex;
    }

    .content_frame {
      height: 77vh;
      width: 100%;

    }
  </style>
  <div class="main-container">
    <section class="content_frame">
      <iframe src="./FeesSelectCategory.php" class="nav_frame" height="100%" width="100%" title="Navbar"></iframe>
    </section>
  </div>
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

    <p class="p-class">Copyright ©
      <?php echo date("Y"); ?>. All rights reserved by @ GRACE COLLEGE OF ENGINEERING
    </p>
    <p class="p-class">Copyright ©
      <?php echo date("Y"); ?>. Developed by 3rd year cse batch 2020-2024
    </p>
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