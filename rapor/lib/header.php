<?php
error_reporting(0);

$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$sess_username'");
$data_user = mysqli_fetch_assoc($check_user);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Untuk Chrome & Opera -->
  <meta name="theme-color" content="#357ffa"/>
  <!-- Untuk Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#357ffa"/>
  <!-- Untuk Safari iOS -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#357ffa"/>
  <meta name="description" content="Davin Wardana">
  <meta name="author" content="Davin Wardana">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo $cfg_webname; ?></title>
  <!-- Iconic Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $cfg_baseurl; ?>vendors/iconic-fonts/flat-icons/flaticon.css">
  <!-- Bootstrap core CSS -->
  <link rel="shortcut icon" href="<?php echo $cfg['logo']; ?>">
  <link href="<?php echo $home; ?>assets/panel/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery UI -->
  <link href="<?php echo $home; ?>assets/panel/css/jquery-ui.min.css" rel="stylesheet">
  <!-- Mystic styles -->
  <link href="<?php echo $home; ?>assets/panel/css/first.css" rel="stylesheet">
  <!-- Page Specific Css (Datatables.css) -->
  <link href="<?php echo $home; ?>assets/panel/css/datatables.min.css" rel="stylesheet">
  <link href="<?php echo $home; ?>assets/panel/css/icons.css" rel="stylesheet" type="text/css">
  <!-- Page Specific CSS (Morris Charts.css) -->
  <link href="<?php echo $home; ?>assets/panel/css/morris.css" rel="stylesheet">
  <link href="<?php echo $home; ?>assets/panel/plugins/morris/morris.css" rel="stylesheet" />
  <script src="<?php echo $home; ?>assets/panel/plugins/morris/morris.min.js"></script>
  <script src="<?php echo $home; ?>assets/panel/plugins/raphael/raphael-min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <!-- Favicon -->

</head>

<body class="ms-body ms-aside-left-open ms-primary-theme">
<!--<body class="ms-body ms-aside-left-open ms-dark-theme">-->

  <!-- Preloader -->
  <div id="preloader-wrap">
    <div class="spinner spinner-8">
      <div class="ms-circle1 ms-child"></div>
      <div class="ms-circle2 ms-child"></div>
      <div class="ms-circle3 ms-child"></div>
      <div class="ms-circle4 ms-child"></div>
      <div class="ms-circle5 ms-child"></div>
      <div class="ms-circle6 ms-child"></div>
      <div class="ms-circle7 ms-child"></div>
      <div class="ms-circle8 ms-child"></div>
      <div class="ms-circle9 ms-child"></div>
      <div class="ms-circle10 ms-child"></div>
      <div class="ms-circle11 ms-child"></div>
      <div class="ms-circle12 ms-child"></div>
    </div>
  </div>

  <!-- Overlays -->
  <div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
  <div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight"></div>

  <!-- Sidebar Navigation Left -->
  <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
