<?php
$page_title = "Notification Center";
// Initial empty state - we'll load data via AJAX
?>

<!-- Modern CSS Framework (Tailwind CDN for demo purposes) -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Animate.css for smooth animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<style>
    /* Custom enhancements */
    .notification-container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        margin
    }
    
    .notification-card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .notification-header {
        background: linear-gradient(135deg, #f6f9fc 0%, #eef2f5 100%);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .notification-table {
        --table-accent: #f8fafc;
        --table-stripe: #f8fafc;
        --table-hover: #f1f5f9;
    }
    
    .notification-table thead th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.75rem;
        color: #64748b;
        background-color: #f8fafc;
    }
    
    .notification-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .notification-table tbody tr:hover {
        background-color: var(--table-hover) !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }
    
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
        border-radius: 9999px;
        font-weight: 600;
    }
    
    .status-unread {
        background-color: #e0f2fe;
        color: #0369a1;
    }
    
    .status-read {
        background-color: #e2e8f0;
        color: #475569;
    }
    
    .unread-row {
        background-color: #f8fafc;
        position: relative;
    }
    
    .unread-row::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background-color: #3b82f6;
        border-radius: 3px 0 0 3px;
    }
    
    .message-preview {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .empty-state {
        transition: all 0.3s ease;
    }
    
    .skeleton-loader {
        background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
        border-radius: 4px;
    }
    
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    .action-btn {
        transition: all 0.2s ease;
        opacity: 0.7;
    }
    
    .action-btn:hover {
        opacity: 1;
        transform: scale(1.1);
    }
    
    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
    
    .dropdown-filter {
        min-width: 200px;
    }
    
    .timestamp {
        white-space: nowrap;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .notification-table thead {
            display: none;
        }
        
        .notification-table tr {
            display: block;
            margin-bottom: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .notification-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .notification-table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #64748b;
            margin-right: 1rem;
            flex: 0 0 120px;
        }
        
        .notification-table .action-buttons {
            justify-content: flex-end;
        }
        
        .unread-row::before {
            border-radius: 8px 0 0 8px;
        }
    }
</style>

<div class="notification-container">
    <div class="notification-card bg-white">
        <!-- Header with title and controls -->
        <div class="notification-header px-6 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg mr-4">
                    <i class="fas fa-bell text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Notification Center</h2>
                    <p class="text-sm text-gray-500" id="notification-summary">Loading notifications...</p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search-input" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Search notifications...">
                </div>
                
                <div class="relative dropdown-filter">
                    <select id="status-filter" class="appearance-none block w-full pl-3 pr-8 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="all">All Status</option>
                        <option value="unread">Unread Only</option>
                        <option value="read">Read Only</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
                
                <button id="refresh-btn" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700 transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>
                    <span class="hidden sm:inline">Refresh</span>
                </button>
            </div>
        </div>
        
        <!-- Notification Table -->
        <div class="overflow-x-auto">
            <table class="notification-table w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left">Time</th>
                        <th class="px-6 py-3 text-left">Notification</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="notifications-body">
                    <!-- Loading skeleton -->
                    <tr>
                        <td colspan="4" class="px-6 py-8">
                            <div class="flex flex-col items-center justify-center gap-4">
                                <div class="flex flex-col w-full gap-2">
                                    <div class="skeleton-loader h-6 w-full"></div>
                                    <div class="skeleton-loader h-6 w-3/4"></div>
                                </div>
                                <div class="skeleton-loader h-16 w-full mt-4"></div>
                                <div class="skeleton-loader h-16 w-full"></div>
                                <div class="skeleton-loader h-16 w-full"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Footer with pagination and bulk actions -->
        <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-200">
            <div class="text-sm text-gray-600" id="pagination-info">
                Loading...
            </div>
            
            <nav class="flex items-center gap-1" id="pagination-controls">
                <!-- Pagination will be inserted here by JavaScript -->
            </nav>
            
            <div class="flex gap-2">
                <button id="mark-all-read" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    <i class="fas fa-check-circle mr-2 text-blue-500"></i>
                    <span class="hidden sm:inline">Mark All Read</span>
                    <span class="inline sm:hidden">Read All</span>
                </button>
                <button id="clear-all" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    <i class="fas fa-trash-alt mr-2 text-red-500"></i>
                    <span class="hidden sm:inline">Clear All</span>
                    <span class="inline sm:hidden">Clear</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notification Detail Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-lg outline-none text-current">
            <div class="modal-header flex items-center justify-between p-4 border-b border-gray-200 rounded-t-lg">
                <h5 class="text-xl font-semibold text-gray-800" id="notificationModalLabel">Notification Details</h5>
                <button type="button" class="btn-close box-content w-4 h-4 p-1 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100 transition-colors" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-6" id="notificationDetails">
                <!-- Content will be loaded via AJAX -->
                <div class="flex justify-center items-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
                </div>
            </div>
            <div class="modal-footer flex items-center justify-end p-4 border-t border-gray-200 rounded-b-lg gap-3">
                <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" data-bs-dismiss="modal">Close</button>
                <button type="button" id="mark-as-read-modal" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">Mark as Read</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed bottom-4 right-4 hidden">
    <div class="bg-gray-800 text-white px-4 py-3 rounded-lg shadow-lg flex items-start max-w-xs">
        <div class="flex-shrink-0 mt-1">
            <i class="fas fa-check-circle text-green-400"></i>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium" id="toast-message">Operation successful</p>
        </div>
        <button class="ml-4 text-gray-400 hover:text-white" onclick="document.getElementById('toast').classList.add('hidden')">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Global variables
let currentPage = 1;
let totalPages = 1;
let perPage = 10;
let searchTerm = '';
let statusFilter = 'all';
let isLoading = false;
let modalInstance = null;

// DOM elements
const notificationsBody = document.getElementById('notifications-body');
const paginationInfo = document.getElementById('pagination-info');
const paginationControls = document.getElementById('pagination-controls');
const searchInput = document.getElementById('search-input');
const statusFilterSelect = document.getElementById('status-filter');
const refreshBtn = document.getElementById('refresh-btn');
const markAllReadBtn = document.getElementById('mark-all-read');
const clearAllBtn = document.getElementById('clear-all');
const notificationModal = document.getElementById('notificationModal');
const markAsReadModalBtn = document.getElementById('mark-as-read-modal');

// Initialize modal
if (notificationModal) {
    modalInstance = new bootstrap.Modal(notificationModal);
}

// Initialize the page
document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();
    
    // Event listeners
    searchInput.addEventListener('input', debounce(function() {
        searchTerm = this.value;
        currentPage = 1;
        loadNotifications();
    }, 300));
    
    statusFilterSelect.addEventListener('change', function() {
        statusFilter = this.value;
        currentPage = 1;
        loadNotifications();
    });
    
    refreshBtn.addEventListener('click', function() {
        loadNotifications();
        showToast('Notifications refreshed');
    });
    
    markAllReadBtn.addEventListener('click', markAllAsRead);
    clearAllBtn.addEventListener('click', clearAllNotifications);
});

