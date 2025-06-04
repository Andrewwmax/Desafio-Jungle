<?php

namespace App\Core\Contracts;

use App\Core\Cidadao;

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
