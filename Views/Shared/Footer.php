<?php
include_once('./Code/Helpers/Cookie.php');

if (!Cookie::IsCookieEqual('Cookie', true)) {
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


<div class="footer" id="footer">
    <div class="text-center ">
        <div class="container" style="width: 1170px">
            <div class="row">
                <div class="col-md-2">
                    <h3 style="font-size: 12pt;"> Strona </h3>
                    <ul>
                        <li><a href="#"> Język strony </a></li>
                        <li><a href="#"> Motyw strony </a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3 style="font-size: 12pt;"> Pomocne linki </h3>
                    <ul>
                        <li><a href="/Site/Installment"> Jak kupić na raty </a></li>
                        <li><a href="/Site/Complaint"> Reklamacje, zwroty, serwis </a></li>
                        <li><a href="/Site/FAQ"> Częste pytania </a></li>
                        <li><a href="/Site/Warranty"> Gwarancje </a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3 style="font-size: 12pt;"> Informacje prawne </h3>
                    <ul>
                        <li><a href="/Site/Terms"> Regulamin </a></li>
                        <li><a href="/Site/Cookies"> Polityka prywatności i cookies </a></li>
                        <li><a href="/Site/Security"> Bezpieczeństwo danych osobowych </a></li>
                        <li><a href="/Site/Downloads"> Materiały do pobrania </a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3 style="font-size: 12pt;"> Sklep </h3>
                    <ul>
                        <li><a href="/Site/Contact"> Kontakt </a></li>
                        <li><a href="/Site/About"> O nas </a></li>
                        <li><a href="/Site/Career"> Kariera </a></li>
                        <li><a href="/Site/Corpo"> Dane firmy </a></li>
                        <li><a href="/Site/TradeCooperation"> Współpraca handlowa </a></li>
                        <li><a href="/Site/Reference"> Nasze referencje </a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h3 style="font-size: 12pt;"> Newsletter </h3>
                    <ul>
                        <li>
                            <div class="input-append newsletter-box text-center">
                                <form id='newsLetterForm' method='post' action='/Account/AddToNewsLetter'>
                                    <input type="text" name="Email" class="full text-center"
                                           placeholder="Twój adres e-mail...">
                                    <button class="btn  bg-gray" type="submit"> Zapisz się do newslettera <i
                                                class="fa fa-long-arrow-right"> </i></button>
                                </form>
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
        <div class="container" style="width: 1170px">
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