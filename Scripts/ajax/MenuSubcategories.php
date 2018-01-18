<?php
$ID = $_POST['ID'];

$GLOBALS['counter'] = 0;

session_start();
$result = $_SESSION['menuData'];

$result = "<table>";
$result .= ShowForCategory($_SESSION['menuData'], $ID, 0, 0);

$result .= "</table>";

echo $result;

function ShowForCategory($array, $mainCategoryId, $level, $pevLevel)
{
    $fr = "";
    $i = 0;

    foreach ($array as $row) {

        if (($level == 0 && $row['CategoryId'] == $mainCategoryId) || $row['ParentId'] == $mainCategoryId) {
            if ($row['ParentId'] != 0) {
                if($GLOBALS['counter']%8 == 0)
                {
                    $fr.= "<div style='width: 250px;float:left;margin: 10px 10px 0 10px;'>";
                }
                $GLOBALS['counter']+=1;
                $fr .= "<div id='menuBtn_$i' class='menuButton' style='width: 250px;float:left'>";
                $size = 15 - ($level * 2) . "pt";

                if ($level == $pevLevel) {
                    $fr .= "<b>";
                }

                $fr .= "<a style='font-size: $size;display: inline-block;' href='/Products/ListFor/$row[CategoryId]'>$row[CategoryName]</a>";

                if ($level == $pevLevel) {
                    $fr .= "</b>";
                }
                $fr .= "</div>";
                if($GLOBALS['counter']%8 == 0)
                {
                    $fr.= "</div>";
                }
            }

            if ($row['ParentId'] == $mainCategoryId) {
                $fr .= ShowForCategory($array, $row['CategoryId'], $level + 1, $level);
            }
        }
        $i++;
    }
    return $fr;
}