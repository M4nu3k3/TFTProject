<?php
namespace Controllers;

use AllowDynamicProperties;
use League\Plates\Engine;
use Models\UnitDAO;
use Models\Unit;
use Models\OriginDAO;

#[AllowDynamicProperties] class UnitController {
    private Engine $templates;
    private UnitDAO $unitDAO;


    public function __construct(Engine $templates,$unitDAO,OriginDAO $originDAO) {
        $this->templates = $templates;
        $this->unitDAO = $unitDAO;
        $this->OriginDAO = $originDAO;

    }

    // Méthode pour afficher la page d'ajout d'une unité
    public function displayAddUnit(): void {
        echo $this->templates->render('add-unit');
    }

    public function displayAddOrigin(): void {
        echo $this->templates->render('add-origin');
    }

    public function getById(string $id) {
        return $this->unitDAO->getById($id);
    }
    // Méthode pour afficher la page de modification d'une unité


    public function displayEditUnit(string $unitId): void {
        // Récupérer l'unité via son ID
        $unitDAO = new \Models\UnitDAO();
        $originDAO = new \Models\OriginDAO();
        $unit = $unitDAO->getByID($unitId);
        $origins = $originDAO->getByUnitId($unitId);
        $allOrigins = $unitDAO->getAllOrigins();

        $selectedOrigins = [];
        foreach ($origins as $orig) {
            $selectedOrigins[] = $orig->getId();
        }

        // Vérifier si l'unité existe
        if (!$unit) {
            throw new \Exception("Unité introuvable avec l'ID $unitId");
        }

        // Afficher la vue avec les informations de l'unité
        echo $this->templates->render('edit-unit', [
            'unit' => $unit,
            'selectedOrigins' => $selectedOrigins,
            'allOrigins' => $allOrigins,
        ]);
    }

    public function addUnit(string $name, int $cost, array $origin, string $url_img): void {

        foreach ($origin as $orig) {
            $array[] = $this->OriginDAO->getById($orig);
        }
        var_dump($array);
        $unit = new \Models\Unit([
            'id' => null,
            'name' => $name,
            'cost' => $cost,
            'url_img' => $url_img,
            'origins' => $array,
        ]);


        $this->unitDAO->addUnit($unit);
    }


    public function editUnit($id, $name, $cost, $origin, $url_img) {
        $unitDAO = new UnitDAO();
        $unitDAO->update($id, $name, $cost, $origin, $url_img);
    }


    public function confirmDelete(int $id) {
        $unitDAO = new \Models\UnitDAO();
        $unit = $unitDAO->getByID($id); // Récupérer l'unité à supprimer

        if ($unit) {
            // Passer l'unité à la vue delete-unit.php
            include __DIR__ . '/../Views/delete-unit.php';
        } else {
            // Si l'unité n'a pas été trouvée
            echo "L'unité n'a pas été trouvée.";
        }
    }


    public function deleteUnit(int $id) {
        $unitDAO = new \Models\UnitDAO();
        $unitDAO->delete($id);  // Supprimer l'unité de la base de données

        // Rediriger l'utilisateur vers la page d'accueil après la suppression
        header("Location: " . "/TFT_projet/" . "index.php");
        exit;  // Arrêter l'exécution du script après la redirection
    }


    public function displaySearchForm() {
        require_once __DIR__ . '/../Views/search-unit.php';
    }
    public function searchUnit(?string $name, ?string $cost, ?string $origin): array {
        return $this->unitDAO->searchMultipleFields($name, $cost, $origin);
    }

    // Affiche les résultats de la recherche
    public function displaySearchResults($results) {
        require_once __DIR__ . '/../Views/search-unit.php'; // Assurez-vous que la vue affiche aussi les résultats
    }
}
