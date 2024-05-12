<?
include 'lib/config.php';
include 'lib/header.php';
?>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <a href="https://wa.me/<? echo cfg(phone); ?>" target="_BLANK">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>WhatsApp</h4>
                        <p><? echo cfg(phone); ?></p>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

<?
include 'lib/footer.php';
?>