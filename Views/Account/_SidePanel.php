<?php

function SidePanel()
{
    echo "<div class='col-md-3'>";
    if (VariablesHelper::IsUserActive()) {
        echo "
        

        <div class=\"panel panel-primary\">
            <a href=\"/Account/Index\"><div class=\"panel-heading\">Moje konto</div></a>

            <ul class=\"list-group\">
                <a href=\"/Account/ChangePassword\">
                    <li class=\"list-group-item\">
                        Zmiana hasła
                    </li>
                </a>
                <a href=\"/Account/BasicInfo\">
                    <li class=\"list-group-item\">
                        Zmiana podstawowych danych
                    </li>
                </a>
                <a href=\"/Account/ChangeEmail\">
                    <li class=\"list-group-item\">
                        Zmiana adresu e-mail
                    </li>
                </a>
                <a href=\"/Account/AddressBook\">
                    <li class=\"list-group-item\">
                        Książka adresowa
                    </li>
                </a>
                <a href=\"/Account/Messages\">
                    <li class=\"list-group-item\">
                        Wiadomości
                    </li>
                </a>
                <a href='/Account/LogoutPost'>
                    <li class=\"list-group-item\">
                        <span class=\"text-danger\">
                            <B>Wyloguj</B>
                        </span>

                    </li>
                </a>
            </ul>
        </div>

        <div class=\"panel panel-warning\">
            <div class=\"panel-heading\">Zamówienia</div>

            <ul class=\"list-group\">
                <a href=\"/Account/ActiveOrders\">
                    <li class=\"list-group-item\">
                        <span class=\"badge\">0</span>
                        Moje aktywne zamówienia
                    </li>
                </a>
                <a href=\"/Account/OldOrder\">
                    <li class=\"list-group-item\">
                        <span class=\"badge\">0</span>
                        Poprzednie zamówienia
                    </li>
                </a>
                <a href=\"/Account/Rate\">
                    <li class=\"list-group-item\">
                        <span class=\"badge\">0</span>
                        Produkty do oceny
                    </li>
                </a>
                <a href=\"/Account/Baskets\">
                    <li class=\"list-group-item\">
                        <span class=\"badge\">0</span>
                        Zapisane koszyki
                    </li>
                </a>
                <a href=\"/Account/Baskets\">
                    <li class=\"list-group-item\">
                        Aktualny koszyk
                    </li>
                </a>
            </ul>
        </div>

        <div class=\"panel panel-info\">
            <div class=\"panel-heading\">Zapytania</div>

            <ul class=\"list-group\">
            
                <a href=\"/Account/Ask\">
                    <li class=\"list-group-item\">
                        Zadaj pytanie poprzez formularz
                    </li>
                </a>
                <a href=\"/Account/AskAboutOrder\">
                    <li class=\"list-group-item\">
                        Zadaj pytanie na temat swojego zamówienia
                    </li>
                </a>
                <a href=\"/Account/MyQuestions\">
                    <li class=\"list-group-item\">
                        <span class=\"badge\">0</span>
                        Zapytania
                    </li>
                </a>
            </ul>
        </div>

    ";
    }else{
        echo "REKLAMA";
    }
    echo "</div>";
}