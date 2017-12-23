<html lang="pl-PL">
<?php

ob_start();
echo "<head>";
include_once("Views/Shared/Includes.php");
include_once("Config/DatabaseContext.php");;
//include_once("Views/Shared/Menu.php");
include_once("Config/route.php");
include_once("Models/UserModel.php");
//session_start();

$route = new Route();
$context = new DatabaseContext();

if (!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    $context->Users->RememberMeToken();
}
$_SESSION['menuData'] = $context->sql->GetMenuData();

echo "</head>";
echo "<body>";

echo "<nav id=\"Header\" class=\"navbar navbar-default\" style=\"margin-bottom: 0px;\">";

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