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
        <title>Reports</title>
        <link rel="stylesheet" href="./assets/css/style_TT.css">
    </head>

    <body>

        <div class="Ad-container">
            <div class="Ad-head">
                <h1>Reports</h1>
            </div>
            <div class="Ad-display">
                <table class="Ad-display-table">
                    <thead>
                        <tr>
                            <th>Attendance Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><button class="Ad-button"
                                    onclick="window.location.href = './AttendanceReport.php';">Attendance Report</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="Ad-display-table">
                    <thead>
                        <tr>
                            <th>Result Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><button class="Ad-button"
                                    onclick="window.location.href = './Resultpostedstatusreport.php';">Result Posted Status
                                    Report</button></td>
                        </tr>
                        <tr>
                            <td><button class="Ad-button" onclick="window.location.href = './ClassReport.php';">Class
                                    Report</button></td>
                        </tr>
                        <tr>
                            <td><button class="Ad-button"
                                    onclick="window.location.href = './IndividualResultReportG.php';">Individual Result
                                    Report</button></td>
                        </tr>
                    </tbody>
                </table>
                <table class="Ad-display-table">
                    <thead>
                        <tr>
                            <th>Overall Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><button class="Ad-button" onclick="window.location.href = './anydataReport.php';">Any Data
                                    Report</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    <?php
} else {
    header("Location: ../index.php");
}
?>