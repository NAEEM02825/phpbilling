<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start secure session
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'crafthiring';

// Create database connection
try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database error: " . $e->getMessage());
}

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';
$valid_token = false;
$token = isset($_GET['token']) ? trim($_GET['token']) : '';

// Check token validity
if ($token) {
    $current_time = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expires > ?");
    if ($stmt) {
        $stmt->bind_param("ss", $token, $current_time);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $valid_token = $result->num_rows === 1;
    }
    
    if (!$valid_token) {
        $error = 'Invalid or expired reset token.';
    }
} else {
    $error = 'No reset token provided.';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => 'An error occurred.'];
    
    try {
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            throw new Exception('Invalid CSRF token');
        }
        
        // Validate token again
        $token = $_POST['token'];
        $current_time = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expires > ?");
        $stmt->bind_param("ss", $token, $current_time);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        if ($result->num_rows !== 1) {
            throw new Exception('Invalid or expired reset token.');
        }
        
        // Validate passwords
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        if (empty($password) || empty($confirm_password)) {
            throw new Exception('Please fill in all fields.');
        }
        
        if ($password !== $confirm_password) {
            throw new Exception('Passwords do not match.');
        }
        
        if (strlen($password) < 8) {
            throw new Exception('Password must be at least 8 characters.');
        }
        
        // Hash new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Update password and clear reset token
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashed_password, $token);
        if (!$stmt->execute()) {
            throw new Exception("Database error: " . $stmt->error);
        }
        
        if ($stmt->affected_rows === 0) {
            throw new Exception('Failed to update password.');
        }
        
        $response['success'] = true;
        $response['message'] = 'Password updated successfully! You can now <a href="login.php">login</a>.';
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Craft Hirring</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Same styles as forgot password page */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reset Password</h1>
            <p>Enter your new password</p>
        </div>
        
        <div class="content">
            <div class="logo">Craft Hirring</div>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <div class="footer mt-3">
                    <a href="login.php">Back to Login</a>
                </div>
            <?php elseif ($valid_token): ?>
                <div id="alert" class="alert"></div>
                <form id="resetPassword">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    
                    <div class="form-group">
                        <label for="password" class="form-label">New Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" required 
                                   placeholder="At least 8 characters" minlength="8">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required 
                                   placeholder="Confirm your password" minlength="8">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn">Reset Password</button>
                </form>
                
                <div class="footer mt-3">
                    Remember your password? <a href="login.php">Sign in</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#resetPassword').on('submit', function(e) {
                e.preventDefault();
                const $alert = $('#alert');
                $alert.hide().empty();
                
                const $submitBtn = $(this).find('button[type="submit"]');
                const originalText = $submitBtn.html();
                $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Resetting...');
                
                $.ajax({
                    url: '',
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $alert.removeClass('alert-error').addClass('alert-success')
                                  .html(response.message).fadeIn();
                            $submitBtn.hide();
                        } else {
                            $alert.removeClass('alert-success').addClass('alert-error')
                                  .html(response.message).fadeIn();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $alert.removeClass('alert-success').addClass('alert-error')
                              .html('An error occurred. Please try again.').fadeIn();
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>
</body>
</html>