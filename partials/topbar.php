<!-- ========== Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="index.php" class="logo-light">
                    <img src="assets/images/logo-light.png" alt="logo" class="logo-lg">
                    <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.php" class="logo-dark">
                    <img src="assets/images/logo-dark.png" alt="dark logo" class="logo-lg">
                    <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Dropdown Menu -->
            <div class="dropdown d-none d-xl-block">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    Pintasan
                    <i class="mdi mdi-chevron-down ms-1"></i>
                </a>
                <div class="dropdown-menu">
                    <!-- item-->
                    <a href="?page=penjualan" class="dropdown-item">
                        <i class="fe-briefcase me-1"></i>
                        <span>Penjualan</span>
                    </a>

                    <!-- item-->
                    <a href="?page=pembelian" class="dropdown-item">
                        <i class="fe-user me-1"></i>
                        <span>Pembelian</span>
                    </a>


                </div>
            </div>


        </div>

        <ul class="topbar-menu d-flex align-items-center">


            <!-- Fullscreen Button -->
            <li class="d-none d-md-inline-block">
                <a class="nav-link waves-effect waves-light" href="" data-toggle="fullscreen">
                    <i class="fe-maximize font-22"></i>
                </a>
            </li>

            <!-- Search Dropdown (for Mobile/Tablet) -->
            <li class="dropdown d-lg-none">
                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-search-line font-22"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..."
                            aria-label="Recipient's username">
                    </form>
                </div>
            </li>


            <!-- Light/Dark Mode Toggle Button -->
            <li class="d-none d-sm-inline-block">
                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li>

            <!-- User Dropdown -->
            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="ms-1 d-none d-md-inline-block">
                        <?php echo $_SESSION['nama_user']; ?> <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">


                    <!-- item-->
                    <a href="logout.php" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

            <!-- Right Bar offcanvas button (Theme Customization Panel) -->
            <li>
                <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas"
                    href="#theme-settings-offcanvas">
                    <i class="fe-settings font-22"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->