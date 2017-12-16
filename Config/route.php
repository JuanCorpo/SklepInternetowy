<?php

class Route
{
    public function submit($sql)
    {
        $uriGetParam = isset($_GET['uri']) ? '' . $_GET['uri'] : '';

        $data = explode('/', $uriGetParam);

        // if(isset($_POST['name']) && $_POST['name'] != ""){
        //    $data[] = $_POST['name'];
        //}

        if (count($data) <= 1) {
            $this->Redirect("Home", "Index", $sql);
            return;
        } else if (count($data) >= 2) // For "ControllerName/ActionName" pattern
        {
            $Controller = $data[0];
            $Action = $data[1];

            foreach (glob("./Controllers/*.php") as $filename) {
                if (strpos($filename, $Controller . 'Controller') !== false) {
                    $this->RedirectTo($Controller, $Action, $data, $sql);
                    return;
                }
            }
        }

        // TODO try catch 404 no action/View
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        throw new Exception("There is no such controller or action or action with given parameters. Check the URL");
        die();

        $this->Redirect("Home", "Index", $sql);
        return;
    }

    public function Redirect($Controller, $Action, $sql)
    {
        $this->RedirectTo($Controller, $Action, null, $sql);
    }

    private function RedirectTo($Controller, $Action, $data, $sql)
    {
        $useController = $Controller . 'Controller';

        include_once("./Controllers/$useController.php");

        $useController = $Controller . 'Controller';
        $class = new $useController($sql);

        if ($data != null && count($data) == 3) {
            $Params = $data[2];
            $class->$Action($Params);
        } else {
            $class->$Action();
        }

    }


}