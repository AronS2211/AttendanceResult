<!--  -->
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
<!--  -->
<div class="panel-container pt-3">
    <div class="panel">
        <div class="panel-header shade1">
            <p>News</p>
            <i class='bx bxs-news'></i>
        </div>
        <div class="scrolling-container panel-body">
            <div class="scrolling-content" id="scrollingContent">
                <marquee scrollamount="2" direction="up" loop="true" onmousedown="this.stop()" onmouseover="this.stop()"
                    onmousemove="this.stop()" onmouseout="this.start()">
                    <?php
                    if (is_array($fetchNews)) {
                        foreach ($fetchNews as $data) {
                            ?>
                            <div class="py-3 d-flex flex-row">
                                <p class='fw-bold text-nowrap mx-2'>
                                    <?php echo $data['news_title'] ?? ''; ?>
                                </p>
                                <p>
                                    <?php echo $data['news_desc'] ?? ''; ?>
                                </p>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <p class='py-3'>
                            <?php echo $fetchNews; ?>
                        </p>
                        <?php
                    }
                    ?>
                </marquee>
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-header shade2">
            <p>Thought of the day</p>
            <i class='bx bx-brain'></i>
        </div>
        <div class="scrolling-container panel-body">
            <div class="scrolling-content" id="scrollingContent">
                <marquee scrollamount="2" direction="up" loop="true" onmousedown="this.stop()" onmouseover="this.stop()"
                    onmousemove="this.stop()" onmouseout="this.start()">

                    <?php
                    if (is_array($fetchTFD)) {
                        foreach ($fetchTFD as $data) {
                            ?>
                            <div class="py-3 d-flex flex-row">
                                <p class='fw-bold text-nowrap mx-2'>
                                    <?php echo $data['news_title'] ?? ''; ?>
                                </p>
                                <p>
                                    <?php echo $data['news_desc'] ?? ''; ?>
                                </p>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <p class='py-3'>
                            <?php echo $fetchTFD; ?>
                        </p>
                        <?php
                    }
                    ?>
            </div>
            </marquee>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-header shade3">
        <p>Notice Board</p>
        <i class='bx bx-chalkboard'></i>
    </div>
    <div class="scrolling-container panel-body">
        <div class="scrolling-content" id="scrollingContent">
            <marquee scrollamount="2" direction="up" loop="true" onmousedown="this.stop()" onmouseover="this.stop()"
                onmousemove="this.stop()" onmouseout="this.start()">
                <?php
                if (is_array($fetchNoticeBoard)) {
                    foreach ($fetchNoticeBoard as $data) {
                        ?>
                        <div class="py-3 d-flex flex-row">
                            <p class='fw-bold text-nowrap mx-2'>
                                <?php echo $data['news_title'] ?? ''; ?>
                            </p>
                            <p>
                                <?php echo $data['news_desc'] ?? ''; ?>
                            </p>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p class='py-3'>
                        <?php echo $fetchNoticeBoard; ?>
                    </p>
                    <?php
                }
                ?>
            </marquee>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-header shade4">
        <p>Best Performer</p>
        <i class='bx bx-medal'></i>
    </div>
    <div class="scrolling-container panel-body">
        <div class="scrolling-content" id="scrollingContent">
            <marquee scrollamount="2" direction="up" loop="true" onmousedown="this.stop()" onmouseover="this.stop()"
                onmousemove="this.stop()" onmouseout="this.start()">

                <?php
                if (is_array($fetchBestperformer)) {
                    foreach ($fetchBestperformer as $data) {
                        ?>
                        <div class="py-3 d-flex flex-row">
                            <p class='fw-bold text-nowrap mx-2'>
                                <?php echo $data['news_title'] ?? ''; ?>
                            </p>
                            <p>
                                <?php echo $data['news_desc'] ?? ''; ?>
                            </p>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p class='py-3'>
                        <?php echo $fetchBestperformer; ?>
                    </p>
                    <?php
                }
                ?>
            </marquee>
        </div>
    </div>
</div>
</div>