<?php
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}
// Get the id parameter from the URL
$id = $_GET['id']; // get id through query string
$db = $_GET["db"];


// Retrieve the record with the corresponding id
$sql = "SELECT * FROM " . $db . " WHERE news_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $student = $_POST["student"];
    $year = $_POST["year"];

    // Update the record with the new data
    $sql = "UPDATE " . $db . " SET news_title='$student', news_desc='$year' WHERE news_id='$id'";
    if (mysqli_query($conn, $sql)) {
        // Redirect to the main page
        header("Location: best_performer_manage.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<div class="main-card">
    <div class="card text-bg-light mx-3 my-3">
        <div class="report-head p-2 d-flex justify-content-between align-items-center">
            <h3 class="m-0">Edit Best Performer</h3>
            <div>
                <a href="../index.php">Back</a>
                <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
            </div>
        </div>
        <div class="card-header border-top">
            <div class="d-flex flex-row justify-content-between">
                <h6 class='mb-0'>Edit</h6>
                <h6 class='mb-0'></h6>
            </div>
        </div>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Edit Notice</title>
        </head>

        <body>
            <center>
            <h1>Edit Notice</h1>
            <form method="post">
                Best Performer: <input type="text" name="student" value="<?php echo $row["news_title"]; ?>"><br><br>
                Description: <input type="text" name="year" value="<?php echo $row["news_desc"]; ?>"><br><br>
                <input type="submit" value="Submit">
            </form>
            </center>
        </body>

        </html>