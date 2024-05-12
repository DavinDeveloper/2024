<?
include 'lib/config.php';
include 'lib/header.php';
?>

    <? if (empty($_GET['paket']) AND empty($_GET['kategori'])) { ?>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="<? echo cfg(banner); ?>">
                        <div class="hero__text">
                            <span>PAKET SPESIAL</span>
                            <h2>Haji Bonus <br />Jadi Tuhan</h2>
                            <p style="color: white;">Gratis pahala unlimited jika hajinya serius</p>
                            <a href="#" class="primary-btn">PESAN SEKARANG</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <? } ?>
    
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <? if (empty($_GET['paket']) AND empty($_GET['kategori'])) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Paket Haji</h2>
                    </div>
                </div>
            </div>
            <? } ?>
            <div class="row featured__filter">
                <?
                if (!empty($_GET['paket'])) {
                    $check_produk = mysqli_query($db, "SELECT * FROM produk WHERE nama LIKE '%".$_GET['paket']."%' ORDER BY nama ASC");
                } else if (!empty($_GET['kategori'])) {
                    $check_produk = mysqli_query($db, "SELECT * FROM produk ORDER BY nama ASC");
                } else {
                    $check_produk = mysqli_query($db, "SELECT * FROM produk ORDER BY RAND()");
                }
                while($data_produk = mysqli_fetch_assoc($check_produk)) {
                ?>
                <a href="<? echo cfg(url); ?>produk/<? echo $data_produk['id']; ?>">
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="<? echo $data_produk['gambar']; ?>">
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><? echo $data_produk['nama']; ?></a></h6>
                            <h5>Rp<? echo number_format($data_produk['harga'],0,',','.'); ?></h5>
                        </div>
                    </div>
                </div>
                </a>
                <? } ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <? if (empty($_GET['paket']) AND empty($_GET['kategori'])) { ?>
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="<? echo cfg(brosur1); ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="<? echo cfg(brosur2); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Testimoni</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?
                $check_testimoni = mysqli_query($db, "SELECT * FROM testimoni ORDER BY RAND()");
                while ($data_testimoni = mysqli_fetch_assoc($check_testimoni)) {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="<? echo $data_testimoni['gambar']; ?>" alt="">
                        </div>
                        <div class="blog__item__text">
                            <h5><a href="#"><? echo $data_testimoni['nama']; ?></a></h5>
                            <p><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($data_testimoni['konten']))); ?></p>
                        </div>
                    </div>
                </div>
                <? } ?>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
    <? } ?>

<?
include 'lib/footer.php';
?>