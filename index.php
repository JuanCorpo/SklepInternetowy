<?php
include_once("Config/DatabaseContext.php");
include_once("Config/route.php");
include_once("Models/UserModel.php");
include_once("Code/Helpers/VariablesHelper.php");
include_once("Code/Helpers/RoleHelper.php");

session_start();
echo "<html lang=\"pl-PL\">";
include_once("Views/Shared/Head.php");

$route = new Route();
$databaseContext = new DatabaseContext();

ob_start();
$route->submit($databaseContext);
$mainContent = ob_get_contents();
ob_clean();

ob_start();

if (!VariablesHelper::IsUserActive()) {
    $databaseContext->Users->CheckRememberMeToken();
}
$_SESSION['menuData'] = $databaseContext->Categories->LoadCategories();


echo "<body>";
echo "
<img src='/Content/loader.gif' id='WaitLoader'/>
<nav id=\"Header\" class=\"navbar navbar-default\">";

if (RoleHelper::IsInRole(1)) {
    include_once "Views/Shared/_AdministrationBar.php";
}

$_SESSION['basketPrice'] = Cookie::GetBasketValue($databaseContext);
include_once("Views/Shared/Menu.php");
echo "</nav>";
echo "
<div id=\"MainContainerModal\">
    <div id=\"MainModalContent\" class=\"container\"></div>
</div>";

echo '<div id="MainContainer" class="panel-body container">';
echo $mainContent;
echo '</div>';

include_once("Views/Shared/Footer.php");
echo "</body>";
echo '</html>';

ob_end_flush();