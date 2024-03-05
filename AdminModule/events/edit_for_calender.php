<?php
session_start();
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}
// Get the id parameter from the URL
$id = $_GET['id']; // get id through query string
$db = $_GET["db"];


// Retrieve the record with the corresponding id
$sql = "SELECT * FROM erp_news WHERE news_id = '$id' AND news_type = 'events'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $event_name = $_POST["event_name"];
    $event_desc = $_POST["event_desc"];
    $event_desc = str_replace(array("'"), '', $event_desc);
    // Update the record with the new data
    $sql = "UPDATE erp_news SET news_title='$event_name', news_desc='$event_desc' WHERE news_id='$id' AND news_type='events'";
    if (mysqli_query($conn, $sql)) {
        // Redirect to the main page
        header("Location: calender.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Notice</title>
</head>

<body>
    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <h1>Edit Calender</h1>
    <form method="post">
        Event Name: <input type="text" name="event_name" value="<?php echo $row["news_title"]; ?>"><br><br>
        Event Description: <input type="text" name="event_desc" value="<?php echo $row["news_desc"]; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>