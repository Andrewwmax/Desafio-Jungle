<?php

namespace App\Domain\UseCases;

use App\Domain\Cidadao;
use App\Domain\Services\NisGeneratorService;
use App\Application\Contracts\CidadaoRepositoryInterface;

class CadastroCidadaoUseCase {
    private CidadaoRepositoryInterface $repositorio;
    private NisGeneratorService $geradorNis;

    public function __construct(
        CidadaoRepositoryInterface $repositorio,
        NisGeneratorService $geradorNis
    ) {
        $this->repositorio = $repositorio;
        $this->geradorNis = $geradorNis;
    }

    /**
     * Cadastra um novo cidadão com nome e NIS único.
     *
     * @param string $nome
     * @return Cidadao
     */
    public function cadastrar(string $nome): Cidadao {
        $nis = $this->geradorNis->gerarNisUnico();
        $cidadao = new Cidadao($nome, $nis);
        $this->repositorio->salvar($cidadao);
        return $cidadao;
    }
}
