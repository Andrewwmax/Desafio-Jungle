<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Http\Controller\CidadaoController;
use App\Domain\Services\NisGeneratorService;
use App\Domain\UseCases\CadastroCidadaoUseCase;
use App\Domain\UseCases\BuscarCidadaoPorNisUseCase;
use App\Infrastructure\Repository\JsonCidadaoRepository;

// Instanciação das dependências
$repo = new JsonCidadaoRepository(__DIR__ . '/../app/Storage/cidadaos.json');
$nis = new NisGeneratorService($repo);
$cadastroUseCase = new CadastroCidadaoUseCase($repo, $nis);
$buscarUseCase = new BuscarCidadaoPorNisUseCase($repo);
$controller = new CidadaoController($cadastroUseCase, $buscarUseCase);

// Variáveis para controle da view
$view = 'cidadao/formulario.php';
$data = null;

// Lógica principal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
    $response = $controller->cadastrar($_POST['nome']);
    $view = 'cidadao/sucesso.php';
    $data = $response;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nis'])) {
    $response = $controller->buscarPorNis($_GET['nis']);
    $view = 'cidadao/resultado.php';
    $data = $response;
}

// Renderização da view
include __DIR__ . '/../views/layouts/base.php';
