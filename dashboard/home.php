<?php

// session_start();

if (isset($_SESSION['user_id'])) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./asset/css/style.css">
    <title>HOME</title>
</head>

<body style="padding-top: 250px;">
    <style>
    html {
        overflow: scroll;
        overflow-x: hidden;
    }

    ::-webkit-scrollbar {
        width: 0;
        background: transparent;
    }

    .col-sm-12 {
        width: 49%;
        margin-left: -10px;
    }

    .panel {
        width: 644px;
        margin-left: 30px;
        height: 282px;
        margin: auto;
    }

    .panel-heading {
        background-color: #FE698B;
        color: #fff;
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
    }

    .panel-info {
        border-color: #FE698B;
    }

    .panel-danger {
        border-color: #FE698B;
    }

    .panel-info {
        border-color: #16B7B7;
    }

    .panel-warning {
        border-color: #FFC300;
        margin-right: 10px;
    }

    .cols-notice {
        margin-right: 10px;
        height: 190px;
    }

    .heading-thought {
        background-color: #FE698B;
        color: #fff;
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        margin: 0;
    }

    .heading-notice {
        background-color: #16B7B7;
        color: #fff;
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        margin: 0;
    }

    .heading-performer {
        background-color: #FFC300;
        color: #fff;
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        margin: 0;
    }

    body {
        padding-top: 50px;
        margin: 0;
    }

    .col-sm-9 {
        display: flex;
        flex-wrap: wrap;
        height: 100vh;
        padding: 0;
    }

    .panel {
        width: 50vw;
        height: 47vh;
        margin: 0;
        box-sizing: border-box;
    }

    .panel-body {
        padding: 5px;
    }

    .linkbtn {
        font-size: 12px;
        margin-bottom: 5px;
    }
    </style>
    <?php // include("../includes/Navbar.php"); 
    ?>
    <?php

    // To fetch News
    function fetch_news($conn)
    {
      $tableName = "erp_n_news";
      $columns = ['news_id', 'news_title', 'news_desc'];
      if (empty($conn)) {
        $msg = "Database connection error";
      } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
      } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
      } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT $columnName FROM $tableName";
        $result = $conn->query($query);

        if ($result == true) {
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $msg = $row;
          } else {
            $msg = "No Data Found";
          }
        } else {
          $msg = mysqli_error($conn);
        }
      }
      return $msg;
    }


    // To fetch Thought for the Day
    function fetch_TOD($conn)
    {
      $tableName = "erp_n_thought";
      $columns = ['news_id', 'news_title', 'news_desc'];
      if (empty($conn)) {
        $msg = "Database connection error";
      } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
      } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
      } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT $columnName FROM $tableName";
        $result = $conn->query($query);

        if ($result == true) {
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $msg = $row;
          } else {
            $msg = "No Data Found";
          }
        } else {
          $msg = mysqli_error($conn);
        }
      }
      return $msg;
    }



    // To fetch best performer
    function fetch_Bestperformer($conn)
    {
      $tableName = "erp_n_performer";
      $columns = ['news_id', 'news_title', 'news_desc'];
      if (empty($conn)) {
        $msg = "Database connection error";
      } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
      } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
      } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT $columnName FROM $tableName";
        $result = $conn->query($query);
        if ($result == true) {
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $msg = $row;
          } else {
            $msg = "No Data Found";
          }
        } else {
          $msg = mysqli_error($conn);
        }
      }
      return $msg;
    }

    // To fetch Notice Board
    function fetch_NoticeBoard($conn)
    {
      $tableName = "erp_n_circular";
      $columns = ['news_id', 'news_title', 'news_desc'];
      if (empty($conn)) {
        $msg = "Database connection error";
      } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
      } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
      } else {

        $columnName = implode(", ", $columns);
        $query = "SELECT $columnName FROM $tableName";
        $result = $conn->query($query);

        if ($result == true) {
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $msg = $row;
          } else {
            $msg = "No Data Found";
          }
        } else {
          $msg = mysqli_error($conn);
        }
      }
      return $msg;
    }

    $fetchNews = fetch_news($conn);
    $fetchTFD = fetch_TOD($conn);
    $fetchBestperformer = fetch_Bestperformer($conn);
    $fetchNoticeBoard = fetch_NoticeBoard($conn);

    ?>
    <section class="home-section col-sm-9" style="margin-top:-230px;">
        <div class="panel panel-primary">
            <div class="panel-heading">News</div>
            <div class="panel-body">

                <marquee scrollamount="2" direction="up" loop="true" height="100" onmousedown="this.stop()"
                    onmouseover="this.stop()" onmousemove="this.stop()" onmouseout="this.start()">


                    <center>

                        <?php
              if (is_array($fetchNews)) {
                $sn = 1;
                foreach ($fetchNews as $data) {
              ?>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-primary linkbtn" data-bs-toggle="modal"
                            data-bs-target="#mynModal<?php echo $sn; ?>">
                            <?php echo $data['news_title'] ?? ''; ?>
                        </button>
                        <?php
                  $sn++;
                }
              } else { ?>
                        <tr>
                            <td colspan="8">
                                <?php echo $fetchNews;
                } ?>


                    </center>

                </marquee>
                <!--  -->
                <?php
          if (is_array($fetchNews)) {
            $sn = 1;
            foreach ($fetchNews as $data) {
          ?>

                <?php
              $sn++;
            }
          } else { ?>
                <tr>
                    <td colspan="8">
                        <?php echo $fetchNews;
            } ?>
            </div>
        </div>
        <!-- Thought for the Day -->
        <div class="col-sm-6">
            <div class="panel panel-danger">
                <div class="heading-thought">Thought for the Day</div>
                <div class="panel-body">
                    <marquee scrollamount="2" direction="up" loop="true" height="120" onmousedown="this.stop()"
                        onmouseover="this.stop()" onmousemove="this.stop()" onmouseout="this.start()">

                        <div>
                            <table cellspacing="0" title="Thought for the day"
                                style="border-width:0px;width:100%;border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <td><br>
                                            <table width="100%" height="100%" style="vertical-align:middle;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <center>

                                                                <?php
                                  if (is_array($fetchTFD)) {
                                    $sn = 1;
                                    foreach ($fetchTFD as $data) {
                                  ?>
                                                    <tr>
                                                        <td><?php echo $sn; ?></td>
                                                        <td><?php echo $data['news_title'] ?? ''; ?></td>
                                                        <td><?php echo $data['news_desc'] ?? ''; ?></td>
                                                    </tr>
                                                    <?php
                                      $sn++;
                                    }
                                  } else { ?>
                                                    <tr>
                                                        <td colspan="8">
                                                            <?php echo $fetchTFD;
                                  } ?>


                                                            </center>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </marquee>
                </div>
            </div>
        </div>
        <!-- Notice Board -->
        <div class="cols-notice">
            <div class="panel panel-info">
                <div class="heading-notice">Notice Board</div>
                <div class="panel-body">

                    <marquee scrollamount="2" direction="up" loop="true" height="120" onmousedown="this.stop()"
                        onmouseover="this.stop()" onmousemove="this.stop()" onmouseout="this.start()">

                        <div>
                            <table cellspacing="0" title="Notice Board"
                                style="border-width:0px;width:100%;border-collapse:collapse;">
                                <tbody>
                                    <tr>
                                        <td><br>
                                            <table width="100%" height="100%" style="vertical-align:middle;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <center>

                                                                <?php
                                  if (is_array($fetchNoticeBoard)) {
                                    $sn = 1;
                                    foreach ($fetchNoticeBoard as $data) {
                                  ?>
                                                    <tr>
                                                        <td><?php echo $sn; ?></td>
                                                        <td><?php echo $data['news_title'] ?? ''; ?></td>
                                                        <td><?php echo $data['news_desc'] ?? ''; ?></td>
                                                    </tr>
                                                    <?php
                                      $sn++;
                                    }
                                  } else { ?>
                                                    <tr>
                                                        <td colspan="8">
                                                            <?php echo $fetchNoticeBoard;
                                  } ?>


                                                            </center>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </marquee>
                </div>
            </div>
        </div>
        <!-- Best Performer -->
        <div class="col-sm-12">
            <div class="panel panel-warning">
                <div class="heading-performer">Best Performer</div>
                <div class="panel-body" style="padding: 5px;">

                    <marquee scrollamount="2" direction="up" loop="true" width="100%" height="150"
                        onmousedown="this.stop()" onmouseover="this.stop()" onmousemove="this.stop()"
                        onmouseout="this.start()">
                        <?php
              if (is_array($fetchBestperformer)) {
                foreach ($fetchBestperformer as $data) {
              ?>
                        <span>
                            <p style="display: inline;"><?php echo $data['news_title'] ?? ''; ?></p>
                            <p style="display: inline;"><?php echo $data['news_desc'] ?? ''; ?></p>
                        </span>
                        <?php
                }
              } else { ?>
                        <span>
                            <p style="display: inline;"><?php echo $fetchBestperformer; ?></p>
                        </span>
                        <?php } ?>
                    </marquee>

                </div>
            </div>
        </div>

    </section>

</body>

</html>

<?php
} else {
  header("Location: ../index.php");
}
?>