<?php 
include_once('functions.php');
include_once('includes/page-parts/header.php');
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@iconscout/unicons/css/line.css" rel="stylesheet">
<link href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Modern Professional Style */
    :root {
        --primary-color: #4361ee;
        --primary-dark: #3a56d4;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --dark-color: #1a1a2e;
        --light-color: #f8f9fa;
        --text-color: #495057;
        --text-light: #6c757d;
        --success-color: #4bb543;
        --error-color: #ff3333;
        --border-radius: 8px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', sans-serif;
        font-weight: 400;
        font-size: 15px;
        line-height: 1.6;
        color: var(--text-color);
        background-color: #f5f7ff !important;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    a {
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        color: var(--primary-color);
    }

    a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .login-container {
        width: 100%;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        width: 100%;
        max-width: 420px;
        padding: 2.5rem;
        margin: auto;
    }

    .login-logo {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-logo img {
        height: 60px;
        width: auto;
    }

    .login-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-color);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 3rem;
        font-size: 0.9375rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--text-color);
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e0e0e0;
        border-radius: var(--border-radius);
        transition: var(--transition);
        height: 48px;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        outline: 0;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 1.1rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.75rem 1.5rem;
        font-size: 0.9375rem;
        line-height: 1.5;
        border-radius: var(--border-radius);
        transition: var(--transition);
        cursor: pointer;
        width: 100%;
        height: 48px;
    }

    .btn-primary {
        color: #fff;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .btn-primary:focus {
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.5);
    }

    .login-footer {
        margin-top: 1.5rem;
        text-align: center;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    /* Alert Styles */
    .alert {
        display: none;
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        z-index: 1000;
        font-family: inherit;
        font-size: 0.9375rem;
        max-width: 350px;
        animation: slideIn 0.3s ease-out;
    }

    .alert-success {
        background-color: var(--success-color);
        color: white;
    }

    .alert-error {
        background-color: var(--error-color);
        color: white;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .login-card {
            padding: 1.5rem;
        }
    }
</style>

<body>
    <!-- Alerts -->
    <div id="successAlert" class="alert alert-success">
        Success! Your action completed successfully.
    </div>
    <div id="errorAlert" class="alert alert-error">
        Error! Your action is not completed.
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="assets/images/logo1.png" alt="Company Logo">
            </div>
            
            <h2 class="login-title">Sign In to Your Account</h2>
            
            <form method="POST" role="form" id="login_form">
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="position-relative">
                        <i class="input-icon uil uil-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" id="email" autocomplete="off" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <i class="input-icon uil uil-lock-alt"></i>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" id="password" autocomplete="off" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="log_in">Sign In</button>
                </div>
                
                <div class="login-footer">
                    <p>Don't have an account? <a href="#">Contact support</a></p>
                    <p><a href="#">Forgot password?</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>

    <script>
        function showSuccessMessage(message) {
            const successAlert = $("#successAlert");
            successAlert.text(message).fadeIn();
            setTimeout(() => {
                successAlert.fadeOut();
            }, 3000);
        }

        function showErrorMessage(message) {
            const errorAlert = $("#errorAlert");
            errorAlert.text(message).fadeIn();
            setTimeout(() => {
                errorAlert.fadeOut();
            }, 3000);
        }

        $(document).ready(function () {
            // Form submission handler
            $("#login_form").on('submit', function (event) {
                event.preventDefault();
                var email = $('#email').val();
                var password = $('#password').val();
                
                if (email.trim() === '' || password.trim() === '') {
                    showErrorMessage("Please enter both email and password");
                    return;
                }
                
                attempLogin();
            });
            
            // Also handle the button click for backward compatibility
            $('#log_in').click(function (event) {
                event.preventDefault();
                $("#login_form").trigger('submit');
            });
            
            // Handle Enter key in inputs
            $('input').keydown(function (e) {
                if (e.which == 13) {
                    e.preventDefault();
                    $("#login_form").trigger('submit');
                }
            });
        });

        function attempLogin() {
            var email = $('#email').val();
            var password = $('#password').val();
            var posted = { 'email': email, 'password': password};
            
            $('#log_in').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Signing in...').prop('disabled', true);
            
            $.ajax({
                type: "POST",
                url: "ajax_helpers/ajax_check_login.php",
                data: posted,
                success: function (data) {
                    if ($.trim(data) == '1') {
                        showSuccessMessage('Login successful. Redirecting...');
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 1000);
                    } else {
                        showErrorMessage("Invalid email or password");
                        $('#log_in').html('Sign In').prop('disabled', false);
                    }
                },
                error: function() {
                    showErrorMessage("Network error. Please try again.");
                    $('#log_in').html('Sign In').prop('disabled', false);
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