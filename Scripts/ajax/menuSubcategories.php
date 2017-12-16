<?php

$ID = $_POST['ID'];


session_start();
$result = $_SESSION['menuData'];

$result = "<table>";
$result .= ShowForCategory($_SESSION['menuData'], $ID, 0, 0);

$result .= "</table>";

//echo "<pre>";
//($result);
echo $result;


// $array ,$mainCategoryId ,$level
function ShowForCategory($array, $mainCategoryId, $level, $pevLevel)
{
    $fr = "";
    //echo "<pre>";
    //print_r($array);
    //die();
$i = 0;
    foreach ($array as $row) {

        if (($level == 0 && $row['CategoryId'] == $mainCategoryId) || $row['ParentId'] == $mainCategoryId) {


            if ($row['ParentId'] != 0) {
                $fr .= "<div id='menuBtn_$i' class='menuButton'>";
                //$fr .= "<td>$row[CategoryId]</td> <td>";
                //for ($i = 0; $i < 3 * $level; $i++) echo "&nbsp;";
                //$fr .= "$row[CategoryName]</td> <td>$row[ParentId]</td>";
                $size = 15 - ($level * 2) . "pt";

                if ($level == $pevLevel) {
                    $fr .= "<b>";
                }

                $fr .= "<a style='font-size: $size;display: inline-block;' href='/products/show/$row[CategoryId]'>$row[CategoryName]</a>";

                if ($level == $pevLevel) {
                    $fr .= "</b>";
                }
                $fr .= "</div>";
            }

            if ($row['ParentId'] == $mainCategoryId) {
                $fr .= ShowForCategory($array, $row['CategoryId'], $level + 1, $level);
            }

        }
        $i++;
    }
    return $fr;
}