<?php

class Route
{
    public function submit($context)
    {
        $uriGetParam = isset($_GET['uri']) ? '' . $_GET['uri'] : '';

        $data = explode('/', $uriGetParam);

        if (count($data) <= 1) {
            $this->Redirect("Home", "Index", $context);
            return;
        } else if (count($data) >= 2) // For "ControllerName/ActionName" pattern
        {
            $Controller = $data[0];
            $Action = $data[1];

            foreach (glob("./Controllers/*.php") as $filename) {
                if (strpos($filename, $Controller . 'Controller') !== false) {
                    $this->RedirectTo($Controller, $Action, $data, $context);
                    return;
                }
            }
        }

        // TODO try catch 404 no action/View
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        //throw new Exception("There is no such controller or action or action with given parameters. Check the URL");
        echo "<div style='color:red;text-align: center;'><h1 style='color:red;'>Exception</h1>There is no such controller or action or action with given parameters. Check the URL</div>";
        // die();

        $this->Redirect("Home", "Index", $context);
        return;
    }

    public function Redirect($Controller, $Action, $context)
    {
        $this->RedirectTo($Controller, $Action, null, $context);
    }

    private function RedirectTo($Controller, $Action, $data, $context)
    {
        $useController = $Controller . 'Controller';

        include_once("./Controllers/$useController.php");

        $useController = $Controller . 'Controller';
        $class = new $useController($context);

        if ($data != null && count($data) == 3) {
            $class->$Action($data[2]);
        } else if ($data != null && count($data) == 4) {
            $class->$Action($data[2],$data[3]);
        } else {
            $class->$Action(null);
        }

    }


}