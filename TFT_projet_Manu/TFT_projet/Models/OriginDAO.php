<?php
namespace Models;
use PDO;
class OriginDAO extends BasePDODAO {
    public function getAll(): array {
        $sql = "SELECT * FROM ORIGIN";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Origin::class);
    }

    public function getByUnitId(string $unitId): array {
        $sql = "SELECT o.* FROM ORIGIN o 
                JOIN UNITORIGIN uo ON o.id = uo.id_origin 
                WHERE uo.id_unit = ?";
        $stmt = $this->execRequest($sql, [$unitId]);
        $origins = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $origins[] = new Origin($row);
        }
        return $origins;
    }

    public function addOrigin(string $name, string $url_img): void {
        $sql = "INSERT INTO origin (name, url_img) VALUES (?, ?)";
        $this->execRequest($sql, [$name, $url_img]);
    }

    public function getById(string $id): ?Origin {
        $sql = "SELECT * FROM ORIGIN WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $origin = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Origin($origin);
    }

}
