<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
</head>
<body>
    <h1>Confirmation</h1>
    <p><?= isset($message) ? htmlspecialchars($message) : "Action réalisée avec succès." ?></p>
<a href="/index.php">Retour à l'accueil</a>
</body>
</html>
