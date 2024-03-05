

<?php
include("conn.php");
include("includes/Header.php");
?>

<div class="main-card">
          <div class="card text-bg-light mx-3 my-3">
            <div class="report-head p-2 d-flex justify-content-between align-items-center">
              <h3 class="m-0">Manage Notices</h3>
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
    <title>Notices Table</title>
    <style>
    </style>
</head>
<body>
    <div class="container">
        <?php
        // SQL query
        $sql = "SELECT * FROM erp_news WHERE news_status = 1 AND news_type='circular'";
        $result = mysqli_query($conn, $sql);
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <!-- <th>Date</th> -->
                                <!-- <th>Posted By</th> -->
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                $currentPage = (int)$_GET['page'];
                            } else {
                                $currentPage = 1;
                            }
                            // Output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr id=\"" . $row['news_id'] . "\">";
                                echo "<td>" . $row["news_title"] . "</td>";
                                echo "<td>" . $row["news_desc"] . "</td>";
                                // echo "<td>" . $row["date"] . "</td>";
                                // echo "<td>" . $row["news_postby"] . "</td>";
                                echo "<td><a href='edit_for_notices.php?id=" . $row["news_id"] . "&db=erp_news" . "' >Edit</a></td>";
                                echo "<td><button class='btn btn-danger btn-sm remove'>Delete</button></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <a href="saved_notices.php" class="btn btn-primary">Saved notices</a>
            </div>

        </div>


        <div class="ml-xl-5 mt-4">
            <br>
            <br>
</body>
<script type="text/javascript">
    $(".remove").click(function() {
        var id = $(this).parents("tr").attr("id");


        if (confirm('Are you sure to remove this record ?')) {
            $.ajax({
                url: '/delete_for_notices.php',
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
            window.location.href = "delete_for_notices.php?id=" + id + "&db=notices";
        }
    });
</script>

</html>