<?php
namespace Controllers\Router\Routes;
use Controllers\UnitController;
use Controllers\Router\Route;


class RouteDeleteUnit extends Route {
    private UnitController $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    // Gérer la méthode GET (avant la suppression)
    public function get(array $params = []) {
        $id = $this->getParam($params, 'id');  // Récupérer l'ID de l'unité
        // Redirige l'utilisateur vers la vue de confirmation de suppression (delete-unit.php)
        $this->controller->confirmDelete($id);
    }

    // Gérer la méthode POST (après avoir confirmé la suppression)
    public function post(array $params = []) {
        $id = $this->getParam($params, 'id');  // Récupérer l'ID de l'unité
        // Supprimer l'unité via le controller
        $this->controller->deleteUnit($id);  // Appelle la méthode du controller pour supprimer l'unité
    }
}
?>
