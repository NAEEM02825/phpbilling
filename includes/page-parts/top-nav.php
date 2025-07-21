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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.3/dist/heic2any.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .notification-badge {
    position: absolute;
    top: 5px;
    right: 0;
    background: #04665F;
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
.dropdown-footer .btn {
  padding: 0.5rem;
  font-size: 0.875rem;
  background-color: #04665F;
  color: white;
  border: none;
}

.dropdown-footer .btn:hover {
  background-color: #03524d;
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

  .dropdown-footer {
    background-color: #f8f9fa;
  }

  .dropdown-footer .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
  }
</style>
<!--start header-->
<header class="top-header">
  <nav class="navbar navbar-expand align-items-center gap-4">
    <div class="btn-toggle">
      <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
    </div>






    <ul class="navbar-nav gap-1 nav-right-links align-items-center ms-auto">

      <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>

        <!-- Notifications Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;" data-bs-toggle="dropdown">
            <i class="material-icons-outlined">notifications</i>
            <span class="notification-badge"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-notifications shadow">
            <div class="dropdown-header">
              <h6 class="mb-0">Notifications</h6>
            </div>
            <div id="notification-list-wrapper" style="max-height: 400px; overflow-y: auto;">

              <div class="dropdown-body" id="notification-list">
                <!-- Notifications will be loaded here via JavaScript -->
              </div>
            </div>


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
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="notificationModalBody">
        Loading notification details...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!--end top header-->
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
  // Move these functions to global scope
  function loadNotifications() {
    fetch('ajax_helpers/get_notifications.php')
      .then(response => response.json())
      .then(data => {
        const container = document.getElementById('notification-list');
        const badge = document.querySelector('.notification-badge');

        container.innerHTML = ''; // Clear previous

        // Handle badge display
        if (data.unread_count > 0) {
          badge.textContent = data.unread_count;
          badge.style.display = 'inline-block';
        } else {
          badge.style.display = 'none';
        }

        // No notifications
        if (!data.notifications || data.notifications.length === 0) {
          container.innerHTML = `
          <div class="px-3 py-2 text-center text-muted small">
            No notifications yet.
          </div>`;
          return;
        }

        // Separate unread and read notifications
        const unread = data.notifications.filter(item => item.is_read === "0");
        const read = data.notifications.filter(item => item.is_read !== "0");

        // Section: Unread
        if (unread.length > 0) {
          container.innerHTML += `
          <div class="dropdown-header text-dark fw-bold px-3 py-1 small">
            New
          </div>`;

          unread.forEach(item => {
            container.innerHTML += `
            <a href="#" class="dropdown-item d-flex align-items-center gap-3 py-2 bg-light border-bottom" data-id="${item.id}">
              <div class="icon-box bg-light-info rounded-circle p-2">
                <i class="material-icons-outlined text-info">notifications</i>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1 fw-semibold">${item.message}</h6>
                ${item.related_task_id ? `<p class="small text-muted mb-0">Task #${item.related_task_id}</p>` : ''}
              </div>
            </a>`;
          });
        }

        // Section: Read
        if (read.length > 0) {
          container.innerHTML += `
          <div class="dropdown-header text-muted fw-bold px-3 py-1 small mt-2">
            Earlier
          </div>`;

          read.forEach(item => {
            container.innerHTML += `
            <a href="#" class="dropdown-item d-flex align-items-center gap-3 py-2 border-bottom" data-id="${item.id}">
              <div class="icon-box bg-light-secondary rounded-circle p-2">
                <i class="material-icons-outlined text-secondary">notifications</i>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1">${item.message}</h6>
                ${item.related_task_id ? `<p class="small text-muted mb-0">Task #${item.related_task_id}</p>` : ''}
              </div>
            </a>`;
          });
        }
const footer = document.createElement('div');
footer.className = 'dropdown-footer text-center p-2 border-top';
footer.innerHTML = `
  <button onclick="viewAllNotifications()" class="btn btn-sm btn-primary w-100">
    View All Notifications
  </button>`;
container.appendChild(footer);
      })
      .catch(error => {
        console.error('Error fetching notifications:', error);
        document.getElementById('notification-list').innerHTML = `
        <p class="text-muted px-3">Unable to load notifications.</p>`;
      });
  }

  function viewAllNotifications() {
    window.location.href = 'index.php?route=modules/notifications/notifications';
  }

  function setupNotificationClickHandlers() {
    document.getElementById('notification-list').addEventListener('click', async function(e) {
      const notificationItem = e.target.closest('.dropdown-item[data-id]');
      if (notificationItem) {
        e.preventDefault();
        const notificationId = notificationItem.getAttribute('data-id');

        if (!notificationId || notificationId === 'undefined') {
          console.error('Notification ID is undefined');
          return;
        }

        // Show loading state
        document.getElementById('notificationModalBody').innerHTML = `
        <div class="text-center py-3">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <p class="mt-2">Loading notification details...</p>
        </div>`;

        const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
        modal.show();

        try {
          // 1. First fetch the single notification details
          const singleResponse = await fetch(`ajax_helpers/single_notification.php?id=${encodeURIComponent(notificationId)}`);
          if (!singleResponse.ok) throw new Error('Network response was not ok');
          const singleData = await singleResponse.json();

          if (!singleData.success) throw new Error(singleData.message || 'Failed to load notification');

          // 2. Update modal content immediately
          document.getElementById('notificationModalBody').innerHTML = `
          <div class="d-flex gap-3 mb-3">
            <div class="icon-box bg-light-${singleData.is_read ? 'secondary' : 'info'} rounded-circle p-2">
              <i class="material-icons-outlined text-${singleData.is_read ? 'secondary' : 'info'}">notifications</i>
            </div>
            <div>
              <h6 class="mb-1">${singleData.message}</h6>
              <small class="text-muted">${singleData.created_at}</small>
            </div>
          </div>
          ${singleData.details ? `<p class="mb-0">${singleData.details}</p>` : ''}`;


          // 3. If unread, mark as read (don't wait for this to complete)
          if (!singleData.is_read) {
            markNotificationAsRead(notificationId).then(() => {
              // 4. Only refresh notifications after marking as read completes
              loadNotifications();
            });
          }

        } catch (error) {
          console.error('Error:', error);
          document.getElementById('notificationModalBody').innerHTML = `
          <div class="alert alert-danger">${error.message || 'Error loading notification details.'}</div>`;
        }
      }
    });
  }

  // Updated markNotificationAsRead to return a Promise
  function markNotificationAsRead(notificationId) {
    return fetch('ajax_helpers/mark_notifications_read.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${notificationId}`
      })
      .then(response => response.json())
      .catch(error => {
        console.error('Error:', error);
        return {
          success: false
        };
      });
  }
  // Single DOMContentLoaded listener
  document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();
    setupNotificationClickHandlers();
    setInterval(loadNotifications, 60000); // Auto-refresh every 60s
  });
</script>