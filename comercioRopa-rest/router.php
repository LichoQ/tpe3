<?php
    require_once 'libs/router.php';
    require_once 'app/controllers/task.api.controller.php';
    $router = new Router();

//                    endpoint      verbo       controller           metodo    
    $router->addRoute('tareas',     'GET',      'TaskApiController', 'getAll');
    $router->addRoute('tareas/:ID', 'GET',      'TaskApiController', 'get');
    $router->addRoute('tareas',     'POST',     'TaskApiController', 'create');
    $router->addRoute('tareas/:ID', 'DELETE',   'TaskApiController', 'delete');

    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);