<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Jquery-3 -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Module</title>

</head>
<style>
    a:hover {
        cursor: pointer;
    }

    .module {
        display: none;
        /* opacity: 0; */
    }

    ul {
        list-style-type: none;
    }


    h1 {
        text-align: center;
        margin-bottom: 1.5%;
    }
</style>

<body>
    <div class="Ad-container">

        <div class="navBarAdminModule">
            <ul>
                <li><a class="navAnchorTag">Academics</a></li>
                <li><a class="navAnchorTag">Dashboard</a></li>
                <li><a class="navAnchorTag">Fee</a></li>
                <li><a class="navAnchorTag">Gallery</a></li>
                <li><a class="navAnchorTag">Roles & Categories</a></li>
                <li><a class="navAnchorTag">Transport Management</a></li>
            </ul>
        </div>
        <div class="modulesContainer">
            <!-- John's module -->
            <div class="module">
                <div class="Ad-head">
                    <h2 >Academics</h2>
                </div>
                <div class="Ad-display">
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Manage Time Table</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Timetable/createtype.php';">Create New Time Table
                                        Type</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Timetable/managetypes.php';">Manage Time Table
                                        Type</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Timetable/createTT.php';">Create Time Table</button>
                                </td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Timetable/manageTT.php';">Manage Time Table</button>
                                </td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Timetable/viewTT.php';">View student Time Table</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Timetable/facultyview.php';">View faculty Time Table</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Manage Exam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Exam/Create.php';">Create
                                        Test</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Exam/Createexam.php';">Create
                                        Exam</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Exam/Manage_exam.php';">Manage
                                        Exam</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Exam/Create_other_exam.php';">Create Other
                                        Exam</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './subject/Create_subject.php';">Create Subject</button>
                                </td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './subject/subject.php';">Manage
                                        Subject</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Class</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './class/createclass.php';">Create New Class</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './class/manageClass.php';">Manage Class</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Thomas's module - Dashboard management -->
            <div class='module'>
                <div class="Ad-head">
                    <h2>Dashboard</h2>
                </div>
                <div class="Ad-display">
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Quotes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/quotes_create.php';">Create Quotes</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/quotes_manage.php';">Manage Quotes</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>
                                    Notices</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/notices_insert.php';">Create Notices</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/notices_manage.php';">Manage Notices</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/saved_notices.php';">Manage Saved Notices</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Calender Events</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/calender_create.php';">Create Event</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/calender_manage.php';">Manage Events</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Best performer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/best_performer_create.php';">Create Best Performer</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Events/best_performer_manage.php';">Manage Best Performer</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Rishu's module - Fee structure management -->
            <div class='module'>
                <div class="Ad-head">
                    <h2>Fee</h2>
                </div>
                <div class="Ad-display">
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Fee Structure</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Fees/home.php';">Fee Menu</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Fees/add/add_fee.php';">Add Fee</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Gowtham's module - Gallery management -->
            <div class="module">
                <div class="Ad-head">
                    <h2>Gallery</h2>
                </div>
                <div class="Ad-display">
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Gallery Moderation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Gallery/Images_Events.php';">Manage Events</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Gallery/UploadImages.php';">Upload Images</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Gallery/Images_All.php';">Manage Images</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Srdihar's module - Gallery management -->
            <div class="module">
                <div class="Ad-head">
                    <h2>Roles & Categories</h2>
                </div>
                <div class="Ad-display">
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Roles Management</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Roles/CreateRoles.php';">Create Roles</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Roles/SearchRoles.php';">Search Roles</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Category Management</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Roles/CreateCategory.php';">Create Category</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './Roles/SearchCategory.php';">Search Category</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Transport module - Thomas's -->
            <div class="module">
                <div class="Ad-head">
                    <h2>Transport Management</h2>
                </div>
                <div class="Ad-display">
                    <table class="Ad-display-table">
                        <thead>
                            <tr>
                                <th>Manage Transport</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './events/transports_manage.php';">Manage Transport Records</button></td>
                            </tr>
                            <tr>
                                <td><button class="Ad-button" onclick="window.location.href = './events/transports.php';">Create Transport Record</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function(d) {
        var allNavAnchorTags = $(".navAnchorTag").click(function(s) {
            var clickedModuleFromNavBar = $(this);
            var clickedAnchorTag = $.trim($(this).html());
            console.log(clickedAnchorTag);
            $('.module').each(function(i, e) {
                // Hiding previously selected module
                $(this).css('display', 'none');
                var moduleName = $.trim($(this).children().eq(0).children().html());
                if (clickedAnchorTag == moduleName) { // Checking condition for matching navbar and module
                    $(this).css('display', 'initial'); // Showing the selected module
                    clickedModuleFromNavBar.addClass('active');
                    $(allNavAnchorTags).not(clickedModuleFromNavBar).removeClass('active');
                }
            });
        })
        $(".navAnchorTag").eq(0).click();
    })
</script>