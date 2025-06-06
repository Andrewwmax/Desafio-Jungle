<?php

use PHPUnit\Framework\TestCase;

use App\Domain\Cidadao;
use App\Infrastructure\Repository\JsonCidadaoRepository;

class JsonCidadaoRepositoryTest extends TestCase
{
    private string $arquivoTeste;
    private JsonCidadaoRepository $repo;

    protected function setUp(): void
    {
        $this->arquivoTeste = __DIR__ . '/cidadaos_test.json';

        // Garante que o arquivo começa limpo
        if (file_exists($this->arquivoTeste)) {
            unlink($this->arquivoTeste);
        }

        $this->repo = new JsonCidadaoRepository($this->arquivoTeste);
    }

    protected function tearDown(): void
    {
        // Limpa o arquivo após os testes
        if (file_exists($this->arquivoTeste)) {
            unlink($this->arquivoTeste);
        }
    }

    public function testSalvarEBuscarCidadao()
    {
        $cidadao = new Cidadao('Teste Usuário', '99999999999');

        $this->repo->salvar($cidadao);

        $resultado = $this->repo->buscarPorNis('99999999999');

        $this->assertNotNull($resultado);
        $this->assertEquals('99999999999', $resultado->getNis());
        $this->assertEquals('Teste Usuário', $resultado->getNome());
    }

    public function testBuscarCidadaoInexistente()
    {
        $resultado = $this->repo->buscarPorNis('00000000000');

        $this->assertNull($resultado);
    }
}
