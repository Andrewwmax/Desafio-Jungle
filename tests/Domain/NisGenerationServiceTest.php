<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Services\NisGeneratorService;
use App\Domain\Cidadao;
use App\Domain\UseCases\CadastroCidadaoUseCase;
use App\Application\Contracts\CidadaoRepositoryInterface;

class FakeRepositoryComConflito implements CidadaoRepositoryInterface {
    private array $nisRegistrados = [];

    public function salvar(Cidadao $cidadao): void {
        $this->nisRegistrados[$cidadao->getNis()] = $cidadao;
    }

    public function buscarPorNis(string $nis): ?Cidadao {
        return $this->nisRegistrados[$nis] ?? null;
    }

    public function nisJaExiste(string $nis): bool {
        return isset($this->nisRegistrados[$nis]);
    }
}

class NisGenerationServiceTest extends TestCase {
    public function testNisEhGeradoComOnzeDigitos() {
        $repo = new FakeRepositoryComConflito();
        $nis = new NisGeneratorService($repo);
        $service = new CadastroCidadaoUseCase($repo, $nis);

        $cidadao = $service->cadastrar("Teste Nome");

        $nis = $cidadao->getNis();
        $this->assertMatchesRegularExpression('/^\d{11}$/', $nis);
    }

    public function testNisGeradoEhUnico() {
        $repo = new FakeRepositoryComConflito();
        $nis = new NisGeneratorService($repo);
        $service = new CadastroCidadaoUseCase($repo, $nis);

        $nises = [];

        for ($i = 0; $i < 100; $i++) {
            $cidadao = $service->cadastrar("Pessoa {$i}");
            $nis = $cidadao->getNis();

            $this->assertNotContains($nis, $nises, "NIS duplicado detectado");
            $nises[] = $nis;
        }
    }
}
