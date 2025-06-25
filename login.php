<?php 
include_once('functions.php');
include_once('includes/page-parts/header.php');
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@iconscout/unicons/css/line.css" rel="stylesheet">
    <link href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css" rel="stylesheet">
    
    <style>
        /* Please ❤ this if you like it! */
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

        body{
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-size: 15px;
            line-height: 1.7;
            color: #c4c3ca;
            background: white !important;
            overflow-x: hidden;
        }
        a {
            cursor: pointer;
            transition: all 200ms linear;
        }
        a:hover {
            text-decoration: none;
        }
        .link {
            color: #c4c3ca;
        }
        .link:hover {
            color: #ffeba7;
        }
        p {
            font-weight: 500;
            font-size: 14px;
            line-height: 1.7;
        }
        h4 {
            font-weight: 600;
        }
        h6 span{
            padding: 0 20px;
            text-transform: uppercase;
            font-weight: 700;
        }
        .section{
            position: relative;
            width: 100%;
            display: block;
        }
        .full-height{
            min-height: 100vh;
        }
        .card-3d-wrap {
            position: relative;
            width: 440px;
            max-width: 100%;
            height: 400px;
            margin-top: 60px;
        }
        .card-3d-wrapper {
            width: 100%;
            height: 100%;
            position:absolute;    
            top: 0;
            left: 0;  
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            transition: all 600ms ease-out; 
        }
        .card-front{
            width: 100%;
            height: 100%;
            background-color: #fe5500;
            background-position: bottom center;
            background-repeat: no-repeat;
            background-size: 300%;
            position: absolute;
            border-radius: 6px;
            left: 0;
            top: 0;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -o-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .checkbox:checked ~ .card-3d-wrap .card-3d-wrapper {
            transform: rotateY(180deg);
        }
        .center-wrap{
            position: absolute;
            width: 100%;
            padding: 0 35px;
            top: 50%;
            left: 0;
            transform: translate3d(0, -50%, 35px) perspective(100px);
            z-index: 20;
            display: block;
        }
        .form-group{ 
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
        }
        .form-style {
            padding: 13px 20px;
            padding-left: 55px;
            height: 48px;
            width: 100%;
            font-weight: 500;
            border-radius: 4px;
            font-size: 14px;
            line-height: 22px;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
            box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
        }
        .form-style:focus,
        .form-style:active {
            border: none;
            outline: none;
            box-shadow: 0 4px 8px 0 rgba(21,21,21,.2);
        }
        .input-icon {
            position: absolute;
            top: 0;
            left: 18px;
            height: 48px;
            font-size: 24px;
            line-height: 48px;
            text-align: left;
            color: #838383;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
        }

        .btn{  
            border-radius: 4px;
            height: 44px;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            -webkit-transition : all 200ms linear;
            transition: all 200ms linear;
            padding: 0 30px;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: none;
            background-color: #ffffff;
            box-shadow: 0 8px 24px 0 rgba(255,235,167,.2);
        }
        .btn:active,
        .btn:focus{  
            background-color: black;
            color: #fe5500;
            box-shadow: 0 8px 24px 0 rgba(16,39,112,.2);
        }
        .btn:hover{  
            background-color: black;
            color: #fe5500;
            box-shadow: 0 8px 24px 0 rgba(16,39,112,.2);
        }
    </style>
<body>


<!--authentication-->
<style>
    .alert-success {
        display: none; /* Hidden by default */
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #4CAF50; /* Green */
        color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        font-family: Arial, sans-serif;
        font-size: 16px;
    }
    .alert-error {
        display: none; /* Hidden by default */
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #f01414; /* red */
        color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        font-family: Arial, sans-serif;
        font-size: 16px;
    }
</style>
<div id="successAlert" class="alert-success">
    Success! Your action completed successfully.
</div>
<div id="errorAlert" class="alert-error">
    Error! Your action is not completed.
</div>


<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <img src="assets/images/craft_logo.png" alt="Logo" style="width:145px">
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <form method="POST" role="form" id="login_form">
                                            <h4 class="mb-4 pb-3" style="color:black">Sign In</h4>
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off">
                                                <i class="input-icon uil uil-at"></i>
                                            </div>	
                                            <div class="form-group mt-2">
                                                <input type="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off">
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>
                                            <a href="#" class="btn mt-4" id="log_in">Log In</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<!--authentication-->



  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>

  <script>

        function showSuccessMessage(message) {
            const successAlert = document.getElementById("successAlert");
            successAlert.textContent = message;
            successAlert.style.display = "block";
            // Hide the alert automatically after 3 seconds
            setTimeout(() => {
                successAlert.style.display = "none";
            }, 3000);
        }

        function showErrorMessage(message) {
            const errorAlert = document.getElementById("errorAlert");
            errorAlert.textContent = message;
            errorAlert.style.display = "block";
            // Hide the alert automatically after 3 seconds
            setTimeout(() => {
                errorAlert.style.display = "none";
            }, 3000);
        }

    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bi-eye-slash-fill");
                $('#show_hide_password i').removeClass("bi-eye-fill");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                $('#show_hide_password i').addClass("bi-eye-fill");
            }
        });

        $('body').addClass('login-page').removeClass('sidebar-collapse layout-top-nav').css('background-color', '#bd282f');
		$('.main-footer').remove();
		$('.wrapper').removeClass('wrapper').addClass('login-box');

        $('#log_in').click(function (event) {
            event.preventDefault(); // Prevent normal form submission

            var email = $('#email').val();
            var password = $('#password').val();
            if (($.trim(email) != '') && ($.trim(password) != '')) {
                attempLogin();
            } else {
                showErrorMessage("Please enter Email and Password");
            }
        });
			
		$('input').keydown(function (e) {
            if (e.which == 13) {
                e.preventDefault(); // Prevent form submission when pressing Enter
                var email = $('#email').val();
                var password = $('#password').val();
                if (($.trim(email) != '') && ($.trim(password) != '')) {
                    attempLogin();
                } else {
                    showErrorMessage("Please Enter User ID and Password");
                }
            }
        });
    });
    function attempLogin() {
        var email = $('#email').val();
        var password = $('#password').val();
        var posted = { 'email': email, 'password': password};
        $.ajax({
            type: "POST",
            url: "ajax_helpers/ajax_check_login.php",
            data: posted,
            beforeSend: function () {
                $('#log_in').attr("value", "Logging In...");
                $('#log_in').addClass("disabled");
            },
            success: function (data) {
                console.log('Response from server:', data); // Debugging response
                if ($.trim(data) == '1') {
                    showSuccessMessage('Login successfully. Redirecting to index page...');
                    window.location.href = 'index.php'; // Redirect if login is successful
                } else {
                    showErrorMessage("Invalid User ID or Password");
                    $('#log_in').attr("value", "Log In");
                    $('#log_in').removeClass("disabled");
                }
            }
        });
	}
  </script>
  <style>
    footer {
      display: none !important;
    }
  </style>
  <?php
  include_once('includes/page-parts/content-bottom.php');
  include_once('includes/page-parts/footer.php');
  ?>