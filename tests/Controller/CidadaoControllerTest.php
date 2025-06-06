<?php

use PHPUnit\Framework\TestCase;

use App\Domain\Cidadao;
use App\Http\Controller\CidadaoController;
use App\Domain\UseCases\CadastroCidadaoUseCase;
use App\Domain\UseCases\BuscarCidadaoPorNisUseCase;

class CidadaoControllerTest extends TestCase {
    public function testCadastrarComSucesso() {
        // Arrange
        $mockCadastroUseCase = $this->createMock(CadastroCidadaoUseCase::class);
        $mockBuscarUseCase = $this->createMock(BuscarCidadaoPorNisUseCase::class);

        $cidadao = new Cidadao('Fulano', '12345678901');

        $mockCadastroUseCase->method('cadastrar')
            ->willReturn($cidadao);

        $controller = new CidadaoController($mockCadastroUseCase, $mockBuscarUseCase);

        // Act
        $response = $controller->cadastrar('Fulano');

        // Assert
        $this->assertTrue($response['success']);
        $this->assertEquals('Cadastro realizado com sucesso!', $response['message']);
        $this->assertEquals('12345678901', $response['nis']);
    }

    public function testCadastrarComErro() {
        // Arrange
        $mockCadastroUseCase = $this->createMock(CadastroCidadaoUseCase::class);
        $mockBuscarUseCase = $this->createMock(BuscarCidadaoPorNisUseCase::class);

        $mockCadastroUseCase->method('cadastrar')
            ->willThrowException(new Exception('Erro de teste'));

        $controller = new CidadaoController($mockCadastroUseCase, $mockBuscarUseCase);

        // Act
        $response = $controller->cadastrar('Fulano');

        // Assert
        $this->assertFalse($response['success']);
        $this->assertStringContainsString('Erro ao cadastrar cidadão', $response['message']);
        $this->assertNull($response['nis']);
    }

    public function testBuscarPorNisEncontrado() {
        // Arrange
        $mockCadastroUseCase = $this->createMock(CadastroCidadaoUseCase::class);
        $mockBuscarUseCase = $this->createMock(BuscarCidadaoPorNisUseCase::class);

        $cidadao = new Cidadao('Ciclano', '98765432109');

        $mockBuscarUseCase->method('buscar')
            ->with('98765432109')
            ->willReturn($cidadao);

        $controller = new CidadaoController($mockCadastroUseCase, $mockBuscarUseCase);

        // Act
        $response = $controller->buscarPorNis('98765432109');

        // Assert
        $this->assertTrue($response['found']);
        $this->assertEquals('Cidadão encontrado: Ciclano', $response['message']);
        $this->assertEquals('Ciclano', $response['nome']);
        $this->assertEquals('98765432109', $response['nis']);
    }

    public function testBuscarPorNisNaoEncontrado() {
        // Arrange
        $mockCadastroUseCase = $this->createMock(CadastroCidadaoUseCase::class);
        $mockBuscarUseCase = $this->createMock(BuscarCidadaoPorNisUseCase::class);

        $mockBuscarUseCase->method('buscar')
            ->with('00000000000')
            ->willReturn(null);

        $controller = new CidadaoController($mockCadastroUseCase, $mockBuscarUseCase);

        // Act
        $response = $controller->buscarPorNis('00000000000');

        // Assert
        $this->assertFalse($response['found']);
        $this->assertEquals('Cidadão não encontrado', $response['message']);
        $this->assertNull($response['nome']);
        $this->assertNull($response['nis']);
    }
}
