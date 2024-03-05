<?php

session_start();

if (isset($_SESSION['user_id'])) {
    include('../includes/config.php');
}
$id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    $sql = "SELECT * FROM erp_login where log_id='$id' and log_pwd='$oldPassword'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($newPassword != $confirmPassword) {
            header("Location: " . "index.php?sts=0");
        } else {
            $qry = "update `erp_login` set log_pwd='$newPassword' where log_id='$id'";
            if (mysqli_query($con, $qry)) {
                header("Location: " . "index.php?sts=1");
            } else {
                header("Location: " . "index.php?sts=-1");
            }
        }
    } else {
        header("Location: " . "index.php?sts=2");
    }
}
?>
<style>
    html {
        overflow: scroll;
        overflow-x: hidden;
    }

    ::-webkit-scrollbar {
        width: 0;
        background: transparent;
    }
</style>