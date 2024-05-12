<?
include 'lib/extend/config.php';
$no1 = 0;
$no2 = 0;
$no3 = 0;
$no4 = 0;
$check_slide = mysqli_query($db, "SELECT * FROM slide");
include 'lib/extend/header.php';
?>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <? while ($slide = mysqli_fetch_assoc($check_slide)) { ?>
                <li data-target="#header-carousel" data-slide-to="<? echo $no1++; ?>" <? if ($no2++ == 0) { ?>class="active"<? } ?>></li>
                <? } ?>
            </ol>
            <div class="carousel-inner">
                <? 
                $check_slide = mysqli_query($db, "SELECT * FROM slide");
                while ($slide = mysqli_fetch_assoc($check_slide)) { ?>
                <div class="carousel-item <? if ($no3++ == 0) { ?>active<? } ?>" style="min-height: 300px;">
                    <img class="position-relative w-100" src="<? echo $slide['gambar']; ?>" style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3"><? echo $slide['kecil']; ?></h5>
                            <h1 class="display-3 text-white mb-md-4"><? echo $slide['besar']; ?></h1>
                            <a href="<? echo $slide['url']; ?>" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2"><? echo $slide['tombol']; ?></a>
                        </div>
                    </div>
                </div>
                <? } ?>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    
    <div class="container-fluid py-5">
        <?
        $check_post = mysqli_query($db, "SELECT * FROM post WHERE status = 'show' ORDER BY RAND()");
        while($data_post = mysqli_fetch_assoc($check_post)) {
            $preview = substr($data_post['konten'], 0, 165);
            $preview .= "...";
        ?>
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="<? echo $data_post['gambar']; ?>" alt="">
                </div>
                <div class="col-lg-10">
                    <div class="text-left mb-4">
                        <h1><? echo $data_post['judul']; ?></h1>
                    </div>
                    <p><? echo $preview; ?></p>
                    <a href="<? echo $cfg['url']; ?>post/<? echo $data_post['id']; ?>" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">More</a>
                </div>
            </div>
        </div>
        <? } ?>
    </div>
    
    <!-- About End -->


<?
include 'lib/extend/footer.php'; 
?>