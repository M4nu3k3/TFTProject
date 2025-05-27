<?php
namespace Models;

use PDO;
use Config\Config;
use PDOStatement;

class BasePDODAO {
    private static ?PDO $db = null;

    protected static function getDB(): PDO {
        if (self::$db === null) {
            $dsn = Config::get('dsn');
            $user = Config::get('user');
            $pass = Config::get('pass');
            self::$db = new PDO($dsn, $user, $pass);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$db;
    }

    protected function execRequest(string $sql, array $params = null): PDOStatement|false {
        $etat = self::getDB()->prepare($sql);
        $etat->execute($params);
        return $etat;
    }
}
