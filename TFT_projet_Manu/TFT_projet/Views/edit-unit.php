<?php
// Vérifier si l'unité existe
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  // ID de l'unité passé par l'URL

    $unitDAO = new \Models\UnitDAO();
    $unit = $unitDAO->getByID($id);

    // Si l'unité n'est pas trouvée
    if (!$unit) {
        echo "L'unité demandée n'existe pas.";
        exit;
    }

    // Récupérer les données de l'unité
    $name = $unit->getName();
    $cost = $unit->getCost();
    $url_img = $unit->getUrlImg();

    $origin = $unitDAO->getOriginsByUnitId($id);
}

// Si le formulaire a été soumis, procéder à la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles valeurs soumises par le formulaire
    $newName = $_POST['name'];
    $newCost = $_POST['cost'];
    $newOrigins = $_POST['origin'];
    $newUrlImg = $_POST['url_img'];

    // Mettre à jour l'unité avec les nouvelles données
    $unitDAO->update($id, $newName, $newCost, $newOrigins, $newUrlImg);

    // Rediriger l'utilisateur vers la page de confirmation de la mise à jour
    header("Location: update-confirmation.php?id=$id");
    exit;
}
?>

<h1>Modifier l'unité : <?= htmlspecialchars($name) ?></h1>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">

    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required>

    <label for="cost">Coût :</label>
    <input type="number" step="1" name="cost" id="cost" value="<?= htmlspecialchars($cost) ?>" required>

    <label for="origin">Origine :</label><br>
    <?php
    // Affichage des cases à cocher
    foreach ($allOrigins as $orig) {
        // Vérifier si cette origine est déjà sélectionnée
        $checked = in_array($orig['id'], $selectedOrigins) ? 'checked' : '';
        echo "<input type=\"checkbox\" name=\"origin[]\" value=\"{$orig['id']}\" $checked> {$orig['name']}<br>";
    }
    ?>

    <label for="url_img">URL de l'image :</label>
    <input type="text" name="url_img" id="url_img" value="<?= htmlspecialchars($url_img) ?>" required>

    <button type="submit">Modifier</button>
</form>

<!-- Lien retour à l'accueil -->
<a href="<?= BASE_URL ?>index.php">Retour à l'accueil</a>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #1a1a2e; /* Fond sombre comme la page principale */
        color: #ffffff; /* Texte en blanc pour le contraste */
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #e94560; /* Couleur accent comme sur la page principale */
        margin-top: 20px;
    }

    form {
        background-color: #162447; /* Fond sombre similaire à celui des unités */
        padding: 20px;
        border-radius: 10px;
        margin: 0 auto;
        width: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    label {
        font-size: 16px;
        color: #e94560;
        display: block;
        margin: 10px 0 5px;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #e94560;
        border-radius: 5px;
        background-color: #1f4068;
        color: #ffffff;
        font-size: 16px;
    }

    input[type="checkbox"] {
        margin: 10px 5px;
    }

    button[type="submit"] {
        background-color: #e94560; /* Couleur de bouton similaire */
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
    }

    button[type="submit"]:hover {
        background-color: #d83652; /* Légère variation au survol */
    }

    a {
        display: block;
        text-align: center;
        color: #e94560;
        text-decoration: none;
        margin-top: 20px;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
