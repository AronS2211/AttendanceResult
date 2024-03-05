<?php
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Best Performer Table</title>
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

<div class="main-card">
          <div class="card text-bg-light mx-3 my-3">
            <div class="report-head p-2 d-flex justify-content-between align-items-center">
              <h3 class="m-0">Manage Best Performer</h3>
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

  <div class="container mt-5">

    <?php

    // SQL query
    $sql = "SELECT * FROM erp_news WHERE news_type='performer'";
    $result = mysqli_query($conn, $sql);
    ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Best Performer Table</h2>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Best Performer</th>
                <th>Description</th>
                <!-- <th>Year</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Posted By</th> -->
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php

              // Output data of each row

              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr id=\"" . $row['news_id'] . "\">";
                echo "<td>" . (isset($row["news_title"]) ? $row["news_title"] : "") . "</td>";
                echo "<td>" . (isset($row["news_desc"]) ? $row["news_desc"] : "") . "</td>";
                // echo "<td>" . (isset($row["year"]) ? $row["year"] : "") . "</td>";
                // echo "<td>" . (isset($row["department"]) ? $row["department"] : "") . "</td>";
                // echo "<td>" . (isset($row["date"]) ? $row["date"] : "") . "</td>";
                // echo "<td>" . (isset($row["posted_by"]) ? $row["posted_by"] : "") . "</td>";
                echo "<td><a href='edit_for_best_performer.php?id=" . $row["news_id"] . "&db=erp_news" . "'>Edit</a></td>";
                echo "<td><button class='btn btn-danger btn-sm remove'>Delete</button></td>";
                echo "</tr>";
              }

              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>





    <?php
    // $sql = "SELECT * FROM best_performer ORDER BY rank ASC LIMIT 3 OFFSET 0";
    // $result = mysqli_query($conn, $sql);

    // if (mysqli_num_rows($result) > 0) {
    //   $i = 1;
    //   while ($row = mysqli_fetch_assoc($result)) {
    //     echo "<h2>Rank " . $i . ": " . $row['student'] . "</h2>";
    //     $i++;
    //   }
    // } else {
    //   echo "<p>No results found.</p>";
    // }


    ?>


    <?php
    // // Retrieve distinct years from the table
    // $sql_years = "SELECT DISTINCT 'year' FROM erp_news WHERE news_type = 'performer'";

    // $result_years = mysqli_query($conn, $sql_years);

    // // Loop through each year
    // while ($row_years = mysqli_fetch_assoc($result_years)) {
    //   $year = $row_years['year'];
    //   echo "<h2>Top 3 Rankers for Year " . $year . "</h2>";

    //   // Retrieve distinct departments for the year
    //   $sql_departments = "SELECT DISTINCT department FROM erp_news WHERE 'year' = $year AND news_type = 'performer'";
    //   $result_departments = mysqli_query($conn, $sql_departments);

    //   // Loop through each department for the year
    //   while ($row_departments = mysqli_fetch_assoc($result_departments)) {
    //     $department = $row_departments['department'];
    //     echo "<h3>" . $department . "</h3>";

    //     // Retrieve the top 3 rankers for the year and department
    //     $sql_rankers = "SELECT * FROM erp_news WHERE year = $year AND department = '$department' AND news_type = 'performer' ORDER BY rank ASC LIMIT 3";
    //     $result_rankers = mysqli_query($conn, $sql_rankers);

    //     // Display the top 3 rankers
    //     if (mysqli_num_rows($result_rankers) > 0) {
    //       echo "<ol>";
    //       while ($row_rankers = mysqli_fetch_assoc($result_rankers)) {
    //         echo "<li>" . $row_rankers['student'] . " - Rank " . $row_rankers['rank'] . "</li>";
    //       }
    //       echo "</ol>";
    //     } else {
    //       echo "<p>No results found.</p>";
    //     }
    //   }
    // }
    ?>

  </div>
</body>
<script type="text/javascript">
  $(".remove").click(function() {
    var id = $(this).parents("tr").attr("id");


    if (confirm('Are you sure to remove this record ?')) {
      $.ajax({
        url: '/delete_for_best_performer.php',
        type: 'GET',
        data: {
          id: id
        },
        error: function() {
          alert('Deleted!');
        },
        success: function(data) {
          $("#" + id).remove();
          alert("The record has shruken into oblivion");
        }
      });
      window.location.href = "delete_for_best_performer.php?id=" + id + "&db=best_performer";
    }
  });
</script>

</html>