<html lang="pl-PL">
<?php
session_start();
echo "<head>";
include_once("Views/Shared/Includes.php");
echo "</head>";

echo "<body>";
include_once("Views/Shared/Menu.php");

include_once("Config/route.php");
include_once("Config/sql.php");


$route = new Route();
$sql = new SQL();

$_SESSION['menuData'] = $sql->GetMenuData($sql);

echo '<div id="MainContainer" class="panel-body container">';

    $route->submit($sql);

echo '</div>';

include_once("Views/Shared/Footer.php");
echo "</body>";
?>
</html>