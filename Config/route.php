<?php

class Route
{
    private $databaseContext;

    public function submit($databaseContext)
    {
        $this->databaseContext = $databaseContext;
        $uriGetParam = isset($_GET['uri']) ? '' . $_GET['uri'] : '';

        $params = explode('/', $uriGetParam);

        if (count($params) < 2) {
            $this->RedirectTo("Home", "Index", null);
            return;
        }
        else if (count($params) >= 2) // For "ControllerName/.../.../..." pattern
        {
            $Controller = $params[0];
            $Action = $params[1];

            foreach (glob("./Controllers/*.php") as $filename) {
                if (strpos($filename, $Controller . 'Controller') !== false) {
                    $this->RedirectTo($Controller, $Action, $params);
                    return;
                }
            }
        }

        echo "<div style='color:red;text-align: center;'><h1 style='color:red;'>Exception</h1>There is no such controller or action. Pl0x check the URL</div><pre>";
        print_r($params);
        echo "</pre>";

        $this->RedirectTo("Home", "Index", null);
        return;
    }

    private function RedirectTo($Controller, $Action, $args)
    {
        $useController = $Controller . 'Controller';

        include_once("./Controllers/$useController.php");

        $useController = $Controller . 'Controller';
        $class = new $useController($this->databaseContext);

        if ($args != null) {
            if (count($args) == 3) {// Controller/Action/Par1
                $class->$Action($args[2]);
            } else if (count($args) == 4) {// Controller/Action/Par1/Par2
                $class->$Action($args[2], $args[3]);
            } else {
                $class->$Action(null);
            }
        }else {
            $class->$Action(null);
        }
    }
}