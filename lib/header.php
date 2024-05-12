<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="<? echo cfg(nama); ?> Murah Meriah">
    <meta name="keywords" content="<? echo cfg(nama); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><? echo cfg(nama); ?></title>
    <link href="<? echo cfg(logo); ?>" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<? echo cfg(url); ?>css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="<? echo cfg(url); ?>"><img src="<? echo cfg(logo); ?>" alt=""></a>
        </div>
        <div class="humberger__menu__widget">
            <? if (!isset($_SESSION['user'])) { ?>
            <div class="header__top__right__social">
                <a href="<? echo cfg(url); ?>auth/daftar"><i class="fa fa-user"></i> Daftar</a>
            </div>
            <div class="header__top__right__auth">
                <a href="<? echo cfg(url); ?>auth/masuk"><i class="fa fa-user"></i> Masuk</a>
            </div>
            <? } else { ?>
            <div class="header__top__right__auth">
                <a href="<? echo cfg(url); ?>dashboard"><i class="fa fa-user"></i> <? echo $user['nama']; ?> </a>
            </div>
            <div class="header__top__right__auth">
                <a href="<? echo cfg(url); ?>auth/keluar">| Keluar</a>
            </div>
            <? } ?>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="<? echo cfg(url); ?>">Home</a></li>
                <li><a href="#">Informasi</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="">Tentang Kami</a></li>
                    </ul>
                </li>
                <li><a href="<? echo cfg(url); ?>hubungi">Hubungi Kami</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <? echo cfg(email); ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <? if (!isset($_SESSION['user'])) { ?>
                            <div class="header__top__right__social">
                                <a href="<? echo cfg(url); ?>auth/daftar"><i class="fa fa-user"></i> Daftar</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="<? echo cfg(url); ?>auth/masuk"><i class="fa fa-user"></i> Masuk</a>
                            </div>
                            <? } else { ?>
                            <div class="header__top__right__auth">
                                <a href="<? echo cfg(url); ?>dashboard"><i class="fa fa-user"></i> <? echo $user['nama']; ?> </a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="<? echo cfg(url); ?>auth/keluar">| Keluar</a>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<? echo cfg(url); ?>"><img src="<? echo cfg(logo); ?>" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="<? echo cfg(url); ?>">Home</a></li>
                            <li><a href="#">Informasi</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="">Tentang Kami</a></li>
                                </ul>
                            </li>
                            <li><a href="<? echo cfg(url); ?>hubungi">Hubungi Kami</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Semua Produk</span>
                        </div>
                        <ul>
                            <li><a href="<? echo cfg(url); ?>?kategori=haji">Paket Haji</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="<? echo cfg(url); ?>">
                                <input type="text" name="paket" placeholder="Cari paket haji">
                                <button type="submit" class="site-btn">Cari</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                            <a href="https://wa.me/<? echo cfg(phone); ?>" target="_BLANK">
                                <h5><? echo cfg(phone); ?></h5>
                                <span>WhatsApp</span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->