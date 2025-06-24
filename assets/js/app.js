$(document).ready(function() {
    // Initialize DataTables
    $('#recentTasksTable, #invoicesTable').DataTable({
        responsive: true,
        dom: '<"top"f>rt<"bottom"lip><"clear">',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search...",
        },
        columnDefs: [
            { orderable: false, targets: -1 } // Disable sorting on last column (actions)
        ]
    });

    // Sidebar toggle functionality
    $('[data-bs-toggle="collapse"]').on('click', function() {
        const target = $(this).attr('href');
        $(target).collapse('toggle');
    });

    // Active link highlighting
    const currentPage = window.location.pathname.split('/').pop();
    $('.nav-link').each(function() {
        const linkPage = $(this).attr('href').split('/').pop();
        if (linkPage === currentPage || 
            (currentPage.includes('tasks') && linkPage.includes('tasks')) ||
            (currentPage.includes('invoices') && linkPage.includes('invoices')) ||
            (currentPage.includes('payments') && linkPage.includes('payments'))) {
            $(this).addClass('active');
            $(this).closest('.collapse').addClass('show');
        }
    });

    // Tooltip initialization
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Show manager sections if user is manager
    if ($('body').hasClass('role-manager')) {
        $('.manager-only').show();
    }

    // Confirm before delete actions
    $('.confirm-delete').on('click', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this item?')) {
            window.location.href = $(this).attr('href');
        }
    });

    // Toast notifications
    if ($('#toastNotification').length) {
        const toast = new bootstrap.Toast($('#toastNotification')[0]);
        toast.show();
    }
});

// Function to show loading spinner
function showLoading() {
    $('#loadingSpinner').removeClass('d-none');
}

// Function to hide loading spinner
function hideLoading() {
    $('#loadingSpinner').addClass('d-none');
}

// AJAX error handler
$(document).ajaxError(function(event, jqxhr, settings, thrownError) {
    hideLoading();
    alert('An error occurred: ' + jqxhr.responseText);
});

