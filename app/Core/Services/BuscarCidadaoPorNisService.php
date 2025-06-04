<?php

namespace App\Core\Services;

use App\Core\Cidadao;
use App\Core\Contracts\CidadaoRepositoryInterface;

class BuscarCidadaoPorNisService {
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
