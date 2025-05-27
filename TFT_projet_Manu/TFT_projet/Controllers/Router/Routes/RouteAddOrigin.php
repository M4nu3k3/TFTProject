<?php
namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteAddOrigin extends Route {
    private UnitController $controller;

    public function __construct(UnitController $controller) {
        $this->controller = $controller;
    }

    // Gère les requêtes GET
    public function get(array $params = []): void {
        $this->controller->displayAddOrigin();
    }

    // Gère les requêtes POST (ajout d'une origine en base de données)
    public function post(array $params = []): void {
        $name = $this->getParam($params, 'name', false);
        $url_img = $this->getParam($params, 'url_img', false);

        $originDAO = new \Models\OriginDAO();
        $originDAO->addOrigin($name, $url_img);

        // Rediriger vers la page d'accueil après l'ajout
        header('Location: index.php?message=Origine ajoutée avec succès');
        exit();
    }
}
