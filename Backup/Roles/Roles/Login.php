<?php
include('../../includes/config.php');


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM erp_login WHERE log_id='$username' AND log_pwd='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user_id'] = $username;

        header("Location: ./grace home/home1.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username Or Password.');</script>";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./img/Images/Logo.png" type="image/x-icon">
    <title>Grace ERP | Login</title>

    <!-- CSS Style Sheet -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins&family=Tilt+Neon&display=swap");


        body {
            font-family: "Poppins", sans-serif;
            overflow-x: hidden;
            background: linear-gradient(to top, rgba(250, 247, 247, 0.384), rgba(243, 239, 239, 0.219)), url(./img/Images/Grace.png) no-repeat center center / 100% auto fixed;
        }

        ::selection {
            background-color: rgb(128, 0, 128);
            color: #fff;
        }

        ::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        main {
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        section {
            padding: 20px 0;
        }

        .erp_info {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        h3 {
            font-size: 24px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .erp_info_text ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .erp_info_text ul li {
            font-size: 16px;
            color: #666;
        }

        .erp_login {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        h5 {
            font-size: 18px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .erp_login_field {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .erp_login_field label {
            font-size: 16px;
            color: #666;
        }

        .erp_login_field input {
            font-family: "Tilt Neon", cursive;
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 5px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .erp_login_field button {
            background-color: #337ab7;
            color: #fff;
            font-size: 16px;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .erp_login_field button:hover {
            background-color: #2e6da4;
        }

        .erp_login_field span {
            font-size: 14px;
            color: #666;
        }

        .Register {
            font-size: 14px;
        }


        @media (max-width: 768px) {
            main {
                margin: 0;
            }

            section {
                padding: 0;
            }

            .erp_info {
                margin-bottom: 20px;
                padding: 10px;
            }

            h3 {
                font-size: 18px;
            }

            .erp_info_text ul {
                margin-bottom: 10px;
            }

            .erp_login {
                margin-bottom: 20px;
            }

            .erp_login h5 {
                text-decoration: underline;
            }

            h5 {
                font-size: 16px;
            }

            .erp_login_field {
                width: 15rem;
                margin-left: 18px;
            }

            .erp_login_field label {
                font-size: 14px;
            }

            .erp_login_field input {
                width: 100%;
                margin-bottom: 10px;
            }

            .erp_login_field button {
                padding: 15px;
                font-family: "Tilt Neon", cursive;
                font-weight: 600;
            }
        }

        @media (min-width: 768px) and (max-width: 992px) {
            main {
                max-width: 768px;
                margin: 0 auto;
            }
        }

        @media (min-width: 992px) and (max-width: 1200px) {
            main {
                max-width: 960px;
                margin: 0 auto;
            }
        }

        @media (min-width: 1200px) {
            main {
                max-width: 1140px;
                margin: 0 auto;
            }
        }
    </style>

</head>

<body>
    <main>
        <!-- Content Section  -->
        <section>
            <div class="content">


                <div class="erp_info">
                    <div>
                        <h3>WELCOME TO GRACE COLLEGE OF ENGINEERING ERP PORTAL</h3>
                        <div class="erp_info_text">
                            <ul>
                                <li>This is a cloud based portal, connecting Managements, Tutors, Students and Parents of educational institutes.</li><br>
                                <li>This portal empowers "GRACE COLLEGE OF ENGINEERING" with improved communication, increased productivity and knowledge enrichment.</li><br>
                                <li>This provides a safe and secure environment for gaining global exposure.</li>
                            </ul>
                        </div>
                    </div>

                    <br><br>

                    <div class="erp_login">
                        <h5 style='color: rgb(128,0,128);'>GRACE ERP Login :</h5>

                        <div class="erp_login_field">

                            <a class="Register" href="./Register.php">Not Registered ? click here</a>
                            <center>
                                <form action="" method="POST">

                                    <br>

                                    <label for="username">User Id :</label>
                                    <input type="text" id="username" name="username" required style="width: 10rem;" placeholder="Enter your user id">

                                    <br>
                                    <br>

                                    <label for="password">Password : </label>
                                    <input type="password" id="password" name="password" style="width: 9rem;" required placeholder="Enter your password">

                                    <br>
                                    <br>

                                    <button type="submit" style='font-family: "Tilt Neon", cursive; font-weight: 600;'>LOGIN</button>
                                    <br>
                                    <br>

                                    <div>
                                        <span style="display: block;">Forgot Password? <a href="./Tools/ForgetPassword.php">Click Here</a></span>
                                    </div>
                                </form>

                            </center>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main>



</body>

</html>