<!--start header-->
<header class="top-header">
    <nav class="navbar navbar-expand align-items-center gap-4">
        <div class="btn-toggle">
            <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
        </div>

        <ul class="navbar-nav gap-1 nav-right-links align-items-center ms-auto">
            <li class="nav-item dropdown ns-auto">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                    data-bs-toggle="dropdown">
                    <img id="selectedLangImg" src="assets/images/county/02.png" width="22" alt="">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 <?= (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') ? 'active' : ''; ?>" href="javascript:;"
                            onclick="setActive(this)" data-lang="en">
                            <img src="assets/images/county/02.png" width="20" alt="">
                            <span class="ms-2">English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 <?= (isset($_SESSION['lang']) && $_SESSION['lang'] == 'es') ? 'active' : ''; ?>" href="javascript:;"
                            onclick="setActive(this)" data-lang="es">
                            <img src="assets/images/county/09.png" width="20" alt="">
                            <span class="ms-2">Español</span>
                        </a>
                    </li>
                </ul>
            </li>
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
            <!-- <li class="nav-item dropdown ns-auto">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
                    data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22" alt="">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                src="assets/images/county/01.png" width="20" alt=""><span
                                class="ms-2">English</span></a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                                src="assets/images/county/09.png" width="20" alt=""><span
                                class="ms-2">Espenol</span></a>
                    </li>
                </ul>
            </li> -->

            <li class="nav-item dropdown">
                <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <img src="https://placehold.co/110x110/png" class="rounded-circle p-1 border" width="45" height="45"
                        alt="">
                </a>
                <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                    <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                        <div class="text-center">
                            <h5 class="user-name mb-0 fw-bold">Hi,
                                <?=(isset($_SESSION['user_name']))? ucfirst($_SESSION['user_name']): 'User'?></h5>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                        href="index.php?route=modules/profile/profile"><i
                            class="material-icons-outlined">person_outline</i>Profile</a>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined">local_bar</i>Setting</a>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined">dashboard</i>Dashboard</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="index.php?logout=1"><i
                            class="material-icons-outlined">power_settings_new</i>Logout</a>
                </div>
            </li>
        </ul>

    </nav>
</header>
<!--end top header-->