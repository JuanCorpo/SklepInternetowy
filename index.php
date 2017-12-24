<html lang="pl-PL">
<?php

ob_start();
echo "<head>";
echo "
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

    <link href=\"/Styles/font-awesome.min.css\" rel=\"stylesheet\">
    <link href=\"/Styles/bootstrap.css\" rel=\"stylesheet\">
    <link href=\"/Styles/footer.css\" rel=\"stylesheet\">
    <link href=\"/Styles/Custom.css\" rel=\"stylesheet\">
    <link href=\"/Styles/menu.css\" rel=\"stylesheet\">

    <script src=\"/Scripts/jquery-1.10.2.js\"></script>
    <script src=\"/Scripts/bootstrap.js\"></script>
    <script src=\"/Scripts/Custom/CookieAccept.js\"></script>
    <script src=\"/Scripts/Custom/MenuSubcategories.js\"></script>
";
include_once("Config/DatabaseContext.php");;
//include_once("Views/Shared/Menu.php");
include_once("Config/route.php");
include_once("Models/UserModel.php");
session_start();

//echo "<h3>Sesion save path & id:</h3>";
//echo "<pre>";
//echo session_save_path() . " " . session_id();
//echo "</pre>";

$route = new Route();
$context = new DatabaseContext();

if (!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    $context->Users->RememberMeToken();
}
$_SESSION['menuData'] = $context->sql->GetMenuData();

echo "</head>";
echo "<body>";

echo "<nav id=\"Header\" class=\"navbar navbar-default\" style=\"margin-bottom: 0px;\">";
include_once("Views/Shared/Menu.php");
echo "</nav>
<div id=\"MainContainerModal\">
    <div id=\"MainModalContent\" class=\"container\"></div>
</div>";

echo '<div id="MainContainer" class="panel-body container">';
$route->submit($context);
echo '</div>';

//echo MainMenu();


include_once("Views/Shared/Footer.php");
echo "</body>";

echo "<script>

$.ajax({
  url: \"/Views/Shared/Menu.php\"  
}).done(function( msg ) {
    document.getElementById('Header').innerHTML = msg; 
  });
        </script>";
ob_end_flush();
?>
</html>