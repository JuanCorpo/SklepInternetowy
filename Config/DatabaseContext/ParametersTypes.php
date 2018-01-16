<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Models/ParametersTypesModel.php";

class ParametersTypes
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function GetParametersTypes()
    {
        $ParametersTypes = [];
        $result = $this->SQL->Query("SELECT * FROM parameterstypes");

        foreach ($result as $item) {
            $ParametersTypes[] = new ParametersTypesModel();
            $ParametersTypes[count($ParametersTypes) - 1]->ParameterId = $item['ParameterId'];
            $ParametersTypes[count($ParametersTypes) - 1]->ParameterName = $item['ParameterName'];
            $ParametersTypes[count($ParametersTypes) - 1]->ValueType = $item['ValueType'];
            $ParametersTypes[count($ParametersTypes) - 1]->Prefix = $item['Prefix'];
            $ParametersTypes[count($ParametersTypes) - 1]->Suffix = $item['Suffix'];
        }

        return $ParametersTypes;
    }

    public function AddParameterType($parameterModel)
    {
        $name = $parameterModel->ParameterName;
        $ValueType = $parameterModel->ValueType;
        $prefix = $parameterModel->Prefix;
        $suffix = $parameterModel->Suffix;

        $this->SQL->Query("INSERT INTO parameterstypes VALUES ('','$name','$ValueType','','$suffix')");
    }
}