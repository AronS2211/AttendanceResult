<?php
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

$sql = "SELECT DISTINCT tr_routename FROM erp_transport";
$result = mysqli_query($conn, $sql);
$TableRows = array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($TableRows, $row);
}
// Close the database connection
mysqli_close($conn);
?>

<div class="main-card">
          <div class="card text-bg-light mx-3 my-3">
            <div class="report-head p-2 d-flex justify-content-between align-items-center">
              <h3 class="m-0">Create Transport</h3>
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
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transport Page</title>
</head>
<style>
    .form-group {
        width: 50%;
        position: relative;
        transform: translate(50%, 50%);
    }
</style>

<body>

    <!-- Page Content -->


    <div class="container mt-4">
        <button style="background-color:#54045E" class="btn btn-dark" onclick="window.location.href = 'transports_manage.php';">Manage Transport
            Details</button>
        <h2>Insert transport details</h2>
        <form id="transportForm">
            <div class="form-group">
                <label for="Route_No">Route No:</label>
                <input type="number" class="form-control" id="Route_No" placeholder="Enter Route Number">
            </div>
            <div class="form-group">
                <label for="Route_Name">Route Name:</label>
                <input type="text" class="form-control" id="Route_Name" placeholder="Enter Route Name" list="routes">
                <datalist id="routes">
                    <?php
                    foreach ($TableRows as $TableRow) {
                        echo "<option value='$TableRow[tr_routename]'>$TableRow[tr_routename]</option>";
                    }
                    ?>
                </datalist>
            </div>
            <div class="form-group">
                <label for="Stop_Name">Stop Name:</label>
                <input type="text" class="form-control" id="Stop_Name" placeholder="Enter Stop Name">
            </div>
            <div class="form-group">
                <label for="Pickup_Time">Pickup Time:</label>
                <input type="time" class="form-control" id="Pickup_Time" placeholder="">
            </div>
            <div class="form-group">
                <label for="Drop_Time">Drop Time:</label>
                <input type="time" class="form-control" id="Drop_Time" placeholder="">
            </div>
            <div class="form-group mt-4">
                <button style="background-color:#54045E" type="submit" class="btn btn-dark">Submit</button>
            </div>
        </form>
        <div class="form-group mt-4">
            <div id="Result">

            </div>
        </div>

    </div>


    <!-- Bootstrap JS and Popper.js -->
    <script>
        $(document).ready(function() {

            $('#transportForm').submit(function(e) {
                e.preventDefault();

                var Route_No = $("#Route_No").val();
                var Route_Name = $("#Route_Name").val();
                var Pickup_Time = $("#Pickup_Time").val();
                var Stop_Name = $("#Stop_Name").val();
                var Drop_Time = $("#Drop_Time").val();
                console.log(Route_No + 'HI');


                // var formData = new FormData(this); 

                // // add selected value to formData
                // formData.append('event_name', event_name);

                // console.log(formData);
                // AJAX CALL FOR INSERTING 
                $.ajax({
                    url: 'functions.php',
                    type: 'POST',
                    // data: formData,
                    // processData: false,
                    // contentType: false,
                    data: {
                        Route_No: Route_No,
                        Route_Name: Route_Name,
                        Pickup_Time: Pickup_Time,
                        Stop_Name: Stop_Name,
                        Drop_Time: Drop_Time,
                        Function: "Insert"
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == "OK") {
                            $("#Result").html(`<div class="alert alert-success fade show" role="alert"> Inserted successfully into Transports table! </div>`);
                        } else {
                            $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                        }
                        setTimeout(function() {
                            $("#Result").html('');
                        }, 5000);

                    }
                });
            });
        });
    </script>
</body>

</html>