<?php

namespace App\Http\Controller;

use App\Domain\UseCases\CadastroCidadaoUseCase;
use App\Domain\UseCases\BuscarCidadaoPorNisUseCase;

class CidadaoController {
    private CadastroCidadaoUseCase $cadastroCidadaoUseCase;
    private BuscarCidadaoPorNisUseCase $buscarCidadaoPorNisUseCase;

    public function __construct(
        CadastroCidadaoUseCase $cadastroCidadaoUseCase,
        BuscarCidadaoPorNisUseCase $buscarCidadaoPorNisUseCase
    ) {
        $this->cadastroCidadaoUseCase = $cadastroCidadaoUseCase;
        $this->buscarCidadaoPorNisUseCase = $buscarCidadaoPorNisUseCase;
    }

    /**
     * Processa o cadastro de um cidadão.
     * @param string $nome
     * @return array ['success' => bool, 'message' => string, 'nis' => string|null]
     */
    public function cadastrar(string $nome): array {
        try {
            $cidadao = $this->cadastroCidadaoUseCase->cadastrar($nome);
            return [
                'success' => true,
                'message' => 'Cadastro realizado com sucesso!',
                'nis' => $cidadao->getNis(),
                'nome' => $cidadao->getNome()
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Erro ao cadastrar cidadão: ' . $e->getMessage(),
                'nis' => null
            ];
        }
    }

    /**
     * Busca um cidadão pelo NIS.
     * @param string $nis
     * @return array ['found' => bool, 'message' => string, 'nome' => string|null, 'nis' => string|null]
     */
    public function buscarPorNis(string $nis): array {
        $cidadao = $this->buscarCidadaoPorNisUseCase->buscar($nis);

        if ($cidadao) {
            return [
                'found' => true,
                'message' => 'Cidadão encontrado: ' . $cidadao->getNome(),
                'nome' => $cidadao->getNome(),
                'nis' => $cidadao->getNis()
            ];
        }

        return [
            'found' => false,
            'message' => 'Cidadão não encontrado',
            'nome' => null,
            'nis' => null
        ];
    }
}
