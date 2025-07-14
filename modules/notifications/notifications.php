<?php
require_once __DIR__ . '/../../includes/classes/db.class.php';

$page_title = "Notification Center";
$notifications = [];
$totalNotifications = 0;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 10;
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';

function formatDateTime($dateString) {
    return empty($dateString) ? 'N/A' : date('M j, Y, g:i a', strtotime($dateString));
}

// Calculate offset for pagination
$offset = ($currentPage - 1) * $perPage;

try {
    // Base query
    $query = "FROM phpbilling.admin_notifications WHERE 1";
    $params = [];
    
    // Apply search filter
    if (!empty($searchTerm)) {
        $query .= " AND (message LIKE ? OR related_task_id LIKE ?)";
        $searchParam = "%$searchTerm%";
        $params = array_merge($params, [$searchParam, $searchParam]);
    }
    
    // Apply status filter
    if ($statusFilter === 'read') {
        $query .= " AND is_read = 1";
    } elseif ($statusFilter === 'unread') {
        $query .= " AND is_read = 0";
    }
    
    // Get total count for pagination
    $countQuery = "SELECT COUNT(*) as total $query";
    $totalResult = DB::query($countQuery, $params);
    $totalNotifications = $totalResult[0]['total'];
    
    // Get paginated data
    $dataQuery = "SELECT * $query ORDER BY created_at DESC LIMIT $offset, $perPage";
    $notifications = DB::query($dataQuery, $params);
    
} catch (Exception $e) {
    $error = $e->getMessage();
}

// Calculate total pages
$totalPages = ceil($totalNotifications / $perPage);
?>

