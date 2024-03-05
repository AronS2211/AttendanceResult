<?php
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
  exit();
}

if (isset($_SESSION['user_id'])) {
  // // Get the JSON data from the POST request
  $user_id = $_SESSION['user_id'];
?>


  <div class="main-card">
    <div class="card text-bg-light mx-3 my-3">
      <div class="report-head p-2 d-flex justify-content-between align-items-center">
        <h3 class="m-0">Manage Quotes</h3>
        <div>
          <a href="../index.php">Back</a>
          <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
        </div>
      </div>
      <div class="card-header border-top">
        <div class="d-flex flex-row justify-content-between">
          <h6 class='mb-0'>Manage</h6>
          <h6 class='mb-0'></h6>
        </div>
      </div>
      <!DOCTYPE html>
      <html>

      <head>
        <title>Quotes Table</title>
        <style>
          h2 {
            font-size: 24px;
            /* Change the font size */
            font-weight: bold;
            /* Make the text bold */
            color: #333;
            /* Change the text color */
            text-align: center;
            /* Align the text to the center */
            text-transform: uppercase;
            /* Change the text to uppercase */
            letter-spacing: 2px;
            /* Add space between letters */
            margin-bottom: 20px;
            /* Add margin to the bottom of the text */
          }
        </style>
      </head>

      <body>

        <!-- Navbar
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">My Website</a>
  <button class="navbar-toggler hamburger hamburger--collapse" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="hamburger-box">
      <span class="hamburger-inner"></span>
    </span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-5"> -->

        <?php
        // SQL query
        $sql = "SELECT * FROM erp_news WHERE news_type= 'thought'";
        $result = mysqli_query($conn, $sql);
        ?>

        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Quote</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  // Output data of each row
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr id=\"" . $row['news_id'] . "\">";
                    echo "<td>" . $row["news_title"] . "</td>";
                    // echo "<td>" . $row["news_postby"] . "</td>";
                    echo "<td><a href='edit_for_quotes.php?id=" . $row["news_id"] . "&db=erp_news" . "'>Edit</a></td>";
                    echo "<td><button class='btn btn-danger btn-sm remove'>Delete</button></td>";
                    echo "</tr>";
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- <div class="ml-xl-5 mt-4">
<h2 class="text-center font-georgia">Insert a quote</h2>
<form id="insert-form-quote" class="form-group" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="form-group row">
    <label for="quote" class="col-sm-2">quote:</label>
    <div class="col-sm-10">
    <input class="" type="text" id="quote" name="quote" required>
    </div>
    </div>
    </div>
    <div class="form-group row">
    <label for="posted_by" class="col-sm-2">posted_by:</label>
    <div class="col-sm-10">
    <input type="text" id="posted_by" name="posted_by" required>
    </div>
    </div>
    <input  class="btn btn-primary ml-4" type="submit" name="insert" value="Insert">
    
</form>
</div> -->
        <?php
        if (isset($_POST["insert"])) {
          // Retrieve data from the form
          $quote = $_POST['quote'];
          $posted_by = $_POST['posted_by'];

          // Create the SQL query
          $sql = "INSERT INTO erp_news (news_title, news_postby) VALUES ('$quote' , '$posted_by')";
          $sql = "INSERT INTO erp_news (news_title, news_postby) VALUES ('$quote' , '$posted_by')";

          // Execute the query
          if (mysqli_query($conn, $sql)) {
            header("Refresh:0");
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
          // Close connection

        }
        ?>


        <?php
        $sql = "SELECT * FROM erp_news WHERE news_type= 'quote' ORDER BY news_id DESC LIMIT 1 ;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          echo "<h2>" . $row['news_title'] . "";
          echo "</h2>";
        }

        mysqli_close($conn);

        ?>
    </div>
    </body>
    <script type="text/javascript">
      $(".remove").click(function() {
        var id = $(this).parents("tr").attr("id");


        if (confirm('Are you sure to remove this record ?')) {
          $.ajax({
            url: '/delete_for_quotes.php',
            type: 'GET',
            data: {
              id: id
            },
            success: function(data) {
              $("#" + id).remove();
              alert("Deleted Successfully!");
            },
            error: function() {
              alert('Deleted');
            }
          });
          window.location.href = "delete_for_quotes.php?id=" + id + "&db=quotes";
        }
      });
    </script>

    </html>

  <?php
} else {
  header("Location: ../../index.php");
}
  ?>