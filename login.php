<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Billing System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #2b2d42;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --text-color: #2b2d42;
            --text-light: #6c757d;
            --border-color: #e0e0e0;
            --success-color: #4cc9f0;
            --error-color: #f72585;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: var(--text-color);
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.88);
            z-index: 0;
        }

        .login-form-container {
            max-width: 420px;
            width: 100%;
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 1;
            border: 1px solid var(--border-color);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            display: inline-flex;
            align-items: center;
        }

        .logo-icon {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .form-title {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .form-control {
            height: 48px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 10px 15px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: var(--primary-color);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 38px;
            color: var(--text-light);
            font-size: 1rem;
        }

        .btn-login {
            background-color: var(--primary-color);
            color: white;
            border: none;
            height: 48px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
            margin-top: 0;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }

        .form-check-label {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }

        .forgot-password {
            color: var(--text-light);
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--text-light);
            font-size: 0.8rem;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .divider::before {
            margin-right: 0.5rem;
        }

        .divider::after {
            margin-left: 0.5rem;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            transition: all 0.3s;
            border: none;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .social-btn.google {
            background-color: #db4437;
        }

        .social-btn.microsoft {
            background-color: #0078d4;
        }

        .social-btn.apple {
            background-color: #000000;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .register-link a {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-form-container {
                padding: 2rem 1.5rem;
                margin: 0 15px;
            }
            
            body {
                background-image: none;
                background-color: #f8fafc;
            }
            
            body::before {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="login-form-container">
        <div class="logo-container">
            <div class="logo">
                <i class="fas fa-calculator logo-icon"></i>
                <span>BILLINGPRO</span>
            </div>
        </div>

        <h2 class="form-title">Welcome Back</h2>

        <form id="login_form" method="POST" role="form">
            <div class="form-group">
                <label for="login" class="form-label">Email Address</label>
                <input type="email" name="login" id="login" class="form-control"
                    placeholder="Enter your email" autocomplete="off" required>
                <i class="fas fa-envelope input-icon"></i>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Enter your password" autocomplete="off" required>
                <i class="fas fa-lock input-icon"></i>
            </div>

            <div class="form-options">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="./forgot_password.php" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-login mb-3" id="log_in">
                <span id="login-text">Sign In</span>
                <span id="login-spinner" class="spinner-border spinner-border-sm d-none" role="status"
                    aria-hidden="true"></span>
            </button>

            <div class="divider">OR</div>

            <div class="social-login">
                <button type="button" class="social-btn google">
                    <i class="fab fa-google"></i>
                </button>
                <button type="button" class="social-btn microsoft">
                    <i class="fab fa-microsoft"></i>
                </button>
                <button type="button" class="social-btn apple">
                    <i class="fab fa-apple"></i>
                </button>
            </div>

            <div class="register-link">
                Don't have an account? <a href="./register.php">Sign up</a>
            </div>
        </form>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Form submission handler
            $('#login_form').on('submit', function(e) {
                e.preventDefault();
                attemptLogin();
            });

            // Enter key handler
            $('input').keydown(function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    attemptLogin();
                }
            });

            // Social login button handlers
            $('.social-btn.google').click(function() {
                Swal.fire({
                    title: 'Google Sign In',
                    text: 'This would redirect to Google authentication in a real application',
                    icon: 'info',
                    confirmButtonColor: var(--primary-color)
                });
            });

            $('.social-btn.microsoft').click(function() {
                Swal.fire({
                    title: 'Microsoft Sign In',
                    text: 'This would redirect to Microsoft authentication in a real application',
                    icon: 'info',
                    confirmButtonColor: var(--primary-color)
                });
            });

            $('.social-btn.apple').click(function() {
                Swal.fire({
                    title: 'Apple Sign In',
                    text: 'This would redirect to Apple authentication in a real application',
                    icon: 'info',
                    confirmButtonColor: var(--primary-color)
                });
            });
        });

        function attemptLogin() {
            const login = $('#login').val().trim();
            const password = $('#password').val().trim();

            if (login === '' || password === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill in all fields',
                    confirmButtonColor: '#4361ee',
                    backdrop: 'rgba(0,0,0,0.1)'
                });
                return;
            }

            if (!validateEmail(login)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address',
                    confirmButtonColor: '#4361ee',
                    backdrop: 'rgba(0,0,0,0.1)'
                });
                return;
            }

            const posted = {
                'login': login,
                'password': password
            };

            $.ajax({
                type: "POST",
                url: "ajax_helpers/ajax_check_login.php",
                data: posted,
                beforeSend: function() {
                    $('#log_in').prop('disabled', true);
                    $('#login-text').text('Signing In...');
                    $('#login-spinner').removeClass('d-none');
                },
                success: function(response) {
                    if (response.trim() === '1') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'Redirecting to your dashboard...',
                            confirmButtonColor: '#4361ee',
                            backdrop: 'rgba(0,0,0,0.1)',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "dashboard.php";
                        });
                    } else if (response.trim() === 'suspended') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Account Suspended',
                            text: 'Your account has been suspended. Please contact support.',
                            confirmButtonColor: '#4361ee',
                            backdrop: 'rgba(0,0,0,0.1)'
                        });
                    } else if (response.trim() === 'fired') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Account Terminated',
                            text: 'Your account has been terminated and you cannot login.',
                            confirmButtonColor: '#4361ee',
                            backdrop: 'rgba(0,0,0,0.1)'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: 'Invalid email or password',
                            confirmButtonColor: '#4361ee',
                            backdrop: 'rgba(0,0,0,0.1)'
                        });
                    }
                    resetLoginButton();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error connecting to server. Please try again later.',
                        confirmButtonColor: '#4361ee',
                        backdrop: 'rgba(0,0,0,0.1)'
                    });
                    resetLoginButton();
                }
            });
        }

        function resetLoginButton() {
            $('#log_in').prop('disabled', false);
            $('#login-text').text('Sign In');
            $('#login-spinner').addClass('d-none');
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    </script>
</body>

</html>