<?
if (!isset($_SESSION['user'])) {
    header("Location :".cfg(url)."auth/masuk");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><? echo cfg(nama); ?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="<? echo cfg(url); ?>dashboard/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="<? echo cfg(url); ?>dashboard/assets/css/ready.css">
	<link rel="stylesheet" href="<? echo cfg(url); ?>dashboard/assets/css/demo.css">
	<link rel="stylesheet" href="<? echo cfg(url); ?>dashboard/table/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<? echo cfg(url); ?>dashboard/table/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="<? echo cfg(url); ?>dashboard" class="logo">
					<? echo cfg(nama); ?>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					
					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
							<!--<h4><b><? echo cfg(nama); ?></b></h4>-->
					</form>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> 
							<img src="<? echo cfg(logo); ?>" alt="user-img" width="36" class="img-circle">
							<span><? echo $user['nama']; ?></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<a class="dropdown-item" href="<? echo cfg(url); ?>dashboard/pengaturan"><i class="ti-settings"></i> Pengaturan</a>
									<div class="dropdown-divider"></div>
									<? if ($user['status'] == 'Admin') { ?>
									<a class="dropdown-item" href="<? echo cfg(url); ?>dashboard/admin"><i class="ti-settings"></i> Configurasi Website</a>
									<div class="dropdown-divider"></div>
									<? } ?>
									<a class="dropdown-item" href="<? echo cfg(url); ?>auth/keluar"><i class="fa fa-power-off"></i> Keluar</a>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<!--<div class="photo">-->
						<!--	<img src="assets/img/profile.jpg">-->
						<!--</div>-->
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<? echo $user['nama']; ?>
									<span class="user-level"><? echo $user['status']; ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="<? echo cfg(url); ?>dashboard/pengaturan">
											<span class="link-collapse">Pengaturan</span>
										</a>
									</li>
									<? if ($user['status'] == 'Admin') { ?>
									<li>
										<a href="<? echo cfg(url); ?>dashboard/admin">
											<span class="link-collapse">Configurasi Website</span>
										</a>
									</li>
									<? } ?>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="<? echo cfg(url); ?>dashboard">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<? if ($user['status'] == 'Admin') { ?>
						<li class="nav-item">
							<a href="<? echo cfg(url); ?>dashboard/produk">
								<i class="la la-table"></i>
								<p>Produk</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<? echo cfg(url); ?>dashboard/pembelian">
								<i class="la la-th"></i>
								<p>Pembelian</p>
							</a>
						</li>
						<? } ?>
						<? if ($user['status'] == 'User') { ?>
						<li class="nav-item">
							<a href="<? echo cfg(url); ?>dashboard/user/pembelian">
								<i class="la la-th"></i>
								<p>Pembelian</p>
							</a>
						</li>
						<? } ?>
					</ul>
				</div>
			</div>