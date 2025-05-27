<?php
namespace Controllers;
use League\Plates\Engine;
use Models\UnitDAO;

class MainController {
    private Engine $templates;

    public function __construct(Engine $templates) {
        $this->templates = new Engine('Views');
    }

    public function index(): void {
        $UnitDAO = new UnitDAO();
        $listUnit = $UnitDAO -> getAll();
        $first = $UnitDAO -> getByID('1');
        $other = $UnitDAO -> getByID('6');

        echo $this->templates->render('home', ['tftSetName' => 'Into The Arcane']);

    }

    public function displaySearch(): void {
        echo $this->templates->render('search');
    }

    // Méthode pour afficher les résultats de la recherche


    public function displayUpdateConfirmation(): void {
        echo $this->templates->render('update-confirmation');
    }
}

