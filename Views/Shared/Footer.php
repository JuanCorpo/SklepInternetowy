<?php
if (!(isset($_COOKIE['Cookie']) && $_COOKIE['Cookie'] == true)) {
    ?>
    <div class="alert alert-dismissible alert-warning navbar-fixed-bottom">
        <button type="button" onclick="CookieAccept()" class="close" data-dismiss="alert">&times;</button>
        <h4>Uwaga!</h4>
        <p>
            Ta strona wykorzystuje ciasteczka. Kontynuując przeglądanie tej witryny, zgadzasz się na używanie
            ciasteczek. Przejrzyj Cookie Policy, aby uzyskać więcej informacji.
        </p>
    </div>

<?php } ?>

<div class="text-center ">

    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3 style="font-size: 12pt;"> Strona </h3>
                    <ul>
                        <li><a href="#"> Język strony </a></li>
                        <li><a href="#"> Motyw strony </a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3 style="font-size: 12pt;"> Pomocne linki </h3>
                    <ul>
                        <li><a href="#"> Jak kupić na raty </a></li>
                        <li><a href="#"> Reklamacje, zwroty, serwis </a></li>
                        <li><a href="#"> Częste pytania </a></li>
                        <li><a href="#"> Gwarancje </a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3 style="font-size: 12pt;"> Informacje prawne </h3>
                    <ul>
                        <li><a href="#"> Regulamin </a></li>
                        <li><a href="#"> Polityka prywatności i cookies </a></li>
                        <li><a href="#"> Bezpieczeństwo danych osobowych </a></li>
                        <li><a href="#"> Materiały do pobrania </a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3 style="font-size: 12pt;"> Sklep </h3>
                    <ul>
                        <li><a href="#"> Kontakt </a></li>
                        <li><a href="#"> O nas </a></li>
                        <li><a href="#"> Kariera </a></li>
                        <li><a href="#"> Dane firmy </a></li>
                        <li><a href="#"> Współpraca handlowa </a></li>
                        <li><a href="#"> Nasze referencje </a></li>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                    <h3 style="font-size: 12pt;"> Newsletter </h3>
                    <ul>
                        <li>
                            <div class="input-append newsletter-box text-center">
                                <input type="text" class="full text-center" placeholder="Twój adres e-mail...">
                                <button class="btn  bg-gray" type="button"> Zapisz się do newslettera <i class="fa fa-long-arrow-right"> </i></button>
                            </div>
                        </li>
                    </ul>
                    <ul class="social">
                        <li><a href="#"> <i class=" fa fa-facebook"> </i> </a></li>
                        <li><a href="#"> <i class="fa fa-twitter"> </i> </a></li>
                        <li><a href="#"> <i class="fa fa-google-plus"> </i> </a></li>
                        <li><a href="#"> <i class="fa fa-pinterest"> </i> </a></li>
                        <li><a href="#"> <i class="fa fa-youtube"> </i> </a></li>
                    </ul>
                </div>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
    </div>
    <!--/.footer-->

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © Footer <?php echo date("Y"); ?>. All right reserved. </p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul>
            </div>
        </div>
    </div>

</div>