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
        #dashboard {
            background-color: var(--pri);
        }

        .Dpanel {
            font-family: EL !important;
            font-size: 0.7rem;
        }

        .Dpanel-heading {
            font-family: EM !important;
            font-size: 1.2rem;
            color: var(--pri);
            border-bottom: 3px solid var(--dark);
            width: fit-content;
            margin-bottom: 5px;
        }

        .table-scroll {
            height: 12rem;
            width: 31rem;
            overflow: scroll;
        }

        .table-scroll-sm {
            height: 6rem;
            width: 31rem;
            overflow: scroll;
        }

        ::-webkit-scrollbar {
            width: 0.3rem;
            height: 0.3rem;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: var(--dark);
            border-radius: 0.3rem;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: var(--pri);
        }

        td,
        tr,
        select,
        label,
        option,
        th,
        td a {
            font-family: EL !important;
        }

        thead tr th {
            font-family: EM !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="asset/css/dashboard.css"> -->
</head>

<body>
    <?php include('../includes/config.php'); ?>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../includes/sidebar.php'); ?>
        <main>
            <?php include('dashboard1.php'); ?>
        </main>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
<script src="../assets/js/script.js"></script>
<!--  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">

    </script>
<!--  -->

</html>