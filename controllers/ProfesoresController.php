<?php

namespace Controllers;

use MVC\Router;


class ProfesoresController {
    public static function index(Router $router)
    {
        $router->render('profesores/index', []);
      
    }
}