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

    /**
     * Salva um objeto Cidadao no arquivo JSON.
     * Se o cidadão já existir (baseado no NIS), ele será atualizado.
     *
     * @param Cidadao $cidadao O objeto Cidadao a ser salvo.
     */
    public function salvar(Cidadao $cidadao): void {
        $dados = $this->carregarDados();
        $dados[$cidadao->getNis()] = [
            'nome' => $cidadao->getNome(),
            'nis' => $cidadao->getNis(),
        ];

        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    /**
     * Busca um cidadão pelo seu NIS.
     *
     * @param string $nis O NIS do cidadão a ser buscado.
     * @return Cidadao|null O objeto Cidadao encontrado ou null se não existir.
     */
    public function buscarPorNis(string $nis): ?Cidadao {
        $dados = $this->carregarDados();

        if (isset($dados[$nis])) {
            return new Cidadao($dados[$nis]['nome'], $dados[$nis]['nis']);
        }

        return null;
    }

    /**
     * Carrega os dados do arquivo JSON.
     *
     * @return array Um array associativo contendo os dados dos cidadãos.
     */
    private function carregarDados(): array {
        $conteudo = file_get_contents($this->arquivo);
        return json_decode($conteudo, true) ?? [];
    }
}
