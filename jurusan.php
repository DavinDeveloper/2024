<?
include 'lib/extend/config.php';
include 'lib/extend/header.php';
?>

    <!-- Header Start -->
    <div class="container-fluid page-header" style="margin-bottom: 90px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase">Jurusan</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Jurusan</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Profile Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="<? echo $cfg['jurusan_gambar']; ?>" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="text-left mb-4">
                        <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Jurusan</h5>
                        <h1><? echo $cfg['name']; ?></h1>
                    </div>
                    <p><? echo nl2br(str_replace(‘‘, ‘‘, htmlspecialchars($cfg['jurusan']))); ?></p>
                    <!--<a href="" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Profile End -->



<?
include 'lib/extend/footer.php'; 
?>