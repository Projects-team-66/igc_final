<?php

namespace Controllers;


use MVC\Router;

class ReporteConductaController
{
    public static function index(Router $router)
    {
        $router->render('reporteconducta/index', []);
    }


}
