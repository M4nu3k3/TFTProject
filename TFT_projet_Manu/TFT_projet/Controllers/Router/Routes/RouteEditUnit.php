<?php
namespace Controllers\Router\Routes;

use Controllers\UnitController;
use Controllers\Router\Route;

class RouteEditUnit extends Route {
    private $unitController;

    public function __construct(UnitController $unitController) {
        $this->unitController = $unitController;
    }

    public function get(array $params = []) {
        try {
            // Vérifier si l'ID est bien passé dans les paramètres
            if (isset($params['id'])) {
                $id = $params['id'];
            } else {
                throw new \Exception("ID manquant");
            }

            // Appel du contrôleur pour récupérer l'unité avec cet ID
            $unit = $this->unitController->getById($id);

            // Afficher la page d'édition de l'unité
            $this->unitController->displayEditUnit($id);
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }


    public function post(array $params = []) {
        try {
            // Récupérer l'ID et les autres données depuis POST
            $id = $this->getParam($params, 'id');
            $name = $this->getParam($params, 'name');
            $cost = $this->getParam($params, 'cost');
            $origin = $this->getParam($params, 'origin');
            $url_img = $this->getParam($params, 'url_img');

            // Vérifier si l'ID existe
            if (empty($id)) {
                throw new \Exception('Le paramètre "id" est absent.');
            }

            // Mettre à jour l'unité
            $this->unitController->editUnit($id, $name, $cost, $origin, $url_img);

            // Redirection vers la page de confirmation
            header("Location: index.php?action=update-confirmation");
            exit; // Assurez-vous que le script s'arrête après la redirection
        } catch (\Exception $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }

}
