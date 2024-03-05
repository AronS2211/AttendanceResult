<?php 
session_start();
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

$sql = "SELECT * FROM erp_news WHERE news_type='events' ORDER BY news_id DESC LIMIT 1;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    echo "<h2><marquee direction='left' scrollamount='17'>" . $row['news_title'] . ": " . $row['news_desc'] . "";
    echo "</marquee>";
    echo "</h2>";
}
?>
<button onclick="goBack()">Go Back</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <h2>Events</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>News Title</th>
                        <th>News Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pagination variables
                    $limit = 3;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start = ($page - 1) * $limit;

                    // Fetch and display data from erp_news table
                    $sql = "SELECT * FROM erp_news WHERE news_type='events' LIMIT $start, $limit";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["news_title"] . "</td>";
                            echo "<td>" . $row["news_desc"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No results</td></tr>";
                    }

                    // Pagination links
                    $sql = "SELECT COUNT(*) AS count FROM erp_news WHERE news_type='events'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_pages = ceil($row['count'] / $limit);

                    echo "<tr><td colspan='3'>";
                    echo "<nav aria-label='Page navigation'>";
                    echo "<ul class='pagination justify-content-center'>";

                    for ($i = 1; $i <= $total_pages; $i++) {
                        $active = ($i == $page) ? "active" : "";
                        echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                    }

                    echo "</ul>";
                    echo "</nav>";
                    echo "</td></tr>";

                    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    //     $event_name = $_POST["event_name"];
                    //     $event_date = $_POST["event_date"];
                    //     $event_time = $_POST["event_time"];
                    //     $event_duration = $_POST["event_duration"];

                    //     // Create news description sentence
                    //     $news_desc = "The event " . $event_name . " of type " . $event_type . " is scheduled for " . $event_date . " at " . $event_time . " for a duration of " . $event_duration;
                    //     $news_desc1 = mysqli_real_escape_string($conn, $news_desc);
                    //     $news_desc = str_replace(array("'"), '', $news_desc1);

                    //     // Insert form data into erp_news table
                    //     $sql = "INSERT INTO erp_news (news_title, news_type, news_desc) VALUES ('$event_name', '$event_type', '$news_desc')";
                    //     if (mysqli_query($conn, $sql)) {
                    //         echo "New event created successfully";
                    //     } else {
                    //         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    //     }
                    // }

                    ?>
                </tbody>
            </table>
            <a href="calender_create.php" class="btn btn-primary">Create</a>
            <a href="calender_manage.php" class="btn btn-primary">Manage</a> <br>
            <br>
        </div>



        <?php include("includes/Footer.php"); ?>