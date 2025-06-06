<?php

namespace App\Application\Contracts;

use App\Domain\Cidadao;

interface CidadaoRepositoryInterface{
    /**
     * Persiste um cidadão.
     */
    public function salvar(Cidadao $cidadao): void;

    /**
     * Busca um cidadão pelo NIS. Retorna null se não encontrado.
     */
    public function buscarPorNis(string $nis): ?Cidadao;
}
