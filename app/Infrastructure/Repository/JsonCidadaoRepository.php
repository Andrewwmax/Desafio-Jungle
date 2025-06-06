<?php

namespace App\Infrastructure\Repository;

use App\Domain\Cidadao;
use App\Application\Contracts\CidadaoRepositoryInterface;

class JsonCidadaoRepository implements CidadaoRepositoryInterface {
    private string $arquivo;

    public function __construct(string $arquivo = __DIR__ . '/../../Storage/cidadaos.json') {
        $this->arquivo = $arquivo;

        if (!file_exists($this->arquivo)) {
            file_put_contents($this->arquivo, json_encode([]));
        }
    }

    public function salvar(Cidadao $cidadao): void {
        $dados = $this->carregarDados();
        $dados[$cidadao->getNis()] = [
            'nome' => $cidadao->getNome(),
            'nis' => $cidadao->getNis(),
        ];

        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    public function buscarPorNis(string $nis): ?Cidadao {
        $dados = $this->carregarDados();

        if (isset($dados[$nis])) {
            return new Cidadao($dados[$nis]['nome'], $dados[$nis]['nis']);
        }

        return null;
    }

    private function carregarDados(): array {
        $conteudo = file_get_contents($this->arquivo);
        return json_decode($conteudo, true) ?? [];
    }
}
