<?php
namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;


class RouteUpdateConfirmation extends \Controllers\Router\Route {
    private $mainController;

    public function __construct($mainController) {
        $this->mainController = $mainController;
    }

    public function get(array $params = []) {
        $this->mainController->displayUpdateConfirmation();
    }

    public function post(array $params = []) {
        // Pas nécessaire pour cette route
    }
}