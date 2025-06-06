<?php

namespace App\Domain\UseCases;

use App\Domain\Cidadao;
use App\Application\Contracts\CidadaoRepositoryInterface;

class BuscarCidadaoPorNisUseCase {
    private CidadaoRepositoryInterface $repositorio;

    public function __construct(CidadaoRepositoryInterface $repositorio) {
        $this->repositorio = $repositorio;
    }

    /**
     * Busca um cidadão pelo número de NIS.
     *
     * @param string $nis
     * @return Cidadao|null
     */
    public function buscar(string $nis): ?Cidadao {
        return $this->repositorio->buscarPorNis($nis);
    }
}
