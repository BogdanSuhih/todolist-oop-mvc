<?php

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '\\' . $className . '.php';
    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/Project/routes.php';
    $isRouteFound = false;

    

    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }
    if (!$isRouteFound) {
        throw new \Project\Exceptions\RouteException('Такого адреса не существует!');
    }
    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];
    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\Project\Exceptions\DbException $ex) {
    $obj = new \Project\Views\View(__DIR__ . '/templates/');
    $obj->renderTemplate(
        'errors/500.php',
        ['error' => $ex->getMessage(),
        'title' => 'DB Error'],
        500
    );
} catch (\Project\Exceptions\RouteException $ex) {
    $obj = new \Project\Views\View(__DIR__ . '/templates/');
    $obj->renderTemplate(
        'errors/401.php',
        ['error' => $ex->getMessage(), 'title' => 'Not found'],
        404
    );
}
