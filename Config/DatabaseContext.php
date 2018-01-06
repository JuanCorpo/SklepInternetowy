<?php
include_once("sql.php");
foreach (glob("./Config/DatabaseContext/*.php") as $filename) {
    include_once $filename;
}

class DatabaseContext
{
    // Database tables
    public $sql;
    public $Users;
    public $Products;
    public $Parameters;
    public $ParametersTypes;
    public $Categories;
    public $EmailQueues;
    public $EmailTemplates;

    public function __construct()
    {
        $this->sql = new SQL();
        $this->Users = new Users($this);
        $this->Products = new Products($this);
        $this->Parameters = new Parameters($this);
        $this->ParametersTypes = new ParametersTypes($this);
        $this->Categories = new Categories($this);
        $this->EmailQueues = new EmailQueues($this);
        $this->EmailTemplates = new EmailTemplates($this);
    }


}