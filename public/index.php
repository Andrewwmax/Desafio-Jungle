<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Services\CadastroCidadaoService;
use App\Core\Services\BuscarCidadaoPorNisService;
use App\Core\Services\NisGeneratorService;
use App\Infrastructure\Repository\JsonCidadaoRepository;
use App\Http\Controller\CidadaoController;

// Criação manual das dependências
$repositorio = new JsonCidadaoRepository();
$nis = new NisGeneratorService($repositorio);
$cadastroService = new CadastroCidadaoService($repositorio, $nis);
$buscaService = new BuscarCidadaoPorNisService($repositorio);
$controller = new CidadaoController($cadastroService, $buscaService);

// Roteamento simples baseado em POST
$action = $_POST['action'] ?? null;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Cidadão</title>
</head>
<body>
    <h1>Cadastro de Cidadão</h1>
    <form method="POST">
        <input type="hidden" name="action" value="cadastrar">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Buscar Cidadão por NIS</h2>
    <form method="POST">
        <input type="hidden" name="action" value="buscar">
        <label>NIS:</label>
        <input type="text" name="nis" required>
        <button type="submit">Buscar</button>
    </form>

    <hr>

    <?php
    if ($action === 'cadastrar') {
        $controller->cadastrar($_POST);
    } elseif ($action === 'buscar') {
        $controller->buscar($_POST);
    }
    ?>
</body>
</html>
