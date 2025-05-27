<?php
require_once 'Helpers/Psr4AutoloaderClass.php';
use Controllers\MainController;
use Helpers\Psr4AutoloaderClass;
use \Controllers\Router\Router;


$loader = new Psr4AutoloaderClass();
$loader->register();
$loader->addNamespace('\Helpers', '/Helpers');
$loader->addNamespace('\League\Plates', '/Vendor/plates-3.5.0/src');
$loader->addNamespace('\Controllers', '/Controllers');
$loader->addNamespace('\Config', '/Config');
$loader->addNamespace('\Models', '/Models');
$loader->addNamespace('\Controllers\Router', '/Controllers/Router');
$loader->addNamespace('\Controllers\Router\Routes', '/Controllers/Router/Routes');




$router = new Router();
$router->routing($_GET, $_POST);

if (isset($_GET['message']) && $_GET['message'] === 'unite_supprimee') {
    echo "<p style='color: green;'>L'unité a été supprimée avec succès.</p>";
}
?>

