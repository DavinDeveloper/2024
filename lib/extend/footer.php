<!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i><? echo $cfg['alamat']; ?></p>
                        <p><i class="fa fa-phone-alt mr-2"></i><? echo $cfg['telepon']; ?></p>
                        <p><i class="fa fa-envelope mr-2"></i><? echo $cfg['email']; ?></p>
                        <div class="d-flex justify-content-start mt-4">
                            <?
                            $check_contact = mysqli_query($db, "SELECT * FROM contact ORDER BY nama ASC");
                            while($data_contact = mysqli_fetch_assoc($check_contact)) {
                            ?>
                            <a class="btn btn-outline-light btn-square mr-2" target="_BLANK" href="<? echo $data_contact['url']; ?>"><i class="fab fa-<? echo $data_contact['icon']; ?>"></i></a>
                            <? } ?>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Our Pages</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <?
                            $check_page = mysqli_query($db, "SELECT * FROM website WHERE mt = '0' ORDER BY target ASC");
                            while($data_page = mysqli_fetch_assoc($check_page)) {
                            ?>
                            <a class="text-white mb-2" href="<? echo $data_page['target']; ?>"><i class="fa fa-angle-right mr-2"></i><? echo $data_page['webname']; ?></a>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 mb-5">
                <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Berlangganan</h5>
                <p>Isi email dibawah untuk berlangganan.</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Email Anda">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Langganan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; Copyright <? echo date(Y); ?> <a href="<? echo $cfg['url']; ?>"><? echo $cfg['name']; ?></a>. All Rights Reserved.
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<? echo $cfg['url']; ?>lib/easing/easing.min.js"></script>
    <script src="<? echo $cfg['url']; ?>lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<? echo $cfg['url']; ?>assets/js/main-page.js"></script>
</body>

</html>