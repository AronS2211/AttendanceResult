<?php

include('includes/config.php');

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM erp_login WHERE log_id='$username' AND log_pwd='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user_id'] = $username;

        header("Location: home/index.php");
        exit();
    } else {
        $sql = "SELECT * FROM `erp_login` left join erp_student on erp_login.log_id=erp_student.stu_id WHERE stu_regno='$username' AND log_pwd='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['user_id'] = $username;

            header("Location: home/index.php");
            exit();
        } else {
            echo "<script>alert('Invalid Username Or Password.');</script>";
        }
    }
}

mysqli_close($conn);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GracER | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    ul {
        list-style: none;
    }

    h4 {
        color: #470a52;
    }

    li,
    label {
        color: #8d1662;
    }

    body {
        background: linear-gradient(#fdfdfd00, #fdfdfd), url(assets/img/clg_wide_drone.JPG) center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 700px;
        overflow: hidden;
    }

    .login-box {
        bottom: 60px;
        right: 40px;
    }
    </style>
    <!-- css for loader -->
    <style>
    .loader {
        border: 8px solid rgba(0, 0, 0, 0.2);
        border-radius: 50%;
        border-top: 8px solid #000;
        width: 10px;
        height: 10px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        display: none;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="d-flex flex-column m-2 jerald_abishek">
        <div class="d-flex align-items-center justify-content-center">
            <?php if (isset($_SESSION['mailsts'])) {
                if ($_SESSION['mailsts']) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success !</strong>
                <?php echo $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } else {
                    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed !</strong>
                <?php echo $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
                unset($_SESSION['mailsts']);
                unset($_SESSION['msg']);
            } ?>
        </div>

        <div class="d-flex flex-row justify-content-around">
            <div class="d-flex w-50 shadow m-2 p-2 rounded-2 bg-light position-absolute login-box">
                <form method='post' action="ResetPassword/ResetPassword.php" class='w-100'>
                    <h4 class='mb-3'>GracER | Forgot Password</h4>
                    <hr>
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row mb-3">
                            <label class="form-label w-50">User ID :</label>
                            <input type="text" id="username" name="username" class="form-control form-control-sm"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <label class="form-label w-50">New Password :</label>
                            <input type="password" id="password" name="password" class="form-control form-control-sm">
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <label class="form-label w-50">Confirm Password :</label>
                            <input type="password" id="confirmPassword" name="confirmPassword"
                                class="form-control form-control-sm">
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <label class="form-label w-50">Verification Code :</label>
                            <input type="password" id="verification" name="verification"
                                class="form-control form-control-sm">
                        </div>
                        <div class="d-flex flex-row justify-content-end mb-3">
                            <input type="submit" class="btn btn-sm btn-primary" value='Reset
                                Password'>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>