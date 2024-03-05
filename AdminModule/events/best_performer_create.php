<?php
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

?>
<style>
    .form-group {
        text-align: left;
    }
</style>

<div class="main-card">
    <div class="card text-bg-light mx-3 my-3">
        <div class="report-head p-2 d-flex justify-content-between align-items-center">
            <h3 class="m-0">Create Best Performer</h3>
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
        <center>
            <div class="col-md-4">
                <h2 class="font-georgia">Insert Best Performer</h2>
                <form id="insert-form-best_performer" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group mt-2">
                        <label for="best_performer">Best Performer:</label>
                        <input class="form-control" type="text" id="best_performer" name="best_performer" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="rank" class="">Rank:</label>
                        <input class="form-control" type="text" id="rank" name="rank" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="year" class="">Year:</label>
                        <div class="">
                            <select class="form-control" id="year" name="year" required>
                                <option value="">Select Year</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="department" class="">Department:</label>
                        <div class="">
                            <select class="form-control" id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="CSE">CSE</option>
                                <option value="ECE">ECE</option>
                                <option value="EEE">EEE</option>
                                <option value="MECH">MECH</option>
                                <option value="MBA">MBA</option>
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-group">
            <label for="posted_by" class="">Posted By:</label>
            <div class="">
                <input class="form-control" type="text" id="posted_by" name="posted_by" required>
            </div>
        </div> -->

                    <div class="form-group mt-2">
                        <div class=""></div>
                        <div class="mt-2">
                            <input class="btn btn-primary" type="submit" name="insert" value="Insert">
                        </div>
                    </div>
                </form>
            </div>
        </center>

        <?php
        if (isset($_POST["insert"])) {
            // Retrieve data from the form
            $best_performer = $_POST['best_performer'];
            $rank = $_POST['rank'];
            $year = $_POST['year'];
            $department = $_POST['department'];
            $posted_by = $_SESSION['user_id'];

            // Concatenate the variables using the dot (.) operator
            $concatenatedTitle = $best_performer;
            $concatenatedDesc = "" . $best_performer . " achieved rank " . $rank . " in year " . $year . " from the " . $department . " department.";

            // Assign to news_title and news_desc
            $news_title = $concatenatedTitle;
            $news_desc = $concatenatedDesc;

            // Create the SQL query
            $sql = "INSERT INTO erp_news(news_title, news_type, news_desc, news_postby) VALUES ('$news_title', 'performer', '$news_desc', '$posted_by')";


            // Execute the query
            if (mysqli_query($conn, $sql)) {
                echo '<script>window.location.href = "best_performer_manage.php"</script>';
                echo "New record created successfully";
                echo $news_title;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            // Close connection

        }
        ?>

        <?php include("includes/Footer.php"); ?>