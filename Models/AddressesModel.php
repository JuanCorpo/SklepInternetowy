<?php

class AddressesModel
{
    public $UserId;
    public $Country;
    public $City;
    public $Street;
    public $HouseNumber;
    public $PostalCode;
    public $PhoneNumber;
    public $Vovoidship;

    public function GetFullAddress() {
        return $this->City . ' ' . $this->Street . ' ' . $this->HouseNumber . ' ' . $this->PhoneNumber . ' ' . $this->Vovoidship;
    }
}