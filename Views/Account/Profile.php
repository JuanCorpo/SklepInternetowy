<?php
function AccountProfileView($model)
{
    //echo "Profil";
    //echo "<a href='/Account/LogoutPost'>WyLoguj</a>";

    echo "
    "; ?>
    <div class='col-md-3'>

        <div class="panel panel-primary">
            <div class="panel-heading">Moje konto</div>

            <ul class="list-group">
                <a href="###">
                    <li class="list-group-item">
                        <!--<span class="badge">14</span>-->
                        Zmiana hasła
                    </li>
                </a>
                <a href="###">
                    <li class="list-group-item">
                        Zmiana podstawowych danych
                    </li>
                </a>
                <a href="###">
                    <li class="list-group-item">
                        Zmiana adresu e-mail
                    </li>
                </a>
                <a href="###">
                    <li class="list-group-item">
                        Książka adresowa
                    </li>
                </a>
                <a href="###">
                    <li class="list-group-item">
                        Wiadomości
                    </li>
                </a>
                <a href='/Account/LogoutPost'>
                    <li class="list-group-item">
                        <span class="text-danger">
                            <B>Wyloguj</B>
                        </span>

                    </li>
                </a>
            </ul>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading">Zamówienia</div>

            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">0</span>
                    Moje aktywne zamówienia
                </li>
                <li class="list-group-item">
                    <span class="badge">0</span>
                    Poprzednie zamówienia
                </li>
                <li class="list-group-item">
                    <span class="badge">0</span>
                    Produkty do oceny
                </li>
                <li class="list-group-item">
                    <span class="badge">0</span>
                    Zapisane koszyki
                </li>
            </ul>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">Zapytania</div>

            <ul class="list-group">
                <li class="list-group-item">
                    Zadaj pytanie poprzez formularz
                </li>
                <li class="list-group-item">
                    Zadaj pytanie na temat swojego zamówienia
                </li>
                <li class="list-group-item">
                    <span class="badge">0</span>
                    Zapytania
                </li>
            </ul>
        </div>

    </div>


<div id="ProfileMainContent" class='col-md-9'>
    Main content (AJAX?)<br>
    <h3>Work in progrss</h3>
    <div class="progress progress-striped active">
        <div class="progress-bar" style="width: 45%"></div>
    </div>

    <div class="jumbotron">
        <h1>Jumbotron</h1>
        <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <p><a class="btn btn-primary btn-lg">Learn more</a></p>
    </div>


    <blockquote class="blockquote-reverse">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
        <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
    </blockquote>


</div>


    <?php
    echo "   ";

}

?>


