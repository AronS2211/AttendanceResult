<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./img/Images/Logo.png" type="image/x-icon">
    <title>Grace ERP | Registration</title>

    <!-- AJAX CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
            flex: 1;
            text-align: left;
        }

        .erp_login_field input {
            font-family: "Tilt Neon", cursive;
            flex: 2;
            width: 10rem;
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

        form {
            padding: 0rem 4rem;
        }


        form button {
            font-family: "Tilt Neon", cursive, sans-serif;
            font-weight: 600;
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

    <!-- Css for loader -->
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
                        <h5 style='color: rgb(128,0,128);'>GRACE ERP Registration :</h5>

                        <div class="erp_login_field">

                            <a class="Register" href="./Login.php">Registered ? click to login</a>

                            <!-- Form for registration -->
                            <form action="" id="registrationForm">
                                <br>

                                <div class="form-container">
                                    <label for="username" class="label">User Id :</label>
                                    <input type="text" id="username" name="username" required class="input" placeholder="Enter your user id">
                                </div>

                                <br>

                                <div class="form-container">
                                    <label for="password" class="label">Password :</label>
                                    <input type="password" id="password" name="password" required class="input" pattern=".{8,}" title="Password must be at least 8 characters long" placeholder="Enter your password">
                                </div>

                                <br>

                                <div class="form-container">
                                    <label for="confirmPassword" class="label">Confirm Password :</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" required class="input" placeholder="Confirm password">
                                </div>

                                <br>

                                <div class="form-container">
                                    <label for="verify" class="label">Verification code :</label>
                                    <input type="text" id="verification" name="verification" class="input" placeholder="Enter verification code">
                                </div>

                                <br>

                                <button type="button" id="generateButton" name="VerificationCode">Generate Code</button>
                                <button type="button" id="signupButton">SIGN UP</button><br><br>
                                <div class="loader"></div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- AJAX script -->
    <script>
        $(document).ready(function() {

            // For sending verification code
            $('#generateButton').click(function(event) {
                event.preventDefault();

                // Show loading animation
                $('.loader').show();

                $.ajax({
                    url: 'Tools/VerificationCodeSender.php',
                    type: 'POST',
                    data: {
                        VerificationCode: true,
                        username: $('#username').val(),
                        password: $('#password').val(),
                        confirmPassword: $('#confirmPassword').val()
                    },
                    success: function(response) {
                        // Handle response from PHP script
                        alert(response);

                        // Hide the loading animation
                        $('#generateButtonSpinner').addClass('d-none');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.log(error);
                    },
                    complete: function() {
                        // Hide loading animation
                        $('.loader').hide();
                    }
                });
            });

            //For SignUp
            $('#signupButton').click(function(event) {
                event.preventDefault();

                // Show loading animation
                $('.loader').show();

                $.ajax({
                    url: 'Tools/SignUp.php',
                    type: 'POST',
                    data: {
                        VerificationCode: true,
                        username: $('#username').val(),
                        password: $('#password').val(),
                        confirmPassword: $('#confirmPassword').val(),
                        verification: $('#verification').val()
                    },
                    success: function(response) {
                        alert(response);
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    },
                    complete: function() {
                        // Hide loading animation
                        $('.loader').hide();
                    }
                });
            });
        });
    </script>

</body>

</html>