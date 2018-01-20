<?php

class SQL
{
    private $connection;

    private $Host;
    private $Database;
    private $Username;
    private $Password;

    public function __construct()
    {
        $this->Host = 'mysql.cba.pl';//'localhost';//
        $this->Username ='AllonerCorp';// 'Alan';//
        $this->Password = 'AllonerCorp12';//'Alan';//
        $this->Database = 'juancorp';
    }

    public function Query($query)
    {
        $this->Connect();

        mysqli_query($this->connection,"SET CHARSET utf8");
        mysqli_query($this->connection,"SET NAMES `utf8` COLLATE `utf8_polish_ci`");

        $sqlResult = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));

        $this->Disconnect();

        $resultArray = array();

        if($sqlResult !="1") {
            while ($row = $sqlResult->fetch_assoc()) {
                $resultArray[] = $row;
            }
        }
        return $resultArray;
    }

    private function Connect()
    {
        $this->connection = new mysqli($this->Host, $this->Username, $this->Password, $this->Database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    private function Disconnect()
    {
        $this->connection->close();
    }
}
