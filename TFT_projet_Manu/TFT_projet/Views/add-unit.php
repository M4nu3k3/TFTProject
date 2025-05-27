<?php

use Models\UnitDAO;

// Récupérer toutes les origines existantes
$unitDAO = new UnitDAO();
$allOrigins = $unitDAO->getAllOrigins();  // Assure-toi que getAllOrigins() est bien définie dans UnitDAO
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($unit) ? "Modifier l'unité" : "Ajouter une unité" ?></title>
    <style>
        /* Couleurs globales */
        :root {
            --bg-color: #1a1a2e; /* Fond sombre */
            --text-color: #ffffff; /* Texte blanc */
            --primary-color: #e94560; /* Couleur primaire (rose) */
            --secondary-color: #162447; /* Fond des cartes (bleu sombre) */
            --input-bg: #162447; /* Fond des champs sombre */
            --input-border-color: #ccc; /* Bordure des champs */
            --button-bg: #e94560; /* Couleur du bouton (rose) */
            --button-bg-hover: #c0392b; /* Survol du bouton */
            --link-color: #e94560; /* Liens couleur rose */
            --link-color-hover: #c0392b; /* Survol des liens */
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: 20px auto;
            background: var(--secondary-color);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--text-color);
        }

        input[type="text"],
        input[type="number"] {
            margin-bottom: 15px;
            padding: 8px;
            font-size: 16px;
            border: 1px solid var(--input-border-color);
            border-radius: 4px;
            background-color: var(--input-bg);
            color: var(--text-color);
        }

        .origin-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .origin-item label {
            margin: 0;
            font-weight: normal;
        }

        .origin-item input[type="checkbox"] {
            margin-left: 10px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: var(--button-bg);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        button:hover:enabled {
            background-color: var(--button-bg-hover);
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--link-color);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: var(--link-color-hover);
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1><?= isset($unit) ? "Modifier l'unité" : "Ajouter une unité" ?></h1>

<!-- Formulaire pour ajouter ou modifier une unité -->
<form method="POST" action="<?= BASE_URL ?>index.php?action=add-unit">
    <!-- ID (optionnel si en mode ajout) -->
    <?php if (isset($unit)): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($unit->getId()) ?>">
    <?php endif; ?>

    <!-- Nom de l'unité -->
    <label for="unitName">Nom de l'unité :</label>
    <input type="text" id="unitName" name="unitName" value="<?= isset($unit) ? htmlspecialchars($unit->getName()) : '' ?>" required>

    <!-- Coût -->
    <label for="unitCost">Coût :</label>
    <input type="number" id="unitCost" name="unitCost" value="<?= isset($unit) ? htmlspecialchars($unit->getCost()) : '' ?>" required>

    <!-- Origine (choix multiple avec cases à cocher) -->
    <label for="unitOrigin">Origine :</label><br>
    <?php
    // Vérifier si une origine est déjà sélectionnée (pour le cas de modification)
    $selectedOrigins = isset($unit) ? $unit->getOrigins() : [];  // Si l'unité est en mode modification, on récupère les origines actuelles
    foreach ($allOrigins as $origin) {
        $checked = in_array($origin['id'], array_column($selectedOrigins, 'id')) ? 'checked' : '';  // Pré-sélectionner les origines existantes
        echo "<div class=\"origin-item\">";
        echo "<label>{$origin['name']}</label>";
        echo "<input type=\"checkbox\" name=\"unitOrigin[]\" value=\"{$origin['id']}\" $checked>";
        echo "</div>";
    }
    ?>

    <!-- URL de l'image -->
    <label for="unitUrlImg">URL de l'image :</label>
    <input type="text" id="unitUrlImg" name="unitUrlImg" value="<?= isset($unit) ? htmlspecialchars($unit->getUrlImg()) : '' ?>" required>

    <?php if (isset($error) && !empty($error)): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <button type="submit"><?= isset($unit) ? "Mettre à jour l'unité" : "Ajouter l'unité" ?></button>
</form>

<!-- Bouton pour revenir à l'accueil -->
<a href="<?= BASE_URL ?>index.php">Retour à l'accueil</a>

</body>
</html>
