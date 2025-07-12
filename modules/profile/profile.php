<?php
// Initialize variables
$error = '';
$success = '';
$user = [];
$formattedName = 'Admin';
$roleText = 'User';

try {
    // Check authentication
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    $user_id = (int) $_SESSION['user_id'];

    // Generate CSRF token
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verify CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            throw new Exception('Invalid CSRF token');
        }

        // Handle AJAX profile picture upload
        if (isset($_POST['isAjaxUpload'])) {
            try {
                if (empty($_FILES['profilePicInput']['tmp_name'])) {
                    throw new Exception('No file uploaded or file is too large');
                }

                // Check for upload errors
                if ($_FILES['profilePicInput']['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception('File upload error: ' . $_FILES['profilePicInput']['error']);
                }

                $uploadDir = __DIR__ . '/../../uploads/profileImages/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $allowedTypes = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/heic' => 'heic',
                    'image/heif' => 'heif'
                ];

                $detectedType = mime_content_type($_FILES['profilePicInput']['tmp_name']);

                if (!array_key_exists($detectedType, $allowedTypes)) {
                    throw new Exception('Only JPG, PNG, and HEIC files are allowed.');
                }

                if ($_FILES['profilePicInput']['size'] > 20 * 1024 * 1024) {
                    throw new Exception('File size must be less than 20MB');
                }

                // Delete old picture if exists
                $user = DB::queryFirstRow("SELECT picture FROM users WHERE user_id = %i", $user_id);
                if (!empty($user['picture']) && file_exists(__DIR__ . '/../../' . $user['picture'])) {
                    unlink(__DIR__ . '/../../' . $user['picture']);
                }

                // Generate unique filename
                $extension = $allowedTypes[$detectedType];
                $filename = "user_{$user_id}_" . time() . ".$extension";
                $targetPath = $uploadDir . $filename;

                if (!move_uploaded_file($_FILES['profilePicInput']['tmp_name'], $targetPath)) {
                    throw new Exception('Error uploading file');
                }

                $relativePath = "uploads/profileImages/$filename";
                DB::update('users', ['picture' => $relativePath], "user_id = %i", $user_id);

                echo json_encode(['success' => true]);
                exit;
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }
        }

        // Process regular form submission
        $name = filter_input(INPUT_POST, 'fullNameInput', FILTER_SANITIZE_SPECIAL_CHARS);
        $username = filter_input(INPUT_POST, 'usernameInput', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'emailInput', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phoneInput', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validate required fields
        if (empty($name) || empty($username) || empty($email)) {
            throw new Exception('All required fields must be filled');
        }

        // Update user data
        DB::update('users', [
            'name' => $name,
            'user_name' => $username,
            'email' => $email,
            'phone' => $phone
        ], "user_id = %i", $user_id);

        $success = 'Profile updated successfully!';
    }

    // Get updated user data
    $user = DB::queryFirstRow("SELECT * FROM users WHERE user_id = %i", $user_id);

    // Format data for display
    $formattedName = isset($user['name']) ? ucfirst($user['name']) : 'Admin';
    $formattedUsername = isset($user['first_name']) && !empty($user['first_name'])
        ? strtolower(trim($user['first_name'] . ' ' . ($user['last_name'] ?? '')))
        : (isset($user['user_name']) ? strtolower($user['user_name']) : 'N/A');

    if ($user['role_id'] == 1) {
        $roleText = 'Admin';
    } elseif ($user['role_id'] == 2) {
        $roleText = 'Manager';
    } elseif ($user['role_id'] == 3) {
        $roleText = 'Employee';
    }  else {
        $roleText = 'User';
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<!-- Main Content -->
<div class="main-content app-content">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h2">Edit Profile</h1>
            <p class="mb-0 text-muted">Manage your account settings</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt me-1"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Status messages -->
    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            <?= htmlspecialchars($success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <!-- Profile Picture -->
                    <div class="position-relative mx-auto mb-4" style="width: 150px; height: 150px;">
                        <img id="profileImage"
                            src="<?= htmlspecialchars(!empty($user['picture']) ? $user['picture'] : 'https://placehold.co/150x150.png?text=' . substr($formattedName, 0, 1)) ?>"
                            alt="Profile Picture"
                            class="img-thumbnail rounded-circle w-100 h-100"
                            onerror="this.src='https://placehold.co/150x150.png?text=<?= substr($formattedName, 0, 1) ?>'">
                        <input type="file" id="profilePicInput" name="profilePicInput" accept="image/*" style="display: none;">
                        <label for="profilePicInput" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2" style="width: 40px; height: 40px; cursor: pointer;">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>

                    <!-- User Info -->
                    <h4 class="mb-1" id="displayName"><?= htmlspecialchars($formattedName) ?></h4>
                    <p class="text-muted mb-2" id="displayUsername">@<?= htmlspecialchars(isset($user['user_name']) ? $user['user_name'] : ($user['role'] ?? 'user')) ?></p>
                    <span class="badge bg-primary mb-3"><?= htmlspecialchars($roleText) ?></span>
                    <!-- Quick Actions -->
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fas fa-key me-2"></i> Change Password
                        </button>
                        <a href="#" class="btn btn-outline-secondary">
                            <i class="fas fa-question-circle me-2"></i> Help
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Edit Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form id="editProfileForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fullNameInput" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="fullNameInput" class="form-control"
                                        placeholder="Full Name"
                                        value="<?= htmlspecialchars(isset($user['name']) ? $user['name'] : 'Admin') ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="usernameInput" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="text" name="usernameInput" class="form-control"
                                        placeholder="Username"
                                        value="<?= htmlspecialchars(isset($user['user_name']) ? $user['user_name'] : 'admin') ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="emailInput" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="emailInput" class="form-control"
                                        placeholder="Email"
                                        value="<?= htmlspecialchars(isset($user['email']) ? $user['email'] : '') ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phoneInput" class="form-label">Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phoneInput" class="form-control"
                                        placeholder="Phone"
                                        value="<?= htmlspecialchars(isset($user['phone']) ? $user['phone'] : '-') ?>">
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="my-4">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save me-2"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Additional Information</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-muted">Role</th>
                                    <td><?= htmlspecialchars($roleText) ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Status</th>
                                    <td><?= isset($user['status']) ? htmlspecialchars($user['status']) : '' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">
                    <i class="fas fa-key me-2"></i> Change Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="currentPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="currentPasswordFeedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="newPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="newPasswordFeedback"></div>
                        <small class="form-text text-muted">Password must be at least 8 characters long</small>
                    </div>

                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" id="confirmPasswordFeedback"></div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.3/dist/heic2any.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize modal
        const changePasswordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const target = document.getElementById(this.getAttribute('data-target'));
                const icon = this.querySelector('i');

                if (target.type === 'password') {
                    target.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    target.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Password validation
       // Update the validatePassword function to be more thorough
function validatePassword() {
    let isValid = true;
    const currentPass = currentPassword.value.trim();
    const newPass = newPassword.value.trim();
    const confirmPass = confirmPassword.value.trim();

    // Validate current password
    if (currentPass.length === 0) {
        document.getElementById('currentPasswordFeedback').textContent = 'Current password is required';
        currentPassword.classList.add('is-invalid');
        isValid = false;
    } else {
        currentPassword.classList.remove('is-invalid');
    }

    // Validate new password
    if (newPass.length < 8) {
        document.getElementById('newPasswordFeedback').textContent = 'Password must be at least 8 characters long';
        newPassword.classList.add('is-invalid');
        isValid = false;
    } else if (currentPass && newPass === currentPass) {
        document.getElementById('newPasswordFeedback').textContent = 'New password must be different from current password';
        newPassword.classList.add('is-invalid');
        isValid = false;
    } else {
        newPassword.classList.remove('is-invalid');
    }

    // Validate confirmation
    if (newPass !== confirmPass) {
        document.getElementById('confirmPasswordFeedback').textContent = 'Passwords do not match';
        confirmPassword.classList.add('is-invalid');
        isValid = false;
    } else if (confirmPass.length === 0) {
        document.getElementById('confirmPasswordFeedback').textContent = 'Please confirm your new password';
        confirmPassword.classList.add('is-invalid');
        isValid = false;
    } else {
        confirmPassword.classList.remove('is-invalid');
    }

    return isValid;
}

        const currentPassword = document.getElementById('currentPassword');
        const newPassword = document.getElementById('newPassword');
        const confirmPassword = document.getElementById('confirmPassword');

        currentPassword.addEventListener('input', validatePassword);
        newPassword.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword);

        // Form submission
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validatePassword()) {
                return;
            }

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Updating...';
            submitBtn.disabled = true;

            fetch('ajax_helpers/update_password.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success message with SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Password Updated!',
                            text: 'Your password has been changed successfully',
                            timer: 3000,
                            showConfirmButton: false
                        });

                        // Close modal and reset form
                        changePasswordModal.hide();
                        this.reset();
                    } else {
                        // Show error message with SweetAlert only for current password mismatch
                        if (data.message.includes('Current password')) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Incorrect Password',
                                text: 'The current password you entered is incorrect',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            document.getElementById('currentPasswordFeedback').textContent = data.message;
                            document.getElementById('currentPassword').classList.add('is-invalid');
                        } else {
                            // For other errors, show inline feedback
                            const errorAlert = document.createElement('div');
                            errorAlert.className = 'alert alert-danger alert-dismissible fade show mt-3';
                            errorAlert.innerHTML = `
                            <i class="fas fa-exclamation-circle me-2"></i>
                            ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `;
                            document.getElementById('changePasswordForm').appendChild(errorAlert);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating your password',
                        timer: 3000,
                        showConfirmButton: false
                    });
                })
                .finally(() => {
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                });
        });

        // Profile picture upload handler with HEIC conversion
        document.getElementById('profilePicInput').addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Client-side validation
            if (file.size > 20 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File too large',
                    text: 'File size must be less than 20MB',
                    timer: 3000
                });
                this.value = '';
                return;
            }

            try {
                // Show loading indicator
                const swalInstance = Swal.fire({
                    title: 'Processing Image',
                    html: 'Please wait while we prepare your image...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                // Convert HEIC to JPG if needed
                const processedFile = await processImageFile(file);

                // Update preview
                await updateImagePreview(processedFile);

                // Upload via AJAX
                await uploadProfilePicture(processedFile);

                // Success notification
                await swalInstance.close();
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Profile picture updated successfully',
                    timer: 2000,
                    showConfirmButton: false
                });

                // Reload the page after upload
                setTimeout(() => {
                    window.location.reload();
                }, 2100); // Slight delay to let the success message show
            } catch (error) {
                console.error('Upload error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: error.message || 'An error occurred while uploading the image',
                    timer: 3000
                });
                this.value = '';
            }
        });

        // Helper functions
        async function processImageFile(file) {
            const isHEIC = file.name.toLowerCase().endsWith('.heic') ||
                file.type === 'image/heic' ||
                file.type === 'image/heif';

            if (!isHEIC) return file;

            try {
                const conversionResult = await heic2any({
                    blob: file,
                    toType: 'image/jpeg',
                    quality: 0.8
                });

                return new File([conversionResult], file.name.replace(/\.[^/.]+$/, '.jpg'), {
                    type: 'image/jpeg',
                    lastModified: new Date().getTime()
                });
            } catch (error) {
                console.error('HEIC conversion failed:', error);
                throw new Error('Failed to convert HEIC image. Please try another file.');
            }
        }

        function updateImagePreview(file) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profileImage').src = event.target.result;
                    resolve();
                };
                reader.readAsDataURL(file);
            });
        }

        async function uploadProfilePicture(file) {
            const formData = new FormData();
            formData.append('profilePicInput', file);
            formData.append('csrf_token', document.querySelector('input[name="csrf_token"]').value);
            formData.append('isAjaxUpload', 'true');

            const response = await fetch(window.location.href, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || 'Upload failed');
            }
        }

        // Regular form submission handler
        const editProfileForm = document.getElementById('editProfileForm');
        if (editProfileForm) {
            editProfileForm.addEventListener('submit', function(e) {
                // Prevent default if we're handling an image upload
                if (document.getElementById('profilePicInput').files.length > 0) {
                    e.preventDefault();
                    return;
                }

                // Show loading state for regular form submission
                const saveBtn = this.querySelector('button[type="submit"]');
                const originalBtnText = saveBtn.innerHTML;
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';
                saveBtn.disabled = true;
            });
        }
    });
</script>