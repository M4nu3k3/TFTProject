<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour réussie</title>
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
            text-align: center;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-top: 50px;
        }

        p {
            font-size: 18px;
            margin: 20px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: var(--link-color);
            text-decoration: none;
            font-size: 18px;
        }

        a:hover {
            text-decoration: underline;
            color: var(--link-color-hover);
        }

        .message-container {
            background-color: var(--secondary-color);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 50px auto;
            max-width: 600px;
        }

        .message-container p {
            font-size: 20px;
            color: var(--text-color);
        }

        .message-container a {
            background-color: var(--button-bg);
            padding: 10px 20px;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
        }

        .message-container a:hover {
            background-color: var(--button-bg-hover);
        }
    </style>
</head>
<body>

<div class="message-container">
    <h1>Mise à jour réussie</h1>
    <p>L'unité a été mise à jour avec succès.</p>
    <a href="index.php">Retour à l'accueil</a>
</div>

</body>
</html>
