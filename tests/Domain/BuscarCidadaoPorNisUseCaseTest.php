<?php

use PHPUnit\Framework\TestCase;

use App\Domain\Cidadao;
use App\Domain\UseCases\BuscarCidadaoPorNisUseCase;
use App\Application\Contracts\CidadaoRepositoryInterface;

class FakeCidadaoRepositoryForBusca implements CidadaoRepositoryInterface {
    private array $data = [];

    public function salvar(Cidadao $cidadao): void     {
        $this->data[$cidadao->getNis()] = $cidadao;
    }

    public function buscarPorNis(string $nis): ?Cidadao {
        return $this->data[$nis] ?? null;
    }

    // Método auxiliar só para testes
    public function inserirFake(Cidadao $cidadao): void {
        $this->salvar($cidadao);
    }
}

class BuscarCidadaoPorNisUseCaseTest extends TestCase {
    public function testDeveRetornarCidadaoSeExistir() {
        $repo = new FakeCidadaoRepositoryForBusca();
        $cidadao = new Cidadao("João da Silva", "12345678901");

        $repo->inserirFake($cidadao);

        $service = new BuscarCidadaoPorNisUseCase($repo);
        $resultado = $service->buscar("12345678901");

        $this->assertInstanceOf(Cidadao::class, $resultado);
        $this->assertEquals("João da Silva", $resultado->getNome());
        $this->assertEquals("12345678901", $resultado->getNis());
    }

    public function testDeveRetornarNullSeCidadaoNaoExistir() {
        $repo = new FakeCidadaoRepositoryForBusca();
        $service = new BuscarCidadaoPorNisUseCase($repo);

        $resultado = $service->buscar("00000000000");

        $this->assertNull($resultado);
    }
}
