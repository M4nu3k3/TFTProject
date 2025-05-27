<h1>Recherche d'unités</h1>

<!-- Formulaire de recherche -->
<form method="POST" action="index.php?action=search" class="search-form">
    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($name ?? '') ?>">

    <label for="cost">Coût :</label>
    <input type="number" name="cost" id="cost" value="<?= htmlspecialchars($cost ?? '') ?>">

    <label for="origin">Origine :</label>
    <input type="text" name="origin" id="origin" value="<?= htmlspecialchars($origin ?? '') ?>">

    <button type="submit">Rechercher</button>
</form>

<!-- Affichage des résultats -->
<?php if (!empty($results)): ?>
    <h2>Résultats de la recherche :</h2>
    <ul class="search-results">
        <?php foreach ($results as $unit): ?>
            <li class="unit-item">
                <?= htmlspecialchars($unit->getName()) ?> - <?= htmlspecialchars($unit->getCost()) ?> -
                <?php
                $origins = $unit->getOrigins(); // On récupère les origines
                $originNames = [];
                foreach ($origins as $origin) { // Parcourt chaque origine
                    $originNames[] = $origin->getName(); // Récupère le nom de chaque origine
                }
                echo htmlspecialchars(implode(', ', $originNames)); // Concatène les noms des origines
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php elseif (isset($results)): ?>
    <p>Aucun résultat trouvé.</p>
<?php endif; ?>

<!-- Lien retour à l'accueil -->
<a href="index.php" class="back-link">Retour à l'accueil</a>

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

    .search-form {
        background-color: #162447; /* Fond sombre pour le formulaire */
        padding: 20px;
        border-radius: 10px;
        width: 50%;
        margin: 20px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .search-form label {
        display: block;
        margin-top: 10px;
    }

    .search-form input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        background-color: #1f4068;
        color: #ffffff;
        border: none;
        border-radius: 5px;
    }

    .search-form button[type="submit"] {
        background-color: #e94560; /* Bouton avec la couleur accent */
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 15px;
    }

    .search-form button[type="submit"]:hover {
        background-color: #d83652; /* Changement de couleur au survol */
    }

    .search-results {
        list-style-type: none;
        padding: 0;
        margin-top: 20px;
    }

    .unit-item {
        background-color: #162447;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .back-link {
        display: block;
        margin-top: 20px;
        color: #e94560;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>
