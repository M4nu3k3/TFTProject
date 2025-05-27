<?php
namespace Models;
use PDO;
class UnitDAO extends BasePDODAO
{
    private $pdo;

    public function __construct()
    {
        // Connexion à la base de données (ajuste tes paramètres ici)
        $this->pdo = new \PDO('mysql:host=localhost;dbname=tft_tp', 'root', '');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function getAll(): array
    {
        $sql = "SELECT * FROM unit";
        $etat = $this->execRequest($sql);
        $r = $etat->fetchAll();
        $result = [];
        foreach ($r as $unit) {
            array_push($result, new Unit($unit));
        }
        return $result;
    }

    public function getByID(string $id): ?Unit
    {
        $sql = "SELECT * FROM unit WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $r = $stmt->fetch();
        if (!$r) {
            return null;
        }
        return new Unit($r);
    }

    public function delete(int $id): void
    {
        // Supprimer les liens dans la table unit_origin d'abord
        $sql = "DELETE FROM unitorigin WHERE id_unit = ?";
        $this->execRequest($sql, [$id]);

        // Puis supprimer l'unité dans la table unit
        $sql = "DELETE FROM unit WHERE id = ?";
        $this->execRequest($sql, [$id]);
    }

    public function addUnit(Unit $unit): void
    {
        try {
            // Démarrer une transaction
            $this->pdo->beginTransaction();

            // Étape 1 : Insérer l'unité dans la table `unit`
            $sqlUnit = "INSERT INTO unit (name, cost, url_img) VALUES (?, ?, ?)";
            $stmtUnit = $this->pdo->prepare($sqlUnit);
            $stmtUnit->execute([
                $unit->getName(),
                $unit->getCost(),
                $unit->getUrlImg()
            ]);

            // Récupérer l'ID de l'unité insérée
            $id_unit = $this->pdo->lastInsertId();

            // Étape 2 : Insérer les relations dans la table `unitorigin`
            $sqlOrigin = "INSERT INTO unitorigin (id_unit, id_origin) VALUES (?, ?)";
            $stmtOrigin = $this->pdo->prepare($sqlOrigin);

            // Parcourir les origines de l'unité pour insérer les relations
            foreach ($unit->getOrigins() as $origin) {
                $id_origin = $origin->getId();
                $stmtOrigin->execute([$id_unit, $id_origin]);
            }

            // Valider la transaction
            $this->pdo->commit();

        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            $this->pdo->rollBack();
            throw $e; // Relancer l'exception
        }
    }



    public function searchMultipleFields(?string $name, ?string $cost, ?string $origin): array {
        // Construction de la requête SQL
        $sql = "
        SELECT 
            u.id AS unit_id,
            u.name AS unit_name,
            u.cost AS unit_cost,
            u.url_img AS unit_url_img,
            GROUP_CONCAT(o.name SEPARATOR ', ') AS origins
        FROM unit u
        LEFT JOIN unitorigin uo ON u.id = uo.id_unit
        LEFT JOIN origin o ON uo.id_origin = o.id
        WHERE 1=1
    ";

        // Construction des paramètres dynamiques
        $params = [];
        if ($name) {
            $sql .= " AND u.name LIKE ?";
            $params[] = "%" . $name . "%";
        }
        if ($cost) {
            $sql .= " AND u.cost LIKE ?";
            $params[] = "%" . $cost . "%";
        }
        if ($origin) {
            $sql .= " AND o.name LIKE ?";
            $params[] = "%" . $origin . "%";
        }

        $sql .= " GROUP BY u.id"; // Groupement par unité

        // Exécution de la requête
        $stmt = $this->execRequest($sql, $params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Transformation des résultats en objets Unit
        $units = [];
        foreach ($results as $row) {
            // Création des objets Origin
            $originNames = explode(', ', $row['origins']);
            $origins = [];
            foreach ($originNames as $originName) {
                if (!empty($originName)) {
                    $origins[] = new \Models\Origin(['name' => $originName]);
                }
            }

            // Création de l'objet Unit
            $unitData = [
                'id' => $row['unit_id'],
                'name' => $row['unit_name'],
                'cost' => $row['unit_cost'],
                'url_img' => $row['unit_url_img'],
                'origins' => $origins, // Ajout des objets Origin
            ];

            $units[] = new \Models\Unit($unitData);
        }

        return $units;
    }







    public function update(int $id, string $name, float $cost, array $origins, string $url_img): void {
        // Mise à jour de l'unité dans la table unit
        $sql = "UPDATE unit SET name = ?, cost = ?, url_img = ? WHERE id = ?";
        $this->execRequest($sql, [$name, $cost, $url_img, $id]);

        // Suppression des anciennes origines associées à cette unité
        $deleteOriginsSql = "DELETE FROM unitorigin WHERE id_unit = ?";
        $this->execRequest($deleteOriginsSql, [$id]);

        // Ajout des nouvelles origines sélectionnées
        foreach ($origins as $origin) {
            $insertSql = "INSERT INTO unitorigin (id_unit, id_origin) VALUES (?, ?)";
            $this->execRequest($insertSql, [$id, $origin]);
        }
    }

    public function getAllOrigins(): array {
        // SQL pour récupérer toutes les origines
        $sql = "SELECT * FROM origin";  // Remplace "origin" par le nom de ta table qui contient les origines
        $stmt = $this->execRequest($sql);  // Exécuter la requête avec PDO

        // Récupérer tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllUnitsWithOrigins(): array {
        $sql = "SELECT id FROM UNIT";
        $stmt = $this->execRequest($sql);
        $unitIds = $stmt->fetchAll(PDO::FETCH_COLUMN); // Récupère les IDs des unités

        $unitsWithOrigins = [];

        foreach ($unitIds as $id) {
            // Récupérer l'objet Unit via getById
            $unit = $this->getById($id);

            // Récupérer les origines associées
            $origins = $this->getOriginsByUnitId($id);

            // Définir les origines dans l'objet Unit
            $unit->setOrigins($origins);

            // Ajouter l'objet Unit complet à la liste
            $unitsWithOrigins[] = $unit;

            // Debug temporaire

        }

        return $unitsWithOrigins;
    }




    public function getOriginsByUnitId(int $unitId): array {
        $sql = "
        SELECT o.id, o.name, o.url_img 
        FROM origin o
        JOIN unitorigin uo ON o.id = uo.id_origin
        WHERE uo.id_unit = ?
    ";
        $stmt = $this->execRequest($sql, [$unitId]);
        $originRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $origins = [];
        foreach ($originRows as $row) {
            $origins[] = new \Models\Origin([
                'id' => $row['id'],
                'name' => $row['name'],
                'url_img' => $row['url_img'],
            ]);
        }

        return $origins;
    }


}


