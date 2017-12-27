<?php

class ParametersModel
{
    public $ProductId;
    public $CategoryId;
    public $ParameterId;
    public $ParameterName;
    public $ParameterValue;
    public $Prefix;
    public $Suffix;

    public function GetFullValue()
    {
        return $this->Prefix.' ' . $this->ParameterValue . ' ' .$this->Suffix;
    }
}