// Load notifications via AJAX
function loadNotifications() {
    if (isLoading) return;
    
    isLoading = true;
    notificationsBody.innerHTML = createSkeletonLoader(5);
    
    const params = new URLSearchParams({
        page: currentPage,
        per_page: perPage,
        search: searchTerm,
        status: statusFilter
    });
    
    fetch(`ajax_helpers/Ajax_get_notifications.php?${params.toString()}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                renderNotifications(data.notifications);
                updatePagination(data.total, data.per_page, data.current_page);
                updateSummary(data.total, data.unread_count);
            } else {
                showError(data.message || 'Failed to load notifications');
            }
        })
        .catch(error => {
            showError(error.message);
            console.error('Error:', error);
        })
        .finally(() => {
            isLoading = false;
        });
}

// Render notifications in the table
function renderNotifications(notifications) {
    if (notifications.length === 0) {
        notificationsBody.innerHTML = `
            <tr>
                <td colspan="4" class="px-6 py-12 text-center">
                    <div class="empty-state animate__animated animate__fadeIn">
                        <div class="bg-gray-100 p-4 rounded-full inline-block mb-3">
                            <i class="far fa-bell text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">No notifications found</h3>
                        <p class="text-gray-500 text-sm">
                            ${searchTerm ? 'No notifications match your search criteria.' : 'All caught up! You have no notifications.'}
                        </p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }
    
    let html = '';
    notifications.forEach(notification => {
        const isUnread = !notification.is_read;
        const statusClass = isUnread ? 'status-unread' : 'status-read';
        const statusText = isUnread ? 'Unread' : 'Read';
        const rowClass = isUnread ? 'unread-row' : '';
        const timeAgo = formatTimeAgo(notification.created_at);
        
        html += `
            <tr class="${rowClass} animate__animated animate__fadeIn" data-id="${notification.id}">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 timestamp" data-label="Time">
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2 text-gray-400"></i>
                        <span title="${new Date(notification.created_at).toLocaleString()}">
                            ${timeAgo}
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900" data-label="Notification">
                    <div class="message-preview font-medium">${escapeHtml(notification.message)}</div>
                    ${notification.related_task_id ? `
                    <div class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-link mr-1"></i> Task ID: ${escapeHtml(notification.related_task_id)}
                    </div>` : ''}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center" data-label="Status">
                    <span class="status-badge ${statusClass}">${statusText}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center action-buttons" data-label="Actions">
                    <div class="flex justify-center gap-2">
                        <button class="view-details action-btn text-blue-500 hover:text-blue-700" 
                                data-id="${notification.id}" 
                                title="View details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="delete-notification action-btn text-red-500 hover:text-red-700" 
                                data-id="${notification.id}" 
                                title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    });
    
    notificationsBody.innerHTML = html;
    
    // Add event listeners to new elements
    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', showNotificationDetails);
    });
    
    document.querySelectorAll('.delete-notification').forEach(btn => {
        btn.addEventListener('click', deleteNotification);
    });
    
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('click', function(e) {
            // Don't trigger if clicking on action buttons
            if (e.target.closest('button')) return;
            
            const notificationId = this.getAttribute('data-id');
            markAsRead(notificationId, this);
        });
    });
}

// Show notification details in modal
function showNotificationDetails(e) {
    e.stopPropagation();
    const notificationId = this.getAttribute('data-id');
    
    // Show loading state
    document.getElementById('notificationDetails').innerHTML = `
        <div class="flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>
    `;
    
    // Show modal
    modalInstance.show();
    
    // Set notification ID on the mark-as-read button
    markAsReadModalBtn.setAttribute('data-id', notificationId);
    
    // Fetch details
    fetch(`ajax_helpers/Ajax_get_notifications.php?id=${notificationId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notification = data.notification;
                const detailsHtml = `
                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Date</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        ${new Date(notification.created_at).toLocaleString()}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <p class="mt-1">
                                        <span class="status-badge ${notification.is_read ? 'status-read' : 'status-unread'}">
                                            ${notification.is_read ? 'Read' : 'Unread'}
                                        </span>
                                    </p>
                                </div>
                                ${notification.read_at ? `
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Read At</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        ${new Date(notification.read_at).toLocaleString()}
                                    </p>
                                </div>` : ''}
                                ${notification.related_task_id ? `
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Related Task</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        ${escapeHtml(notification.related_task_id)}
                                    </p>
                                </div>` : ''}
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Message</h4>
                            <div class="bg-gray-50 p-4 rounded-lg whitespace-pre-wrap text-sm text-gray-800">
                                ${escapeHtml(notification.message)}
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('notificationDetails').innerHTML = detailsHtml;
            } else {
                document.getElementById('notificationDetails').innerHTML = `
                    <div class="bg-red-50 border-l-4 border-red-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    ${data.message || 'Failed to load notification details.'}
                                </p>
                            </div>
                        </div>
                    </div>
                `;
            }
        })
        .catch(error => {
            document.getElementById('notificationDetails').innerHTML = `
                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                Error loading notification: ${error.message}
                            </p>
                        </div>
                    </div>
                </div>
            `;
        });
}

// Mark notification as read
function markAsRead(notificationId, rowElement = null) {
    const formData = new FormData();
    formData.append('id', notificationId);
    
    fetch('ajax_helpers/Ajax_get_notifications.php', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-Action': 'mark-read'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the UI
            if (rowElement) {
                rowElement.classList.remove('unread-row');
                const badge = rowElement.querySelector('.status-badge');
                if (badge) {
                    badge.classList.remove('status-unread');
                    badge.classList.add('status-read');
                    badge.textContent = 'Read';
                }
            }
            
            // Update summary if we're not in a modal
            if (!modalInstance._isShown) {
                updateSummary(data.total_count, data.unread_count);
            }
            
            showToast('Notification marked as read');
        } else {
            showError(data.message || 'Failed to mark as read');
        }
    })
    .catch(error => {
        showError('Error marking as read: ' + error.message);
    });
}

// Mark all notifications as read
function markAllAsRead() {
    if (!confirm('Mark all notifications as read?')) return;
    
    fetch('ajax_helpers/Ajax_get_notifications.php', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-Action': 'mark-all-read'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all rows in the UI
            document.querySelectorAll('.status-badge.status-unread').forEach(badge => {
                badge.classList.remove('status-unread');
                badge.classList.add('status-read');
                badge.textContent = 'Read';
            });
            
            document.querySelectorAll('.unread-row').forEach(row => {
                row.classList.remove('unread-row');
            });
            
            updateSummary(data.total_count, data.unread_count);
            showToast('All notifications marked as read');
        } else {
            showError(data.message || 'Failed to mark all as read');
        }
    })
    .catch(error => {
        showError('Error marking all as read: ' + error.message);
    });
}

// Delete a notification
function deleteNotification(e) {
    e.stopPropagation();
    const notificationId = this.getAttribute('data-id');
    
    if (!confirm('Are you sure you want to delete this notification?')) return;
    
    const formData = new FormData();
    formData.append('id', notificationId);
    
    fetch('ajax_helpers/ajax_get_notification.php', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-Action': 'delete'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the row with animation
            const row = document.querySelector(`tr[data-id="${notificationId}"]`);
            if (row) {
                row.classList.add('animate__animated', 'animate__fadeOut');
                row.addEventListener('animationend', () => {
                    row.remove();
                    
                    // Check if table is now empty
                    if (document.querySelectorAll('#notifications-body tr').length === 0) {
                        renderNotifications([]);
                    }
                });
            }
            
            updateSummary(data.total_count, data.unread_count);
            showToast('Notification deleted');
        } else {
            showError(data.message || 'Failed to delete notification');
        }
    })
    .catch(error => {
        showError('Error deleting notification: ' + error.message);
    });
}

// Clear all notifications
function clearAllNotifications() {
    if (!confirm('Are you sure you want to delete ALL notifications? This cannot be undone.')) return;
    
    fetch('ajax_helpers/ajax_get_notification.php', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-Action': 'clear-all'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show empty state
            renderNotifications([]);
            updateSummary(0, 0);
            showToast('All notifications cleared');
        } else {
            showError(data.message || 'Failed to clear all notifications');
        }
    })
    .catch(error => {
        showError('Error clearing all notifications: ' + error.message);
    });
}

// Update pagination controls
function updatePagination(total, perPage, currentPage) {
    totalPages = Math.ceil(total / perPage);
    currentPage = currentPage || 1;
    
    // Update info text
    const start = (currentPage - 1) * perPage + 1;
    const end = Math.min(currentPage * perPage, total);
    paginationInfo.textContent = total === 0 
        ? 'No notifications' 
        : `Showing ${start} to ${end} of ${total} notifications`;
    
    // Update pagination controls
    let paginationHtml = '';
    
    if (totalPages <= 1) {
        paginationControls.innerHTML = '';
        return;
    }
    
    // Previous button
    paginationHtml += `
        <li class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium ${currentPage === 1 ? 'text-gray-300 cursor-not-allowed' : 'text-gray-500 hover:bg-gray-50'}">
            <a href="#" class="page-link" data-page="${currentPage - 1}" ${currentPage === 1 ? 'onclick="return false;"' : ''}>
                <span class="sr-only">Previous</span>
                <i class="fas fa-chevron-left"></i>
            </a>
        </li>
    `;
    
    // Page numbers
    const maxVisiblePages = 5;
    let startPage, endPage;
    
    if (totalPages <= maxVisiblePages) {
        startPage = 1;
        endPage = totalPages;
    } else {
        const maxPagesBeforeCurrent = Math.floor(maxVisiblePages / 2);
        const maxPagesAfterCurrent = Math.ceil(maxVisiblePages / 2) - 1;
        
        if (currentPage <= maxPagesBeforeCurrent) {
            startPage = 1;
            endPage = maxVisiblePages;
        } else if (currentPage + maxPagesAfterCurrent >= totalPages) {
            startPage = totalPages - maxVisiblePages + 1;
            endPage = totalPages;
        } else {
            startPage = currentPage - maxPagesBeforeCurrent;
            endPage = currentPage + maxPagesAfterCurrent;
        }
    }
    
    // First page and ellipsis if needed
    if (startPage > 1) {
        paginationHtml += `
            <li class="relative inline-flex items-center px-3 py-2 border border-gray-300 bg-white text-sm font-medium ${currentPage === 1 ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50'}">
                <a href="#" class="page-link" data-page="1">1</a>
            </li>
        `;
        
        if (startPage > 2) {
            paginationHtml += `
                <li class="relative inline-flex items-center px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500">
                    <span>...</span>
                </li>
            `;
        }
    }
    
    // Page range
    for (let i = startPage; i <= endPage; i++) {
        paginationHtml += `
            <li class="relative inline-flex items-center px-3 py-2 border border-gray-300 bg-white text-sm font-medium ${currentPage === i ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50'}">
                <a href="#" class="page-link" data-page="${i}">${i}</a>
            </li>
        `;
    }
    
    // Last page and ellipsis if needed
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationHtml += `
                <li class="relative inline-flex items-center px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500">
                    <span>...</span>
                </li>
            `;
        }
        
        paginationHtml += `
            <li class="relative inline-flex items-center px-3 py-2 border border-gray-300 bg-white text-sm font-medium ${currentPage === totalPages ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50'}">
                <a href="#" class="page-link" data-page="${totalPages}">${totalPages}</a>
            </li>
        `;
    }
    
    // Next button
    paginationHtml += `
        <li class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium ${currentPage === totalPages ? 'text-gray-300 cursor-not-allowed' : 'text-gray-500 hover:bg-gray-50'}">
            <a href="#" class="page-link" data-page="${currentPage + 1}" ${currentPage === totalPages ? 'onclick="return false;"' : ''}>
                <span class="sr-only">Next</span>
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>
    `;
    
    paginationControls.innerHTML = `<ul class="flex gap-0">${paginationHtml}</ul>`;
    
    // Add event listeners to pagination links
    document.querySelectorAll('.page-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = parseInt(this.getAttribute('data-page'));
            if (page !== currentPage) {
                currentPage = page;
                loadNotifications();
            }
        });
    });
}

// Update the summary text
function updateSummary(total, unread) {
    const summaryText = total === 0 
        ? 'No notifications' 
        : `${total} notifications (${unread} unread)`;
    document.getElementById('notification-summary').textContent = summaryText;
}

// Show toast notification
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    
    // Set message and icon based on type
    toastMessage.textContent = message;
    
    let iconClass = 'fas fa-check-circle';
    if (type === 'error') iconClass = 'fas fa-exclamation-circle';
    else if (type === 'warning') iconClass = 'fas fa-exclamation-triangle';
    else if (type === 'info') iconClass = 'fas fa-info-circle';
    
    toast.innerHTML = `
        <div class="bg-gray-800 text-white px-4 py-3 rounded-lg shadow-lg flex items-start max-w-xs">
            <div class="flex-shrink-0 mt-1">
                <i class="${iconClass} ${type === 'success' ? 'text-green-400' : type === 'error' ? 'text-red-400' : type === 'warning' ? 'text-yellow-400' : 'text-blue-400'}"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">${message}</p>
            </div>
            <button class="ml-4 text-gray-400 hover:text-white" onclick="this.parentElement.parentElement.classList.add('hidden')">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Show and auto-hide
    toast.classList.remove('hidden');
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 3000);
}

// Show error message
function showError(message) {
    showToast(message, 'error');
}

// Utility function to create skeleton loader
function createSkeletonLoader(rows = 5) {
    let html = '';
    for (let i = 0; i < rows; i++) {
        html += `
            <tr>
                <td class="px-6 py-4 whitespace-nowrap"><div class="skeleton-loader h-4 w-24"></div></td>
                <td class="px-6 py-4">
                    <div class="skeleton-loader h-4 w-full"></div>
                    <div class="skeleton-loader h-3 w-1/2 mt-2"></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center"><div class="skeleton-loader h-4 w-16 mx-auto"></div></td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center gap-2">
                        <div class="skeleton-loader h-6 w-6 rounded-full"></div>
                        <div class="skeleton-loader h-6 w-6 rounded-full"></div>
                    </div>
                </td>
            </tr>
        `;
    }
    return html;
}

// Utility function to escape HTML
function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// Utility function to format time ago
function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);
    
    if (seconds < 60) return `${seconds} seconds ago`;
    
    const minutes = Math.floor(seconds / 60);
    if (minutes < 60) return `${minutes} minute${minutes === 1 ? '' : 's'} ago`;
    
    const hours = Math.floor(minutes / 60);
    if (hours < 24) return `${hours} hour${hours === 1 ? '' : 's'} ago`;
    
    const days = Math.floor(hours / 24);
    if (days < 7) return `${days} day${days === 1 ? '' : 's'} ago`;
    
    const weeks = Math.floor(days / 7);
    if (weeks < 4) return `${weeks} week${weeks === 1 ? '' : 's'} ago`;
    
    return date.toLocaleDateString();
}

// Utility function to debounce
function debounce(func, wait) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(context, args);
        }, wait);
    };
}

// Event listener for modal mark-as-read button
if (markAsReadModalBtn) {
    markAsReadModalBtn.addEventListener('click', function() {
        const notificationId = this.getAttribute('data-id');
        const row = document.querySelector(`tr[data-id="${notificationId}"]`);
        
        markAsRead(notificationId, row);
        modalInstance.hide();
    });
}
</script>