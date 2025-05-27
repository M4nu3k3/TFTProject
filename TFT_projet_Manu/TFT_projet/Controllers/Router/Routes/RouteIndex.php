<?php
namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteIndex extends Route {
    private MainController $controller;

    public function __construct(MainController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []) {
        $this->controller->index();
    }

    public function post(array $params = []) {
    }
}
