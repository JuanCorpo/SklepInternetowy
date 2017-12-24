<?php
if (!isset($_SESSION)) {

    //echo "<h3>BRAK SESJI!</h3>";
    include_once($_SERVER['DOCUMENT_ROOT'] . "/Models/UserModel.php");
    session_start();
}
/*
echo "<h3>Session save path & id:</h3>";
echo "<pre>";
echo session_save_path() . " " . session_id();
echo "</pre>";

echo "<h3>Session user:</h3>";
echo "<pre>";
print_r($_SESSION['user']);
echo "</pre>";

echo "<h3>Session userialized user:</h3>";
$session = unserialize($_SESSION['user']);
echo "<pre>";
print_r($session);
echo "</pre>";

echo "<h3>Session menu:</h3>";
echo "<pre>";
print_r($_SESSION['menuData']);
echo "</pre>";
*/
?>

    <div class="container" style="width: 1170px">
        <div class="container-fluid">

            <div id="TopMenuContainer">
                <div id="MainLogo">
                    <a href="/">
                        <div id="BANNER"></div>
                    </a>
                </div>

                <div id="MainUserPanel">
                    <div id="MenuSpacer"></div>

                    <div id="MenuControlsPanel">
                        <div id="SearchBarPanel">

                            <div id="SearchBarMenu">
                                <form method="get" action="/products/search">
                                    <div class="input-group">
                                        <input placeholder="Szukaj produktu" name="name" type="text"
                                               class="form-control">

                                        <span class="input-group-btn">
                                            <button class="btn btn-warning" type="submit">Szukaj</button>
                                        </span>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div id="UserPanel">
                            <a href="/Account/Index">
                                <div id="UserProfile">
                                    <span style="font-size: 30pt;margin-top: 15px;"
                                          class="glyphicon glyphicon-user"></span>
                                    <div style="display: inline-block;">
                                        <?php
                                        if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
                                            $session = unserialize($_SESSION['user']);
                                            echo $session->FirstName . '<br/>' . $session->SurName;
                                        } else {
                                            echo "Zaloguj się <br/> Załóż konto";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </a>
                            <a href="###">
                                <div id="UserCart">
                                    <span style="font-size: 30pt;margin-top: 15px;"
                                          class="glyphicon glyphicon-shopping-cart"></span>
                                    <div style="display: inline-block;">Koszyk<br/>0,00zł</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="MenuMainCategories">


                <ul class="nav navbar-nav">
                    <?php
                    for ($i = 0; $i < count($_SESSION['menuData']); $i++) {
                        if ($_SESSION['menuData'][$i]['ParentId'] == 0) {
                            $name = $_SESSION['menuData'][$i]['CategoryName'];
                            $Id = $_SESSION['menuData'][$i]['CategoryId'];

                            echo "<li style='margin: 0 20px;'><a class=\"navbar-brand MainMenuButton\" id='MainButton_$Id' category='$Id' href=\"/Products/ListFor/$Id\">$name</a></li>";
                        }
                    }
                    ?>
                </ul>


            </div>

        </div>
    </div>


