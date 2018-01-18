<?php

include_once("/Config/DatabaseContext.php");
include_once("/Code/Helpers/VariablesHelper.php");
include_once("/Models/UserModel.php");
include_once("/Models/CategoriesModel.php");
include_once("/Models/BasketModel.php");
foreach (glob("Config/DatabaseContext/*.php") as $filename) {
    include_once $filename;
}
session_start();
$data = json_decode(stripslashes($_POST['data']));

$context = unserialize($_SESSION['context']);

$data = fixIds($data, $context->Categories->NewCategoryId());

foreach ($data as $d) {
    $context->Categories->UpdateCategory($d[0], $d[1], $d[2]);
}

function allPrentsTo($oldPar, $newPar, $arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i][2] == $oldPar) {
            $arr[$i][2] = $newPar;
        }
    }
    return $arr;
}

function fixIds($d,$lastId)
{
    for ($i = 0; $i < count($d); $i++) {
        if ($d[$i][0] < 0) { // Jesli CatID<0 <=> ParId ?= <0

            $newId = $lastId+($d[$i][0]*-1)-1;

            $d = allPrentsTo($d[$i][0], $newId, $d);
            $d[$i][0] = $newId;
        }
    }
    return $d;
}