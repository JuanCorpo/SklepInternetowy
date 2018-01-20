<?php

class Addresses
{
    private $Context;
    private $SQL;

    public function __construct($context)
    {
        $this->Context = $context;
        $this->SQL = $this->Context->sql;
    }

    public function GetAddress($AddressId)
    {
        $address = null;
        $result = $this->SQL->Query("SELECT * FROM addresses WHERE AddressId=$AddressId");

        if (count($result) != 0) {
            $address = new AddressesModel();

            $address->AddressId = $result[0]['AddressId'];
            $address->UserId = $result[0]['UserId'];
            $address->Country = $result[0]['Country'];
            $address->City = $result[0]['City'];
            $address->Street = $result[0]['Street'];
            $address->HouseNumber = $result[0]['HouseNumber'];
            $address->PostalCode = $result[0]['PostalCode'];
            $address->PhoneNumber = $result[0]['PhoneNumber'];
            $address->Vovoidship = $result[0]['Vovoidship'];
        }
            return $address;
    }

    public function  GetUserAddresses($UserId)
    {
        $Addresses = [];
        $result = $this->SQL->Query("SELECT * FROM addresses WHERE UserId = $UserId");

        foreach ($result as $item) {

            $Addresses[] = new AddressesModel();

            $Addresses[count($Addresses) - 1]->AddressId = $item['AddressId'];
            $Addresses[count($Addresses) - 1]->UserId = $item['UserId'];
            $Addresses[count($Addresses) - 1]->Country = $item['Country'];
            $Addresses[count($Addresses) - 1]->City = $item['City'];
            $Addresses[count($Addresses) - 1]->Street = $item['Street'];
            $Addresses[count($Addresses) - 1]->HouseNumber = $item['HouseNumber'];
            $Addresses[count($Addresses) - 1]->PostalCode = $item['PostalCode'];
            $Addresses[count($Addresses) - 1]->PhoneNumber = $item['PhoneNumber'];
            $Addresses[count($Addresses) - 1]->Vovoidship = $item['Vovoidship'];

        }
        if (count($Addresses) != 0) return $Addresses;
        else return null;
    }

    public function  AddAddress($AddressModel)
    {
        $UserID = $AddressModel->UserId;
        $Country = $AddressModel->Country;
        $City = $AddressModel->City;
        $Street = $AddressModel->Street;
        $HouseNumber = $AddressModel->HouseNumber;
        $PostalCode = $AddressModel->PostalCode;
        $PhoneNumber = $AddressModel->PhoneNumber;
        $Vovoidship = $AddressModel->Vovoidship;

        $query = "INSERT INTO addresses VALUES ('',$UserID, '$Country', '$City', '$Street', '$HouseNumber', '$PostalCode', '$PhoneNumber', '$Vovoidship' )";
        $this->SQL->Query($query);
    }

    public function  DeleteAddress($AddressId)
    {

        $query = "DELETE FROM addresses WHERE AddressId = $AddressId";
        $this->SQL->Query($query);
    }
}