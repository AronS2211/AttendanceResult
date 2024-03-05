<div class="container pt-3">
    <div class="gallery-box m-3">
        <div class="d-flex flex-row justify-content-between px-3 pt-3">
            <h2 class="w-50 m-0">Gallery</h2>
            <div class="d-flex flex-row align-items-center">
                <h5>Year: </h5>&ensp;
                <select class="form-select" onchange="showAlbum(this)">
                    <?php
                    $first_year = 0;
                    $sql = "SELECT DISTINCT YEAR(g_timestamp) as albumyear FROM `erp_gallery` order by `albumyear` desc";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($first_year == 0) {
                                $first_year = $row["albumyear"];
                            }
                            ?>
                            <option>
                                <?php echo $row['albumyear']; ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-wrap m-3" id='album'>
            <?php
            $sql = "SELECT * FROM `erp_gallery` left join erp_img on erp_gallery.g_id=erp_img.g_id where YEAR(g_timestamp)=$first_year group by erp_gallery.g_title";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["g_id"];
                    $title = $row["g_title"];
                    $thumbnail = $row["img_img"];
                    ?>
                    <a href="images.php?gid=<?php echo $id; ?>">
                        <div class="d-flex flex-column align-items-center flex-wrap">
                            <!-- E:\xampp\htdocs\ERPGRACE\AdminModule\gallery\img -->
                            <img class="folder-img m-2" src="../AdminModule/gallery/<?php echo $thumbnail; ?>" alt="folder">
                            <p>
                                <?php echo $title; ?>
                            </p>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<p class='p-1'>No Album Found</p>";
            }
            ?>
        </div>
    </div>
</div>