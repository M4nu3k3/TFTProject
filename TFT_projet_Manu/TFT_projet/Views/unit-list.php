<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a202c;
            color: white;
            font-family: Arial, sans-serif;
        }
        .unit-card {
            background-color: #2d3748;
            border-radius: 10px;
            padding: 15px;
            margin: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .unit-card img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }
        .unit-card .unit-name {
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 10px;
        }
        .unit-card .unit-cost {
            font-size: 1.2em;
            color: gold;
            font-weight: bold;
        }
        .origin-icon {
            width: 30px;
            height: 30px;
            margin-right: 5px;
        }
        .origin-name {
            font-size: 1.1em;
        }
        .origin-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <?php foreach ($units as $unit): ?>
            <div class="col-md-4">
                <div class="unit-card">
                    <!-- Image du personnage -->
                    <img src="<?= htmlspecialchars($unit->getUrlImg()) ?>" alt="<?= htmlspecialchars($unit->getName()) ?>">

                    <!-- Nom du personnage -->
                    <div class="unit-name">
                        <?= htmlspecialchars($unit->getName()) ?>
                    </div>

                    <!-- Origines -->
                    <div class="origin-container">
                        <?php foreach ($unit->getOrigins() as $origin): ?>
                            <img class="origin-icon" src="<?= htmlspecialchars($origin->getUrlImg()) ?>" alt="<?= htmlspecialchars($origin->getName()) ?>">
                            <span class="origin-name"><?= htmlspecialchars($origin->getName()) ?></span>
                        <?php endforeach; ?>
                    </div>

                    <!-- Coût -->
                    <div class="unit-cost">
                        <?= htmlspecialchars($unit->getCost()) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
