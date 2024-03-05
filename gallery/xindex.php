<?php

session_start();

if (isset($_SESSION['user_id'])) {

    include('../includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Gallery</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .gallery {
        display: grid;
        grid-template-rows: repeat(auto-fill, minmax(200px, 1fr));
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        grid-gap: 20px;
    }

    .gallery img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        cursor: pointer;
    }

    .gallery img:hover {
        opacity: 0.8;
    }

    .folder-img {
        height: 100px;
    }

    a {
        color: var(--pri);
        text-decoration: none;
    }

    a:hover,
    a:active {
        color: var(--dark);
        text-decoration: underline;
    }
    </style>
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
    <script src='assets/js/script.js'></script>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>
<?php
} else {
    header("Location: ../index.php");
}
?>