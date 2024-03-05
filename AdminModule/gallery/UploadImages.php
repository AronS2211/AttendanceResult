<?php include("Includes/Header.php") ?>


<?php
// Include the database connection file
include('Includes/db_connection.php');

// Execute an SQL query
$sql = 'SELECT * FROM erp_gallery';
$result = mysqli_query($conn, $sql);
$EventRows = array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($EventRows, $row);
}
// print_r($EventRows);
// Close the database connection
mysqli_close($conn);
?>




<div class="card m-3 w-50">
    <div class="card-header">
        Image Upload
    </div>
    <div class="card-body">
        <!-- <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a> -->


        <form id="ImageUploadForm" >

            <div class="form-group">
                <label for="Evnet">Select Event</label>
                <select class="form-control" id="Evnet" name="platform" required="required">
                    <?php
                    foreach ($EventRows as $Event) {
                        echo "<option value=" . $Event['g_id'] . ">" . $Event['g_title'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- <div class="form-group">
                <label for="ImageName" required="required">Image Name (Optional)</label>
                <input type="text" name="ImageName" class="form-control" id="ImageName" aria-describedby="ImageName"
                    placeholder="">
            </div> -->
            <div class="form-group">
                <label for="ImageDesc" required="required">Image Desc</label>
                <input type="text" name="ImageDesc" class="form-control" id="ImageDesc" aria-describedby="ImageDesc"
                    placeholder="">
            </div>
            <div class="form-group">
                <label class="p-2">Select File </label>
                <input class="form-control" type="file" name="fileToUpload[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary" >Upload</button>
        </form>

              <div id="Result" class="m-3">

        </div>

    </div>
</div>
<!-- JavaScript code to handle form submission with AJAX -->    
<script>
    $(document).ready(function () {
        $('#ImageUploadForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            var selectedEvent = $('#Evnet').val(); // get selected value
            // var ImageName = $('#ImageName').val(); // get selected value
            var ImageDesc = $('#ImageDesc').val(); // get selected value

            // add selected value to formData
            formData.append('Evnet', selectedEvent);
            // formData.append('ImageName', ImageName);
            formData.append('ImageDesc', ImageDesc);

            console.log(formData);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response == "OK") {
                        $("#Result").html(`<div class="alert alert-success fade show" role="alert"> Upload successful! </div>`);
                    } else {
                        $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                    }
                    setTimeout(function () {
                        $("#Result").html('');
                    }, 5000);

                }
            });
        });
    });
</script>









<?php include("Includes/Footer.php") ?>