<style>
    .notification-container {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .notification-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
        padding: 1rem 1.5rem;
    }
    .notification-title {
        font-size: 1.25rem;
        font-weight: 500;
        color: #212529;
    }
    .notification-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .notification-table thead th {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 500;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e0e0e0;
    }
    .notification-table tbody tr {
        transition: background-color 0.15s ease;
    }
    .notification-table tbody tr:hover {
        background-color: #f8fafc;
    }
    .notification-table tbody td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
        font-size: 0.9rem;
    }
    .status-badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        border-radius: 0.375rem;
    }
    .status-unread {
        background-color: #fff3cd;
        color: #856404;
    }
    .status-read {
        background-color: #d4edda;
        color: #155724;
    }
    .timestamp {
        color: #6c757d;
        font-size: 0.85rem;
        white-space: nowrap;
    }
    .message-content {
        line-height: 1.5;
    }
    .action-buttons .btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.8rem;
    }
    .empty-state {
        padding: 3rem;
        text-align: center;
        background-color: #f8f9fa;
    }
    .empty-icon {
        font-size: 2.5rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }
    .pagination-info {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .unread-row {
        background-color: #f8fafc;
        border-left: 3px solid #3d8bfd;
    }
    .table-actions {
        border-top: 1px solid #e0e0e0;
        background-color: #f8f9fa;
        padding: 0.75rem 1.5rem;
    }
    .pagination .page-item.active .page-link {
        background-color: #3d8bfd;
        border-color: #3d8bfd;
    }
    .notification-details {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-top: 1rem;
    }
    .detail-row {
        display: flex;
        margin-bottom: 0.5rem;
    }
    .detail-label {
        font-weight: 600;
        min-width: 120px;
        color: #495057;
    }
    .detail-value {
        flex-grow: 1;
    }
    .modal-notification-content {
        white-space: pre-wrap;
    }
</style>


<!-- Bootstrap CSS (for modal, buttons, and basic styling) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome (for icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Google Fonts (for typography) -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&family=Segoe+UI:wght@400;500&display=swap" rel="stylesheet">

<!-- Your custom notification center CSS -->
<link href="/css/notification-center.css" rel="stylesheet">
<div class="notification-container">
    <div class="card border-0 shadow-sm">
        <div class="card-header notification-header d-flex justify-content-between align-items-center">
            <h5 class="notification-title mb-0">
                <i class="fas fa-bell me-2"></i>Notification Center
            </h5>
            <div class="d-flex align-items-center">
                <form method="get" class="d-flex align-items-center">
                    <div class="input-group input-group-sm me-2" style="width: 200px;">
                        <input type="text" name="search" class="form-control form-control-sm" 
                               placeholder="Search notifications..." value="<?= htmlspecialchars($searchTerm) ?>">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <select name="status" class="form-select form-select-sm me-2" style="width: 120px;" onchange="this.form.submit()">
                        <option value="all" <?= $statusFilter === 'all' ? 'selected' : '' ?>>All Status</option>
                        <option value="read" <?= $statusFilter === 'read' ? 'selected' : '' ?>>Read</option>
                        <option value="unread" <?= $statusFilter === 'unread' ? 'selected' : '' ?>>Unread</option>
                    </select>
                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href='<?= $_SERVER['PHP_SELF'] ?>'">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table notification-table">
                    <thead>
                        <tr>
                            <th style="width: 180px;">Time</th>
                            <th>Notification</th>
                            <th style="width: 100px;" class="text-center">Status</th>
                            <th style="width: 120px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($error)): ?>
                            <tr><td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-exclamation-triangle text-danger empty-icon"></i>
                                    <h5 class="text-danger mb-2">Error loading notifications</h5>
                                    <p class="text-muted mb-2"><?= htmlspecialchars($error) ?></p>
                                    <button class="btn btn-sm btn-outline-primary" onclick="window.location.reload()">
                                        <i class="fas fa-sync-alt me-1"></i> Try Again
                                    </button>
                                </div>
                            </td></tr>
                        <?php elseif (count($notifications) > 0): ?>
                            <?php foreach ($notifications as $notification): ?>
                                <?php
                                $statusClass = $notification['is_read'] ? 'status-read' : 'status-unread';
                                $statusText = $notification['is_read'] ? 'Read' : 'Unread';
                                $rowClass = $notification['is_read'] ? '' : 'unread-row';
                                ?>
                                <tr class="<?= $rowClass ?>" data-id="<?= $notification['id'] ?>">
                                    <td class="timestamp">
                                        <i class="far fa-clock me-1"></i><?= formatDateTime($notification['created_at']) ?>
                                    </td>
                                    <td>
                                        <div class="message-content">
                                            <?= htmlspecialchars($notification['message']) ?>
                                        </div>
                                        <?php if (!empty($notification['related_task_id'])): ?>
                                            <small class="text-muted">Task ID: <?= htmlspecialchars($notification['related_task_id']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view-details" 
                                                data-id="<?= $notification['id'] ?>" 
                                                title="View details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-notification" 
                                                data-id="<?= $notification['id'] ?>" 
                                                title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4">
                                <div class="empty-state">
                                    <i class="far fa-bell empty-icon"></i>
                                    <h5 class="text-muted mb-2">No notifications found</h5>
                                    <p class="text-muted mb-0"><?= empty($searchTerm) ? 'All caught up! You have no notifications.' : 'No notifications match your search criteria.' ?></p>
                                </div>
                            </td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="table-actions d-flex justify-content-between align-items-center">
            <div class="pagination-info">
                Showing <?= $offset + 1 ?> to <?= min($offset + $perPage, $totalNotifications) ?> of <?= $totalNotifications ?> notifications
            </div>
            <div>
                <nav aria-label="Notifications pagination">
                    <ul class="pagination pagination-sm mb-0">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($searchTerm) ?>&status=<?= $statusFilter ?>">
                                    Previous
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($searchTerm) ?>&status=<?= $statusFilter ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($searchTerm) ?>&status=<?= $statusFilter ?>">
                                    Next
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <div class="btn-group">
                <button class="btn btn-sm btn-outline-secondary mark-all-read">
                    <i class="fas fa-check-circle me-1"></i> Mark All as Read
                </button>
                <button class="btn btn-sm btn-outline-danger clear-all">
                    <i class="fas fa-trash-alt me-1"></i> Clear All
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notification Details Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notificationDetails">
                <!-- Content will be loaded via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary mark-as-read">Mark as Read</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View notification details
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const notificationId = this.getAttribute('data-id');
            
            // Show loading state
            document.getElementById('notificationDetails').innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading notification details...</p>
                </div>
            `;
            
            // Fetch notification details via AJAX
            fetch(`/api/notification_details.php?id=${notificationId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const notification = data.notification;
                        const modalContent = `
                            <div class="notification-details">
                                <div class="detail-row">
                                    <div class="detail-label">Date:</div>
                                    <div class="detail-value">${new Date(notification.created_at).toLocaleString()}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Status:</div>
                                    <div class="detail-value">
                                        <span class="status-badge ${notification.is_read ? 'status-read' : 'status-unread'}">
                                            ${notification.is_read ? 'Read' : 'Unread'}
                                        </span>
                                    </div>
                                </div>
                                ${notification.read_at ? `
                                <div class="detail-row">
                                    <div class="detail-label">Read At:</div>
                                    <div class="detail-value">${new Date(notification.read_at).toLocaleString()}</div>
                                </div>` : ''}
                                ${notification.related_task_id ? `
                                <div class="detail-row">
                                    <div class="detail-label">Related Task:</div>
                                    <div class="detail-value">${notification.related_task_id}</div>
                                </div>` : ''}
                                <div class="detail-row">
                                    <div class="detail-label">User ID:</div>
                                    <div class="detail-value">${notification.user_id || 'System'}</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6>Message:</h6>
                                <div class="modal-notification-content p-3 bg-light rounded">
                                    ${notification.message}
                                </div>
                            </div>
                        `;
                        document.getElementById('notificationDetails').innerHTML = modalContent;
                        
                        // Store notification ID on the mark-as-read button
                        document.querySelector('.mark-as-read').setAttribute('data-id', notificationId);
                        
                        // Show modal
                        const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                        modal.show();
                    } else {
                        document.getElementById('notificationDetails').innerHTML = `
                            <div class="alert alert-danger">
                                ${data.message || 'Failed to load notification details.'}
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    document.getElementById('notificationDetails').innerHTML = `
                        <div class="alert alert-danger">
                            Error loading notification: ${error.message}
                        </div>
                    `;
                });
        });
    });
    
    // Mark notification as read when clicking on row
    document.querySelectorAll('.notification-table tbody tr').forEach(row => {
        row.addEventListener('click', function(e) {
            // Don't trigger if clicking on action buttons
            if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                return;
            }
            
            const notificationId = this.getAttribute('data-id');
            markAsRead(notificationId, this);
        });
    });
    
    // Mark as read button in modal
    document.querySelector('.mark-as-read').addEventListener('click', function() {
        const notificationId = this.getAttribute('data-id');
        markAsRead(notificationId);
        
        // Close the modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('notificationModal'));
        modal.hide();
    });
    
    // Delete notification
    document.querySelectorAll('.delete-notification').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            if (confirm('Are you sure you want to delete this notification?')) {
                const notificationId = this.getAttribute('data-id');
                fetch(`/api/delete_notification.php?id=${notificationId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the row from the table
                        document.querySelector(`tr[data-id="${notificationId}"]`).remove();
                    } else {
                        alert(data.message || 'Failed to delete notification.');
                    }
                })
                .catch(error => {
                    alert('Error deleting notification: ' + error.message);
                });
            }
        });
    });
    
    // Mark all as read
    document.querySelector('.mark-all-read').addEventListener('click', function() {
        if (confirm('Mark all notifications as read?')) {
            fetch('/api/mark_all_read.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI
                    document.querySelectorAll('.status-badge.status-unread').forEach(badge => {
                        badge.classList.remove('status-unread');
                        badge.classList.add('status-read');
                        badge.textContent = 'Read';
                    });
                    document.querySelectorAll('.unread-row').forEach(row => {
                        row.classList.remove('unread-row');
                    });
                } else {
                    alert(data.message || 'Failed to mark all as read.');
                }
            })
            .catch(error => {
                alert('Error marking all as read: ' + error.message);
            });
        }
    });
    
    // Clear all notifications
    document.querySelector('.clear-all').addEventListener('click', function() {
        if (confirm('Are you sure you want to delete ALL notifications? This cannot be undone.')) {
            fetch('/api/clear_all_notifications.php', {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload the page
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to clear all notifications.');
                }
            })
            .catch(error => {
                alert('Error clearing all notifications: ' + error.message);
            });
        }
    });
    
    // Function to mark a notification as read
    function markAsRead(notificationId, rowElement = null) {
        fetch(`/api/mark_as_read.php?id=${notificationId}`, {
            method: 'POST'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the UI if row element is provided
                if (rowElement) {
                    rowElement.classList.remove('unread-row');
                    const badge = rowElement.querySelector('.status-badge');
                    if (badge) {
                        badge.classList.remove('status-unread');
                        badge.classList.add('status-read');
                        badge.textContent = 'Read';
                    }
                }
            } else {
                console.error(data.message || 'Failed to mark as read.');
            }
        })
        .catch(error => {
            console.error('Error marking as read:', error);
        });
    }
});
</script>