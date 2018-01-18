<div class="container navbar-fixed-top" style="width: 1170px">
<nav class="navbar navbar-default ">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



            <ul class="nav navbar-nav navbar-left">
                <li><a href="../../">Strona główna</a></li>
                <li class="active"><a>Zalogowany jako {administrator}</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Produkty i kategorie <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../../Administration/ListAll/">Produkty</a></li>
                        <li><a href="../../Administration/Categories/">Kategorie</a></li>
                        <li class="divider"></li>
                        <li><a href="../../Administration/AddProduct/">Dodaj produkt</a></li>
                        <li><a href="../../Administration/ParametersTypes/">Rodzaj parametrów</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Użytkowicy <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../../Administration/UsersList/">Lista użytkowników</a></li>
                        <li><a href="../../Administration/EmployeeList/">Lista pracowników</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administracja <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="../../Administration/Grups/">Grupy</a></li>
                        <li><a href="../../Administration/Settings/">Ustawienia</a></li>
                        <li><a href="../../Administration/EmailTemplates/">Szablony email</a></li>
                        <li><a href="../../Administration/EmailQueue/">Kolejka email</a></li>
                    </ul>
                </li>


                <?php echo '<li><a href="../../Account/LogoutPost/">Wyloguj</a></li>'?>
            </ul>

        </div>
    </div>
</nav>
</div><br><br>