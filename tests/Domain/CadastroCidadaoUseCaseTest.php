<?php

use PHPUnit\Framework\TestCase;

use App\Domain\Cidadao;
use App\Domain\Services\NisGeneratorService;
use App\Domain\UseCases\CadastroCidadaoUseCase;
use App\Application\Contracts\CidadaoRepositoryInterface;

class FakeCidadaoRepository implements CidadaoRepositoryInterface {
    private array $data = [];

    public function salvar(Cidadao $cidadao): void {
        $this->data[$cidadao->getNis()] = $cidadao;
    }

    public function buscarPorNis(string $nis): ?Cidadao {
        return $this->data[$nis] ?? null;
    }
}

class CadastroCidadaoUseCaseTest extends TestCase {
    public function testCadastroDeCidadaoGeraNisValido() {
        $repo = new FakeCidadaoRepository();
        $nis = new NisGeneratorService($repo);

        $service = new CadastroCidadaoUseCase($repo, $nis);

        $cidadao = $service->cadastrar("Maria da Silva");

        $this->assertInstanceOf(Cidadao::class, $cidadao);
        $this->assertEquals("Maria da Silva", $cidadao->getNome());
        $this->assertMatchesRegularExpression('/^\d{11}$/', $cidadao->getNis());
    }
}
