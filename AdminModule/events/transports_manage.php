<?php
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

// Constants
$recordsPerPage = 7;

// Calculate the current page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Execute an SQL query with pagination

$sql = "SELECT * FROM `erp_transport` ORDER BY tr_id DESC LIMIT $offset, $recordsPerPage";
$result = mysqli_query($conn, $sql);

$TableRows = array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($TableRows, $row);
}
// Get total records count for pagination
$totalRecordsSql = "SELECT COUNT(*) as count FROM `erp_transport`";
$totalRecordsResult = mysqli_query($conn, $totalRecordsSql);
$totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
$totalRecords = $totalRecordsRow['count'];
// print_r($TableRows);

// Distinct set of values for route name

$sql = "SELECT DISTINCT tr_routename, tr_routeno FROM erp_transport";
$result = mysqli_query($conn, $sql);
$TableRows2 = array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($TableRows2, $row);
}


// Close the database connection
mysqli_close($conn);

?>

<div class="main-card">
          <div class="card text-bg-light mx-3 my-3">
            <div class="report-head p-2 d-flex justify-content-between align-items-center">
              <h3 class="m-0">Manage Transport Details</h3>
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transport Page</title>
</head>

<body>

    <!-- Page Content -->


    <div class="container mt-4">
        <button style="background-color:#54045E" class="btn btn-dark" onclick="window.location.href = 'transports.php';">Create Transport Record</button>
        <h2>Manage the transport details</h2>
        <!-- Table with Pagination -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Transport ID</th>
                    <th>Route Number</th>
                    <th>Route Name</th>
                    <th>Stop_Name</th>
                    <th>Pickup Time</th>
                    <th>Drop Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- Your table rows go here -->
                <?php
                foreach ($TableRows as $TableRow) {
                    echo "<tr>
                        <td>$TableRow[tr_id]</td>
                        <td>$TableRow[tr_routeno]</td>
                        <td>$TableRow[tr_routename]</td>
                        <td>$TableRow[tr_stop]</td>
                        <td>$TableRow[tr_pickup]</td>
                        <td>$TableRow[tr_drop]</td>
                        <td>
                        <button type='button' value='$TableRow[tr_id]' class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                        Edit
                    </button>
                    </td>
                        <td><button value='$TableRow[tr_id]' class='btn btn-danger deleteBtn' data-bs-toggle='modal' data-bs-target='#exampleModal2'>Delete</button></td>
                    </tr> ";
                }
                ?>
                <!-- Add more rows as needed -->
            </tbody>
        </table>

        <!-- Button trigger modal
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit your post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="transportForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="Route_No">Route No:</label>
                                    <input type="number" class="form-control" value="" id="Route_No" placeholder="Enter Route Number" list="routenos">
                                    <datalist id="routenos">
                                        <?php
                                        foreach ($TableRows2 as $TableRow) {
                                            echo "<option value='$TableRow[tr_routeno]'>$TableRow[tr_routeno]</option>";
                                        }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label for="Route_Name">Route Name:</label>
                                    <input type="text" class="form-control" value="" id="Route_Name" placeholder="Enter Route Name" list="routes">
                                    <datalist id="routes">
                                        <?php
                                        foreach ($TableRows2 as $TableRow) {
                                            echo "<option value='$TableRow[tr_routename]'>$TableRow[tr_routename]</option>";
                                        }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label for="Stop_Name">Stop Name:</label>
                                    <input type="text" class="form-control" value="" value="" id="Stop_Name" placeholder="Enter Stop Name">
                                </div>
                                <div class="form-group">
                                    <label for="Pickup_Time">Pickup Time:</label>
                                    <input type="time" class="form-control" value="" id="Pickup_Time" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="Drop_Time">Drop Time:</label>
                                    <input type="time" class="form-control" value="" id="Drop_Time" placeholder="">
                                </div>
                            </div>
                        </form>
                        <div id="Result"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Former MOdal -->
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit your post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
            </div>
        </div> -->

        <!-- Pagination -->
        <div aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                $totalPages = ceil($totalRecords / $recordsPerPage);

                // Previous page
                echo "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'>
                        <a class='page-link' href='?page=" . ($page - 1) . "' tabindex='-1' aria-disabled='true'>Previous</a>
                      </li>";

                // Page numbers
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
                }

                // Next page
                echo "<li class='page-item " . ($page == $totalPages ? 'disabled' : '') . "'>
                        <a class='page-link' href='?page=" . ($page + 1) . "'>Next</a>
                      </li>";
                ?>
            </ul>
        </div>
    </div>

    <!-- Modal 2 for delete confirmation-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal2Label">Caution!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                    <button type="button" id="delConfirmBtn" class="btn btn-danger">Yes</button>
                </div>
                <div id="DelResult"></div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS and Popper.js -->
    <script>
        $(document).ready(function() {
            // Listen for the click event on elements with the class 'edit-btn'
            $(".edit-btn").click(function(e) {
                e.preventDefault();
                // Log information about the clicked button to the console
                var tableRows = $(this).parent().parent().children();
                var modal = $('#transportForm').children(':eq(0)').children();

                for (let i = 0; i < tableRows.length; i++) {
                    if (i == 0) {
                        continue;
                    }
                    var rowValue = tableRows.eq(i).html();
                    if (/^\d+$/.test(rowValue)) {
                        var rowValue = parseInt(rowValue, 10);
                        console.log(rowValue);
                        $('input', modal[i - 1]).attr('value', rowValue);
                    } else {
                        $('input', modal[i - 1]).attr('value', rowValue);
                    }
                    if (i == 5) {
                        break;
                    }
                }
                console.log($('input', modal[0]).val());
                // var parentElement = $(this).parent().parent().children().eq(6).html();
                // console.log(parentElement);
                console.log("Button Clicked:", this.value);
                var tId = $(this).val();

                $('#saveBtn').unbind().click(function(e) {

                    var Route_No = $("#Route_No").val();
                    var Route_Name = $("#Route_Name").val();
                    var Pickup_Time = $("#Pickup_Time").val();
                    var Stop_Name = $("#Stop_Name").val();
                    var Drop_Time = $("#Drop_Time").val();
                    console.log(Route_No + 'HI');

                    // AJAX call for updating the edit
                    var thisEditButton = $(this);
                    $.ajax({
                        url: 'functions.php',
                        type: 'POST',
                        data: {
                            tId: tId,
                            Route_No: Route_No,
                            Route_Name: Route_Name,
                            Pickup_Time: Pickup_Time,
                            Stop_Name: Stop_Name,
                            Drop_Time: Drop_Time,
                            Function: "Update"
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == "OK") {
                                $("#Result").html(`<div class="alert alert-success fade show" role="alert"> Updation Successful! </div>`);
                            } else {
                                $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                            }
                            setTimeout(function() {
                                $("#Result").html('');
                                location.reload();
                            }, 2000);

                        }
                    });
                });
            });

            // Ajax for Delete
            $('.deleteBtn').click(function(e) {
                var tId = $(this).val();
                console.log(tId);

                $('#delConfirmBtn').unbind().click(function(event) {
                    $.ajax({
                        url: 'functions.php',
                        method: 'POST',
                        data: {
                            tId: tId,
                            Function: 'Delete'
                        },
                        success: function(response) {
                            if (response == 'OK') {
                                $("#DelResult").html(`<div class="alert alert-success fade show" role="alert"> Deletion Successful!  </div>`);
                            } else {
                                $("#DelResult").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                            }
                            setTimeout(function() {
                                $("#DelResult").html('');
                                location.reload();
                            }, 2000)
                        }
                    });
                });
            })
        });
    </script>
</body>

</html>