<?php

namespace App\Http\Controller;

use App\Core\Services\CadastroCidadaoService;
use App\Core\Services\BuscarCidadaoPorNisService;
use App\Core\Services\NisGeneratorService;
use App\Infrastructure\Repository\JsonCidadaoRepository;

class CidadaoController
{
    private CadastroCidadaoService $cadastroService;
    private BuscarCidadaoPorNisService $buscaService;
    private NisGeneratorService $nisService;

    public function __construct() {
        $repositorio = new JsonCidadaoRepository();
        $nis = new NisGeneratorService($repositorio);
        $this->cadastroService = new CadastroCidadaoService($repositorio, $nis);
        $this->buscaService = new BuscarCidadaoPorNisService($repositorio);
    }
    public function handle(): void {
        $action = $_POST['action'] ?? null;

        if ($action === 'cadastrar' && isset($_POST['nome'])) {
            
            $nome = trim($_POST['nome']);
            if (empty($nome)) {
                $this->render('cidadao/formulario', 'Cadastro de Cidadão', [
                    'erro' => 'Nome é obrigatório.',
                ]);
                return;
            }
            $cidadao = $this->cadastroService->cadastrar($nome);

            if ($this->isAjax()) {
                $this->responderJson(['status' => 'success', 'mensagem' => "NIS gerado: {$cidadao->getNis()}"]);
                return;
            }

            $this->render('cidadao/formulario', 'Cadastro realizado', [
                'mensagem' => "NIS gerado: {$cidadao->getNis()}",
            ]);
            return;
        }

        if ($action === 'buscar' && isset($_POST['nis'])) {
            $nis = trim($_POST['nis']);
            $cidadao = $this->buscaService->buscar($nis);

            if ($this->isAjax()) {
                if ($cidadao) {
                    $this->responderJson(['cidadao' => [
                        'nome' => $cidadao->getNome(),
                        'nis' => $cidadao->getNis()
                    ]]);
                } else {
                    $this->responderJson(['cidadao' => null]);
                }
                return;
            }

            $mensagem = $cidadao
                ? "Cidadão: {$cidadao->getNome()} — NIS: {$cidadao->getNis()}"
                : "Cidadão não encontrado.";

            $this->render('cidadao/formulario', 'Resultado da busca',[
                'mensagem' => $mensagem,
            ]);
            return;
        }

        $this->render('cidadao/formulario');
    }

    private function isAjax(): bool {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    private function responderJson(array $data): void {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    private function render(string $viewPath, string $title = '', array $params = []): void {
        extract($params); // Transforma array ['nis' => 123] em variável $nis = 123

        $view = __DIR__ . '/../../../views/' . $viewPath . '.php';
        $layout = __DIR__ . '/../../../views/layouts/base.php';

        if (!file_exists($view) || !file_exists($layout)) {
            http_response_code(500);
            echo "Erro ao renderizar view: arquivos não encontrados.";
            return;
        }

        include $layout;
    }

}
