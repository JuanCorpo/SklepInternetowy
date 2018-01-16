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
    public $Orders;
    public $Baskets;
    public $Products;
    public $SiteInfos;
    public $Parameters;
    public $Categories;
    public $EmailQueues;
    public $EmailTemplates;
    public $ParametersTypes;
    public $Addresses;

    public function __construct()
    {
        $this->sql = new SQL();
        $this->Users = new Users($this);
        $this->Orders = new Orders($this);
        $this->Baskets = new Baskets($this);
        $this->Products = new Products($this);
        $this->SiteInfos = new SiteInfos($this);
        $this->Parameters = new Parameters($this);
        $this->Categories = new Categories($this);
        $this->EmailQueues = new EmailQueues($this);
        $this->EmailTemplates = new EmailTemplates($this);
        $this->ParametersTypes = new ParametersTypes($this);
        $this->Addresses = new Addresses($this);
    }


}