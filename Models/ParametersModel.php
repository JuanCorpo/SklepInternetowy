<?php

class ParametersModel
{
    public $ProductId;
    public $CategoryId;
    public $ParameterId;
    public $ParameterValue;
    public $ParameterType;

    public function GetFullValue()
    {
        return $this->ParameterType->Prefix.' ' . $this->ParameterValue . ' ' .$this->ParameterType->Suffix;
    }
}