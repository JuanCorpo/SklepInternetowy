<?php

class ParametersModel
{
    // TODO dopisać poprawki z parametermodel do database context
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