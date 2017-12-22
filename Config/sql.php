<?php

class SQL
{
    private $host;
    private $base;
    private $user;
    private $pass;

    public function __construct()
    {
        //$this->host = 'localhost';
        //$this->user = 'Alan';
        //$this->pass = 'Alan';
        //$this->base = 'juancorp';

        $this->host = 'mysql.cba.pl';
        $this->user = 'AllonerCorp';
        $this->pass = 'AllonerCorp12';
        $this->base = 'juancorp';
    }

    public function Query($query)
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->base);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        mysqli_query($conn,"SET CHARSET utf8");
        mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`");

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        $conn->close();

        return $result;
    }

    public function GetMenuData()
    {
        $result = $this->Query("SELECT * FROM categories");

        $data = array();
        while ($d = $result->fetch_assoc()) {
            $data[] = $d;
        }

        return $data;
    }

    public function MenuDataToJSON()
    {
        $data = $this->GetMenuData();

        //initialize array
        $myArray = array();

        //set up the nested associative arrays using literal array notation
        foreach ($data as $row)
            $myArray[] = array("id" => $row['CategoryId'], "name" => $row['CategoryName'], "parent" => $row['ParentId']);

        //convert to json
        $json = json_encode($myArray);

        return $json;
    }
}