<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Code/CustomClasses/Parameter.php";

class Parameters
{

    private $Parameter = [];
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function LoadParametersForProduct($productId)
    {
        $this->Parameter = [];
        $result = $this->SQL->Query("SELECT * FROM parameters WHERE ProductId=$productId");

        while ($d = $result->fetch_assoc()) {
            $this->Parameter[] = new Parameter();
            $this->Parameter[count($this->Parameter)-1]->ProductId = $d['ProductId'];
            $this->Parameter[count($this->Parameter)-1]->CategoryId = $d['CategoryId'];
            $this->Parameter[count($this->Parameter)-1]->ParameterId = $d['ParameterId'];
            $this->Parameter[count($this->Parameter)-1]->ParameterValue = $d['ParameterName'];
            $this->Parameter[count($this->Parameter)-1]->ParameterValue = $d['ParameterValue'];
            $this->Parameter[count($this->Parameter)-1]->Suffix = $d['Suffix'];
            $this->Parameter[count($this->Parameter)-1]->Prefix = $d['Prefix'];
        }

        return $this->Parameter;
    }
}