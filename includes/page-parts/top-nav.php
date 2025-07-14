<?php

if (isset($_SESSION['user_id'])) {
  try {
    $user = DB::queryFirstRow(
      "SELECT picture, role_id FROM users WHERE user_id = %i",
      $_SESSION['user_id']
    );

    if ($user) {
      $_SESSION['role_id'] = $user['role_id']; // Store role in session
      if (!empty($user['picture'])) {
        $userImage = $user['picture'];
      }
    }
  } catch (Exception $e) {
    error_log("Profile image error: " . $e->getMessage());
  }
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .notification-badge {
    position: absolute;
    top: 5px;
    right: 0;
    background: red;
    color: white;
    border-radius: 50%;
    font-size: 12px;
    padding: 2px 6px;
    display: none;
    /* default hidden */
  }

  .dropdown-notifications .dropdown-item {
    background-color: white !important;
  }

  .dropdown-notifications .dropdown-item.bg-light {
    background-color: #f8f9fa !important;
    /* Slightly off-white for unread items if you want distinction */
  }

  @media (max-width: 575.98px) {
    .dropdown-notifications {
      width: 280px;
      position: fixed !important;
      left: 50% !important;
      transform: translateX(-50%) !important;
      top: 60px !important;
    }

    .dropdown-notifications .dropdown-item {
      white-space: normal !important;
      padding: 10px 15px !important;
    }

    #notification-list-wrapper {
      max-height: 60vh !important;
      /* Use viewport height units */
    }

    .notification-badge {
      top: 0;
      right: -5px;
    }
  }
</style>
<style>
  .view-all-btn {
    display: block;
    text-align: center;
    padding: 8px;
    background: #f8f9fa;
    border-top: 1px solid #eee;
    color: #0d6efd;
    font-weight: 500;
  }

  .view-all-btn:hover {
    background: #e9ecef;
    text-decoration: none;
  }

  .notification-time {
    font-size: 12px;
    color: #6c757d;
    margin-top: 4px;
  }

  .notification-item {
    transition: background-color 0.2s;
  }

  .notification-item:hover {
    background-color: #f8f9fa !important;
  }
