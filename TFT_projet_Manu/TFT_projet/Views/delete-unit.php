<?php

// Vérifier si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  // Convertir l'ID en entier pour plus de sécurité

    // Créer une instance de UnitDAO pour accéder aux données
    $unitDAO = new \Models\UnitDAO();

    // Récupérer l'unité à supprimer
    $unit = $unitDAO->getByID($id);

    // Si l'unité existe
    if ($unit) {
        // Si la requête est en POST, on supprime l'unité
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Supprimer l'unité de la base de données
            $unitDAO->delete($id);

            // Rediriger vers la page d'accueil avec un message de confirmation
            header("Location: " . BASE_URL . "index.php?message=unite_supprimee");
            exit; // Arrêter l'exécution du script après la redirection
        }
    } else {
        // Si l'unité n'a pas été trouvée
        echo "L'unité n'a pas été trouvée.";
        exit;
    }
} else {
    // Si aucun ID n'est spécifié dans l'URL
    echo "Aucun ID d'unité spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de suppression</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a2e; /* Fond sombre */
            color: #ffffff; /* Texte en blanc pour contraster */
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #e94560; /* Couleur accent pour le titre */
            margin-top: 20px;
        }

        form {
            background-color: #162447; /* Fond sombre pour le formulaire */
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        button[type="submit"] {
            background-color: #e94560; /* Bouton avec la couleur accent */
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #d83652; /* Changement de couleur au survol */
        }

        a {
            display: block;
            margin-top: 20px;
            color: #e94560;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Êtes-vous sûr de vouloir supprimer l'unité : <?= htmlspecialchars($unit->getName()) ?> ?</h1>

<!-- Formulaire de confirmation de suppression -->
<form method="POST" action="">
    <button type="submit">Supprimer</button>
</form>

<!-- Lien retour à l'accueil -->
<a href="<?= BASE_URL ?>index.php">Retour à l'accueil</a>

</body>
</html>
