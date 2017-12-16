<?php
include_once("./Models/AboutModel.php");
foreach (glob("./Views/About/*.php") as $filename) {
    include_once $filename;
}
include_once "./Controllers/MessagesController.php";

class AboutController
{
    private $context;

    public function __construct($sql)
    {
        $this->context = $sql;
    }

    public function Index()
    {
        //$model = new AboutModel();

        // TODO Load from DB into model
        // TODO Add pager class to model (abstract/interface ? )
        // TODO Auth class
        // TODO migrations ??
        // TODO View() automatic redirect from controller to View
        // TODO ListViewModel in Models as array of DB entries
        // TODO Pass whole model via html form

        $model = [];

        $db_Result = $this->context->Query("SELECT * FROM table_v1");

        $count = 0;
        while ($row = $db_Result->fetch_array(MYSQLI_NUM)) {

            $model[] = new AboutModel();

            $model[$count]->IdTable = $row[0];
            $model[$count]->NameTable = $row[1];
            $model[$count]->BoolTable = $row[2];
            $model[$count]->ValueTable = $row[3];

            $count++;
        }

        return AboutIndexView($this, $model);
    }

    public function About()
    {
        $model = new AboutModel();
        $model->text = "ABOUT  - 2";
        $model->value = 100000;

        return AboutAboutView($this, $model);
    }

    public function Edit($param)
    {
        $model = new AboutModel();
        $db_Result = $this->context->Query("SELECT * FROM table_v1 WHERE ID = $param");

        $count = 0;
        while ($row = $db_Result->fetch_array(MYSQLI_NUM)) {

            $model->IdTable = $row[0];
            $model->NameTable = $row[1];
            $model->BoolTable = $row[2];
            $model->ValueTable = $row[3];

            $count++;
        }

        return AboutEditView($this, $model);
    }

    public function EditPost()
    {
        $id = $_POST['id'];
        $name = $_POST['textArea'];
        $bool = isset($_POST["bool"]) ? 1 : 0;
        $value = $_POST['select'];

        $this->context->Query("UPDATE table_v1 SET NAME='$name' ,BOOL=$bool ,VALUE=$value WHERE ID = $id");

        $this->Index();
    }

    public function Add()
    {

        return AboutAddView();
    }

    public function AddPost()
    {
        $name = $_POST['textArea'];
        $bool = isset($_POST["bool"]) ? 1 : 0;
        $value = $_POST['select'];

        // TEST
        $message = new MessagesController();

        if ($bool == 1) {
            $message->SendMail();
        }


        $this->context->Query("INSERT INTO table_v1 (name ,bool ,value) VALUES ('$name' ,$bool,$value)");

        $this->Index();
    }

    public function Delete($param)
    {
        $db_Result = $this->context->Query("DELETE FROM table_v1 WHERE ID = $param");

        $this->Index();
    }
}