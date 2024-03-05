<?php

// if (!isset($_SESSION['user_id'])) {
//     // header("Location: ../index.php");
//     // exit();
// }
?>
<?php
$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
$query = "SELECT f_id, f_fname, f_lname,f_img,f_role FROM erp_faculty WHERE f_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Access the values from the row
        $f_id = $row['f_id'];
        $f_fname = $row['f_fname'];
        $f_lname = $row['f_lname'];
        $f_img = $row['f_img'];
        $f_role = $row['f_role'];
        // 
        $qry = "SELECT r_rolename FROM erp_role WHERE r_id = '$f_role'";
        $res = mysqli_query($conn, $qry);
        if ($res) {
            $r = mysqli_fetch_assoc($res);
            if ($r) {
                $frole = $r['r_rolename'];
            }
        }
        // 
    } else {
        // Handle the case where no matching user is found
        echo "User not found.";
    }
} else {
    // Handle the case where the query fails
    echo "Query failed: " . mysqli_error($conn);
}

$fileName = $f_img;
$imageFolderPath = "/$app_name/assets/img/profile/";
$profileimg = $imageFolderPath . '' . $fileName;
if (file_exists($profileimg)) {
    $profileimg = $imageFolderPath . '' . $fileName;
} else {
    $profileimg = $imageFolderPath . '' . 'nouser.png';
}
?>

<header>
    <div class="logo-box">
        <div class="gracer-logo">
            <img src="/<?php echo $app_name; ?>/assets/img/gracer.png" alt="grace" height="60px">
            <div class="gracer-title">
                <img src="/<?php echo $app_name; ?>/assets/img/gracer-text.png" alt="grace" height="40px">
                <p>Campus Management System of</p>
            </div>
        </div>
    </div>
    <div class="clg-logo">
        <img src="/<?php echo $app_name; ?>/assets/img/gcoe_logo.png" alt="grace" height="60px">
        <img src="/<?php echo $app_name; ?>/assets/img/grace.png" alt="grace" height="60px">
        <img src="/<?php echo $app_name; ?>/assets/img/coe.png" alt="grace" height="60px">
    </div>
    <div class="avatar-card">
        <div class="avatar">
            <img src="<?php echo $profileimg ?>" alt="avatar" height="60px">
        </div>
        <div class="welcome-card">
            <div class="welcome">
                <h5>Welcome!
                    <?php echo "$f_fname $f_lname"; ?> ,
                </h5>
                <h5 class='text-center'>
                    <?php echo "$frole" ?>
                </h5>
            </div>
            <div class="logout">
                <a href="/<?php echo $app_name; ?>/logout.php">
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>