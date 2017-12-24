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
    <link href=\"/Styles/bootstrap-slider.css\" rel=\"stylesheet\">

    <script src=\"/Scripts/jquery-1.10.2.js\"></script>
    <script src=\"/Scripts/bootstrap.bundle.js\"></script>
    <script src=\"/Scripts/Custom/CookieAccept.js\"></script>
    <script src=\"/Scripts/Custom/MenuSubcategories.js\"></script>
    <script src=\"/Scripts/bootstrap-slider.js\"></script>";

include_once("Config/DatabaseContext.php");
include_once("Config/route.php");
include_once("Models/UserModel.php");
session_start();

$route = new Route();
$context = new DatabaseContext();

$route->submit($context);
$c = ob_get_contents();
ob_clean();
ob_start();

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
echo $c;
echo '</div>';

include_once("Views/Shared/Footer.php");
echo "</body>";

echo "<script>
/*
$.ajax({
  url: \"/Views/Shared/Menu.php\"  
}).done(function( msg ) {
    document.getElementById('Header').innerHTML = msg; 
  });
       */ </script>";
ob_end_flush();
?>
</html>