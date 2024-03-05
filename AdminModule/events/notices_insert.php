<?php
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

if (isset($_SESSION['user_id'])) {
  // // Get the JSON data from the POST request
  $user_id = $_SESSION['user_id'];

?>

<div class="main-card">
          <div class="card text-bg-light mx-3 my-3">
            <div class="report-head p-2 d-flex justify-content-between align-items-center">
              <h3 class="m-0">Create Notices</h3>
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

  <h2 class="text-center font-georgia">Insert a notice</h2>

  <div class="container">
    <div class="row justify-content-center">
      <form id="insert-form-notice" class="form-group col-md-8" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group row">
          <label for="news_title" class="col-sm-2 col-form-label">Notice Title:</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" id="news_type" name="news_title" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="news_desc" class="col-sm-2 col-form-label">Notice Description:</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" id="news_desc" name="news_desc" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-sm-2">
            <input class="btn btn-primary" type="submit" name="save" value="Save">
            <input class="btn btn-primary ml-4" type="submit" name="insert" value="Insert">
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
  if (isset($_POST["insert"])) {
    // Retrieve data from the form
    $notice_title = $_POST['news_title'];
    $notice_desc = $_POST['news_desc'];
    $posted_by = $user_id;
    $status = 1;


    // Create the SQL query
    $sql = "INSERT INTO erp_news (news_title, news_desc, news_postby, news_status,news_type) VALUES ('$notice_title', '$notice_desc', '$posted_by','$status','circular')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
      echo '<script>window.location.href = "notices_manage.php"</script>';
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // Close connection

  }
  // if(isset($_POST["s_submit"])){
  //   $id = $_POST['s_id'];
  //   $del = mysqli_query($conn, "DELETE FROM notices_saved WHERE id = '" . $id . "'" ); // delete query
  //   echo "This is" . $id . "value";
  // } 
  if (isset($_POST["save"])) {
    $notice_title = $_POST['news_title'];
    $notice_subject = $_POST['news_desc'];
    $status = 0;

    // Create the SQL query
    $sql = "INSERT INTO erp_news (news_title, news_desc, news_status, news_type)
        VALUES ('$notice_title','$notice_subject','$status','circular')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
      echo '<script>window.location.href = "saved_notices.php"</script>';
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // Close connection
  }
  if (isset($_POST["s_submit"])) {
    $news_id = $_POST['s_id'];
    $notice_title = $_POST['s_notice_type'];
    $notice_subject = $_POST['s_notice_subject'];

    // Create the SQL query
    //  SQL query to update the news_status value
    $sql = "UPDATE erp_news SET news_status = 1 WHERE news_id = $news_id";
    if (mysqli_query($conn, $sql)) {
      echo "New record deleted successfully";
      echo '<script>window.location.href = "notices_manage.php"</script>';
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
  }
  // Execute the query
  ?> </div>

  </body>
  <script type="text/javascript">
    $(".remove").click(function() {
      var id = $(this).parents("tr").attr("id");


      if (confirm('Are you sure to remove this record ?')) {
        $.ajax({
          url: '/delete_for_notices.php',
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
        window.location.href = "delete_for_notices.php?id=" + id + "&db=notices";
      }
    });
  </script>

  <?php include("includes/Footer.php"); ?>

<?php
} else {
  header("Location: ../../index.php");
}
?>