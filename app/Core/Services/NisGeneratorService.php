<?php

namespace App\Core\Services;

use App\Core\Contracts\CidadaoRepositoryInterface;

class NisGeneratorService {
    private CidadaoRepositoryInterface $repositorio;

    public function __construct(CidadaoRepositoryInterface $repositorio) {
        $this->repositorio = $repositorio;
    }

    /**
     * Gera um NIS único de 11 dígitos que ainda não exista no repositório.
     */
    public function gerarNisUnico(): string {
        do {
            $nis = $this->gerarNis();
        } while ($this->repositorio->buscarPorNis($nis) !== null);

        return $nis;
    }

    /**
     * Gera um número NIS aleatório com 11 dígitos.
     */
    private function gerarNis(): string {
        $numero = '';
        for ($i = 0; $i < 11; $i++) {
            $numero .= random_int(0, 9);
        }
        return $numero;
    }
}