<br><br><br><br>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
      <!-- Dashboard -->
        <li class="menu-item">
          <a href="<?php echo $home; ?>">
            <span><i class="material-icons fs-16">apps</i>Main Page</span>
          </a>
        </li>
      <?php if (isset($_SESSION['user'])) {
      ?>
        <li class="menu-item">
          <a href="<?php echo $cfg_baseurl; ?>">
            <span><i class="material-icons fs-16">airplay</i>Dashboard</span>
          </a>
        </li>
        <?php
        if ($data_user['status'] == "Siswa") {
        ?>
          <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#siswa" aria-expanded="false" aria-controls="siswa">
              <span><i class="material-icons fs-16">account_box</i>Menu Siswa</span>
            </a>
            <ul id="siswa" class="collapse" aria-labelledby="siswa">
              <li><a href="#" class="has-chevron" data-toggle="collapse" data-target="#rapor-pts" aria-expanded="false" aria-controls="rapor-pts">Rapor PTS</a></li>
              <ul id="rapor-pts" class="collapse" aria-labelledby="rapor-pts" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_user['nomor']; ?>/1" target="_BLANK">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_user['nomor']; ?>/2" target="_BLANK">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_user['nomor']; ?>/3" target="_BLANK">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_user['nomor']; ?>/4" target="_BLANK">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_user['nomor']; ?>/5" target="_BLANK">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pts/<?php echo $data_user['nomor']; ?>/6" target="_BLANK">Semester 6</a></li>
              </ul>
              <li><a href="#" class="has-chevron" data-toggle="collapse" data-target="#rapor-pas" aria-expanded="false" aria-controls="rapor-pas">Rapor PAS</a></li>
              <ul id="rapor-pas" class="collapse" aria-labelledby="rapor-pas" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_user['nomor']; ?>/1" target="_BLANK">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_user['nomor']; ?>/2" target="_BLANK">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_user['nomor']; ?>/3" target="_BLANK">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_user['nomor']; ?>/4" target="_BLANK">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_user['nomor']; ?>/5" target="_BLANK">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pas/<?php echo $data_user['nomor']; ?>/6" target="_BLANK">Semester 6</a></li>
              </ul>
            </ul>
            </ul>
          </li>
        <?php
        }
        ?>
        <?php 
        if ($data_user['status'] == 'Admin') {
        ?>
        <li class="menu-item">
          <a href="<?php echo $cfg_baseurl; ?>admin/kop">
            <span><i class="material-icons fs-16">airplay</i>Kop Rapor</span>
          </a>
        </li>
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#pengguna" aria-expanded="false" aria-controls="pengguna">
              <span><i class="material-icons fs-16">account_box</i>Kelola Pengguna</span>
            </a>
            <ul id="pengguna" class="collapse" aria-labelledby="pengguna" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>admin/guru">Guru</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>admin/siswa">Siswa</a></li>
            </ul>
          </li>
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#pelajaran" aria-expanded="false" aria-controls="pelajaran">
              <span><i class="material-icons fs-16">account_box</i>Kelola Pelajaran</span>
            </a>
            <ul id="pelajaran" class="collapse" aria-labelledby="pelajaran" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>admin/pelajaran/umum">Umum</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>admin/pelajaran/jurusan">Jurusan</a></li>
            </ul>
          </li>
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#kelasjurusan" aria-expanded="false" aria-controls="kelasjurusan">
              <span><i class="material-icons fs-16">account_box</i>Kelas & Jurusan</span>
            </a>
            <ul id="kelasjurusan" class="collapse" aria-labelledby="kelasjurusan" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>admin/kelas">Kelas</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>admin/jurusan">Jurusan</a></li>
            </ul>
          </li>
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#ptsc" aria-expanded="false" aria-controls="ptsc">
              <span><i class="material-icons fs-16">account_box</i>Kelola Rapor PTS</span>
            </a>
            <ul id="ptsc" class="collapse" aria-labelledby="ptsc" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>ptsc/1">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>ptsc/2">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>ptsc/3">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>ptsc/4">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>ptsc/5">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>ptsc/6">Semester 6</a></li>
            </ul>
          </li>
        <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#pasc" aria-expanded="false" aria-controls="pasc">
              <span><i class="material-icons fs-16">account_box</i>Kelola Rapor PAS</span>
            </a>
            <ul id="pasc" class="collapse" aria-labelledby="pasc" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>pasc/1">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pasc/2">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pasc/3">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pasc/4">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pasc/5">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>pasc/6">Semester 6</a></li>
            </ul>
          </li>
        <?php } ?>
        <?php
        if ($data_user['status'] == 'Guru' AND $data_user['kelas'] != '') {
        ?>
          <li class="menu-item">
            <a href="<?php echo $cfg_baseurl; ?>rapor/<?php echo $data_user['kelas']; ?>">
              <span><i class="material-icons fs-16">account_box</i>Lihat Rapor</span>
            </a>
          </li>
          <? if (!empty($data_user['kelas'])) { ?>
          <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#catatanpts" aria-expanded="false" aria-controls="catatanpts">
              <span><i class="material-icons fs-16">account_box</i>Import Catatan PTS</span>
            </a>
            <ul id="catatanpts" class="collapse" aria-labelledby="catatanpts" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>cpts/1">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpts/2">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpts/3">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpts/4">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpts/5">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpts/6">Semester 6</a></li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#catatanpas" aria-expanded="false" aria-controls="catatanpas">
              <span><i class="material-icons fs-16">account_box</i>Import Catatan PAS</span>
            </a>
            <ul id="catatanpas" class="collapse" aria-labelledby="catatanpas" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>cpas/1">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpas/2">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpas/3">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpas/4">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpas/5">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>cpas/6">Semester 6</a></li>
            </ul>
          </li>
        <?php
        } }
        ?>
        <?php
        if (!empty($data_user['pelajaran'])) {
        ?>
          <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#pts" aria-expanded="false" aria-controls="pts">
              <span><i class="material-icons fs-16">account_box</i>Import Nilai PTS</span>
            </a>
            <ul id="pts" class="collapse" aria-labelledby="pts" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>npts/1">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npts/2">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npts/3">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npts/4">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npts/5">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npts/6">Semester 6</a></li>
              </ul>
          </li>
          <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#pas" aria-expanded="false" aria-controls="pas">
              <span><i class="material-icons fs-16">account_box</i>Import Nilai PAS</span>
            </a>
              <ul id="pas" class="collapse" aria-labelledby="pas" data-parent="#side-nav-accordion">
                <li><a href="<?php echo $cfg_baseurl; ?>npas/1">Semester 1</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npas/2">Semester 2</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npas/3">Semester 3</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npas/4">Semester 4</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npas/5">Semester 5</a></li>
                <li><a href="<?php echo $cfg_baseurl; ?>npas/6">Semester 6</a></li>
              </ul>
          </li>
        <?php
        }
        ?>
      <?php
      } else {
      ?>
        <!-- /Maps -->
        <li class="menu-item">
          <a href="<?php echo $home; ?>login">
            <span><i class="material-icons fs-16">airplay</i>Masuk</span>
          </a>
        </li>
      <?php
      }
      ?>
      <!-- /Apps -->
    </ul>


  </aside>

  <!-- Main Content -->
  <main class="body-content">
    <!-- Navigation Bar -->
    <nav class="navbar ms-navbar fixed-top">
      <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft">
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
      </div>

      <center>
        <h2><b><a style="color: #44425A; font-size: 16px;" href="<?php echo $cfg_baseurl; ?>"><?php echo $cfg_webname; ?></a></b></h2>
      </center>

      <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">

        <?php if (isset($_SESSION['user'])) {
        ?>
          <li class="ms-nav-item ms-nav-user dropdown">
            <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img class="ms-user-img ms-img-round float-right" src="<?php echo $cfg['logo']; ?>" alt="people"> </a>
            <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
              <li class="ms-dropdown-list">
                <a class="media fs-14 p-2" href="<?php echo $cfg_baseurl; ?>lib/setting"> <span><i class="flaticon-gear mr-2"></i> Account Settings</span> </a>
              </li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-menu-footer">
              </li>
              <li class="dropdown-menu-footer">
                <a class="media fs-14 p-2" href="<?php echo $cfg_baseurl; ?>lib/logout"> <span><i class="flaticon-shut-down mr-2"></i> Logout</span> </a>
              </li>
            </ul>
          </li>
      </ul>

      <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
        <span class="ms-toggler-bar bg-primary"></span>
      </div>
    <?php
        }
    ?>
    </nav>

    <?php 
    //echo $z; 
    ?>
        
    </nav>
    <br><br><br>
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">