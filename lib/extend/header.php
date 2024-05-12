<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><? echo $cfg['name']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<? echo $cfg['name']; ?>" name="keywords">
    <meta content="<? echo $cfg['name']; ?>" name="description">

    <!-- Favicon -->
    <link href="<? echo $cfg['logo']; ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<? echo $cfg['url']; ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<? echo $cfg['url']; ?>css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center py-4 px-xl-5">
            <div class="col-lg-3">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0"><span class="text-primary"></span><a style="color: #44425A;" href="<? echo $cfg['url']; ?>"><? echo $cfg['name']; ?></a></h1>
                </a>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Our Office</h6>
                        <small><? echo $cfg['alamat']; ?></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-envelope text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Email Us</h6>
                        <small><? echo $cfg['email']; ?></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-phone text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Call Us</h6>
                        <small><? echo $cfg['telepon']; ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <!--<a class="d-flex align-items-center justify-content-between bg-secondary w-100 text-decoration-none" style="height: 67px; padding: 0 30px;">-->
                    <!--<h5 class="text-primary m-0"><i class="fa fa-book-open mr-2"></i><? echo $cfg['name']; ?></h5>-->
                    <!--<i class="fa fa-angle-down text-primary"></i>-->
                <!--</a>-->
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 9;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Web Design <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="" class="dropdown-item">HTML</a>
                                <a href="" class="dropdown-item">CSS</a>
                                <a href="" class="dropdown-item">jQuery</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link">Apps Design</a>
                        <a href="" class="nav-item nav-link">Marketing</a>
                        <a href="" class="nav-item nav-link">Research</a>
                        <a href="" class="nav-item nav-link">SEO</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0"><span class="text-primary"></span><? echo $cfg['name']; ?></h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav py-0">
                            <a href="<? echo $cfg['url']; ?>" class="nav-item nav-link active">Home</a>
                            <a href="<? echo $cfg['url']; ?>profile" class="nav-item nav-link">Profile</a>
                            <a href="<? echo $cfg['url']; ?>fasilitas" class="nav-item nav-link">Fasilitas</a>
                            <a href="<? echo $cfg['url']; ?>visi" class="nav-item nav-link">Visi Misi</a>
                            <a href="<? echo $cfg['url']; ?>jurusan" class="nav-item nav-link">Jurusan</a>
                            <a href="<? echo $cfg['url']; ?>kegiatan" class="nav-item nav-link">Kegiatan</a>
                            <a href="<? echo $cfg['url']; ?>rapor" class="nav-item nav-link">Rapor</a>
                            <!--<div class="nav-item dropdown">-->
                            <!--    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Blog</a>-->
                            <!--    <div class="dropdown-menu rounded-0 m-0">-->
                            <!--        <a href="blog" class="dropdown-item">Blog List</a>-->
                            <!--        <a href="single" class="dropdown-item">Blog Detail</a>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<a href="contact" class="nav-item nav-link">Contact</a>-->
                        </div>
                        <a class="btn btn-primary py-2 px-4 ml-auto d-lg-block" href="<? echo $cfg['url']; ?>ppdb">PPDB</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->