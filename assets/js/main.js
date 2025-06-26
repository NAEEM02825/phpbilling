$(document).ready(function() {
  "use strict";

  /* scrollbar */
  if ($(".notify-list").length) new PerfectScrollbar(".notify-list");
  if ($(".search-content").length) new PerfectScrollbar(".search-content");

  /* enhanced toggle button with error handling */
  function setupToggleButton() {
    const $body = $("body");
    const $sidebarWrapper = $(".sidebar-wrapper");
    
    if ($(".btn-toggle").length === 0 || $body.length === 0 || $sidebarWrapper.length === 0) {
      console.warn("Toggle button or required elements not found");
      return;
    }

    $(".btn-toggle").off("click").on("click", function(e) {
      e.preventDefault();
      
      if ($body.hasClass("toggled")) {
        $body.removeClass("toggled");
        $sidebarWrapper.off("mouseenter mouseleave");
      } else {
        $body.addClass("toggled");
        $sidebarWrapper.on({
          mouseenter: function() {
            $body.addClass("sidebar-hovered");
          },
          mouseleave: function() {
            $body.removeClass("sidebar-hovered");
          }
        });
      }
    });
  }

  /* menu */
  function initMetisMenu() {
    if ($('#sidenav').length) {
      $('#sidenav').metisMenu();
    }
  }

  /* sidebar close */
  $(".sidebar-close").off("click").on("click", function() {
    $("body").removeClass("toggled");
  });

  /* dark mode button */
  $(".dark-mode i").off("click").on("click", function() {
    $(this).text(function(i, v) {
      return v === 'dark_mode' ? 'light_mode' : 'dark_mode';
    });
  });

  $(".dark-mode").off("click").on("click", function() {
    $("html").attr("data-bs-theme", function(i, v) {
      return v === 'dark' ? 'light' : 'dark';
    });
  });

  /* sticky header */
  $(window).on("scroll", function() {
    if ($(this).scrollTop() > 60) {
      $('.top-header .navbar').addClass('sticky-header');
    } else {
      $('.top-header .navbar').removeClass('sticky-header');
    }
  });

  /* email */
  $(".email-toggle-btn").off("click").on("click", function() {
    $(".email-wrapper").toggleClass("email-toggled");
  });
  
  $(".email-toggle-btn-mobile").off("click").on("click", function() {
    $(".email-wrapper").removeClass("email-toggled");
  });
  
  $(".compose-mail-btn").off("click").on("click", function() {
    $(".compose-mail-popup").show();
  });
  
  $(".compose-mail-close").off("click").on("click", function() {
    $(".compose-mail-popup").hide();
  });

  /* chat */
  $(".chat-toggle-btn").off("click").on("click", function() {
    $(".chat-wrapper").toggleClass("chat-toggled");
  });
  
  $(".chat-toggle-btn-mobile").off("click").on("click", function() {
    $(".chat-wrapper").removeClass("chat-toggled");
  });

  /* switcher */
  $("#BlueTheme").off("click").on("click", function() {
    $("html").attr("data-bs-theme", "blue-theme");
  });
  
  $("#LightTheme").off("click").on("click", function() {
    $("html").attr("data-bs-theme", "light");
  });
  
  $("#DarkTheme").off("click").on("click", function() {
    $("html").attr("data-bs-theme", "dark");
  });
  
  $("#SemiDarkTheme").off("click").on("click", function() {
    $("html").attr("data-bs-theme", "semi-dark");
  });
  
  $("#BoderedTheme").off("click").on("click", function() {
    $("html").attr("data-bs-theme", "bodered-theme");
  });

  /* search control */
  $(".search-control").off("click").on("click", function() {
    $(".search-popup").addClass("d-block");
    $(".search-close").addClass("d-block");
  });
  
  $(".search-close").off("click").on("click", function() {
    $(".search-popup").removeClass("d-block");
    $(".search-close").removeClass("d-block");
  });
  
  $(".mobile-search-btn").off("click").on("click", function() {
    $(".search-popup").addClass("d-block");
  });
  
  $(".mobile-search-close").off("click").on("click", function() {
    $(".search-popup").removeClass("d-block");
  });

  /* menu active */
  function setActiveMenu() {
    for (var e = window.location, o = $(".metismenu li a").filter(function() {
      return this.href == e;
    }).addClass("").parent().addClass("mm-active"); o.is("li");) {
      o = o.parent("").addClass("mm-show").parent("").addClass("mm-active");
    }
  }

  /* initialize all components */
  function initComponents() {
    setupToggleButton();
    initMetisMenu();
    setActiveMenu();
  }

  /* document ready handler */
  initComponents();

  /* re-initialize if content is loaded dynamically */
  $(document).on('ajaxComplete', initComponents);
});

/* notification functions */
function showSuccessMessage(message) {
  const successAlert = document.getElementById("successAlert");
  if (successAlert) {
    successAlert.textContent = message;
    successAlert.style.display = "block";
    setTimeout(() => {
      successAlert.style.display = "none";
    }, 3000);
  }
}

function showErrorMessage(message) {
  const errorAlert = document.getElementById("errorAlert");
  if (errorAlert) {
    errorAlert.textContent = message;
    errorAlert.style.display = "block";
    setTimeout(() => {
      errorAlert.style.display = "none";
    }, 3000);
  }
}