<?php
namespace Controllers\Router;
use Models\OriginDAO;
use Models\UnitDAO;

use League\Plates\Engine;

class Router {
    private array $routeList = [];
    private array $ctrlList = [];
    private string $actionKey;

    public function __construct(string $actionKey = "action") {
        $this->actionKey = $actionKey;
        $this->createControllerList();
        $this->createRouteList();
    }

    private function createControllerList() {
        $engine = new Engine('Views');
        $unitDAO = new UnitDAO(); // Instancie UnitDAO ici
        $OriginDAO = new OriginDAO();
        $this->ctrlList = [
            "main" => new \Controllers\MainController($engine),
            "unit" => new \Controllers\UnitController($engine, $unitDAO,$OriginDAO) // Passe UnitDAO ici
        ];
    }


    private function createRouteList() {
        $this->routeList = [
            "index" => new \Controllers\Router\Routes\RouteIndex($this->ctrlList["main"]),
            "add-unit" => new \Controllers\Router\Routes\RouteAddUnit($this->ctrlList["unit"]),
            "add-origin" => new \Controllers\Router\Routes\RouteAddOrigin($this->ctrlList["unit"]),
            "search" => new \Controllers\Router\Routes\RouteSearch($this->ctrlList["unit"]),
            "edit-unit" => new \Controllers\Router\Routes\RouteEditUnit($this->ctrlList["unit"]),
            "delete-unit" => new \Controllers\Router\Routes\RouteDeleteUnit($this->ctrlList["unit"]),
            "update-confirmation" => new \Controllers\Router\Routes\RouteUpdateConfirmation($this->ctrlList["main"])

        ];
    }

    public function routing(array $get, array $post) {
        $action = $get[$this->actionKey] ?? "index";
        if (isset($this->routeList[$action])) {
            $route = $this->routeList[$action];
            $method = empty($post) ? "get" : "post";
            $route->$method($method === "get" ? $get : $post);
        } else {
            throw new \Exception("Route inconnue : $action");
        }
    }
}
