<?php
function AdministrationCategories($model)
{
    echo "<script src=\"/Scripts/ajax/UpdateCategories.js\"></script>";
    echo "<div style='display:inline;'>
<h2 style='display:inline;'>Edycja kategorii</h2>

    <div class='navbar-right'>
        <input style='float: left;width:180px;margin: 0 5px;' class='form-control' placeholder='Nazwa nowej kategorii' name='NewCategoryName' id='NewCategoryName'/>
        <button class=\"btn btn-warning\" type=\"submit\" id='AddNewCategory'><span class=\"glyphicon glyphicon-plus\"></span> Dodaj nową</button>
        <button class=\"btn btn-warning \" type=\"submit\" id='SaveCategories'>Zapisz</button>
    </div>

    <div class='navbar-right' style='float: left;margin: 0 20px 0 0;'>
        <input style='float: left;width:180px;margin:0 5px;' class='form-control EditElement' disabled placeholder='Wybierz aby edytować' name='EditCategoryName' id='EditCategoryName'/>
        <button class=\"btn btn-warning EditElement\" type=\"submit\" disabled id='EditCategory'><span class=\"glyphicon glyphicon-pencil\"></span> Edytuj</button>
        <button class=\"btn btn-danger EditElement\" type=\"submit\" disabled id='DelNewCategory'><span class=\"glyphicon glyphicon-remove\"></span> Usuń</button>
    </div>
         
</div>
<hr>";

    echo "<div categoryid='0' id='root' class=\"CategoryDroppable col-md-12 root Cat_0\" style='min-width:100px;min-height:100px;'>";

    echo InitCategories($model, 0, 0);

    echo "</div>";

}

$GLOBALS['res'] = "";

function InitCategories($array, $mainCategoryId, $level)
{
    $bg = "";
    foreach ($array as $row) {
        if (($level == 0 && $row['CategoryId'] == $mainCategoryId) || $row['ParentId'] == $mainCategoryId) {

            if ($row['ParentId'] == 0)
                $bg = "#75caeb";
            else
                $bg = "rgba(237, 239, 241, 0.5)";

            $GLOBALS['res'] .= '<div id="' . $row["CategoryId"] . '" categoryname="' . $row["CategoryName"] . '" parentid="' . $row["ParentId"] . '" categoryid="' . $row["CategoryId"] . '"  class="CategoryDraggable CategoryDroppable Categories CatEle Cat_' . $row["CategoryId"] . '" 
            style="background-color: ' . $bg . ';">';

            $GLOBALS['res'] .= '<div id="' . $row['CategoryId'] . 'Name" style="margin: 5px;">';
            $GLOBALS['res'] .= $row["CategoryName"];

            $GLOBALS['res'] .= "</div>";

            if ($row['ParentId'] == $mainCategoryId) {
                InitCategories($array, $row['CategoryId'], $level + 1);
            }
            $GLOBALS['res'] .= '</div>';
        }
    }
    return $GLOBALS['res'];
}