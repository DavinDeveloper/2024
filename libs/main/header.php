<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<? echo cfg(url); ?>assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><? echo cfg(nama); ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<? echo cfg(logo); ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/css/demo.css" />
	<link rel="stylesheet" href="<? echo cfg(url); ?>assets/table/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/table/Buttons-1.5.6/css/buttons.bootstrap4.min.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<? echo cfg(url); ?>assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<? echo cfg(url); ?>assets/vendor/js/helpers.js"></script>

    <script src="<? echo cfg(url); ?>assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="<? echo cfg(url); ?>" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="<? echo cfg(logo); ?>" height="30px">
              </span>
              <span class="demo menu-text fw-bolder ms-2"><? echo cfg(nama); ?></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="<? echo cfg(url); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <?
            include cfg(path).'ketua/header.php';
            include cfg(path).'bendahara/header.php';
            include cfg(path).'anggota/header.php';
            ?>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <!--<i class="bx bx-search fs-4 lh-0"></i>-->
                  <!--<input-->
                  <!--  type="text"-->
                  <!--  class="form-control border-0 shadow-none"-->
                  <!--  placeholder="Search..."-->
                  <!--  aria-label="Search..."-->
                  <!--/>-->
                  <b><? echo cfg(nama); ?></b>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<? echo cfg(logo); ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<? echo cfg(logo); ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><? echo $user['nama']; ?></span>
                            <small class="text-muted"><? echo $user['status']; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <? if ($user['status'] == 'Anggota' AND $user['pinjaman'] == 'Disetujui') { ?>
                    <li>
                      <a class="dropdown-item" href="<? echo cfg(url); ?>auth/kartu">
                        <i class="bx bx-collection me-2"></i>
                        <span class="align-middle">Kartu Anggota</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <? } ?>
                    <li>
                      <a class="dropdown-item" href="<? echo cfg(url); ?>auth/pengaturan">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Pengaturan</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<? echo cfg(url); ?>auth/keluar">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Keluar</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->