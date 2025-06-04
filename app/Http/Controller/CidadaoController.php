<?php

namespace App\Http\Controller;

use App\Core\Services\CadastroCidadaoService;
use App\Core\Services\BuscarCidadaoPorNisService;

class CidadaoController {
    private CadastroCidadaoService $cadastroService;
    private BuscarCidadaoPorNisService $buscaService;

    public function __construct(
        CadastroCidadaoService $cadastroService,
        BuscarCidadaoPorNisService $buscaService
    ) {
        $this->cadastroService = $cadastroService;
        $this->buscaService = $buscaService;
    }

    public function cadastrar(array $request): void {
        $nome = trim($request['nome'] ?? '');

        if ($nome === '') {
            echo 'Nome é obrigatório.';
            return;
        }

        $cidadao = $this->cadastroService->cadastrar($nome);

        echo "Cidadão cadastrado com sucesso!<br>";
        echo "Nome: {$cidadao->getNome()}<br>";
        echo "NIS: {$cidadao->getNis()}<br>";
    }

    public function buscar(array $request): void {
        $nis = trim($request['nis'] ?? '');

        if ($nis === '') {
            echo 'NIS é obrigatório.';
            return;
        }

        $cidadao = $this->buscaService->buscar($nis);

        if ($cidadao === null) {
            echo "Cidadão não encontrado.";
        } else {
            echo "Cidadão encontrado:<br>";
            echo "Nome: {$cidadao->getNome()}<br>";
            echo "NIS: {$cidadao->getNis()}<br>";
        }
    }
}
