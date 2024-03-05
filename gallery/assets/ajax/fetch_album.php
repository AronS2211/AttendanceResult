<?php
include('../../../includes/config.php');
$q = intval($_GET['q']);
$sql = "SELECT * FROM `erp_gallery` left join erp_img on erp_gallery.g_id=erp_img.g_id where YEAR(g_timestamp)=$q group by erp_gallery.g_title";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["g_id"];
        $title = $row["g_title"];
        $thumbnail = $row["img_img"];
        echo '<a href="images.php?gid=' . $id . '">
            <div class="d-flex flex-column align-items-center flex-wrap">
                <img class="folder-img m-2" src="../AdminModule/gallery/' . $thumbnail . '" alt="folder">
                <p>
                    ' . $title . '
                </p>
            </div>
        </a>';
    }
} else {
    echo "No Album Found";
}
?>