</style>
<!--start header-->
<header class="top-header">
  <nav class="navbar navbar-expand align-items-center gap-4">
    <div class="btn-toggle">
      <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
    </div>
    <ul class="navbar-nav gap-1 nav-right-links align-items-center ms-auto">

      <!-- Modify the notifications dropdown section -->
      <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;" data-bs-toggle="dropdown" id="notificationsDropdown">
            <i class="material-icons-outlined">notifications</i>
            <span class="notification-badge"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-notifications shadow">
            <div class="dropdown-header d-flex justify-content-between align-items-center">
              <h6 class="mb-0">Notifications</h6>
              <a href="index.php?route=modules/admin_notifications" class="text-primary small">View All</a>
            </div>
            <div id="notification-list-wrapper" style="max-height: 400px; overflow-y: auto;">
              <div class="dropdown-body" id="notification-list">
                <!-- Loading spinner -->
                <div class="text-center py-3">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </div>
              </div>
            </div>
            <a href="index.php?route=modules/admin_notifications" class="view-all-btn">View All Notifications</a>
          </div>
        </li>
      <?php endif; ?>

      <li class="nav-item dropdown ns-auto">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
          <img id="selectedLangImg" src="assets/images/county/02.png" width="22" alt="">
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item d-flex align-items-center py-2 <?= (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') ? 'active' : ''; ?>"
              href="javascript:;" onclick="setActive(this)" data-lang="en">
              <img src="assets/images/county/02.png" width="20" alt="">
              <span class="ms-2">English</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center py-2 <?= (isset($_SESSION['lang']) && $_SESSION['lang'] == 'es') ? 'active' : ''; ?>"
              href="javascript:;" onclick="setActive(this)" data-lang="es">
              <img src="assets/images/county/09.png" width="20" alt="">
              <span class="ms-2">Español</span>
            </a>
          </li>
        </ul>
      </li>

      <div class="notify-list">
        <div class="card-body search-content">
        </div>
      </div>

      <li class="nav-item dropdown">
        <a href="javascript:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
          <?php
          // Start the session at the very beginning
          if (session_status() === PHP_SESSION_NONE) {
            session_start();
          }

          $defaultImage = 'https://placehold.co/110x110/png';
          $userImage = $defaultImage;

          if (isset($_SESSION['user_id'])) {
            try {
              // Get user data from database using MeekroDB
              $user = DB::queryFirstRow(
                "SELECT picture FROM users WHERE user_id = %i",
                $_SESSION['user_id']
              );

              if ($user && !empty($user['picture'])) {
                // Assuming the path in the database is relative to your web root
                $userImage = $user['picture'];
              }
            } catch (Exception $e) {
              error_log("Profile image error: " . $e->getMessage());
            }
          }
          ?>
          <div class="position-relative">
            <img src="<?= htmlspecialchars($userImage) ?>"
              class="rounded-circle border-2 border-white"
              width="40"
              height="40"
              alt="Profile Picture"
              onerror="this.onerror=null;this.src='<?= htmlspecialchars($defaultImage) ?>'">
            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width: 10px; height: 10px;"></span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end p-0 shadow-lg" style="min-width: 250px; border: none;">
          <div class="bg-primary text-white p-3 rounded-top">
            <div class="d-flex align-items-center gap-3">
              <img src="<?= htmlspecialchars($userImage) ?>"
                class="rounded-circle border border-2 border-white"
                width="60"
                height="60"
                alt="Profile Picture"
                onerror="this.onerror=null;this.src='<?= htmlspecialchars($defaultImage) ?>'">
              <div>
                <h6 class="mb-0 fw-semibold text-truncate" style="max-width: 160px;"><?= ucfirst($_SESSION['user_name']) ?></h6>
                <small class="opacity-75"><?= $_SESSION['user_email'] ?? '' ?></small>
              </div>
            </div>
          </div>

          <div class="p-2">
            <a class="dropdown-item d-flex align-items-center gap-3 px-3 py-2 rounded-2"
              href="index.php?route=modules/profile/profile">
              <div class="icon-box bg-light-primary rounded-circle p-2">
                <i class="material-icons-outlined text-primary">person_outline</i>
              </div>
              <div>
                <h6 class="mb-0">Profile</h6>
                <small class="text-muted">View your profile</small>
              </div>
            </a>

            <a class="dropdown-item d-flex align-items-center gap-3 px-3 py-2 rounded-2"
              href="index.php?route=modules/settings">
              <div class="icon-box bg-light-warning rounded-circle p-2">
                <i class="material-icons-outlined text-warning">settings</i>
              </div>
              <div>
                <h6 class="mb-0">Settings</h6>
                <small class="text-muted">Account settings</small>
              </div>
            </a>
          </div>

          <div class="dropdown-divider m-0"></div>

          <div class="p-2">
            <a class="dropdown-item d-flex align-items-center gap-3 px-3 py-2 rounded-2 text-danger"
              href="index.php?logout=1">
              <div class="icon-box bg-light-danger rounded-circle p-2">
                <i class="material-icons-outlined text-danger">power_settings_new</i>
              </div>
              <div>
                <h6 class="mb-0">Logout</h6>
                <small class="text-muted">Sign out from system</small>
              </div>
            </a>
          </div>
        </div>
      </li>
    </ul>

  </nav>
</header>
<!-- Notification Details Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalTitle">Notification Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="notificationModalBody">
        Loading notification details...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="notificationActionBtn" style="display:none;">View Details</button>
      </div>
    </div>
  </div>
</div>
<!--end top header-->

<script>
          // Load notifications when dropdown is shown
          document.getElementById('notificationsDropdown').addEventListener('shown.bs.dropdown', function() {
            loadNotifications();
          });

          // Also load notifications on page load if dropdown is open by default
          if (document.querySelector('.dropdown-notifications.show')) {
            loadNotifications();
          }
        </script>
<script>
  function setActive(selectedItem) {
    // Remove 'active' class from all dropdown items
    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.classList.remove('active');
    });


    // Active selected item
    selectedItem.classList.add('active');


    // Get selected item language
    let selectedLang = selectedItem.getAttribute('data-lang');


    // Get selected item image
    let selectedImgSrc = selectedItem.querySelector("img").src;


    // Update dropdown image
    document.getElementById("selectedLangImg").src = selectedImgSrc;


    // Update URL with lang parameter and reload the page
    let url = new URL(window.location.href);
    url.searchParams.set('lang', selectedLang); // Add or update lang parameter
    window.location.href = url.toString(); // Redirect to updated URL
  }


  window.addEventListener('DOMContentLoaded', function() {
    let url = new URL(window.location.href);
    let lang = url.searchParams.get('lang'); // Get lang parameter from URL


    // Remove 'active' class from all dropdown items
    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.classList.remove('active');
    });


    if (lang) {
      // Find the matching dropdown item
      let selectedItem = document.querySelector(`.dropdown-item[data-lang="${lang}"]`);


      if (selectedItem) {
        // Get selected image src
        let selectedImgSrc = selectedItem.querySelector("img").src;


        // Update dropdown image
        document.getElementById("selectedLangImg").src = selectedImgSrc;


        // Mark selected item as active
        selectedItem.classList.add('active');
      }
    }
  });
