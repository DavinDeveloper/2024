<?
include 'lib/config.php';
$check_produk = mysqli_query($db, "SELECT * FROM produk WHERE id = '".$_GET['1']."'");
if (mysqli_num_rows($check_produk) == 0) {
    header("Location : ".cfg(url));
} else {
    $data_produk = mysqli_fetch_assoc($check_produk);
    if (isset($_POST['pesan'])) {
        if ($user['status'] == 'Admin') {
            header("Location: ".cfg(url)."dashboard/pembelian");
        } else {
            $insert = mysqli_query($db, "INSERT INTO pembelian (id_produk, produk, username, harga, datetime) VALUES ('".$data_produk['id']."', '".$data_produk['nama']."', '".$user['username']."', '".$data_produk['harga']."', '".date("Y-m-d H:i:s")."')");
            if ($insert == TRUE) {
                $id = mysqli_insert_id($db);
                header("Location: ".cfg(url)."dashboard/user/bayar?1=".$id);
            }
        }
    }
}
include 'lib/header.php';
?>
     <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="<? echo $data_produk['gambar']; ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><? echo $data_produk['nama']; ?></h3>
                        <div class="product__details__price">Rp<? echo number_format($data_produk['harga'],0,',','.'); ?></div>
                        <div class="accordion">
                            <label for="rencana" class="accordion-btn">RENCANA PERJALANAN</label>
                            <input type="checkbox" id="rencana" class="accordion-toggle">
                            <div class="accordion-content">
                                <p><? echo nl2br($data_produk['rencana']); ?></p>
                            </div>
                        </div>
                        <form method="POST">
                        <? if (!isset($_SESSION['user'])) { ?>
                        <a href="<? echo cfg(url); ?>auth/masuk" class="primary-btn">PESAN</a>
                        <? } else { ?>
                        <button type="submit" name="pesan" class="primary-btn">PESAN</button>
                        <? } ?>
                        </form>
                        <ul>
                            <li><b>Ketersediaan</b> <span>Ready</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Fasilitas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Persyaratan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Syarat & Ketentuan</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Fasilitas</h6>
                                    <p><? echo nl2br($data_produk['fasilitas']); ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Persyaratan</h6>
                                    <p><? echo nl2br($data_produk['persyaratan']); ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Syarat & Ketentuan</h6>
                                    <p><? echo nl2br($data_produk['syarat']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

<?
include 'lib/footer.php';
?>