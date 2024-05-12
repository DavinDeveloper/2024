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
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
      <!-- Dashboard -->
      <br><br><br><br><br>
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
        <li class="menu-item">
          <a href="<?php echo $cfg_baseurl; ?>post">
            <span><i class="material-icons fs-16">book</i>Postingan</span>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo $cfg_baseurl; ?>pendaftar">
            <span><i class="material-icons fs-16">airplay</i>Pendaftar</span>
          </a>
        </li>
       <li class="menu-item">
            <a href="#" class="has-chevron" data-toggle="collapse" data-target="#siswa" aria-expanded="false" aria-controls="siswa">
              <span><i class="material-icons fs-16">settings</i>Config</span>
            </a>
            <ul id="siswa" class="collapse" aria-labelledby="siswa">
              <li><a href="<?php echo $cfg_baseurl; ?>config/contact">Contact</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/ppdb">PPDB</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/profile">Profile</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/slide">Slide</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/fasilitas">Fasilitas</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/visi">Visi Misi</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/jurusan">Jurusan</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/kegiatan">Kegiatan</a></li>
              <li><a href="<?php echo $cfg_baseurl; ?>config/website">Website</a></li>
            </ul>
            </ul>
          </li>
      <?php
      } else {
      ?>
        <!-- /Maps -->
        <li class="menu-item">
          <a href="<?php echo $cfg_baseurl; ?>auth/login">
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
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">
        <br><br><br>