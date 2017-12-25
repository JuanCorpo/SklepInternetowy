<?php
include_once("Config/DatabaseContext.php");
include_once("Config/route.php");
include_once("Models/UserModel.php");

session_start();

$route = new Route();
$context = new DatabaseContext();

ob_start();

$route->submit($context);
$c = ob_get_contents();
ob_clean();

ob_start();

echo "<html lang=\"pl-PL\">";
echo "<head>";
echo "
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

    <link href=\"/Styles/font-awesome.min.css\" rel=\"stylesheet\">
    <link href=\"/Styles/bootstrap.css\" rel=\"stylesheet\">
    <link href=\"/Styles/footer.css\" rel=\"stylesheet\">
    <link href=\"/Styles/Custom.css\" rel=\"stylesheet\">
    <link href=\"/Styles/menu.css\" rel=\"stylesheet\">
    <link href=\"/Styles/bootstrap-slider.css\" rel=\"stylesheet\">
    <link href=\"/Styles/jquery-ui.css\" rel=\"stylesheet\">


    <script src=\"/Scripts/jquery-3.2.1.min.js\"></script>
    <script src=\"/Scripts/jquery-ui.min.js\"></script>
    <script src=\"/Scripts/Custom/CookieAccept.js\"></script>
    <script src=\"/Scripts/Custom/MenuSubcategories.js\"></script>    
    <script src=\"/Scripts/bootstrap.bundle.js\"></script>";

if (!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    $context->Users->RememberMeToken();
}
$_SESSION['menuData'] = $context->Categories->GetCategories();

echo "</head>";
echo "<body>";
echo "<nav id=\"Header\" class=\"navbar navbar-default\" style=\"margin-bottom: 0px;\">";

if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $session = unserialize($_SESSION['user']);
    if ($session->UserRole == 1) {
        include_once "Views/Shared/_AdministrationBar.php";
    }
}

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
ob_end_flush();
?>
</html>