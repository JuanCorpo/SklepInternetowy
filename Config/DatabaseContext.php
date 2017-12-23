<?php
include_once("sql.php");
include_once("DatabaseContext/Users.php");

class DatabaseContext
{
    public $sql;
    public $Users;

    public function __construct()
    {
        $this->sql = new SQL();
        $this->Users = new Users($this->sql);
    }
}