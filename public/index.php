<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\Controller\CidadaoController;

$controller = new CidadaoController();
$controller->handle();

?>