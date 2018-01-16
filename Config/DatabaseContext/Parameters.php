<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/Models/ParametersModel.php";

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
        $ParameterTypeQuery = $this->Context->ParametersTypes->GetParametersTypes();

        foreach ($result as $d) {
            $Parameter[] = new ParametersModel();
            $Parameter[count($Parameter) - 1]->ProductId = $d['ProductId'];
            $Parameter[count($Parameter) - 1]->CategoryId = $d['CategoryId'];
            $Parameter[count($Parameter) - 1]->ParameterId = $d['ParameterId'];
            $Parameter[count($Parameter) - 1]->ParameterValue = $d['ParameterValue'];

            foreach ($ParameterTypeQuery as $item) {
                if ($item->ParameterId == $d['ParameterId'])
                    $Parameter[count($Parameter) - 1]->ParameterType = $item;
            }
        }
        return $Parameter;
    }

    public function LoadParametersForCategory($categoryId)
    {
        $Parameter = [];
        $result = $this->SQL->Query("SELECT * FROM parameters WHERE CategoryId=$categoryId");
        $ParameterTypeQuery = $this->Context->ParametersTypes->GetParametersTypes();

        foreach ($result as $d) {
            $Parameter[] = new ParametersModel();
            $Parameter[count($Parameter) - 1]->ProductId = $d['ProductId'];
            $Parameter[count($Parameter) - 1]->CategoryId = $d['CategoryId'];
            $Parameter[count($Parameter) - 1]->ParameterId = $d['ParameterId'];
            $Parameter[count($Parameter) - 1]->ParameterValue = $d['ParameterValue'];

            foreach ($ParameterTypeQuery as $item) {
                if ($item->ParameterId == $d['ParameterId'])
                    $Parameter[count($Parameter) - 1]->ParameterType = $item;
            }
        }
        return $Parameter;
    }

    public function AddParameter($ParameterModel)
    {
        $result = $this->SQL->Query("INSERT INTO parameters VALUES ('', $ParameterModel->ProductId, $ParameterModel->CategoryId, $ParameterModel->ParameterId, '$ParameterModel->ParameterValue')");
        $result = $this->SQL->Query("SELECT Id FROM parameters ORDER BY Id DESC LIMIT 1");
        return $result[0]['Id'];
    }

    public function DeleteParameters($ProductId)
    {
        $result = $this->SQL->Query("DELETE FROM parameters WHERE ProductId=$ProductId");
    }
}