<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">
    <style>
        #gallery {
            background-color: var(--pri);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
    <script src='https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js'></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include('../includes/config.php'); ?>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../includes/sidebar.php'); ?>
        <main>
            <!--  -->
            <?php
            $id = $_GET['gid'];
            $gallery = "No Image Found";
            $sql = "SELECT * FROM `erp_img` LEFT JOIN `erp_gallery` ON erp_img.img_id=erp_gallery.g_id  WHERE erp_gallery.g_id=$id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $gallery = $row['g_title'];
                }
            }
            ?>
            <div class="container pt-3">
                <div class="gallery-box m-3">
                    <div class="d-flex justify-content-between px-3 pt-3 img-head">
                        <h2>Images -
                            <?php echo $gallery; ?>
                        </h2>
                        <a href="index.php">
                            Back
                        </a>
                    </div>
                    <hr>
                    <div class="d-flex  m-3 flex-wrap">
                        <?php
                        $id = $_GET['gid'];
                        $sql = "SELECT * FROM `erp_img` LEFT JOIN `erp_gallery` ON erp_img.img_id=erp_gallery.g_id  WHERE erp_img.g_id='$id'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row["img_id"];
                                $img = $row["img_img"];
                                $desc = $row["img_desc"];
                                ?>
                                <div class="d-flex flex-column align-items-center flex-wrap g-img">
                                    <a href="../AdminModule/gallery/<?php echo $img; ?>" data-fancybox="gallery">
                                        <img class="folder-img m-2" src="../AdminModule/gallery/<?php echo $img; ?>" />
                                        <p>
                                            <?php echo $desc; ?>
                                        </p>
                                    </a>
                                </div>
                                <!-- <a id="img<?php echo $id; ?>" class="img" href="../AdminModule/gallery/<?php echo $img; ?>"><img
                                src="../AdminModule/gallery/<?php echo $img; ?>" alt="" /></a>
                        <a id="inline" class="desc" href="#data<?php echo $id; ?>">
                            <?php echo $desc; ?>
                        </a>
                        <div style="display:none">
                            <div id="data<?php echo $id; ?>">
                                <?php echo $desc; ?>
                            </div>
                        </div> -->
                                <?php
                            }
                        } else {
                            ?>
                            <div class="d-flex flex-column align-items-center flex-wrap">
                                <img class='folder-img' src="assets/img/folder.png" alt="folder">
                                <p>
                                    <?php echo "No Image Found"; ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
<script src="../assets/js/script.js"></script>
<script src="assets/js/script.js"></script>
<!--  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
<!--  -->

</html>
<script>
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });
</script>
<?php
// } else {
//     header("Location: ../index.php");
// }
?>