</script>
<script>
  function loadNotifications() {
    fetch('ajax_helpers/get_notifications.php')
      .then(response => response.json())
      .then(data => {
        const container = document.getElementById('notification-list');
        const badge = document.querySelector('.notification-badge');

        container.innerHTML = ''; // Clear previous

        // Handle badge display
        if (data.unread_count > 0) {
          badge.textContent = data.unread_count > 9 ? '9+' : data.unread_count;
          badge.style.display = 'inline-block';
        } else {
          badge.style.display = 'none';
        }

        // No notifications
        if ((!data.unread || data.unread.length === 0) && (!data.read || data.read.length === 0)) {
          container.innerHTML = `
          <div class="px-3 py-2 text-center text-muted small">
            No notifications yet.
          </div>`;
          return;
        }

        // Section: Unread
        if (data.unread && data.unread.length > 0) {
          container.innerHTML += `
          <div class="dropdown-header text-dark fw-bold px-3 py-1 small">
            New
          </div>`;

          data.unread.forEach(item => {
            const message = item.message || getDefaultMessage(item);
            const icon = getNotificationIcon(item.type);

            container.innerHTML += `
            <a href="javascript:;" onclick="handleNotificationClick(${item.id}, '${item.type}')" 
               class="dropdown-item notification-item d-flex align-items-center gap-3 py-2 bg-light">
              <div class="icon-box bg-light-primary rounded-circle p-2">
                ${icon}
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1 fw-semibold">${message}</h6>
                <p class="notification-time">${formatTimeAgo(item.created_at)}</p>
              </div>
            </a>`;
          });
        }

        // Section: Read
        if (data.read && data.read.length > 0) {
          container.innerHTML += `
          <div class="dropdown-header text-muted fw-bold px-3 py-1 small mt-2">
            Earlier
          </div>`;

          data.read.forEach(item => {
            const message = item.message || getDefaultMessage(item);
            const icon = getNotificationIcon(item.type);

            container.innerHTML += `
            <a href="javascript:;" onclick="handleNotificationClick(${item.id}, '${item.type}')" 
               class="dropdown-item notification-item d-flex align-items-center gap-3 py-2">
              <div class="icon-box bg-light-secondary rounded-circle p-2">
                ${icon}
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">${message}</h6>
                <p class="notification-time">${formatTimeAgo(item.created_at)}</p>
              </div>
            </a>`;
          });
        }
      })
      .catch(error => {
        console.error('Error fetching notifications:', error);
        document.getElementById('notification-list').innerHTML = `
        <div class="alert alert-danger mx-2 my-2 py-1 small">
          Unable to load notifications. <a href="javascript:location.reload()">Try again</a>
        </div>`;
      });
  }

  // Helper functions
  function getDefaultMessage(item) {
    switch (item.type) {
      case 'new_user':
        return 'New user registered';
      case 'application':
        return 'New application submitted';
      case 'payment':
        return 'New payment received';
      default:
        return 'New notification';
    }
  }

  function getNotificationIcon(type) {
    switch (type) {
      case 'new_user':
        return '<i class="material-icons-outlined text-success">person_add</i>';
      case 'application':
        return '<i class="material-icons-outlined text-info">assignment</i>';
      case 'payment':
        return '<i class="material-icons-outlined text-success">payments</i>';
      default:
        return '<i class="material-icons-outlined text-primary">notifications</i>';
    }
  }

  function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);

    if (diffInSeconds < 60) return 'Just now';
    if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)}m ago`;
    if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)}h ago`;
    return `${Math.floor(diffInSeconds / 86400)}d ago`;
  }

  function showNotificationDetails(notificationId, source) {
    // Close the dropdown if open
    const dropdown = document.querySelector('.dropdown-notifications');
    if (dropdown) {
      const bsDropdown = bootstrap.Dropdown.getInstance(dropdown);
      if (bsDropdown) {
        bsDropdown.hide();
      }
    }

    // Show loading state
    const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
    document.getElementById('notificationModalTitle').textContent = 'Loading...';
    document.getElementById('notificationModalBody').innerHTML = `
    <div class="text-center py-4">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>`;
    document.getElementById('notificationActionBtn').style.display = 'none';
    modal.show();

    // Fetch notification details
    fetch(`ajax_helpers/get_notification.php?id=${notificationId}&source=${source}`)
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Update modal with notification details
          document.getElementById('notificationModalTitle').textContent = data.notification.title;

          let detailsHtml = `
          <div class="mb-3">
            <p class="mb-1">${data.notification.message}</p>
            <small class="text-muted">${new Date(data.notification.created_at).toLocaleString()}</small>
          </div>`;

          if (data.notification.details) {
            detailsHtml += `<div class="alert alert-light">${data.notification.details}</div>`;
          }

          if (data.notification.user_name) {
            detailsHtml += `<div class="text-muted small">From: ${data.notification.user_name}</div>`;
          }

          document.getElementById('notificationModalBody').innerHTML = detailsHtml;

          // Show action button if there's a link
          const actionBtn = document.getElementById('notificationActionBtn');
          if (data.notification.link) {
            actionBtn.style.display = 'inline-block';
            actionBtn.textContent = data.notification.link_text || 'View Details';
            actionBtn.onclick = function() {
              window.location.href = data.notification.link;
            };
          } else {
            actionBtn.style.display = 'none';
          }
        } else {
          document.getElementById('notificationModalBody').innerHTML = `
          <div class="alert alert-danger">${data.error || 'Failed to load notification details'}</div>`;
        }
      })
      .catch(error => {
        document.getElementById('notificationModalBody').innerHTML = `
        <div class="alert alert-danger">Error loading notification details. Please try again.</div>`;
        console.error('Error:', error);
      });
  }function handleNotificationClick(id, type) {
  // Mark as read immediately
  fetch(`ajax_helpers/mark_notification_read.php?id=${id}`)
    .catch(error => console.error('Error marking notification read:', error));
  
  // Determine the source based on type
  let source = 'general';
  if (type === 'application') {
    source = 'applicants';
  } else if (type === 'new_user') {
    source = 'users';
  }
  
  showNotificationDetails(id, source);
}
</script>