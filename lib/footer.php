    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="<? echo cfg(url); ?>"><img width="250px" src="<? echo cfg(logo); ?>" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: <? echo cfg(address); ?></li>
                            <li>Phone: <? echo cfg(phone); ?></li>
                            <li>Email: <? echo cfg(email); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Halaman</h6>
                        <ul>
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Pengguna</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Berlangganan</h6>
                        <p>Dapatkan email jika terdapat promo dan update terbaru.</p>
                        <form action="#">
                            <input type="text" placeholder="Masukkan email">
                            <button type="submit" class="site-btn">Langganan</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="<? echo cfg(url); ?>" target="_blank"><? echo cfg(nama); ?></a>
  </p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="<? echo cfg(url); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<? echo cfg(url); ?>js/bootstrap.min.js"></script>
    <script src="<? echo cfg(url); ?>js/jquery.nice-select.min.js"></script>
    <script src="<? echo cfg(url); ?>js/jquery-ui.min.js"></script>
    <script src="<? echo cfg(url); ?>js/jquery.slicknav.js"></script>
    <script src="<? echo cfg(url); ?>js/mixitup.min.js"></script>
    <script src="<? echo cfg(url); ?>js/owl.carousel.min.js"></script>
    <script src="<? echo cfg(url); ?>js/main.js"></script>



</body>

</html>