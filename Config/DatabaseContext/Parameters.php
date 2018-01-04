<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Models/ParametersModel.php";

class Parameters
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function LoadParametersForProduct($productId)
    {
        $Parameter = [];
        $result = $this->SQL->Query("SELECT * FROM parameters WHERE ProductId=$productId");

        foreach ($result as $d) {
            $Parameter[] = new ParametersModel();
            $Parameter[count($Parameter) - 1]->ProductId = $d['ProductId'];
            $Parameter[count($Parameter) - 1]->CategoryId = $d['CategoryId'];
            $Parameter[count($Parameter) - 1]->ParameterId = $d['ParameterId'];
            $Parameter[count($Parameter) - 1]->ParameterValue = $d['ParameterValue'];
            // TODO dodać wczytywanie parametersTypes (context, model)
        }

        return $Parameter;
    }

    public function LoadParametersForCategory($categoryId)
    {
        $Parameter = [];
        $result = $this->SQL->Query("SELECT * FROM parameters WHERE CategoryId=$categoryId");

        while ($d = $result->fetch_assoc()) {
            $Parameter[] = new Parameter();
            $Parameter[count($Parameter) - 1]->ProductId = $d['ProductId'];
            $Parameter[count($Parameter) - 1]->CategoryId = $d['CategoryId'];
            $Parameter[count($Parameter) - 1]->ParameterId = $d['ParameterId'];
            $Parameter[count($Parameter) - 1]->ParameterValue = $d['ParameterValue'];
            // TODO dodać wczytywanie parametersTypes (context, model)
        }

        return $Parameter;
    }
}