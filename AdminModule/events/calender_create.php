<?php

include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $event_duration = $_POST["event_duration"];

    // Create news description sentence
    $news_desc = "The event '" . $event_name . "' is scheduled for " . $event_date . " at " . $event_time . " for a duration of " . $event_duration;
    $news_desc = mysqli_real_escape_string($conn, $news_desc);

    // Insert form data into erp_n_event table
    $sql = "INSERT INTO erp_news (news_title, news_type, news_desc) VALUES ('$event_name', 'events' , '$news_desc')";
    if (mysqli_query($conn, $sql)) {
        echo "New event created successfully";
        header("location:calender.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


<div class="main-card">
          <div class="card text-bg-light mx-3 my-3">
            <div class="report-head p-2 d-flex justify-content-between align-items-center">
              <h3 class="m-0">Create Event</h3>
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
<style>
    .form-group {
        text-align: left;
    }
</style>
<center>
    <div class="col-md-4">
        <h2>Create Event</h2>
        <form id="calenderForm">
            <div class="form-group">
                <label for="event_name">Event name:</label>
                <p style="color:red;font-size:10px;"> * The calendar will be marked as red mark if the event name
                    includes
                    "holiday"</p>
                <input type="text" class="form-control" id="event_name" name="event_name">
            </div>
            <div class="form-group">
                <label for="event_date">Start Date:</label>
                <input type="date" class="form-control" id="event_start_date" name="event_start_date">
            </div>
            <div class="form-group">
                <label for="event_time">Time:</label>
                <input type="time" class="form-control" id="event_time" name="event_time">
            </div>
            <div class="form-group">
                <label for="event_end_date">End Date:</label>
                <input type="date" class="form-control" id="event_end_date" name="event_end_date">
            </div>
            <div class="form-group">
                <label for="event_duration">Duration (days):</label>
                <input type="number" class="form-control" id="event_duration" name="event_duration" min="1" max="10" value="" disabled>
            </div>
            <div class="form-group">
                <label class="p-2">Select File</label>
                <input class="form-control" type="file" name="calenderImages[]">
            </div>
            <div class="d-flex justify-content-end my-1">
                <button type="submit" class="btn btn-primary">Create Event</button>
            </div>
        </form>
    </div>
</center>
<div id="Result" class="m-3"></div>




<!-- JavaScript code to handle form submission with AJAX -->
<script>
    $(document).ready(function() {
        $('#calenderForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var event_name = $('#event_name').val(); // get selected value
            // var ImageName = $('#ImageName').val(); // get selected value
            var event_start_date = $('#event_start_date').val(); // get selected value
            var event_end_date = $('#event_end_date').val(); // get selected value
            var event_time = $('#event_time').val(); // get selected value
            var event_duration = $('#event_duration').val(); // get selected value

            // add selected value to formData
            formData.append('event_name', event_name);
            // formData.append('ImageName', ImageName);
            formData.append('event_start_date', event_start_date);
            formData.append('event_end_date', event_end_date);
            formData.append('event_time', event_time);
            formData.append('event_duration', event_duration);

            // console.log(formData);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response == "OK") {
                        $("#Result").html(
                            `<div class="alert alert-success fade show" role="alert"> Calender Event Created Successfully! </div>`
                        );
                    } else {
                        $("#Result").html(
                            `<div class="alert alert-danger fade show" role="alert"> ${response}</div>`
                        );
                    }
                    setTimeout(function() {
                        $("#Result").html('');
                        window.location.replace("calender_manage.php")
                    }, 5000);

                }
            });
        });
    });


    //  function updateEndDate() {
    //     var duration = document.getElementById('event_duration').value;
    //     var endDateField = document.getElementById('event_end_date');

    //     if (duration > 1) {
    //         endDateField.disabled = false;
    //     } else {
    //         endDateField.disabled = true;
    //         // Set the end date the same as the start date for a single day event
    //         document.getElementById('event_end_date').value = document.getElementById('event_start_date').value;
    //     }
    // }
    function endDateMinSetter() {
        var startDate = new Date(document.getElementById('event_start_date').value);
        var endDateField = document.getElementById('event_end_date');
        // Set the min attribute of the end date input to the start date
        endDateField.min = startDate.toISOString().split('T')[0];
        //   document.getElementById('event_end_date').value = document.getElementById('event_start_date').value;
    }

    function updateDuration() {
        var duration = parseInt(document.getElementById('event_duration').value, 10);
        var startDate = new Date(document.getElementById('event_start_date').value);
        var endDateField = document.getElementById('event_end_date');

        // endDateField.disabled = 1;


        // Calculate the duration based on the difference between start and end dates
        var endDate = new Date(endDateField.value);
        var duration = endDate.getDate() - startDate.getDate();
        // var duration = Math.abs(Math.ceil((startDate - endDate) / (24 * 60 * 60 * 1000)) + 1);

        // Update the duration input
        document.getElementById('event_duration').value = duration + 1;
    }

    // Add event listeners for both duration and start date
    document.getElementById('event_start_date').addEventListener('input', endDateMinSetter);
    document.getElementById('event_end_date').addEventListener('input', updateDuration);


    // document.getElementById('event_start_date').addEventListener('input',updateEndDate);
    // document.getElementById('event_duration').addEventListener('input',updateEndDate);
</script>

<?php include("includes/Footer.php"); ?>