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
        #calendar {
            background-color: var(--pri);
        }

        .container {
            margin: 0px !important;
            background-color: #fff;
            padding: 0px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        table td {
            height: 40px;
            width: 80px;
            padding: 10px 5px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #470a52;
            color: #fff;
            text-align: center;
        }

        .d-flex {
            display: flex;
        }

        .flex-column {
            flex-direction: column;
        }

        .flex-row {
            flex-direction: row;
        }

        .flex-row p {
            margin: 0px;
        }

        .container {
            margin: 10px;
        }

        .events button {
            color: green !important;
        }

        .leave button {
            color: red !important;
        }

        .today {
            color: white !important;
            background-color: var(--pri) !important;
        }

        .today button {
            color: white !important;
            background-color: var(--pri) !important;
        }

        .fs-day {
            font-size: 30px;
        }

        .fs-day button {
            background-color: transparent;
            border: none;
            color: var(--pri);
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        h2 {
            margin: 5px;
        }

        .model-link {
            background-color: white;
            border: none;
            color: #8d1662;
            font-size: 13px;
            font-family: EL;
        }

        .cal-event {
            display: flex;
            justify-content: center;
        }

        .cal-event img {
            max-width: 500px;
            max-height: 500px;
        }

        .calendar-head a {
            color: var(--pri);
        }

        .calendar-head a:hover,
        .calendar-head a:active {
            color: var(--dark);
        }
    </style>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include('../includes/config.php'); ?>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../includes/sidebar.php'); ?>
        <main>
            <?php include('calendar.php'); ?>
        </main>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</html>