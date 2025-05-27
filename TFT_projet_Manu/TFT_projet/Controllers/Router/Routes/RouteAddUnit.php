<?php
namespace Controllers\Router\Routes;

use Controllers\Router\Route;
use Controllers\UnitController;

class RouteAddUnit extends Route {
    private UnitController $controller;

    public function __construct(UnitController $controller) {
        $this->controller = $controller;
    }

    // Gère les requêtes GET
    public function get(array $params = []): void {
        $this->controller->displayAddUnit();
    }

    // Gère les requêtes POST (ajout d'une unité en base de données)
    public function post(array $params = []) {
        try {
            // Récupérer les données POST
            $name = $this->getParam($params, 'unitName');
            $cost = $this->getParam($params, 'unitCost');
            $origin = $this->getParam($params, 'unitOrigin');
            $url_img = $this->getParam($params, 'unitUrlImg');
            // Ajouter l'unité via le controller
            $this->controller->addUnit($name, (int)$cost, $origin, $url_img);

            // Redirection après ajout
            header("Location: index.php?action=update-confirmation");
            exit;
        } catch (\Exception $e) {
            echo "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }

}
