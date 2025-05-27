<?php
const BASE_URL = '/TFT_projet/';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une origine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #1a1a2e; /* Fond sombre */
            color: #ffffff; /* Texte en blanc */
        }

        h1 {
            color: #e94560; /* Couleur accent */
            text-align: center;
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 20px auto;
            background: #162447; /* Fond pour le formulaire */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #ffffff; /* Texte des labels en blanc */
        }

        input {
            margin-bottom: 15px;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #1f4068; /* Fond sombre pour les champs */
            color: #ffffff; /* Texte blanc pour les champs */
        }

        button {
            padding: 10px;
            font-size: 16px;
            color: #ffffff;
            background-color: #e94560; /* Bouton avec couleur accent */
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        button:hover:enabled {
            background-color: #d83652; /* Couleur plus foncée au survol */
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #e94560; /* Lien en couleur accent */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Ajouter une origine</h1>

<!-- Formulaire pour ajouter une origine -->
<form method="POST" action="<?= BASE_URL ?>index.php?action=add-origin" oninput="checkForm()">
    <!-- Nom de l'origine -->
    <label for="name">Nom de l'origine :</label>
    <input type="text" id="name" name="name" placeholder="Entrez le nom de l'origine" required>

    <!-- URL de l'image -->
    <label for="url_img">URL de l'image :</label>
    <input type="text" id="url_img" name="url_img" placeholder="Entrez l'URL de l'image" required>

    <!-- Bouton de soumission -->
    <button type="submit" id="submitButton" disabled>Ajouter l'origine</button>
</form>

<!-- Lien retour à l'accueil -->
<a href="<?= BASE_URL ?>index.php">Retour à l'accueil</a>

<script>
    // Fonction pour activer/désactiver le bouton en fonction des champs remplis
    function checkForm() {
        const nameField = document.getElementById('name');
        const urlField = document.getElementById('url_img');
        const submitButton = document.getElementById('submitButton');

        if (nameField.value.trim() !== '' && urlField.value.trim() !== '') {
            submitButton.disabled = false; // Active le bouton
        } else {
            submitButton.disabled = true; // Désactive le bouton
        }
    }
</script>

</body>
</html>
