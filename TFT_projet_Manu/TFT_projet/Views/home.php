<?php
$this->layout('template', ['title' => 'TP TFT']);
?>

<h1>TFT - Set <?= $this->e($tftSetName) ?></h1>

<?php
require_once __DIR__ . '/../Controllers/UnitController.php';
require_once __DIR__ . '/../Models/UnitDAO.php';

// Créer l'instance du DAO
$unitDAO = new \Models\UnitDAO();
$units = $unitDAO->getAllUnitsWithOrigins();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Liste des Unités</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'avoir un fichier CSS pour le style -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a2e;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #e94560;
            margin-top: 20px;
        }

        .unit-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .unit-card {
            background-color: #162447;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 250px;
            padding: 15px;
            text-align: center;
            position: relative;
        }

        .unit-card img {
            max-width: 100%; /* L'image ne dépasse pas la largeur du conteneur */
            height: auto; /* Préserve les proportions de l'image */
            display: block; /* Assure que l'image est rendue */
            min-height: 32px; /* Hauteur minimale pour garantir qu'elle est visible */
            object-fit: cover; /* Ajuste l'image au conteneur */
        }

        .unit-card h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #e94560;
        }

        .unit-card .cost {
            background-color: #1f4068;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-weight: bold;
        }

        .unit-card .origins {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .unit-card .origins .origin-item {
            display: flex;
            align-items: center;
            gap: 8px; /* Espacement entre l'icône et le nom */
        }

        .unit-card .origins img {
            width: 32px;  /* Taille de l'image d'origine ajustée à 32px */
            height: 32px; /* Taille de l'image d'origine ajustée à 32px */
            border-radius: 50%; /* Garder les coins arrondis */
        }

        .actions {
            margin-top: 15px;
        }

        .actions a {
            text-decoration: none;
            color: #e94560;
            margin: 0 10px;
            font-weight: bold;
        }

        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Liste des Unités</h1>

<div class="unit-grid">
    <?php foreach ($units as $unit): ?>
        <div class="unit-card">
            <?php
            // Télécharger l'image depuis l'URL
            $imageContent = file_get_contents($unit->getUrlImg());
            if ($imageContent !== false):
                // Détecter le type MIME de l'image
                $imageInfo = getimagesizefromstring($imageContent);
                if ($imageInfo !== false) {
                    $mimeType = $imageInfo['mime']; // type MIME de l'image (ex: image/jpeg, image/png)
                    $base64Image = base64_encode($imageContent);
                }
                ?>
                <!-- Afficher l'image encodée avec le bon type MIME -->
                <img src="data:<?= $mimeType ?>;base64,<?= $base64Image ?>" alt="<?= htmlspecialchars($unit->getName()); ?>">
            <?php else: ?>
                <!-- Image par défaut -->
                <img src="default-unit.png" alt="Image par défaut">
            <?php endif; ?>

            <!-- Nom de l'unité -->
            <h2><?= htmlspecialchars($unit->getName()); ?></h2>

            <!-- Coût -->
            <div class="cost">Coût : <?= htmlspecialchars($unit->getCost()); ?></div>

            <!-- Origines -->
            <div class="origins">
                <?php foreach ($unit->getOrigins() as $origin): ?>
                    <span class="origin-item">
                        <img src="<?= $origin->getUrlImg(); ?>" alt="<?= htmlspecialchars($origin->getName()); ?>" style="width: 32px; height: 32px;">
                        <?= htmlspecialchars($origin->getName()); ?>
                    </span>
                <?php endforeach; ?>
            </div>

            <div class="actions">
                <a href="index.php?action=edit-unit&id=<?= $unit->getId(); ?>">Modifier</a>
                <a href="index.php?action=delete-unit&id=<?= $unit->getId(); ?>">Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
