<?php

class SQL
{
    private $conn;

    private $host;
    private $base;
    private $user;
    private $pass;

    public function __construct()
    {
        $this->host = 'mysql.cba.pl';//'localhost';//
        $this->user = 'AllonerCorp';//'Alan';//
        $this->pass = 'AllonerCorp12';//'Alan';//
        $this->base = 'juancorp';
    }

    public function Query($query)
    {
        $this->Connect();

        mysqli_query($this->conn,"SET CHARSET utf8");
        mysqli_query($this->conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`");

        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));

        $this->Disconnect();

        return $result;
    }

    public function SqlResultToArray($sqlResult)
    {
        $data = array();
        while ($d = $sqlResult->fetch_assoc()) {
            $data[] = $d;
        }

        return $data;
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

    private function Connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->base);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function Disconnect()
    {
        $this->conn->close();
    }
}
