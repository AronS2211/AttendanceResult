<style>
    .card {
        transition: all 0.3s ease-in;
    }

    .card img {
        height: 10rem;
    }

    .card:hover {
        transform: scale(1.1);
        cursor: pointer;
    }

    .modal-xl {
        max-width: 130vh !important;
    }
</style>

<?php include("Includes/Header.php") ?>



<?php
// Include the database connection file
include('Includes/db_connection.php');
if (isset($_GET['Id'])) {
    $Id = $_GET["Id"];
    $sql = 'SELECT * FROM `erp_img` WHERE g_id=' . $Id . ' ORDER BY img_id ASC';
} else {
    $sql = 'SELECT * FROM `erp_img` ORDER BY img_id ASC';
}

// Execute an SQL query
$result = mysqli_query($conn, $sql);
$ImageRows = array();
// Process the result set
while ($row = mysqli_fetch_assoc($result)) {
    // Do something with each row
    array_push($ImageRows, $row);
}
// Close the database connection
// mysqli_close($conn);
?>

<?php
// Include the database connection file
// include('Includes/db_connection.php');

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





<section class="gallery-block cards-gallery">
    <div class="heading m-3 mb-0 ">
        <h2>Cards Gallery</h2>
    </div>

    <div class="container p-5">
        <div class="row">

            <?php
            foreach ($ImageRows as $ImageRow) {
                echo '	            <div class="col-md-4 col-lg-3">
                <div class="card border-0 transform-on-hover">
                    <a class="lightbox" data-bs-toggle="modal" data-bs-target="#Modal' . $ImageRow['img_id'] . '">
                        <img src="' . $ImageRow['img_img'] . '" alt="Card Image" class="card-img-top">
                    </a>
                    <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <h6>' . $ImageRow['img_desc'] . '</h6>
                    </div>
                    <div class="col-3 text-end">
                    <i class="fas fa-edit" id="' . $ImageRow['img_id'] . '" onclick="PreviewEvent(this)"></i>
                    </div>
                    </div>
                    </div>
                </div>
            </div>

            
            <div class="modal fade" id="Modal' . $ImageRow['img_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <img src="' . $ImageRow['img_img'] . '" alt="Card Image" class="card-img-top">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>









';


            }

            ?>


        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="EditImgModal" tabindex="-1" aria-labelledby="EditImgModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditImgModalLabel">Edit Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div class="form-group">
                    <label for="EditImgDesc" required="required">Edit Image Desc</label>
                    <input type="text" name="EditImgDesc" class="form-control" id="EditImgDesc"
                        aria-describedby="EditImgDesc" placeholder="">
                </div>
                <div class="form-group">
                    <label for="Event">Select Event</label>
                    <select class="form-control" id="Event" name="platform" required="required">
                        <?php
                        foreach ($EventRows as $Event) {
                            echo "<option value=" . $Event['g_id'] . ">" . $Event['g_title'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="UpdateDataId d-none"></div>
                <div id="EditResult" class="m-3">

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="DeleteEventBtn"
                    onclick="DeleteEvent(this)">Delete</button>
                <button type="button" class="btn btn-primary" id="EditEventBtn"
                    onclick="UpdateEvent(this)">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function PreviewEvent(e) {
        console.log(e);
        $('#EditImgModal').modal('show');
        $(".UpdateDataId").html(e.id);
        var id = e.id;
        $.ajax({
            url: 'Functions.php',
            type: 'POST',
            data: { EventId: id, Function: "ReadImage" },
            success: function (Data) {
                Data = JSON.parse(Data);
                console.log(Data);
                if (Data.Response == "OK") {
                    $("#Event").val(Data.g_id);
                    $("#EditImgDesc").val(Data.img_desc);
                } else {
                    $("#EditResult").html(`<div class="alert alert-danger fade show" role="alert"> ${Data.Response}</div>`);
                    setTimeout(function () {
                        $("#EditResult").html('');
                    }, 5000);

                }
            }
        });

    }

    function UpdateEvent(e) {
        var id = $(".UpdateDataId").html();
        var Event = $("#Event").val();
        var EditImgDesc = $("#EditImgDesc").val();

        console.log(id + Event+EditImgDesc);
        $.ajax({
            url: 'Functions.php',
            type: 'POST',
            data: { EventId: id, Event: Event, EditImgDesc: EditImgDesc, Function: "UpdateImage" },
            success: function (response) {
                console.log(response);
                if (response == "OK") {
                    $("#EditResult").html(`<div class="alert alert-success fade show" role="alert"> Image Updated Successfully</div>`);
                    setTimeout(function () {
                        $("#EditResult").html('');
                        $('#EditImgModal').modal('hide');
                        location.reload();
                    }, 5000);
                } else {
                    $("#EditResult").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                    setTimeout(function () {
                        $("#EditResult").html('');
                    }, 5000);

                }

            }
        });
    }

    function DeleteEvent(e) {
                var id = $(".UpdateDataId").html();

                console.log(id);
                $.ajax({
                    url: 'Functions.php',
                    type: 'POST',
                    data: { EventId: id, Function: "DeleteImage" },
                    success: function (response) {
                        console.log(response);
                        if (response == "OK") {
                            $("#EditResult").html(`<div class="alert alert-danger fade show" role="alert"> Image Deleted Successfully</div>`);
                            setTimeout(function () {
                                $("#EditResult").html('');
                                $('#EditEventModal').modal('hide');
                                location.reload();
                            }, 5000);
                        } else {
                            $("#EditResult").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                            setTimeout(function () {
                                $("#EditResult").html('');
                            }, 5000);

                        }

                    }
                });
            }






</script>









<?php
// print_r($ImageRows);
include("Includes/Footer.php") ?>