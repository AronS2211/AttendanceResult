<?php
include("conn.php");
include("includes/Header.php");


if (!isset($_SESSION['user_id'])) {
    exit();
}

if (isset($_SESSION['user_id'])) {
    // // Get the JSON data from the POST request
    $user_id = $_SESSION['user_id'];


    // Getting staff name of staff who posts
    $query = "SELECT f_id, f_fname, f_lname,f_img,f_role FROM erp_faculty WHERE f_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Access the values from the row
            $f_id = $row['f_id'];
            $f_fname = $row['f_fname'];
            $f_lname = $row['f_lname'];
            $f_img = $row['f_img'];
            $f_role = $row['f_role'];
        } else {
            // Handle the case where no matching user is found
            echo "User not found.";
        }
    } else {
        // Handle the case where the query fails
        echo "Query failed: " . mysqli_error($conn);
    }
?>
    <div class="main-card">
        <div class="card text-bg-light mx-3 my-3">
            <div class="report-head p-2 d-flex justify-content-between align-items-center">
                <h3 class="m-0">Create Quotes</h3>
                <div>
                    <a href="../index.php">Back</a>
                    <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                </div>
            </div>
            <div class="card-header border-top">
                <div class="d-flex flex-row justify-content-between">
                    <h6 class='mb-0'>Create</h6>
                    <h6 class='mb-0'></h6>
                </div>
            </div>
            <div style="width: 25%" class="ml-xl-5 mt-4 mx-auto" style="width: fit-content;">
                <h2 class="text-center font-georgia">Insert a quote</h2>
                <form id="insert-form-quote" class="form-group" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group row">
                        <label for="quote" class="">Quote:</label>
                        <div class="col-sm-10">
                            <input class="" type="text" id="quote" name="quote" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <label for="posted_by" class="col-sm-2">posted_by:</label> -->
                        <div class="col-sm-10">
                            <input type="hidden" id="posted_by" name="posted_by" value="<?php echo $f_fname . ' ' . $f_lname ?>">
                        </div>
                    </div>
                    <input class="btn btn-primary ml-4 mt-4" type="submit" name="insert" value="Insert">
                </form>
            </div>

            <?php
            if (isset($_POST["insert"])) {
                // Retrieve data from the form
                $quote = $_POST['quote'];
                $posted_by = $_POST['posted_by'];

                // Create the SQL query
                $sql = "INSERT INTO erp_news (news_title, news_postby, news_type) VALUES ('$quote' , '$posted_by', 'thought')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    // header("Refresh:0");
                    echo "New record created successfully";
                    echo '<script>window.location.href = "quotes_manage.php"</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                // Close connection

            }
            ?>


            <?php
            $sql = "SELECT * FROM erp_news WHERE news_type = 'quote' ORDER BY news_id DESC LIMIT 1;";

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
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $("#" + id).remove();
                            alert("The record has shruken into oblivion");
                        }
                    });
                    window.location.href = "delete_for_quotes.php?id=" + id + "&db=quotes";
                }
            });
        </script>



        <?php include("includes/Footer.php"); ?>
    <?php
} else {
    header("Location: ../../index.php");
}
    ?>