<?php
namespace Controllers\Router;

abstract class Route {
    abstract public function get(array $params = []);
    abstract public function post(array $params = []);

    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true) {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new \Exception("Le paramètre '$paramName' est vide.");
            }
            return $array[$paramName];
        }
        throw new \Exception("Le paramètre '$paramName' est absent.");
    }
}

