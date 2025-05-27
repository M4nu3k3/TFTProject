<?php
namespace Controllers\Router\Routes;

use Controllers\UnitController;
use Controllers\Router\Route;

class RouteSearch extends Route {
private $unitController;

public function __construct(UnitController $unitController) {
$this->unitController = $unitController;
}

public function get(array $params = []) {
// Afficher la page de recherche sans faire de recherche pour le moment
$this->unitController->displaySearchForm(); // Cette méthode affiche le formulaire sans rechercher
}

public function post(array $params = []) {
// Récupérer les paramètres de recherche envoyés par le formulaire
$name = $params['name'] ?? null;
$cost = $params['cost'] ?? null;
$origin = $params['origin'] ?? null;

// Appeler la méthode de recherche
$results = $this->unitController->searchUnit($name, $cost, $origin);

// Afficher la page de recherche avec les résultats
$this->unitController->displaySearchResults($results);
}
}
