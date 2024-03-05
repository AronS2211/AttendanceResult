<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">
    <style>
    #chg_pwd {
        background-color: var(--pri);
    }

    form {
        padding: 25px;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        width: max-content;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    label {
        margin-bottom: 8px;
        font-family: EL;
    }

    input {
        padding: 8px;
        margin-bottom: 16px !important;
        border: 2px solid var(--dark);
        border-radius: 5px;
        ;
    }

    .alert h5 {
        margin: 0px;
        font-family: EL;
    }

    form button {
        padding: 10px;
        background-color: var(--dark);
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: fit-content;
        border-radius: 5px !important;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        align-self: end;
    }

    form button:hover {
        background-color: var(--pri);
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include('../includes/config.php'); ?>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../includes/sidebar.php'); ?>
        <main>
            <?php include('change_password.php'); ?>
        </main>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

</html>